<?php

//open section
session_start();

//load config
require_once('../config.php');

//carrega todas as classes do projeto
require_once('../vendor/autoload.php');

//carrega as rotas
require_once('../core/routes.php');
