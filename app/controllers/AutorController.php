<?php
require_once './app/models/AutorModel.php';
require_once './app/views/AutorView.php';
require_once './app/helpers/AuthHelper.php';

//
class AutorController {

    private $model;
    private $view;

    function __construct() {
        AuthHelper::initialize();

        $this->view = new AutorView();
        $this->model = new AutorModel();
    }
    
    
    function showAutores($case=0, $autorNew=null) {
        

        $autores = $this->model->getAutores();
        if(!empty($autores))
            $this->view->showAutores($autores, $case, $autorNew);
        else 
            


            $this->view->showError('datos no encontrados');
    }
    
    function showAutorById($id, $case=0) {
        $autor = $this->model->getAutorById($id);
        if(!empty($autor))
            $this->view->showAutor($autor);
        else 
            $this->view->showError('datos no encontrados');
    }

    public function agregarAutor() {
        AuthHelper::verify();
        $nombre = $_POST['nombre'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $nacionalidad = $_POST['nacionalidad'];
        
        


        


        if (empty($nombre) || empty($fecha_nacimiento) || empty($nacionalidad)) {
            $this->view->showError("Complete todos los campos");
            return;
        }
        
        
        
        $id = $this->model->insertAutor($nombre, $fecha_nacimiento, $nacionalidad);
         


        if ($id) {
                 $this->showAutores(1);
        } else {
                 $this->view->showError("Error");
        }
    }

    function showAutorAModificar($id){
        AuthHelper::verify();
        $autor = $this->model->getAutorById($id);
        $this->view->showAutorModificar($autor);
    }

    function modificarAutor($id){
        AuthHelper::verify();
        if(isset($_POST['nombre']) && isset($_POST['fecha_nacimiento']) &&
          !empty($_POST['nombre']) && !empty($_POST['fecha_nacimiento'])){
            $nombre = $_POST['nombre'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            
            $this->model->modificarAutor($id, $nombre, $fecha_nacimiento);
            $this->showAutorById($id, 1);
        }
        else{
            $this->view->showError("Error al modificar");
        }
    }

    function solicitudEliminarAutor($id) {
        AuthHelper::verify();
        $TextosIdAutor=$this->model->getTextosIdByAutorId($id);
        if (empty($TextosIdAutor)) {
            $this->eliminarAutor($id);
        } else {
            $autor=$this->model->getAutorById($id);
            $this->showAutores(2, $autor);
        }
    }
    
    function eliminarAutor($id) {
        AuthHelper::verify();
        $copiaAutor=$this->model->getAutorById($id);
        $this->model->borrarAutorById($id);
        $autorEliminado=$this->model->getAutorById($id);
        
        if (empty($autorEliminado)) {
            $this->showAutores(3, $copiaAutor);
        } else {
            $this->view->showError("No pudo eliminarse");
        }
    } 
}
