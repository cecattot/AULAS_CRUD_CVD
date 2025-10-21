<?php


// -------------------------
// 1. Produto
// -------------------------
class Produto
{
    private string $nome;
    private float $preco;
    private int $estoque;

    public function __construct(string $nome, float $preco, int $estoque)
    {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->estoque = $estoque;
    }

    public function aplicarDesconto(float $percentual): void
    {
        $this->preco -= $this->preco * ($percentual / 100);
    }

    public function vender(int $quantidade): string
    {
        if ($quantidade > $this->estoque) {
            return "Estoque insuficiente!";
        }
        $this->estoque -= $quantidade;
        return "Venda realizada de $quantidade unidade(s).";
    }

    public function resumo(): string
    {
        return "Produto: {$this->nome}, Preço: R$ {$this->preco}, Estoque: {$this->estoque}";
    }
}

// -------------------------
// 2. Aluno
// -------------------------
class Aluno
{
    private string $nome;
    private string $matricula;
    private array $notas = [];

    public function __construct(string $nome, string $matricula)
    {
        $this->nome = $nome;
        $this->matricula = $matricula;
    }

    public function adicionarNota(float $nota): void
    {
        $this->notas[] = $nota;
    }

    public function media(): float
    {
        return count($this->notas) ? array_sum($this->notas) / count($this->notas) : 0;
    }

    public function aprovado(): bool
    {
        return $this->media() >= 6;
    }

    public function info(): string
    {
        return "{$this->nome} - Média: {$this->media()} - " . ($this->aprovado() ? "Aprovado" : "Reprovado");
    }
}

// -------------------------
// 3. ContaBancaria
// -------------------------
class ContaBancaria
{
    private string $titular;
    private float $saldo;

    public function __construct(string $titular, float $saldoInicial = 0)
    {
        $this->titular = $titular;
        $this->saldo = $saldoInicial;
    }

    public function depositar(float $valor): void
    {
        $this->saldo += $valor;
    }

    public function sacar(float $valor): string
    {
        if ($valor > $this->saldo) {
            return "Saldo insuficiente!";
        }
        $this->saldo -= $valor;
        return "Saque de R$ $valor realizado.";
    }

    public function transferir(ContaBancaria $destino, float $valor): string
    {
        if ($valor > $this->saldo) {
            return "Saldo insuficiente para transferir.";
        }
        $this->saldo -= $valor;
        $destino->depositar($valor);
        return "Transferência de R$ $valor para {$destino->titular}.";
    }

    public function extrato(): string
    {
        return "{$this->titular} - Saldo: R$ {$this->saldo}";
    }
}

// -------------------------
// 4. Biblioteca
// -------------------------
class Biblioteca
{
    private string $nome;
    private array $livros = [];

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function adicionarLivro(string $titulo): void
    {
        $this->livros[] = $titulo;
    }

    public function buscarLivro(string $termo): array
    {
        return array_filter($this->livros, fn($livro) => stripos($livro, $termo) !== false);
    }

    public function listarLivros(): string
    {
        return "Livros da biblioteca {$this->nome}: " . implode(", ", $this->livros);
    }
}

// -------------------------
// 5. Pedido
// -------------------------
class Pedido
{
    private string $cliente;
    private array $itens = []; // cada item: ['produto' => Produto, 'quantidade' => int]

    public function __construct(string $cliente)
    {
        $this->cliente = $cliente;
    }

    public function adicionarItem(Produto $produto, int $quantidade): void
    {
        $this->itens[] = ['produto' => $produto, 'quantidade' => $quantidade];
    }

    public function total(): float
    {
        $soma = 0;
        foreach ($this->itens as $item) {
            $refProduto = $item['produto'];
            $ref = new ReflectionClass($refProduto);
            $preco = $ref->getProperty('preco');
            $preco->setAccessible(true);
            $soma += $preco->getValue($refProduto) * $item['quantidade'];
        }
        return $soma;
    }

