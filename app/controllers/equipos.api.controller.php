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
        
        $sort = $_GET['sort'] ?? 'id';
        $order = $_GET['order'] ?? 'ASC'; 
        $offset = $_GET['offset'] ?? 0;  
        $limit = $_GET['limit'] ?? 30;   
        $filter = $_GET['filter'] ?? null; 
        $value = $_GET['value'] ?? null; 
    
        $allowedOrders = ['ASC', 'DESC'];
        if (!in_array(strtoupper($order), $allowedOrders)) {
            $order = 'ASC'; 
        }
    
        
        $allowedSortFields = ['id','equipo', 'liga', 'pais', 'imagen']; 
        if (!in_array($sort, $allowedSortFields)) {
            $sort = 'equipo'; 
        }
    
        if (empty($params)) {
            if ($filter && $value) {
                
                $equipos = $this->model->getEquiposFiltered($filter, $value, $offset, $limit, $sort, $order);
                
                
                if (empty($equipos)) {
                   
                    if ($filter == 'liga') {
                        $this->view->response("No hay ningún equipo con la liga '$value'.", 404);
                    } elseif ($filter == 'pais') {
                        $this->view->response("No hay ningún equipo con el pais '$value'.", 404);
                    } else {
                        $this->view->response("No hay ningún equipo con el filtro '$filter' y el valor '$value'.", 404);
                    }
                    return;
                }
            } else {
                
                $equipos = $this->model->getEquiposPaginated($offset, $limit, $sort, $order);
            }
    
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
