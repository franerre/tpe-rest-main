<?php
    require_once 'app/models/model.php';
    require_once 'app/models/equipos.model.php';

class JugadorModel  extends Model {  
    /**
     * Obtiene y devuelve de la base de datos todas las tareas.
     */

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
        // Si no se recibe un campo por el cual ordenar, ordenar por id
        $validSortFields = ['id', 'nombre', 'apellido', 'id_equipo'];  // Los campos válidos por los cuales se puede ordenar
        
        if (!in_array($sort, $validSortFields)) {
            $sort = 'id';  // Si el campo no es válido, se ordena por id por defecto
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
    
        // Consulta SQL con LIMIT y OFFSET
        $query = $this->db->prepare('SELECT * FROM jugadores ORDER BY ' . $sort . ' ' . $order . ' LIMIT :limit OFFSET :offset');
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
    
      
        $players = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $players;
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