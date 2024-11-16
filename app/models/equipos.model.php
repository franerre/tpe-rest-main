<?php
    require_once 'app/models/model.php';

class EquipoModel  extends Model {  
    /**
     * Obtiene y devuelve de la base de datos todas las tareas.
     */

    function getEquipos() {
        $query = $this->db->prepare('SELECT * FROM equipos');
        $query->execute();

        // $tasks es un arreglo de tareas
        $teams = $query->fetchAll(PDO::FETCH_OBJ);

        return $teams;
    }

    function getEquipo($id) {
        $query = $this->db->prepare('SELECT * FROM equipos WHERE id = ?');
        $query->execute([$id]);

        // $task es una tarea sola
        $team = $query->fetch(PDO::FETCH_OBJ);

        return $team;
    }

    function getEquiposOrderBy($campo, $orden = 'ASC') {
        // Verificar que el campo y el orden sean válidos
        $columnasPermitidas = ['equipo', 'liga', 'pais', 'id'];
        $ordenPermitido = ['ASC', 'DESC'];
    
        // Si el campo o el orden no son válidos, asignar valores predeterminados
        if (!in_array($campo, $columnasPermitidas)) {
            $campo = 'equipo';
        }
        if (!in_array($orden, $ordenPermitido)) {
            $orden = 'ASC';
        }
    
        // Preparar la consulta SQL con orden dinámico
        $query = $this->db->prepare("SELECT * FROM equipos ORDER BY $campo $orden");
        $query->execute();
    
        // Obtener los resultados como un arreglo de objetos
        $teams = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $teams;
    }
    

    
    function insertEquipo($equipo, $liga, $pais, $imagen) {
        $query = $this->db->prepare('INSERT INTO equipos (equipo, liga, pais, imagen) VALUES(?,?,?,?)');
        $query->execute([$equipo, $liga, $pais, $imagen]);

        return $this->db->lastInsertId();
    }
    
    function deleteEquipo($id) {
        $query = $this->db->prepare('DELETE FROM equipos WHERE id = ?');
        $query->execute([$id]);
    }

    function updateEquipo($id,$equipo, $liga, $pais, $imagen) {
        $query = $this->db->prepare('UPDATE equipos SET equipo = ?, liga = ?, pais = ?, imagen = ? WHERE id = ?');
        $query->execute([$equipo, $liga, $pais, $id, $imagen]);
    }

    function updateEquipoData($id, $equipo, $liga, $pais, $imagen) {    
        $query = $this->db->prepare('UPDATE equipos SET equipo = ?, liga = ?, pais = ?, imagen = ? WHERE id = ?');
        $query->execute([$equipo, $liga, $pais, $imagen, $id]);
    }
    
}