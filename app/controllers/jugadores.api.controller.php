<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/controllers/user.api.controller.php';
require_once 'app/models/jugadores.model.php';

class JugadoresApiController extends ApiController {
    private $model;
    
    
    function __construct() {
        parent::__construct();
        $this->model = new JugadorModel();
        
    }
    
    function get($params = []) {
        
        $sort = $_GET['sort'] ?? 'id';  
        $order = $_GET['order'] ?? 'ASC';   
        $offset = $_GET['offset'] ?? 0;     
        $limit = $_GET['limit'] ?? 50;      
        $filter = $_GET['filter'] ?? null;  
        $value = $_GET['value'] ?? null;    
    
        $allowedOrders = ['ASC', 'DESC'];
        if (!in_array(strtoupper($order), $allowedOrders)) {
            $order = 'ASC'; 
        }
    
        
        $allowedSortFields = ['id','nombre', 'equipo', 'liga', 'imagen_jugador']; 
        if (!in_array($sort, $allowedSortFields)) {
            $sort = 'nombre'; 
        }
    
        if (empty($params)) {
            if ($filter && $value) {
                
                $jugadores = $this->model->getJugadoresFiltered($filter, $value, $offset, $limit, $sort, $order);
                
                
                if (empty($jugadores)) {
                    
                    if ($filter == 'equipo') {
                        $this->view->response("No hay ningún jugador con el equipo '$value'.", 404);
                    } elseif ($filter == 'liga') {
                        $this->view->response("No hay ningún jugador con la liga '$value'.", 404);
                    } elseif ($filter == 'pais') {
                        $this->view->response("No hay ningún jugador con el país '$value'.", 404);
                    } else {
                        $this->view->response("No hay ningún jugador con el filtro '$filter' y el valor '$value'.", 404);
                    }
                    return;
                }
            } else {
                
                $jugadores = $this->model->getJugadoresPaginated($offset, $limit, $sort, $order);
            }
    
            $this->view->response($jugadores, 200);
        } else {
           
            $jugador = $this->model->getJugador($params[':ID']);
            if (!empty($jugador)) {
                if (isset($params[':subrecurso']) && $params[':subrecurso']) {
                    
                    switch ($params[':subrecurso']) {
                        case 'nombre':
                            $this->view->response($jugador->nombre, 200);
                            break;
                        case 'apellido':
                            $this->view->response($jugador->apellido, 200);
                            break;
                        case 'id_equipo':
                            $this->view->response($jugador->id_equipo, 200);
                            break;
                        case 'imagen_jugador':
                            $this->view->response($jugador->imagen_jugador, 200);
                            break;
                        default:
                            $this->view->response(
                                'El jugador no contiene ' . $params[':subrecurso'] . '.',
                                404
                            );
                            break;
                    }
                } else {
                    
                    $this->view->response($jugador, 200);
                }
            } else {
                
                $this->view->response(
                    'El jugador con el id=' . $params[':ID'] . ' no existe.',
                    404
                );
            }
        }
    }
    

    function delete($params = []) {
        $id = $params[':ID'];
        $jugador = $this->model->getJugador($id);

        if ($jugador) {
            $this->model->deleteJugador($id);
            $this->view->response('El jugador con id=' . $id . ' ha sido borrado.', 200);
        } else {
            $this->view->response('El jugador con id=' . $id . ' no existe.', 404);
        }
    }

    function create($params = []) {
        //$this->verifyToken();
        $body = $this->getData();

        $nombre = $body->nombre;
        $apellido = $body->apellido;
        $id_equipo = $body->id_equipo;
        $imagen_jugador = $body->imagen_jugador;

        if (empty($nombre) || empty($apellido) || empty($id_equipo) || empty($imagen_jugador)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertJugador($nombre, $apellido, $id_equipo, $imagen_jugador);

            
            $jugador = $this->model->getJugador($id);
            $this->view->response($jugador, 201);
        }
        var_dump($body);
    }

    function update($params = []) {
        //$this->verifyToken();
        $id = $params[':ID'];
        $jugador = $this->model->getJugador($id);

        if ($jugador) {
            $body = $this->getData();
            $nombre = $body->nombre;
            $apellido = $body->apellido;
            $id_equipo = $body->id_equipo;
            $imagen_jugador = $body->imagen_jugador;
            $this->model->updateJugadorData($id, $nombre, $apellido, $id_equipo, $imagen_jugador);

            $this->view->response('El jugador con id=' . $id . ' ha sido modificado.', 200);
        } else {
            $this->view->response('El jugador con id=' . $id . ' no existe.', 404);
        }
    }


}
?>
