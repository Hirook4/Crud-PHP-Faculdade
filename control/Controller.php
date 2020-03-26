<?php

require_once 'C:\xampp\htdocs\Projetos\CRUD\model\Filme.php';
require_once '../model/FilmeDao.php';

use model\Filme;
use model\FilmeDao;

$op = $_POST["operacao"];

switch ($op) {
    case 'insert':
        insert();
        break;
}

function insert(){

    $nome = $_POST["nome"];
    $genero = $_POST["genero"];

    $dao = new FilmeDao();
    $movie = new Filme();

    $movie->setNome($nome);
    $movie->setGenero($genero);
    $dao->insert($movie);
}