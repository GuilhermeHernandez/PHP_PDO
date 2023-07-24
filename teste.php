<?php

use Ghzferna\BdPhp\Infrastructure\Repository\PdoStudentRepository;

function bancoAlunos(PdoStudentRepository $repositorio){
    $listaAluno = $repositorio ->studentsBirthAt(new \DateTimeImmutable('2001-04-18'));
}