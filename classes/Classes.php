<?php
class Pessoa {
    protected $id;
    protected $nome;

    public function __construct($id = null, $nome = null) {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
}



class Usuario extends Pessoa {
    private $email;
    private $senha;

    public function __construct($id, $nome, $email, $senha) {
        parent::__construct($id, $nome);
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getEmail() {
        return $this->email;
    }

    public function verificarSenha($senhaDigitada) {
        return password_verify($senhaDigitada, $this->senha);
    }
}


class Autor extends Pessoa {
    private $idClassificacao;

    public function __construct($id, $nome, $idClassificacao) {
        parent::__construct($id, $nome);
        $this->idClassificacao = $idClassificacao;
    }

    public function getClassificacao() {
        return $this->idClassificacao;
    }
}

