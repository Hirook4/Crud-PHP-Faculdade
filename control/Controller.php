<?php

require_once '../model/Filme.php';
require_once '../model/FilmeDao.php';

use model\Filme;
use model\FilmeDao;

$op = $_REQUEST["operacao"];

switch ($op) {
    case 'insert':
        insert();
        break;

    case 'update':
        update();
        break;

    case 'delete':
        delete();
        break;

    case 'select':
        select();
        break;

    case 'selectById':
        selectById();
        break;

    case 'selectByName':
        selectByName();
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
    $id = $_POST["id"];

    $filmeDao = new FilmeDao();
    $filmeDao->delete($id);
}

function select()
{
    $filmeDao = new FilmeDao();
    $movies = $filmeDao->select();
    echo convertToJson($movies);
}

function selectById()
{
    $id = $_POST['id'];
    $filmeDao = new FilmeDao();
    $movies = $filmeDao->selectById($id);
    echo convertToJson($movies);
}

function selectByName()
{
    $nome = $_POST['nome'];
    $filmeDao = new FilmeDao();
    $movies = $filmeDao->selectByName($nome);
    echo convertToJson($movies);
}

function convertToJson($movies)
{
    $filmes = array();

    foreach ($movies as $movieTMP) {
        $id = $movieTMP->getid();
        $nome = $movieTMP->getNome();
        $genero = $movieTMP->getGenero();

        $arrayTMP = array('id' => $id, 'nome' => $nome, 'genero' => $genero);
        array_push($filmes, $arrayTMP);
    }

    return json_encode($filmes);
}
