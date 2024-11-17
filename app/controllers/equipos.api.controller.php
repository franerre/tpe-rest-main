<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/controllers/user.api.controller.php';
require_once 'app/models/equipos.model.php';

class EquipoApiController extends ApiController {
    private $model;
    
    function __construct() {
        parent::__construct();
        $this->model = new EquipoModel();
    }
    
    function get($params = []) {
        $sort = $_GET['sort'] ?? null; 
        $order = $_GET['order'] ?? 'ASC'; // Tipo de orden (ASC o DESC)
        $offset = $_GET['offset'] ?? 0; // Valor por defecto es 0
        $limit = $_GET['limit'] ?? 10; // Valor por defecto es 10
        
        if (empty($params)) {
            // Obtener los equipos paginados
            $equipos = $this->model->getEquiposPaginated($offset, $limit, $sort, $order);
            $this->view->response($equipos, 200);
        } else {
            $equipo = $this->model->getEquipo($params[':ID']);
            if (!empty($equipo)) {
                if (isset($params[':subrecurso']) && $params[':subrecurso']) {
                    switch ($params[':subrecurso']) {
                        case 'equipo':
                            $this->view->response($equipo->equipo, 200);
                            break;
                        case 'liga':
                            $this->view->response($equipo->liga, 200);
                            break;
                        case 'pais':
                            $this->view->response($equipo->pais, 200);
                            break;
                        case 'imagen':
                            $this->view->response($equipo->imagen, 200);
                            break;
                        default:
                            $this->view->response(
                                'El equipo no contiene ' . $params[':subrecurso'] . '.',
                                404
                            );
                            break;
                    }
                } else {
                    $this->view->response($equipo, 200);
                }
            } else {
                $this->view->response(
                    'El equipo con el id=' . $params[':ID'] . ' no existe.',
                    404
                );
            }
        }
    }
    
    
    

    function delete($params = []) {
        $id = $params[':ID'];
        $Equipo = $this->model->getEquipo($id);

        if ($Equipo) {
            $this->model->deleteEquipo($id);
            $this->view->response('El equipo con id=' . $id . ' ha sido borrado.', 200);
        } else {
            $this->view->response('El equipo con id=' . $id . ' no existe.', 404);
        }
    }

    function create($params = []) {
       // $this->verifyToken();
        $body = $this->getData();

        $equipo = $body->equipo;
        $liga = $body->liga;
        $pais = $body->pais;
        $imagen = $body->imagen;

        if (empty($equipo) || empty($liga) || empty($pais) || empty($imagen)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertEquipo($equipo, $liga, $pais, $imagen);

            // En una API REST, es buena práctica devolver el recurso creado
            $Equipo = $this->model->getEquipo($id);
            $this->view->response($Equipo, 201);
        }
        var_dump($body);
    }

    function update($params = []) {
        //$this->verifyToken();
        $id = $params[':ID'];
        $Equipo = $this->model->getEquipo($id); 
        if ($Equipo) { 
            $body = $this->getData();
            $equipo = $body->equipo;
            $liga = $body->liga;
            $pais = $body->pais;
            $imagen = $body->imagen;
    
            $this->model->updateEquipoData($id, $equipo, $liga, $pais, $imagen);
    
            $this->view->response('El equipo con id=' . $id . ' ha sido modificado.', 200);
        } else {
            $this->view->response('El equipo con id=' . $id . ' no existe.', 404);
        }
    }
}
?>
