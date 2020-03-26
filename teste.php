<?php







require_once 'C:\xampp\htdocs\Projetos\CRUD\model\Filme.php';
require_once 'C:\xampp\htdocs\Projetos\CRUD\model\FilmeDao.php';

use model\Filme;
use model\FilmeDao;

$nome = "Usuário de teste";
$genero = "email@teste.com";

$filme = new Filme();
$filme->setNome($nome);
$filme->setGenero($genero);

$filmeDao = new FilmeDao();
$filmeDao->insert($filme);

?>