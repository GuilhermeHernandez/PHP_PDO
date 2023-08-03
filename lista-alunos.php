<?php

use Ghzferna\Pdo\Domain\Model\Student;
use Ghzferna\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Ghzferna\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($pdo);



$statement = $pdo->query('SELECT * FROM students;');
$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
$studentList = $repository -> allStudents();

var_dump($studentList);
