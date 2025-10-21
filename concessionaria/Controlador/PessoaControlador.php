<?php
namespace Controlador;

use Modelo\Pessoa;
use Tabela\TabelaPessoa;

require_once '../Modelo/Pessoa.php';
require_once '../Tabela/TabelaPessoa.php';

$tabelaPessoa = new TabelaPessoa();

// --- Inserção ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'inserir') {
    $pessoa = new Pessoa($_POST['nome'], $_POST['telefone'], $_POST['endereco']);
    $tabelaPessoa->inserirPessoa($pessoa);

    // Redireciona para a view após inserir
    header('Location: ../telas/pessoa.php');
    exit;
}

// --- Exclusão ---
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $tabelaPessoa->deletarPessoa($id);

    // Redireciona para a view após deletar
    header('Location: ../telas/pessoa.php');
    exit;
}
