<?php

require_once 'vendor/autoload.php';

$pdo = \Ghzferna\Pdo\Infrastructure\Persistence\ConnectionCreator::createConnection();

$preparedStatement = $pdo->prepare('DELETE FROM students WHERE id = ?;');
$preparedStatement->bindValue(1, 1, PDO::PARAM_INT);
var_dump($preparedStatement->execute());
