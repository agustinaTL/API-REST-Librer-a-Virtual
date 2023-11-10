<?php
require_once './app/views/agregar.view.php';
require_once './app/models/usermodel.php';
require_once './app/models/textos.model.php';
require_once './app/helpers/auth.helper.php';

class AgregarController {
    private $view;
    private $model;

    function __construct(){
        AuthHelper::verifyStrict();

        $this->model = new TextosModel();
        $this->view = new AgregarView();
    }

    function showAgregar(){     
        $this->view->showAgregar();
    }

    function addTexto(){

    $texto=$_POST['texto'];
    $autor=$_POST['autor'];
    $categoria=$_POST['categoria'];
    
    if (empty($texto) || empty($autor)|| empty($categoria)) {
        $this->view->showError("Completar todos los campos");
        return;
    }

    $id = $this->model->insertTexto($texto, $autor, $categoria);

    if ($id) {        
        $this->view->showAgregar($id);
    } else {
        echo "Error al insertar texto";
    }

    } 
}