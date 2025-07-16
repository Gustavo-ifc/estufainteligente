<?php
class Estufa {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=estufa;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function cadastrar($nome, $variedade, $responsavel, $latitude, $longitude) {
        $sql = "INSERT INTO estufa (nome, variedade, responsavel, latitude, longitude)
                VALUES (:nome, :variedade, :responsavel, :latitude, :longitude)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':variedade' => $variedade,
            ':responsavel' => $responsavel,
            ':latitude' => $latitude,
            ':longitude' => $longitude
        ]);
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM estufa ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
