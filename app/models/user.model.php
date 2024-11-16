<?php
require_once 'app/models/model.php';
class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_futbol;charset=utf8', 'root', '');
        
    }

    public function getByUsuario($usuario) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $query->execute([$usuario]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}