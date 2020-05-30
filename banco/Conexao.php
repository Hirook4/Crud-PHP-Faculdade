<?php

namespace banco;

use PDO;
use PDOException;

class Conexao
{
    private $sgbd = "mysql";
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "devweb";
    private $conexao = null;

    public function __construct()
    {
        $this->conect();
    }

    public function getConexao()
    {
        return $this->conexao;
    }

    private function conect()
    {
        try {
            $this->conexao = new PDO("$this->sgbd:host=$this->host;dbname=$this->database", $this->username, $this->password);
        } catch (PDOException $e) {
            printf("Falha na conexao" + $e->getMessage());
            die();
        }
    }
}
