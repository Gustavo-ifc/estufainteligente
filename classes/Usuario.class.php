<?php
class Usuario {
    public $id;
    public $usuario;
    public $nome;
    public $numero;


    public function __construct($id = null, $usuario = '', $nome = '', $numero = '') {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->nome = $nome;
        $this->numero = $numero;

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
            $stmt = $conn->prepare("INSERT INTO usuario (usuario, nome, numero,) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->usuario, $this->nome, $this->numero,]);
        } else {
            $stmt = $conn->prepare("UPDATE usuario SET usuario = ?, nome = ?, numero = ? WHERE id = ?");
            $stmt->execute([$this->usuario, $this->nome, $this->numero, $this->id]);
        }
    }

    public static function excluir($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM usuario WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function setId($id){
        if ($id < 0)
            throw new Exception("Erro, o ID deve ser maior que 0!");
        else
            $this->id = $id;
    }

    public function setIdUsuario($usuario){
        if ($usuario < 0)
            throw new Exception("Erro, o ID da Disciplina deve ser maior que 0!");
        else
            $this->usuario = $usuario;
    }

    public function setNome($nome){
        if ($nome < 0)
            throw new Exception("Erro, o nome deve ser maior que 0!");
        else
            $this->$nome = $nome;
    }

    public function setNumero($numero){
            if ($numero < 0)
                throw new Exception("Erro, o numero deve ser maior que 0!");
            else
                $this->$numero = $numero;
    }

    

    public function getId(): int{
        return $this->id;
    }
    public function getNome(): String{
        return $this->usuario;
    }
    public function getVariedade(): float{
        return $this->nome;
    }
    public function getNumero(): String{
        return $this->numero;
    }
}
?>