    public function detalhes(): string
    {
        $detalhes = "Pedido de {$this->cliente}:\n";
        foreach ($this->itens as $item) {
            $produto = $item['produto'];
            $ref = new ReflectionClass($produto);
            $nome = $ref->getProperty('nome');
            $preco = $ref->getProperty('preco');
            $nome->setAccessible(true);
            $preco->setAccessible(true);
            $detalhes .= "- {$nome->getValue($produto)} ({$item['quantidade']} x R$ {$preco->getValue($produto)})\n";
        }
        $detalhes .= "TOTAL: R$ {$this->total()}";
        return $detalhes;
    }
}

// -------------------------
// 6. Turma
// -------------------------
class Turma
{
    private string $disciplina;
    private array $alunos = [];

    public function __construct(string $disciplina)
    {
        $this->disciplina = $disciplina;
    }

    public function adicionarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function melhorAluno(): ?Aluno
    {
        if (empty($this->alunos)) return null;
        usort($this->alunos, fn($a, $b) => $b->media() <=> $a->media());
        return $this->alunos[0];
    }

    public function resultadoFinal(): array
    {
        return array_map(fn($aluno) => $aluno->info(), $this->alunos);
    }
}

// -------------------------
// 7. Agenda
// -------------------------
class Agenda
{
    private array $contatos = [];

    public function adicionarContato(string $nome, string $telefone): void
    {
        $this->contatos[$nome] = $telefone;
    }

    public function removerContato(string $nome): void
    {
        unset($this->contatos[$nome]);
    }

    public function buscarContato(string $nome): string
    {
        return $this->contatos[$nome] ?? "Contato não encontrado.";
    }

    public function listarContatos(): string
    {
        ksort($this->contatos);
        $lista = "Contatos:\n";
        foreach ($this->contatos as $nome => $tel) {
            $lista .= "- $nome: $tel\n";
        }
        return $lista;
    }
}

// -------------------------
// Exemplo rápido de uso
// -------------------------
echo "=== Exercício Produto ===\n";
$p1 = new Produto("Notebook", 3000, 10);
echo $p1->resumo() . "\n";
$p1->aplicarDesconto(10);
echo $p1->resumo() . "\n";
echo $p1->vender(2) . "\n";

echo "\n=== Exercício Aluno ===\n";
$a1 = new Aluno("João", "2023001");
$a1->adicionarNota(7);
$a1->adicionarNota(5);
echo $a1->info() . "\n";

echo "\n=== Exercício Conta ===\n";
$c1 = new ContaBancaria("Maria", 1000);
$c2 = new ContaBancaria("Pedro", 500);
echo $c1->transferir($c2, 200) . "\n";
echo $c1->extrato() . "\n";
echo $c2->extrato() . "\n";

echo "\n=== Exercício Biblioteca ===\n";
$b1 = new Biblioteca("Central");
$b1->adicionarLivro("PHP Avançado");
$b1->adicionarLivro("Estruturas de Dados");
print_r($b1->buscarLivro("PHP"));
echo $b1->listarLivros() . "\n";

echo "\n=== Exercício Pedido ===\n";
$pedido = new Pedido("Carlos");
$pedido->adicionarItem($p1, 2);
echo $pedido->detalhes() . "\n";

echo "\n=== Exercício Turma ===\n";
$turma = new Turma("POO");
$turma->adicionarAluno($a1);
$a2 = new Aluno("Maria", "2023002");
$a2->adicionarNota(9);
$a2->adicionarNota(8);
$turma->adicionarAluno($a2);
echo "Melhor aluno: " . $turma->melhorAluno()->info() . "\n";
print_r($turma->resultadoFinal());

echo "\n=== Exercício Agenda ===\n";
$agenda = new Agenda();
$agenda->adicionarContato("Ana", "1111-2222");
$agenda->adicionarContato("Carlos", "3333-4444");
echo $agenda->listarContatos();
