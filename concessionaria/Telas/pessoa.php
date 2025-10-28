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
<form id="form1" method="POST" action="../Controlador/PessoaControlador.php">
    <label>Nome:</label>
    <input type="text" name="nome" id="nome" required>
    <label>Telefone:</label>
    <input type="text" name="telefone" id="telefone" required>
    <label>Endereço:</label>
    <input type="text" name="endereco" id="endereco" required>
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
                <button onclick='editar(<?= json_encode($p) ?>)'>Editar</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script type="application/javascript">
    function editar(pessoa) {
        if(document.getElementById("id") == null){
            formulario = document.getElementById("form1");
            inputHidden = document.createElement("input");
            inputHidden.type = "hidden";
            inputHidden.name = "id";
            inputHidden.id = "id";
            formulario.appendChild(inputHidden);
        } else {
            inputHidden = document.getElementById("id");
        }
        inputHidden.value = pessoa.id;
        document.getElementById("nome").value = pessoa.nome;
        document.getElementById("telefone").value = pessoa.telefone;
        document.getElementById("endereco").value = pessoa.endereco;
    }
</script>
</body>
</html>
