<?php
require_once './app/views/editar.view.php';
require_once './app/models/textos.model.php';
require_once './app/helpers/auth.helper.php';

class EditarController {
    private $view;
    private $model;

    function __construct(){
        AuthHelper::verifyStrict();

        $this->model = new TextosModel();
        $this->view = new EditarView();
    }
 
    function showEditar($id){     
        $this->view->showEditar($id);
    }

    function editTexto($id){

        $texto=$_POST['texto'];
        $autor=$_POST['autor'];
        $categoria=$_POST['categoria'];
        
        if (empty($texto) || empty($autor)|| empty($categoria)) {
            $this->view->showError("Completar todos los campos");
            return;
        }
    
        $this->model->editTexto($texto, $autor, $categoria, $id);

        header('Location: ' . BASE_URL . '/textos');
    }
}
