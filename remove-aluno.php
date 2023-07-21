<?php

require_once 'vendor/autoload.php';

$caminhoBD = __DIR__ . 'banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBD);

$sqlDelete = 'DELETE FROM students WHERE id = ?;';
$preparedStatement = $pdo -> prepare($sqlDelete);

$preparedStatement ->bindValue(1, 3,PDO::PARAM_INT);

if($preparedStatement ->execute()){
    echo "Usuario removido com sucesso !" . PHP_EOL;
}