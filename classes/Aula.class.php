<?php
class Aula {
    public $id;
    public $instrutor;
    public $aluno;
    public $data;
    public $hora;
    public $veiculo;
    public $arquivo;

    public function __construct($id = null, $instrutor = '', $aluno = '', $data = '', $hora = '', $veiculo = '', $arquivo = '') {
        $this->id = $id;
        $this->instrutor = $instrutor;
        $this->aluno = $aluno;
        $this->data = $data;
        $this->hora = $hora;
        $this->veiculo = $veiculo;
        $this->arquivo = $arquivo;
    }

    public static function buscarTodos($conn) {
        $stmt = $conn->query("SELECT * FROM aula");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM aula WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($conn) {
        if ($this->id == null) {
            $stmt = $conn->prepare("INSERT INTO aula (instrutor, aluno, data, hora, veiculo, arquivo) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->instrutor, $this->aluno, $this->data, $this->hora, $this->veiculo, $this->arquivo]);
        } else {
            $stmt = $conn->prepare("UPDATE aula SET instrutor = ?, aluno = ?, data = ?, hora = ?, veiculo = ?, arquivo = ? WHERE id = ?");
            $stmt->execute([$this->instrutor, $this->aluno, $this->data, $this->hora, $this->veiculo, $this->arquivo, $this->id]);
        }
    }

    public static function excluir($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM aula WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
