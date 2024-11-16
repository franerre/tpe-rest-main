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
        // Obtén el header de autorización
        $auth_header = $_SERVER['HTTP_AUTHORIZATION']; // "Basic dXN1YXJpbw=="
        if (!$auth_header) {
            return $this->view->response("Falta el header de autorización", 400);
        }
    
        $auth_header = explode(' ', $auth_header); // ["Basic", "dXN1YXJpbw=="]
        
        if (count($auth_header) != 2 || $auth_header[0] != 'Basic') {
            return $this->view->response("Error en los datos ingresados", 400);
        }
        
        // Decodifica el usuario y la contraseña
        $user_pass = base64_decode($auth_header[1]); // "usuario:password"
        $user_pass = explode(':', $user_pass); // ["usuario", "password"]
        
        // Aquí puedes seguir con la lógica de obtención del token
    }

    // Método para login
    public function login($req, $res) {
        $user_pass = explode(':', $req->getHeader('Authorization')[0]); // `usuario:contraseña`

        // Verificamos si las credenciales se enviaron correctamente
        if(count($user_pass) !== 2) {
            return $this->view->response("Formato incorrecto", 400);  // Error 400 si no está bien formateado
        }

        // Buscamos al usuario en la base de datos
        $user = $this->model->getByUsuario($user_pass[0]);

        // Verificamos si el usuario no existe o si la contraseña no coincide
        if ($user == null || !password_verify($user_pass[1], $user->password)) {
            return $this->view->response("Usuario o contraseña incorrectos", 400);  // Error 400 si credenciales incorrectas
        }

        // Si las credenciales son correctas, generamos el JWT
        $token = $this->createJWT(array(
            'sub' => $user->id,
            'username' => $user->usuario,
            'role' => 'admin',
            'iat' => time(),
            'exp' => time() + 3600,
        ));

        // Respondemos con el token si todo está bien
        return $this->view->response(['token' => $token], 200);
    }

  
}
?>
