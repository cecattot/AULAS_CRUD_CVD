<?php
namespace Tabela;
use Database;
use Modelo\Pessoa;

require_once '../Controlador/Database.php';
require_once '../Modelo/Pessoa.php';
class TabelaPessoa extends Database
{
    public function __construct(){
        parent::__construct();
    }

    public function criarTabelaPessoa()
    {
        $this->criarTabela("Pessoa (
              idPessoa INT NOT NULL AUTO_INCREMENT,
              nome VARCHAR(255) NULL,
              telefone VARCHAR(11) NULL,
              endereco VARCHAR(255) NULL,
              PRIMARY KEY (idPessoa),
              UNIQUE INDEX idPessoa_UNIQUE (idPessoa ASC) VISIBLE)");
    }

    public function inserirPessoa(Pessoa $pessoa){
        $this->inserir('pessoa', $pessoa->toArray());
    }
    public function atualizarPessoa(Pessoa $pessoa){
        $this->atualizar('pessoa', $pessoa->toArray(),
            "pessoa.id = $pessoa->id");
    }

    public function buscarPessoa($id){
        $p = $this->buscar("SELECT * FROM Pessoa where idPessoa = $id");
        return new Pessoa($p['nome'], $p['telefone'],
            $p['endereco'], $p['idPessoa']);
    }

    public function buscarPessoas(){
        $pessoas = [];
        $pessoasLista = $this->buscar("SELECT * FROM Pessoa");
        foreach ($pessoasLista as $p){
            $pessoa = new Pessoa($p['nome'], $p['telefone'],
                $p['endereco'], $p['idPessoa']);
            array_push($pessoas,$pessoa);
        }
        return $pessoas;
    }

    public function deletarPessoa($id){
        $this->deletar('Pessoa', $id);
    }
}