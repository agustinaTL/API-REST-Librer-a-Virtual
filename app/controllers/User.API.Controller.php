<?php
require_once './app/models/user.Model.php';
require_once './app/helpers/auth.api.helper.php';
require_once './app/views/API.view.php';
require_once './app/controllers/API.controller.php';


// Clase para manejar el recurso textos

class UserApiController extends APIController
{
    private $model;
    private $authHelper;

    function __construct()
    {
        parent::__construct();
        $this->authHelper = new AuthHelper();
        $this->model = new TextoModel();
    }

    function getToken($params = [])
    {
        $basic = $this->authHelper->getAuthHeaders(); //Nos va a dar el header "Authorization"

        if (empty($basic)) {
            $this->view->response("No envió encabezados de autenticación", 401);
            return;
        }
        // Si envió algo debería tener formato: método "Basic" y valor "base64(usr:pass)"
        $basic = explode(" ", $basic); // Ahora es un arreglo: ["Basic", "base64(usr:pass)"]

        if ($basic[0] != "Basic") {
            $this->view->response("Los encabezados de autenticación son incorrectos", 401);
            return;
        }

        $userpass = base64_decode($basic[1]); // usr:pass
        $userpass = explode(":", $userpass); // Ahora tenemos un arreglo: ["user", "pass"]

        $user = $userpass[0];
        $pass = $userpass[1];

        $userdata = ["name" => $user, "id" => 123]; // Llamar a la Base de Datos

        if ($user == "TPE3" & $pass == "553394") {
            // Usuario es válido
            $token = $this->authHelper->createToken($userdata);
            $this->view->response($token);
        } else {
            // Datos incorrectos
            $this->view->response("El usuario o contraseña son incorrectos", 401);
        }
    }
}
