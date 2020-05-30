
// Insere um registro no banco de dados
function inserir() {
    $('idUpdate').val('');
    var nome = $('#nome').val();
    var genero = $('#genero').val();

    $.ajax({
        url: "../control/Controller.php",
        type: "POST",
        data: {
            "operacao": "insert",
            "nome": nome,
            "genero": genero,
        },

        success: function (response) {
            alert('Registro Inserido com Sucesso');
            $('#modalInsert').modal('hide');
            carregarRegistros();
        },
        error: function (response) {
            alert('Falha na Inclusão do Registro');
            window.location.href = "../view/Select.php";
        }
    });
}

// Exclui um registro do banco de dados
function excluir(id) {
    $.ajax({
        url: "../control/Controller.php",
        type: "POST",
        data: {
            "operacao": "delete",
            "id": id,
        },

        success: function (response) {
            alert('Registro Excluido com Sucesso');
            carregarRegistros();
        },
        error: function (response) {
            alert('Falha na Exclusao do Registro');
            carregarRegistros();
        }
    });
}

// Altera um registro no banco de dados
function alterar(params) {
    var id = $('#idUpdate').val();
    var nome = $('#nome').val();
    var genero = $('#genero').val();

    $.ajax({
        url: "../control/Controller.php",
        type: "POST",
        data: {
            "operacao": "update",
            "id": id,
            "nome": nome,
            "genero": genero,
        },

        success: function (response) {
            alert('Registro Alterado com Sucesso');
            window.location.href = "../view/Select.php";
        },
        error: function (response) {
            alert('Falha na Alteracao do Registro');
            window.location.href = "../view/Select.php";
        }
    });
}

// Carrega a lista de registro do banco de dados
function carregarRegistros() {
    $.ajax({
        url: "../control/Controller.php",
        type: "POST",
        data: {
            "operacao": "select"
        },

        success: function (response) {
            var registros = JSON.parse(response);
            carregarTabela(registros);
        },
        error: function (response) {
            alert('Falha ao Carregar Registros');
            window.location.href = "../view/Select.php";
        }
    });
}

// Popula a Tabela de Registros
function carregarTabela(registros) {
    $('#tabelaFilmes>tbody').empty();
    for (i = 0; i < registros.length; i++) {
        linha = montarLinha(registros[i]);
        $('#tabelaFilmes>tbody').append(linha);
    }
}

// Monta Linha da Tabela de Registros
function montarLinha(registros) {
    var linha = "<tr>" +
        "<td>" + registros.id + "</td>" +
        "<td>" + registros.nome + "</td>" +
        "<td>" + registros.genero + "</td>" +
        "<td><button type='button' onclick='exibirModalAlterar(" + registros.id + ");' class='btn btn-warning'>Alterar</button></td>" +
        "<td><button type='button' onclick='excluir(" + registros.id + ");' class='btn btn-danger'>Excluir</button></td>" +
        "</tr>";

    return linha;
}

// Exibe o modal de inclusao de registro
function exibirModalInsert() {
    $('#formInclusao').trigger('reset');
    $('#modalInsert').modal('show');
}

// Exibe o modal de alteracao de registro
function exibirModalAlterar(id) {
    $.ajax({
        url: "../control/Controller.php",
        type: "POST",
        data: {
            "operacao": "selectById",
            "id": id
        },

        success: function (response) {
            var registros = JSON.parse(response);

            var id = registros[0].id;
            var nome = registros[0].nome;
            var genero = registros[0].genero;

            $('#idUpdate').val(id);
            $('#nome').val(nome);
            $('#genero').val(genero);

            $('#modalInsert').modal('show');
        },
        error: function (response) {
            alert('Falha ao Carregar Registros');
            window.location.href = "../view/Select.php";
        }
    });
}

// Metodo para pesquisar nome do filme
function buscarNome() {
    var nome = $('#pesquisa').val();
    $.ajax({
        url: "../control/Controller.php",
        type: "POST",
        data: {
            "operacao": "selectByName",
            "nome": nome
        },

        success: function (response) {
            var registros = JSON.parse(response);
            carregarTabela(registros);
        },
        error: function (response) {
            alert('Falha ao Carregar Registros');
            window.location.href = "../view/Select.php";
        }
    });
}

// Grava registro 
function gravarRegistro() {
    if ($('#idUpdate').val() != '') {
        alterar();
    } else {
        inserir();
    }
}