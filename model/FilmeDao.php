<?php

namespace model;

require_once '../banco/Conexao.php';
require_once '../model/Filme.php';

use ArrayObject;
use PDO;
use PDOException;
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

      try {
         $sql = "insert into filmes (nome, genero) values (:NOME, :GENERO)";
         $stmt = $this->conexao->prepare($sql);
         $stmt->bindParam(":NOME", $nome, PDO::PARAM_STR);
         $stmt->bindParam(":GENERO", $genero, PDO::PARAM_STR);
         $stmt->execute();
      } catch (PDOException $e) {
         printf("Falha na Inclusão", $e->getMessage());
         die();
      }
   }

   public function select()
   {
      $sql = "select * from filmes order by nome";
      $stmt = $this->conexao->prepare($sql);
      return $this->getArrayMovies($stmt);
   }

   public function selectById($id)
   {
      $sql = "select * from filmes where id = :ID";
      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(":ID", $id, PDO::PARAM_INT);

      return $this->getArrayMovies($stmt);
   }

   public function selectByName($nome)
   {
      $nome = "%" . $nome . "%";

      $sql = "select * from filmes where nome like :NOME";
      $stmt = $this->conexao->prepare($sql);
      $stmt->bindParam(":NOME", $nome, PDO::PARAM_STR);

      return $this->getArrayMovies($stmt);
   }

   public function getArrayMovies($stmt)
   {
      $filmes = new ArrayObject();
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result as $row) {
         $f = new Filme();
         $f->setId($row["id"]);
         $f->setNome($row["nome"]);
         $f->setGenero($row["genero"]);

         $filmes->append($f);
      }
      return $filmes;
   }

   public function update(Filme $movie)
   {
      $sql = "update filmes set nome = :NOME, genero = :GENERO where id = :ID";

      try {
         $stmt = $this->conexao->prepare($sql);
         $stmt->bindParam(":NOME", $movie->getNome(), PDO::PARAM_STR);
         $stmt->bindParam(":GENERO", $movie->getGenero(), PDO::PARAM_STR);
         $stmt->bindParam(":ID", $movie->getId(), PDO::PARAM_INT);
         $stmt->execute();
      } catch (PDOException $e) {
         printf("Falha na Edição", $e->getMessage());
      }
   }

   public function delete($id)
   {
      try {
         $sql = "delete from filmes where id = :ID";

         $stmt = $this->conexao->prepare($sql);
         $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
         $stmt->execute();
      } catch (PDOException $e) {
         printf("Falha na Exclusão", $e->getMessage());
      }
   }
}
