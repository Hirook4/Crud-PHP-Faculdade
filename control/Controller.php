<?php

require_once 'C:\xampp\htdocs\Projetos\CRUD\model\Filme.php';
require_once '../model/FilmeDao.php';

use model\Filme;
use model\FilmeDao;

$op = $_REQUEST["operacao"];

switch ($op) {
    case 'insert':
        insert();
        header("Location: ../view/select.php");
        break;

    case 'update':
        update();
        header("Location: ../view/select.php");
        break;

    case 'delete':
        delete();
        header("Location: ../view/select.php");
        break;
}

function insert()
{
    $nome = $_POST["nome"];
    $genero = $_POST["genero"];

    $dao = new FilmeDao();
    $movie = new Filme();

    $movie->setNome($nome);
    $movie->setGenero($genero);
    $dao->insert($movie);
}

function update()
{
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];

    $filme = new Filme();
    $filme->setId($id);
    $filme->setNome($nome);
    $filme->setGenero($genero);

    $filmeDao = new FilmeDao();
    $filmeDao->update($filme);
}

function delete()
{

    $id = $_GET["id"];

    $filmeDao = new FilmeDao();
    $filmeDao->delete($id);
}
