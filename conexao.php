<?php 

require_once 'vendor/autoload.php';

use Ghzferna\BdPhp\Infrastructure\Persistence\ConnectionCreator;
// ----------------> PARTE 1 : CONEXÃO 
//FAZENDO CONEXÃO COM BD
//1 - STRING DE CONEXÃO - > QUAL DRIVE VAMOS ULTILIZAR : DETALHES ESPECIFICOS DO BD
    // NO CASO DO SQLITE SÓ INFORMAMOS O CAMINHO 
//2 - USUARIO
//3 - SENHA 

// REGRA TER UM LOCAL RAIZ 
$pdo = ConnectionCreator::createConnection();

echo "Conectado !";

// ----------------> PARTE 2 : EXECUÇÃO -> CRIAÇÃO TABELA 
$pdo -> exec('CREATE TABLE students (id INTEGER PRIMARY KEY, name TEXT , birth_date TEXT)');
