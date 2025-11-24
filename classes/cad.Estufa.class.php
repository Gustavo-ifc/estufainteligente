<?php
require_once 'conexao.php';

class Estufa {
    private $nome, $variedade, $responsavel, $latitude, $longitude;

    public function setNome($n)         { $this->nome = $n; }
    public function setVariedade($v)    { $this->variedade = $v; }
    public function setResponsavel($r)  { $this->responsavel = $r; }
    public function setLatitude($lat)   { $this->latitude = $lat; }
    public function setLongitude($long) { $this->longitude = $long; }

    public function inserir() {
        global $pdo;
        $sql = "INSERT INTO estufa (nome, variedade, responsavel, latitude, longitude)
                VALUES (:nome, :variedade, :responsavel, :latitude, :longitude)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $this->nome,
            ':variedade' => $this->variedade,
            ':responsavel' => $this->responsavel,
            ':latitude' => $this->latitude,
            ':longitude' => $this->longitude
        ]);
    }

    public function listar() {
        global $pdo;
        return $pdo->query("SELECT * FROM estufa ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
}
