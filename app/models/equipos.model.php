<?php
    require_once 'app/models/model.php';

class EquipoModel  extends Model {  
    
    function getEquipos() {
        $query = $this->db->prepare('SELECT * FROM equipos');
        $query->execute();

       
        $teams = $query->fetchAll(PDO::FETCH_OBJ);

        return $teams;
    }

    function getEquipo($id) {
        $query = $this->db->prepare('SELECT * FROM equipos WHERE id = ?');
        $query->execute([$id]);

        
        $team = $query->fetch(PDO::FETCH_OBJ);

        return $team;
    }

    function getEquiposOrderBy($campo, $orden = 'ASC') {
       
        $columnasPermitidas = ['equipo', 'liga', 'pais', 'id'];
        $ordenPermitido = ['ASC', 'DESC'];
    
       
        if (!in_array($campo, $columnasPermitidas)) {
            $campo = 'equipo';
        }
        if (!in_array($orden, $ordenPermitido)) {
            $orden = 'ASC';
        }
    
        $query = $this->db->prepare("SELECT * FROM equipos ORDER BY $campo $orden");
        $query->execute();
    
        
        $teams = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $teams;
    }

    function getEquiposPaginated($offset, $limit, $sort = 'id', $order = 'ASC') {
        
        $validSortFields = ['id', 'equipo', 'liga', 'pais'];
        if (!in_array($sort, $validSortFields)) {
            $sort = 'id';  
        }
    
        if ($order !== 'ASC' && $order !== 'DESC') {
            $order = 'ASC';  
        }
    
        
        $offset = (int) $offset;
        $limit = (int) $limit;
        
        $query = $this->db->prepare('SELECT * FROM equipos ORDER BY ' . $sort . ' ' . $order . ' LIMIT :limit OFFSET :offset');
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
    
       
        $equipos = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $equipos;
    }

    public function getEquiposFiltered($filter, $value, $offset, $limit, $sort, $order) {
        $allowedFilters = ['liga', 'pais', 'equipo']; 
        if (!in_array($filter, $allowedFilters)) {
            return []; 
        }
    
        
        $query = "SELECT * FROM equipos WHERE $filter = ? ORDER BY $sort $order LIMIT ? OFFSET ?";
        $stmt = $this->db->prepare($query);
    
       
        $stmt->bindValue(1, $value, PDO::PARAM_STR);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(3, (int)$offset, PDO::PARAM_INT);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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