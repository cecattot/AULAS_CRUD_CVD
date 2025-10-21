<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    switch ($_POST['operacao']) {
        case "somar":
            $resultado = $_POST['num1'] + $_POST['num2'];
            break;
        case "subtrair":
            $resultado = $_POST['num1'] - $_POST['num2'];
            break;
        case "multiplicar":
            $resultado = $_POST['num1'] * $_POST['num2'];
            break;
        case "dividir":
            $resultado = $_POST['num1'] / $_POST['num2'];
            break;
    }
    echo "<h2>Resultado: $resultado</h2>";
    echo "<a href='index.php'>Voltar</a>";
}
