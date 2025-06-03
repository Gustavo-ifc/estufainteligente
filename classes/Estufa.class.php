<?php
class Estufa {
    public $id;
    public $nome;
    public $variedade;
    public $responsavel;

    public function __construct($id = null, $nome = '', $variedade = '', $responsavel = '') {
        $this->id = $id;
        $this->nome = $nome;
        $this->variedade = $variedade;
        $this->responsavel = $responsavel;
        $this->hora = $hora;
    }

    public static function buscarTodos($conn) {
        $stmt = $conn->query("SELECT * FROM estufa");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM estufa WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($conn) {
        if ($this->id == null) {
            $stmt = $conn->prepare("INSERT INTO estufa (nome, variedade, responsavel,) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->nome, $this->variedade, $this->responsavel,]);
        } else {
            $stmt = $conn->prepare("UPDATE estufa SET nome = ?, variedade = ?, responsavel = ? WHERE id = ?");
            $stmt->execute([$this->nome, $this->variedade, $this->responsavel, $this->id]);
        }
    }

    public static function excluir($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM estufa WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>