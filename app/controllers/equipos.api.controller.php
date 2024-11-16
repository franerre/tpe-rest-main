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
        
        if (empty($params)) {
            
            if ($sort) {
                $equipos = $this->model->getEquiposOrderBy($sort, $order);
            } else {
                $equipos = $this->model->getEquipos(); 
            }
            $this->view->response($equipos, 200);
        } else {
            // Lógica para obtener un equipo específico
            $Equipo = $this->model->getEquipo($params[':ID']);
            if (!empty($Equipo)) {
                if (isset($params[':subrecurso']) && $params[':subrecurso']) {
                    switch ($params[':subrecurso']) {
                        case 'equipo':
                            $this->view->response($Equipo->equipo, 200);
                            break;
                        case 'liga':
                            $this->view->response($Equipo->liga, 200);
                            break;
                        case 'pais':
                            $this->view->response($Equipo->pais, 200);
                            break;
                        case 'imagen':
                            $this->view->response($Equipo->imagen, 200);
                            break;
                        default:
                            $this->view->response(
                                'El equipo no contiene ' . $params[':subrecurso'] . '.',
                                404
                            );
                            break;
                    }
                } else {
                    $this->view->response($Equipo, 200);
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
