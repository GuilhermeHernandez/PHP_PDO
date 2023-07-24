<?php 

namespace Ghzferna\BdPhp\Infrastructure\Persistence;

use PDO;

// METODO DE CRIAÇÃO ESTATICA - Static Creation Method
// RETORNAR UM UNICO OBJETO SEM A CRIAÇÃO DELE 

class ConnectionCreator
{
    public static function createConnection() : PDO
    {
        $dbPath = __DIR__ . '/../../../banco.sqlite';
        $pdo = new PDO('sqlite' . $dbPath);

        return $pdo;
    }
}