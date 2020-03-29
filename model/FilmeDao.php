<?php

namespace model;

require_once 'C:\xampp\htdocs\Projetos\CRUD\banco\Conexao.php'; // Tive que colocar todo o caminho para evitar erros no xamp!
require_once 'Filme.php';

use ArrayObject;
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

   public function select()
   {
      $sql = "select * from filmes order by nome";
      $stmt = $this->conexao->prepare($sql);
      return $this->getArrayMovies($stmt);
   }

   public function selectById($id)
   {
      $sql = "select * from filmes where id = ?";
      $stmt = $this->conexao->prepare($sql);
      $stmt->bind_param('i', $id);

      return $this->getArrayMovies($stmt);
   }

   public function selectByName($nome)
   {
      $nome = "%".$nome."%";

      $sql = "select * from filmes where nome like ?";
      $stmt = $this->conexao->prepare($sql);
      $stmt->bind_param('s', $nome);

      return $this->getArrayMovies($stmt);
   }

   public function getArrayMovies($stmt)
   {
      $filmes = new ArrayObject();
      $stmt->execute();
      $result = $stmt->get_result();

      while ($row = $result->fetch_assoc()) {
         $f = new Filme();
         $f->setId($row["id"]);
         $f->setNome($row["nome"]);
         $f->setGenero($row["genero"]);

         $filmes->append($f);
      }

      $stmt->close();
      return $filmes;
   }

   public function update(Filme $movie)
   {
      $sql = "update filmes set nome = ?, genero = ? where id = ?";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bind_param(
         'ssi',
         $movie->getNome(),
         $movie->getGenero(),
         $movie->getId()
      );
      $stmt->execute();
      $stmt->close();
   }

   public function delete($id)
   {
      $sql = "delete from filmes where id = ?";

      $stmt = $this->conexao->prepare($sql);
      $stmt->bind_param('i', $id);
      $stmt->execute();
      $stmt->close();
   }
}
