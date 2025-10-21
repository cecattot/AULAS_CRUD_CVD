<?php
require_once '../Tabela/TabelaPessoa.php';
require_once '../Modelo/Pessoa.php';

use Tabela\TabelaPessoa;

// Instancia o controlador e a tabela
$tabelaPessoa = new TabelaPessoa();

// Busca todas as pessoas
$pessoas = $tabelaPessoa->buscarPessoas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Pessoas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #eee; }
        form { margin-bottom: 20px; }
        input, button { padding: 8px; margin: 5px; }
        .delete { color: red; text-decoration: none; }
    </style>
</head>
<body>

<h1>Gerenciar Pessoas</h1>

<!-- Formulário de inserção -->
<form method="POST" action="../Controlador/PessoaControlador.php">
    <input type="hidden" name="acao" value="inserir">
    <label>Nome:</label>
    <input type="text" name="nome" required>
    <label>Telefone:</label>
    <input type="text" name="telefone" required>
    <label>Endereço:</label>
    <input type="text" name="endereco" required>
    <button type="submit">Adicionar</button>
</form>

<!-- Tabela de listagem -->
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Endereço</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($pessoas as $p): ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= $p->nome ?></td>
            <td><?= $p->telefone ?></td>
            <td><?= $p->endereco ?></td>
            <td>
                <a href="../Controlador/PessoaControlador.php?delete=<?= $p->id ?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
