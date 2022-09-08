<?php

use core\classes\Database;


//open section
session_start();

//load config
require_once('../config.php');

//carrega todas as classes do projeto
require_once('../vendor/autoload.php');

$bd = new Database();
$clientes = $bd->select("SELECT * FROM clientes");
echo '<pre>';
print_r($clientes);


