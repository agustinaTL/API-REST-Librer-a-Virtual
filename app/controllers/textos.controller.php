<?php
require_once './app/models/textos.model.php';
require_once './app/views/libros.view.php';
require_once './app/helpers/auth.helper.php';

class TextosController
{
    private $model;
    private $view;

    public function __construct()
    {
        AuthHelper::verify();
        $this->model = new TextosModel();
        $this->view = new TextosView();
    }

    public function showTextos()
    {
        // obtengo tareas del controlador
        $textos = $this->model->getTextos();

        // muestro las tareas desde la vista 
        $this->view->showTextos($textos);
    }
    //
    public function addTexto()
    {

        // obtengo los datos del usuario
        $texto = $_POST['texto'];
        $autor = $_POST['autor'];
        $categoria = $_POST['categoria'];

        // validaciones
        if (empty($texto) || empty($autor)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertTexto($texto, $autor, $categoria);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar");
        }
    }

    //

    public function showTextosByCategoria($categoria)
    {
        $textos = $this->model->getTextosByCategoria($categoria);
        $this->view->showTextos($textos);
    }

    public function showTextosByAutor($autor)
    {
        $textos = $this->model->getTextosByAutor($autor);
        $this->view->showTextos($textos);
    }

    public  function showTextoById($id)
    {
        $texto = $this->model->getTextoById($id);
        $this->view->showTextos($texto);
    }
    public function deleteTexto($id)
    {
        $this->model->deleteTexto($id);
        header('Location: ' . BASE_URL . '/textos');
    }



    public function showHome()
    {
        $this->view->showHome();
    }
}
