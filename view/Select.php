<?php
require_once '../model/FilmeDao.php';

use model\FilmeDao;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="../js/Crud.js"></script>

    <title>Listagem de Filmes</title>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="Select.php">Filmes Hirooka</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="Select.php">Home<span class="sr-only">(current)</span></a>
                </li>
            </ul>

            <h1 class="form-inline my-2 my-lg-0 navbar-brand">
                Não Pesquisar Apertando Enter!
            </h1>

            <form class="form-inline my-2 my-lg-0" action="../control/Controller.php" method="POST">
                <input class="form-control mr-sm-2" type="text" id="pesquisa" name="pesquisa">
                <button onclick="buscarNome();" class="btn btn-success my-2 my-sm-0" type="button">Busca AJAX</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid">

        <h1>Listagem de Filmes</h1> <br>

        <?php
        $filmeDao = new FilmeDao();
        $movie = $filmeDao->select();
        ?>

        <?php

        if (isset($_POST["pesquisa"])) {

            $pesquisa = $_POST["pesquisa"];

            if ($pesquisa == null || $pesquisa == "") {
                $movie = $filmeDao->select();
                //echo ("ola");
            } else {
                $movie = $filmeDao->selectByName($pesquisa);
            }
        }
        ?>

        <table class="table table-striped" id="tabelaFilmes" name="tabelaFilmes">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Titulo</th>
                    <th>Genero</th>
                    <th colspan="2">Operações</th>
                </tr>
            </thead>

            <tbody>
                <!-- Fechamento do laço de repetição -->
            </tbody>
        </table>

        <button type="button" onclick="exibirModalInsert();" class="btn btn-primary">
            Novo Registro
        </button>

        <!-- Inicio do Modal -->
        <!-- The Modal -->
        <div class="modal" id="modalInsert">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Cadastro de Filme</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id="formInclusao" action="../control/Controller.php" method="post">
                            <div class="form-group">
                                <label for="nome">Titulo do Filme</label>
                                <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome">
                            </div>
                            <div class="form-group">
                                <label for="genero">Genero do Filme</label>
                                <input type="text" class="form-control" placeholder="Genero" name="genero" id="genero">
                            </div>

                            <input type="hidden" id="idUpdate" name="idUpdate">
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" onclick="gravarRegistro();" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- Fim do Modal -->
</body>

</html>

<script>
    // Função carregada assim que a pagina é carregada
    $(function() {
        carregarRegistros();
    });
</script>