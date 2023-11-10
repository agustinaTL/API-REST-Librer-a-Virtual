<?php

require_once './app/models/categorias.model.php';
require_once './app/views/categorias.view.php';


class CategoriasController {
    private $model;
    private $view;
    public function __construct() {
        AuthHelper::verify();

        $this->model = new CategoriaModel();
        $this->view = new Categoriasview();
    }
 
    function mostrarCategorias() {

            // obtengo tareas del controlador
            $categorias = $this->model->obtenerCategorias();

            // muestro las tareas desde la vista 
            $this->view->mostrarCategorias($categorias);
    }

    function mostrarTextosXCategoria($categoria){  
        $textos = $this->model->getTextosXCategoria($categoria);
        
        // muestro las tareas desde la vista 
        $this->view->mostrarTextoXCategortia($textos);

    }
}