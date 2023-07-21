<?php

use Ghzferna\BdPhp\Domain\Model\Student;

require_once 'vendor/autoload.php';

$dbPath = __DIR__ . 'banco.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);

$student = new Student(null,"Teste da silva",new \DateTimeImmutable('2003-04-18'));

// ? ? é para receber parametro de variaveis 
$sqlInsert = "INSERT INTO students (name,birth_date) VALUES (:name , :birth_date);";

//PREPARANDO UMA INSTRUÇÃO     
$statement = $pdo -> prepare($sqlInsert);

// NO PRIMEIRO PARAMETRO RETORNA UMA STRING
$statement ->bindValue(':name',$student->name());

// NO SEGUNDO RETORNA UMA DATA
$statement ->bindValue(':birth_date',$student->birth_date()->format('Y-m-d'));

if ($statement ->execute()){
    echo "Aluno incluido !" .PHP_EOL;
}

/*

EVITANDO ERRO DE SQL INJECT 

    - ADIONANDO PARAMENTRO 

*/