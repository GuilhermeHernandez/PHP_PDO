<?php

require_once 'vendor/autoload.php';

use Ghzferna\BdPhp\Infrastructure\Persistence\ConnectionCreator;


$pdo = ConnectionCreator::createConnection();

$sqlDelete = 'DELETE FROM students WHERE id = ?;';
$preparedStatement = $pdo -> prepare($sqlDelete);
$preparedStatement ->bindValue(1, 2,PDO::PARAM_INT);

if($preparedStatement ->execute()){
    echo "Usuario removido com sucesso !" . PHP_EOL;
}