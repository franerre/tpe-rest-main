<?php
    require_once 'app/models/model.php';
    require_once 'app/models/equipos.model.php';

class JugadorModel  extends Model {  
    
    function getJugadores() {
        $query = $this->db->prepare('SELECT * FROM jugadores');
        $query->execute();

       
        $players = $query->fetchAll(PDO::FETCH_OBJ);

        return $players;
        
    }

    function getJugador($id) {
        $query = $this->db->prepare('SELECT * FROM jugadores WHERE id = ?');
        $query->execute([$id]);

     
        $player = $query->fetch(PDO::FETCH_OBJ);

        return $player;
    }

    function getJugadoresOrderBy($sort = null, $order = 'ASC') {
        $validSortFields = ['id', 'nombre', 'apellido', 'id_equipo'];  
        if (!in_array($sort, $validSortFields)) {
            $sort = 'id';  
        }
    
        $query = $this->db->prepare('SELECT * FROM jugadores ORDER BY ' . $sort . ' ' . $order);
        $query->execute();
    
        $players = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $players;
    }
    
    function getJugadoresPaginated($offset, $limit, $sort = 'id', $order = 'ASC') {
        $validSortFields = ['id', 'nombre', 'apellido', 'id_equipo'];
        if (!in_array($sort, $validSortFields)) {
            $sort = 'id';  
        }   
        if ($order !== 'ASC' && $order !== 'DESC') {
            $order = 'ASC';  
        }

        $offset = (int) $offset;
        $limit = (int) $limit;
    
        $query = $this->db->prepare('SELECT * FROM jugadores ORDER BY ' . $sort . ' ' . $order . ' LIMIT :limit OFFSET :offset');
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
    
      
        $players = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $players;
    }
    
    public function getJugadoresFiltered($filter, $value, $offset, $limit, $sort, $order) {
        
        $allowedFilters = ['id', 'nombre', 'apellido', 'id_equipo', 'imagen_jugador']; 
        if (!in_array($filter, $allowedFilters)) {
            return []; 
        }

        $query = "SELECT * FROM jugadores WHERE $filter = ? ORDER BY $sort $order LIMIT ? OFFSET ?";
        $stmt = $this->db->prepare($query);
    
       
        $stmt->bindValue(1, $value, PDO::PARAM_STR);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(3, (int)$offset, PDO::PARAM_INT);
    
        
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    
    
    

   

    /**
     * Inserta el jugador en la base de datos
     * revisar, porque se agrega solo cuando se actualiza la pagina
     */
    function insertJugador($nombre, $apellido, $id_equipo, $imagen_jugador) {
        $query = $this->db->prepare('INSERT INTO jugadores (nombre, apellido, id_equipo, imagen_jugador) VALUES(?,?,?,?)');
        $query->execute([$nombre, $apellido, $id_equipo, $imagen_jugador]);

        return $this->db->lastInsertId();
    }
    
    function deleteJugador($id) {
        $query = $this->db->prepare('DELETE FROM jugadores WHERE id = ?');
        $query->execute([$id]);
    }

    function updateJugador($id, $nombre, $apellido, $id_equipo, $imagen_jugador) {
        $query = $this->db->prepare('UPDATE jugadores SET nombre = ?, apellido = ?, id_equipo = ?, imagen_jugador = ? WHERE id = ?');
        $query->execute([$id]);
    }

    function updateJugadorData($id, $nombre, $apellido, $id_equipo, $imagen_jugador) {    
        $query = $this->db->prepare('UPDATE jugadores SET nombre = ?, apellido = ?, id_equipo = ?, imagen_jugador = ? WHERE id = ?');
        $query->execute([$nombre, $apellido, $id_equipo, $imagen_jugador, $id]);
    }
}