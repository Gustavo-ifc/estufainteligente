<?php
class Usuario {
    public $id;
    public $nome;
    public $email;
    public $senha;

    public function __construct($id = null, $nome = '', $email = '', $senha = '') {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    public static function buscarTodos($conn) {
        $stmt = $conn->query("SELECT * FROM usuario");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($conn) {
        if ($this->id == null) {
            $stmt = $conn->prepare("INSERT INTO usuario (nome, email, senha,) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->nome, $this->email, $this->senha,]);
        } else {
            $stmt = $conn->prepare("UPDATE usuario SET nome = ?, email = ?, senha = ? WHERE id = ?");
            $stmt->execute([$this->nome, $this->email, $this->senha, $this->id]);
        }
    }

    public static function excluir($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM estufa WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function setId($id){
        if ($id < 0)
            throw new Exception("Erro, o ID deve ser maior que 0!");
        else
            $this->id = $id;
    }

    public function setIdNome($nome){
        if ($nome < 0)
            throw new Exception("Erro, o ID da Disciplina deve ser maior que 0!");
        else
            $this->nome = $nome;
    }

    public function setVariedade($email){
        if ($email < 0)
            throw new Exception("Erro, o varieda$email deve ser maior que 0!");
        else
            $this->$email = $email;
    }

    public function setResponsavel($senha){
            if ($senha < 0)
                throw new Exception("Erro, o senha esta errada!");
            else
                $this->senha = $senha;
    }

    

    public function getId(): int{
        return $this->id;
    }
    public function getNome(): String{
        return $this->nome;
    }
    public function getVariedade(): float{
        return $this->variedade;
    }
    public function getResponsavel(): String{
        return $this->responsavel;
    }
}
?>