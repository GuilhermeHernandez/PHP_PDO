<?php

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

#$pdo->exec('DROP TABLE phone;');
#exit();

$pdo -> exec("INSERT INTO phone (area_code,number,student_id) VALUES ('11','123451112',1),('11','95656521',2);");
echo 'Inseri'. PHP_EOL;
exit();

$sqlCreateTable = 'CREATE TABLE if NOT EXISTS students 
    (id INTEGER PRIMARY KEY ,
    name TEXT ,
    birth_date TEXT);

    CREATE TABLE if NOT EXISTS phone 
    (id INTEGER PRIMARY KEY ,
    area_code TEXT ,
    number TEXT,
    student_id INTEGER ,
    FOREIGN KEY(student_id) REFERENCES students(id))
';

$pdo->exec($sqlCreateTable);

echo "Tabelas criadas" . PHP_EOL;