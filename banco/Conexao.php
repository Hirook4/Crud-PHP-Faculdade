<?php

namespace banco;

use mysqli;

class Conexao
{
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
        $this->conexao = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if (mysqli_connect_errno()) {
            printf("Falha na conexão: %s\n", mysqli_connect_error());
            exit();
        } else {
            //echo("Conexão realizada com sucesso: <br>");
            //print_r($this->getConexao());
        }
    }
}
//$conexao = new Conexao();
