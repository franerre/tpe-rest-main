<?php
    require_once 'config.php';
    require_once 'libs/router.php';

    require_once 'app/controllers/equipos.api.controller.php';
    require_once 'app/controllers/jugadores.api.controller.php';
    require_once 'app/controllers/user.api.controller.php';
    

    $router = new Router();

    #                 endpoint      verbo     controller           método
    $router->addRoute('equipos',     'GET',    'EquipoApiController', 'get'   ); # EquipoApiController->get($params)
    $router->addRoute('equipos',     'POST',   'EquipoApiController', 'create');
    $router->addRoute('equipos/:ID', 'GET',    'EquipoApiController', 'get'   );
    $router->addRoute('equipos/:ID', 'PUT',    'EquipoApiController', 'update');
    $router->addRoute('equipos/:ID', 'DELETE', 'EquipoApiController', 'delete');

    $router->addRoute('jugadores',     'GET',    'JugadoresApiController', 'get'   ); # JugadorApiController->get($params)
    $router->addRoute('jugadores',     'POST',   'JugadoresApiController', 'create');
    $router->addRoute('jugadores/:ID', 'GET',    'JugadoresApiController', 'get'   );
    $router->addRoute('jugadores/:ID', 'PUT',    'JugadoresApiController', 'update');
    $router->addRoute('jugadores/:ID', 'DELETE', 'JugadoresApiController', 'delete');
    
    $router->addRoute('equipos/:ID/:subrecurso', 'GET',    'EquipoApiController', 'get'   );
    $router->addRoute('jugadores/:ID/:subrecurso', 'GET',    'JugadoresApiController', 'get'   );

    $router->addRoute('user/token', 'GET',    'UserApiController', 'getToken'   ); # UserApiController->getToken()
    
    #               del htaccess resource=(), verbo con el que llamo GET/POST/PUT/etc
    $router->route($_GET['resource']        , $_SERVER['REQUEST_METHOD']);

   
