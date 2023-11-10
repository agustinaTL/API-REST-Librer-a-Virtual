<?php
require_once './app/models/TextoModel.php';
require_once './app/views/TextoView.php';
require_once './app/models/AutorModel.php';
require_once './app/helpers/AuthHelper.php';

class TextoController {

    private $view;
    private $model;
    private $autorModel;

    function __construct() {
        AuthHelper::initialize();

        $this->view = new TextoView();
        $this->model = new TextoModel();
        $this->autorModel = new AutorModel();
    }

    function showTextos(){
        //obtengo texstosa
        $textos = $this->model->getTextosAutores();
        
        $autores = $this->autorModel->getautores();
        //obtengo autores y mando as la vista
        $this->view->showTextos($textos, $autores);
    }

    function showTextoById($id){
        $texto = $this->model->getTextoById($id);
        $this->view->showTexto($texto);
    }

    function showTextoAModificar($id){
        


        AuthHelper::verify();
        $texto = $this->model->getTextoById($id);
        $autores = $this->autorModel->getAutores();
        $this->view->showTextoAModificar($texto, $autores);
    }

    function agregarTexto(){
        AuthHelper::verify();
        if(isset($_POST['nombre']) && isset($_POST['fecha'])  && isset($_POST['stock']) &&  isset($_POST['valor']) &&  isset($_POST['id_autor']) &&
        !empty($_POST['nombre']) && !empty($_POST['fecha']) && !empty($_POST['stock']) && !empty($_POST['valor']) && !empty($_POST['id_autor'])){
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            
            $stock = $_POST ['stock'];
            $valor = $_POST ['valor'];
            $id_autor = $_POST ['id_autor'];

            $id = $this->model->agregarTexto($nombre, $fecha, $stock, $valor, $id_autor);
            if ($id) {
                header('Location: ' . BASE_URL . '/listarTextos');
            } else {
                $this->view->showError("Error al insrertar");
            }
        }
        else {
            $this->view->showError("todos los campos deben estar completos");
        }
    }

    function modificarTexto($id){
        AuthHelper::verify();
        if(isset($_POST['nombre']) && isset($_POST['fecha']) && isset($_POST['stock']) &&  isset($_POST['valor']) &&  isset($_POST['id_autor']) &&
        !empty($_POST['nombre']) && !empty($_POST['fecha']) && !empty($_POST['stock']) && !empty($_POST['valor']) && !empty($_POST['id_autor'])){
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            
            $stock = $_POST ['stock'];
            $valor = $_POST ['valor'];
            $id_autor = $_POST ['id_autor'];

            $this->model->modificarTexto($id, $nombre, $fecha, $stock, $valor, $id_autor);
            $this->view->showMensaje("Se modifico correctamente");
        }
        else{
            $this->view->showError("verifica que todos los campos esten completos");
        }
    }

    function eliminarTexto($id){
        AuthHelper::verify();
        $this->model->borrarTexto($id);
        header('Location: ' . BASE_URL . '/listarTextos');
    }

}