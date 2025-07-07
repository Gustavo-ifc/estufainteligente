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

    public function setVariedade($variedade){
        if ($variedade < 0)
            throw new Exception("Erro, o varieda$variedade deve ser maior que 0!");
        else
            $this->$variedade = $variedade;
    }

    public function setResponsavel($responsavel){
            if ($responsavel < 0)
                throw new Exception("Erro, o responsavel deve ser maior que 0!");
            else
                $this->responsavel = $responsavel;
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