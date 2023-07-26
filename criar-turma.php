<?php

use Ghzferna\Pdo\Domain\Model\Student;
use Ghzferna\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Ghzferna\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

// realizo processos de definição da turma

$connection->beginTransaction();

$aStudent = new Student(
    null,
    'Guilherme Hernandez Batista',
    new DateTimeImmutable('1985-05-01'),
);
$studentRepository->save($aStudent);

$anotherStudent = new Student(
    null,
    'Leonardo Ferreira',
    new DateTimeImmutable('1985-05-01'),
);
$studentRepository->save($anotherStudent);

$connection->commit();