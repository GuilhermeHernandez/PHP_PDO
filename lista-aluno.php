<?php

// CRIANDO CONEXÃO AO BANCO , JA TEMOS 1 ALUNO INSERIDO

use Ghzferna\BdPhp\Domain\Model\Student;
use Ghzferna\BdPhp\Infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();

// CRIANDO UMA CONSULTA 
$statement = $pdo ->query('SELECT * FROM students;');

// RETORNO É UM ARRAY ASSOCIATIVO ONDE A CHAVE É O NOME DA COLUNA (ID , NOME , BIRTH_DATE) E VALOR É O VALOR DA COLUNAS EM SI
// RETORNA TODA A CONSULTA (FETCHALL)
// RETORNA APENAS UM OBJETO DA CONSULTA (FETCH)

$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($studentDataList);
exit();

$studentList = [];

foreach ($studentDataList as $student) {
    $studentList[] = new Student (
        $student['id'],
        $student['name'],
        new \DateTimeImmutable($student['birth_date'])
    );
}

var_dump($studentList);