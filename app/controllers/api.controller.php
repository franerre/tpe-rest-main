<?php
    require_once 'app/views/api.view.php';
    
    abstract class ApiController {
        protected $view;
        private $data;
        
        function __construct() {
            $this->view = new ApiView();
            $this->data = file_get_contents('php://input');
        }

        function getData() {
            return json_decode($this->data);
        }

        protected function verifyToken() {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
            if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
                $this->view->response("Token no proporcionado o inválido", 401);
                die();
            }
    
            $token = substr($authHeader, 7);
            try {
                $payload = verifyJWT($token); // Decodifica el token
                return $payload; // Devuelve el payload si es válido
            } catch (Exception $e) {
                $this->view->response("Token inválido o expirado", 401);
                die();
            }
        }
    }