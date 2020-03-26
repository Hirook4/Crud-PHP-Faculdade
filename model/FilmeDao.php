<?php

namespace model;

require_once 'C:\xampp\htdocs\Projetos\CRUD\banco\Conexao.php'; // Tive que colocar todo o caminho para evitar erros no xamp!
require_once 'Filme.php';

use banco\Conexao;
use model\Filme;

class FilmeDao
{

   private $conexao = null;

   public function __construct()
   {
      $conexao = new Conexao();
      $this->conexao = $conexao->getConexao();
   }

   public function insert(Filme $filme)
   {
      $nome = $filme->getNome();
      $genero = $filme->getGenero();

      $sql = "insert into filmes (nome, genero) values (?,?)";
      $stmt = $this->conexao->prepare($sql);
      $stmt->bind_param('ss', $nome, $genero);
      $stmt->execute();
      $stmt->close();
   }
}
