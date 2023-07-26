<?php

use Ghzferna\Pdo\Domain\Model\Student;
use Ghzferna\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();

$student = new Student(
    null,
    "Patricia Freitas",
    new \DateTimeImmutable('1986-10-25')
);

$name = $student->name();

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);";
$statement = $pdo->prepare($sqlInsert);

if ($statement === false){
    throw new RuntimeException("ERRO QUERY BANCO!" . PHP_EOL);
}

$statement->bindParam(':name', $student->name());
$statement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

if ($statement->execute()) {
    echo "Aluno incluído";
}
