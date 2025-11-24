<?php
require_once "conexao.php";

class Leituras {
    private ?int $id;
    private int $estufa_id;
    private float $temperatura;
    private float $umidade_ar;
    private float $umidade_solo;
    private float $nivel_agua;

    public function __construct(?int $id = null, int $estufa_id = 0, float $temperatura = 0, float $umidade_ar = 0, float $umidade_solo = 0, float $nivel_agua = 0)
    {
        $this->id = $id;
        $this->estufa_id = $estufa_id;
        $this->temperatura = $temperatura;
        $this->umidade_ar = $umidade_ar;
        $this->umidade_solo = $umidade_solo;
        $this->nivel_agua = $nivel_agua;
    }

    public function listarPorEstufa($estufa_id) {
        global $pdo;

        $sql = "select * from leituras 
                where estufa_id = :id
                and data_hora = (select max(b.data_hora) from leituras b where b.estufa_id = :id)         ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $estufa_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarUltimaLinha($estufa_id) {
        global $pdo;

        $sql = "SELECT * FROM leituras
                WHERE estufa_id = :id
                ORDER BY data_hora DESC
                LIMIT 1";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $estufa_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarTodasPorEstufa($estufa_id) {
        global $pdo;

        $sql = "SELECT * FROM leituras
                WHERE estufa_id = :id
                ORDER BY data_hora DESC limit 50";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $estufa_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($conn) {
        if ($this->id == null) {
            $stmt = $conn->prepare("INSERT INTO leituras (estufa_id, temperatura, umidade_ar, umidade_solo, nivel_agua) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$this->estufa_id, $this->temperatura, $this->umidade_ar, $this->umidade_solo,$this->nivel_agua]);
        } else {
            $stmt = $conn->prepare("UPDATE leituras SET estufa_id = ?, temperatura = ?, umidade_ar = ?, umidade_solo = ?, nivel_agua = ? WHERE id = ?");
            $stmt->execute([$this->estufa_id, $this->temperatura, $this->umidade_ar, $this->umidade_solo, $this->nivel_agua, $this->id]);
        }
    }
}
