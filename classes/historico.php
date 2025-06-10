<?php
class Historico {
    public $id;
    public $datahora;
    public $temp;
    public $umidade;
    public $nvagua;

    public function __construct($id = null, $datahora = '', $temp = '', $umidade = '', $nvagua = '') {
        $this->id = $id;
        $this->datahora = $datahora;
        $this->temp = $temp;
        $this->umidade = $umidade;
        $this->nvagua = $nvagua;
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
            $stmt = $conn->prepare("INSERT INTO estufa (datahora, temp, umidade,) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->datahora, $this->temp, $this->umidade,]);
        } else {
            $stmt = $conn->prepare("UPDATE estufa SET datahora = ?, temp = ?, umidade = ? WHERE id = ?");
            $stmt->execute([$this->datahora, $this->temp, $this->umidade, $this->id]);
        }
    }

    public static function excluir($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM estufa WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>