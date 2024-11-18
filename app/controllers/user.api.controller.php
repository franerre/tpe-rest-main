<?php

require_once './app/models/user.model.php';
require_once './app/views/api.view.php';
require_once './libs/jwt.php';

class UserApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new JSONView();
    }

    // Método para obtener el token
    public function getToken() {
       
        $auth_header = $_SERVER['HTTP_AUTHORIZATION']; 
        if (!$auth_header) {
            return $this->view->response("Falta el header de autorización", 400);
        }
    
        $auth_header = explode(' ', $auth_header); 
        
        if (count($auth_header) != 2 || $auth_header[0] != 'Basic') {
            return $this->view->response("Error en los datos ingresados", 400);
        }
        
        
        $user_pass = base64_decode($auth_header[1]);
        $user_pass = explode(':', $user_pass); 
        
       
    }

    
    public function login($req, $res) {
        $user_pass = explode(':', $req->getHeader('Authorization')[0]); 

        
        if(count($user_pass) !== 2) {
            return $this->view->response("Formato incorrecto", 400);  
        }

       
        $user = $this->model->getByUsuario($user_pass[0]);

        
        if ($user == null || !password_verify($user_pass[1], $user->password)) {
            return $this->view->response("Usuario o contraseña incorrectos", 400);  


        $token = $this->createJWT(array(
            'sub' => $user->id,
            'username' => $user->usuario,
            'role' => 'admin',
            'iat' => time(),
            'exp' => time() + 3600,
        ));

     
        return $this->view->response(['token' => $token], 200);
    }
    }
  
}
?>
