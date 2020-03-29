<?php

require_once '../model/FilmeDao.php';

use model\FilmeDao;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Inserir Filme</title>
</head>

<body>

    <?php
    $id = $_GET["id"];
    $filmeDao = new FilmeDao();
    $movies = $filmeDao->selectById($id);

    $nome = $movies[0]->getNome();
    $genero = $movies[0]->getGenero();
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="http://localhost/projetos/CRUD/view/select.php">Filmes Hirooka</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="Select.php">Home<span class="sr-only">(current)</span></a>
                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0" action="Select.php" method="POST">
                <input class="form-control mr-sm-2" type="text" name="genero">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>

    <div class="container">

        <h1>Adicionar Filme</h1>

        <form action="../control/Controller.php" method="post">

            <div class="form-group">
                <label for="nome">Titulo do Filme</label>
                <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome" value="<?= $nome; ?>">
            </div>

            <div class="form-group">
                <label for="genero">Genero do Filme</label>
                <input type="text" class="form-control" placeholder="Genero" name="genero" id="genero" value="<?= $genero; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>

            <input type="hidden" id="operacao" name="operacao" value="update" />
            <input type="hidden" name="id" value="<?= $id; ?>" />

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>