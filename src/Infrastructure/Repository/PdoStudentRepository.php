<?php

// É UMA FORMA DE ACESSAR OS DADOS 
// COM METODOS PUBLICOS QUE LEMBRA UMA COLEÇÃO , UMA LISTA 
// CRIAMOS UMA INTERFACE ABSTRATA 

namespace Ghzferna\BdPhp\Infrastructure\Repository;

use DateTimeImmutable;
use Ghzferna\BdPhp\Domain\Model\Student;
use Ghzferna\BdPhp\Domain\Repository\StudentRepository\StudentRepository;
use Ghzferna\BdPhp\Infrastructure\Persistence\ConnectionCreator;
use PDO;

class PdoStudentRepository implements StudentRepository
{

    private PDO $connection;

    public function __construct()
    {
        $this -> connection = ConnectionCreator::createConnection();
    }

    public function allStudents() : array 
    {
        $query = 'SELECT * FROM students;';
        $consult = $this -> connection -> query($query);

        return $this ->hydrateStudentList($consult);
    }

    public function studentsBirthAt(\DateTimeImmutable $birthData) : array 
    {
        $query = 'SELECT * FROM students WHERE birth_date = :birth_date;';
        $consult = $this -> connection -> prepare($query);
        $consult ->bindValue('birth_date',$birthData->format('Y-m-d'));
        // QUANDO CONTEM UM PREPATE STATEMENT PRECISA DO EXECUTE 
        $consult ->execute();

        return $this ->hydrateStudentList($consult);
    }

    public function hydrateStudentList(\PDOStatement $statement) : array
    {
        $studentDataLista = $statement -> fetchAll(PDO::FETCH_ASSOC);
        $studentDataLista = [];

        foreach ($studentDataLista as $studentData){
            $studentDataLista[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birth_date'])
            );
        }

        return $studentDataLista;
    }

    public function saveStudent(Student $student) : bool 
    {
        // SE FOR NULO ELE N EXISTE ENTÃO INSERE
        if($student -> id() === null){
            return $this -> insertStudent($student);
        }

        // SE NÃO FOR NULO ELE ATUALIZA
        return $this -> update($student);
    }

    public function insertStudent(Student $student) : bool
    {
        $insertQuery = 'INSERT INTO students (name,birth_date) VALUE (:name,:birth_date);';
        $insert = $this -> connection ->prepare($insertQuery);
        $insert -> bindValue(':name' , $student -> name());
        $insert -> bindValue(':birth_date' , $student -> birth_date()->format('Y-m-d'));
        $resultInsert = $insert -> execute();

        if ($resultInsert){
            $student ->defineId($this -> connection ->lastInsertId());
        }

        return $resultInsert;
    }

    public function update(Student $student) : bool
    {
        $updateQuery = 'UPDATE students SET name = :name , birth_date = :birth_date WHERE id = :id';
        $update = $this -> connection -> prepare($updateQuery);
        $update ->bindValue(':name' , $student ->name());
        $update ->bindValue(':birth_date' , $student -> birth_date());
        $update ->bindValue(':id' , $student ->id(),PDO::PARAM_INT);        

        return $update -> execute();
    }

    public function removeStudent(Student $student) : bool
    {
        $consult = $this -> connection -> prepare('DELETE FROM students WHERE id = ?;');
        $consult -> bindValue(1,$student->id(),PDO::PARAM_INT);
        

        return $consult -> execute();
    }
}