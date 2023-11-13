<?php
require_once './app/models/textos.model.php';
require_once './app/views/API.view.php';
require_once './app/controllers/API.controller.php';


// Clase para manejar el recurso textos

class LibrosApiController extends APIController {
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new TextosModel();
        $this->view = new APIView();
    }

    function getAll()
    {
        $libros = $this->model->getTextos();
        $this->view->response($libros, 200);
    }

    function getTextos($params = ['orderBy', 'orderDirection'])
    {
        // La API tiene que permitir traer todos los libros(textos): /api/textos
        if (empty($params)) {
            $libros = $this->model->getTextos();
            return $this->view->response($libros, 200);
        } else {
            // La API tiene que permitir traer un libro(texto): /api/textos/:ID
            $libro = $this->model->getTextos($params[":ID"]);
            if (!empty($libro)) {
                return $this->view->response($libro, 200);
            }
        }

        // /api/textos?sort=titulo, autor...&order=asc
        // Por parámetro GET recibe el valor de “sort” y “order”, 
        // que devuelve el arreglo de libros ordenado por titulo, autor (etc) ascendente
        $resultados = "";
        // Ordenar los resultados
        if (($params = 'orderBy' != null && 'orderDirection' != null)) {
            if (orderDirection . equals("asc")) {
                $resultados . sort(Comparator . comparing(T::getTitulo));
            } else if (orderDirection . equals("desc")) {
                $resultados . sort(Comparator . comparing(T::getAutor) . reversed());
            }
        }
        return $resultados;
    }
}

<<<<<<< HEAD
=======

>>>>>>> 260a19b41466907d1780204a7fd884d4431d4c23
// Definimos una clase abstracta común para encapsular los métodos:

abstract class ApiController
{
    protected $model; // lo instancia el hijo
    protected $view;

    private $data;

    public function __construct()
    {
        $this->view = new APIView();
        $this->data = file_get_contents("php://input");
    }

    function getData()
    {
        return json_decode($this->data);
    }
}

// Definimos la clase concreta que implementa el controlador para textos:

class TextosApiController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new TextosModel();
    }


    // Agregar libro (recurso textos): (POST) /api/textos

    public function addTexto($params = [])
    {
        // Devuelve el objeto JSON enviado por POST     
        $body = $this->getData();

        // Inserta el libro
        $titulo = $body->showTextoById;
        $autor = $body->showTextosByAutor;
        $categoria = $body->showTextosByCategoria;
        $categoria = $this->model->saveTexto($titulo, $autor);
    }


    // Modificar libro (recurso textos): (PUT) /api/textos

    public function updateTexto($params = [])
    {
        $texto_id = $params[':ID'];
        $texto = $this->model->getTexto($texto_id);

        if ($texto) {
            $body = $this->getData();
            $titulo = $body->showTextoById;
            $autor = $body->showTextosByAutor;
            $categoria = $body->showTextosByCategoria;
            $texto = $this->model->updateTexto($texto_id, $titulo, $autor, $categoria);
            $this->view->response("Libro id=$texto_id actualizado con éxito", 200);
        } else
            $this->view->response("Libro id=$texto_id not found", 404);
    }
}
