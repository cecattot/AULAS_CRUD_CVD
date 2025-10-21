<?php
namespace Modelo;
require 'Pessoa.php';
//require '/PASTA/SUBBASTA/PessoaControlador.php';
class Carro
{
    public $motor;
    public $torque;
    public $peso;
    public $espaco;
    public $velocidade;
    public Pessoa $propietario;
    public ?int $id;
    public function __construct($motor, $torque, $peso, $espaco, ?int $id = null){
        $this->id = $id; //se não passar nada é null
        $this->motor = $motor;
        $this->torque = $torque;
        $this->peso = $peso;
        $this->espaco = $espaco;
    }
    public function ligar(){
        $this->velocidade = 20;
        echo "Carro ligado, velocidade atual $this->velocidade";
    }
    public function desligar(){
        $this->velocidade = 0;
        echo "Carro desligado!";
    }
    public function acelerar(){
        //aumentar a velocidade em 5;
        $this->velocidade += 5;
        echo "Acelerando, velocidade atual $this->velocidade";
    }
    public function desacelerar()
    {
        if($this->velocidade >= 5) {
            $this->velocidade -= 5;
            echo "Desacelerando, velocidade atual $this->velocidade";
        }
    }
}

class Utilitario extends Carro
{
    public $modoTurbo;
    public function __construct($motor, $torque, $peso, $espaco, $modoTurbo){
        parent::__construct($motor, $torque, $peso, $espaco);
        $this->modoTurbo = $modoTurbo;
    }
    public function modoEsportivo(){
        $this->velocidade += 5 * $this->modoTurbo;
        echo "Acelerando no turbo, velocidade atual $this->velocidade";
    }
}

class SUV extends Utilitario{
    public $assentos = 5;
}

$carro = new Carro('5', '10','20', '15');
$pf1 = new PessoaFisica('Raul', '66992026614',
    'Rua dos Bobos, nº 0', '09878909889');

$carro->propietario = $pf1;

$suv = new SUV('5', '10','20', '15', '2');
$suv->propietario = new PessoaJuridica('IFMT', '3500-2900',
    'Dom Aquino', '123456789/1000-00');
$suv->propietario->adicionarSocio($pf1);

var_dump($carro);
echo "<br>";
echo "<br>";
echo "<br>";
var_dump($suv);
