<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calculadora PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f3f3f3;
        }
        .calc-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 280px;
        }
        .display {
            width: 100%;
            height: 50px;
            margin-bottom: 10px;
            font-size: 22px;
            text-align: right;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #fafafa;
        }
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }
        button {
            padding: 15px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: #e0e0e0;
        }
        button:active {
            background: #bdbdbd;
        }
        .equal {
            grid-column: span 2;
            background: #4caf50;
            color: white;
        }
        .equal:active {
            background: #388e3c;
        }
    </style>
</head>
<body>
<div class="calc-container">
    <form action="controller.php" method="post" id="calcForm">
        <input type="text" id="display" class="display" readonly>

        <!-- campos ocultos que serão enviados -->
        <input type="hidden" name="num1" id="num1">
        <input type="hidden" name="num2" id="num2">
        <input type="hidden" name="operacao" id="operacao">

        <div class="buttons">
            <button type="button" onclick="appendNumber('7')">7</button>
            <button type="button" onclick="appendNumber('8')">8</button>
            <button type="button" onclick="appendNumber('9')">9</button>
            <button type="button" onclick="setOperation('dividir')">÷</button>

            <button type="button" onclick="appendNumber('4')">4</button>
            <button type="button" onclick="appendNumber('5')">5</button>
            <button type="button" onclick="appendNumber('6')">6</button>
            <button type="button" onclick="setOperation('multiplicar')">×</button>

            <button type="button" onclick="appendNumber('1')">1</button>
            <button type="button" onclick="appendNumber('2')">2</button>
            <button type="button" onclick="appendNumber('3')">3</button>
            <button type="button" onclick="setOperation('subtrair')">−</button>

            <button type="button" onclick="appendNumber('0')">0</button>
            <button type="button" onclick="appendNumber('.')">.</button>
            <button type="submit" class="equal">=</button>
            <button type="button" onclick="setOperation('somar')">+</button>
        </div>
    </form>
</div>

<script>
    let currentInput = "";
    let firstNumber = "";
    let operation = "";

    function appendNumber(num) {
        currentInput += num;
        document.getElementById("display").value = currentInput;
    }

    function setOperation(op) {
        if (currentInput === "") return;
        firstNumber = currentInput;
        operation = op;
        currentInput = "";
        document.getElementById("display").value = "";
    }

    // Antes de enviar, coloca os valores nos inputs ocultos
    document.getElementById("calcForm").addEventListener("submit", function(e) {
        if (firstNumber === "" || currentInput === "" || operation === "") {
            e.preventDefault();
            alert("Operação incompleta!");
            return;
        }
        document.getElementById("num1").value = firstNumber;
        document.getElementById("num2").value = currentInput;
        document.getElementById("operacao").value = operation;
    });
</script>
</body>
</html>
