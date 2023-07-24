<?php

/*
DEFINIÇÃO DE ALGUM REPOSITORIO DE USUARIO

*/

namespace Ghzferna\BdPhp\Domain\Repository\StudentRepository;
use Ghzferna\BdPhp\Domain\Model\Student;

interface StudentRepository
{
    public function allStudents() : array ;

    public function studentsBirthAt(\DateTimeImmutable $birthData) : array ;

    public function saveStudent(Student $student) : bool ;

    public function removeStudent(Student $student) : bool ;
}