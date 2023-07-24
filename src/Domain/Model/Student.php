<?php

// 1 - PRIMEIRO SELECIONAR O NAMESPACE
namespace Ghzferna\BdPhp\Domain\Model;

// É UMA ENTIDADE UNICA NO BANCO DE DADOS 
class Student
{
    // ATRIBUTOS DA CLASSE QUE É OS MESMAS COLUNAS DA TABELA 
    private ?int $id;
    private string $name;
    private \DateTimeInterface $birth_date;

    public function __construct(?int $id,string $name,\DateTimeInterface $birth_date)
    {
        $this -> id = $id;
        $this -> name = $name;
        $this -> birth_date = $birth_date;
    }

    public function defineId(int $id) : void
    {
        if (!is_null($this ->id)){
            throw new \DomainException("Você só pode definir o ID uma vez");
        }

        $this -> id = $id;
    }

    public function id() : ?int
    {
        return $this -> id;
    }

    public function name() : string
    {
        return $this -> name;
    }

    public function changeName(string $newName) : void 
    {
        $this -> name = $newName;
    }

    public function birth_date() : \DateTimeInterface
    {
        return $this -> birth_date;
    }

    public function age() : int
    {
        return $this ->birth_date->
        diff(new \DateTimeImmutable())
        ->y;
    }
}