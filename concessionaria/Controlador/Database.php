<?php
require_once "config.php";
class Database
{
    private $conn;

    public function __construct() {
        try{
            //conexão ao mysql sem definir o banco
            $this->conn = new PDO("mysql:host=".DB_HOST,
                 DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);

            //criação do banco se não existir
            $this->conn->exec("CREATE DATABASE IF NOT EXISTS ".DB_NAME);

            //Conectar ao banco
            $this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,
                DB_USER, DB_PASS);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }

    public function criarTabela($comando) {
        /**
         *   " usuarios(
         *   id INT AUTO_INCREMENT PRIMARY KEY,
         *   nome VARCHAR(100) NOT NULL,
         *   email VARCHAR(100) UNIQUE NOT NULL)
         * "
         */
        try {
            $sql = "CREATE TABLE IF NOT EXISTS $comando";
            $this->conn->exec($sql);
            echo "Tabela criada/verificada com sucesso.<br>";
        } catch (PDOException $e) {
            echo "Erro ao criar tabela: " . $e->getMessage();
        }
    }

    // Inserir registros (genérico)
    public function inserir($tabela, $dados) {
        /**
         * $tabela = "usuarios"
         * $dados = ["nome" => "João", "email" => "joao@gmail.com"]
         */
        $colunas = implode(", ", array_keys($dados));
        $placeholders = ":" . implode(", :", array_keys($dados));
        $sql = "INSERT INTO $tabela ($colunas) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($dados);
    }

    public function buscar($sql) {
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizar($tabela, $dados, $condicao)
    {
        // monta "col1 = :col1, col2 = :col2"
        $set = implode(", ", array_map(function($coluna) {
            return "$coluna = :$coluna";
        }, array_keys($dados)));

        $sql = "UPDATE $tabela SET $set WHERE $condicao";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($dados);
    }
    public function deletar($tabela, $id)
    {
        $sql = "DELETE FROM $tabela WHERE id$tabela = :id$tabela";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id".$tabela => $id]);
    }

}