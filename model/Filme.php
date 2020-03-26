<?php

namespace model;

class Filme
{
   private $id;
   private $nome;
   private $genero;

   public function getId()
   {
      return $this->id;
   }

   public function setId($id)
   {
      $this->id = $id;
   }

   public function getNome()
   {
      return $this->nome;
   }

   public function setNome($nome)
   {
      $this->nome = $nome;
   }

   public function getGenero()
   {
      return $this->genero;
   }

   public function setGenero($genero)
   {
      $this->genero = $genero;
   }
}
