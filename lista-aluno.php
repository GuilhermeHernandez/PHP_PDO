<?php

// CRIANDO CONEXÃO AO BANCO , JA TEMOS 1 ALUNO INSERIDO

use Ghzferna\BdPhp\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . 'banco.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

// CRIANDO UMA CONSULTA 
$statement = $pdo ->query('SELECT * FROM students;');

// RETORNO É UM ARRAY ASSOCIATIVO ONDE A CHAVE É O NOME DA COLUNA (ID , NOME , BIRTH_DATE) E VALOR É O VALOR DA COLUNAS EM SI
// RETORNA TODA A CONSULTA (FETCHALL)
// RETORNA APENAS UM OBJETO DA CONSULTA (FETCH)

$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
$studentList = [];

foreach ($studentDataList as $student) {
    $studentList[] = new Student (
        $student['id'],
        $student['name'],
        new \DateTimeImmutable($student['birth_date'])
    );
}

var_dump($studentList);