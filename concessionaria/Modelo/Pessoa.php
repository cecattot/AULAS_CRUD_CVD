<?php
namespace Modelo;

class Pessoa
{
    public string $nome;
    public string $telefone;
    public string $endereco;
    public ?int $id;

    public function __construct(string $nome, string $telefone, string $endereco, ?int $id = null) {
        $this->id = $id; // se não passar, fica null
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
    }

    public function toArray() {
        return [
            "nome" => $this->nome,
            "telefone" => $this->telefone,
            "endereco" => $this->endereco
        ];
    }
}

class PessoaFisica extends Pessoa
{
    public string $cpf;

    public function __construct(string $nome, string $telefone, string $endereco, string $cpf)
    {
        parent::__construct($nome, $telefone, $endereco);
        $this->cpf = $cpf;
    }

}

class PessoaJuridica extends Pessoa
{
    public string $cnpj;
    private array $socios = [];
    public function __construct(string $nome, string $telefone, string $endereco, string $cnpj)
    {
        parent::__construct($nome, $telefone, $endereco);
        $this->cnpj = $cnpj;
    }

    public function adicionarSocio(PessoaFisica $socio){
//        $this->socios[] += $socio;
        array_push($this->socios, $socio);
    }

}

// ---------------- EXEMPLO DE USO ----------------

$pf1 = new PessoaFisica("João", "99999-1111", "Rua A, 123", "123.456.789-00");
$pf2 = new PessoaFisica("Maria", "99999-2222", "Rua B, 456", "987.654.321-00");

$pj = new PessoaJuridica("Tech Ltda", "3333-4444", "Av. Central, 1000",
    "12.345.678/0001-99");
$pj->adicionarSocio($pf1);
$pj->adicionarSocio($pf2);

//var_dump($pf1);
//echo "<br>";
//echo "<br>";
//var_dump($pf2);
//echo "<br>";
//echo "<br>";
//var_dump($pj);
//echo "<br>";
//echo "<br>";