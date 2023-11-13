<?php

require_once './app/models/AutorModel.php';
require_once './app/views/API.view.php';
require_once './app/controllers/API.controller.php';

//
class AutorAPIController extends ApiController
{
    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new AutorModel();
    }

    function get($params = [])
    {
        if (empty($params)) {
            $num = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $page = $num > 0 ? $num : 1;
            $sort = isset($_GET['sort']) ? $_GET['sort'] : null;
            $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

            $orderQuery = '';
            $acceptedOrders = ['ASC', 'DESC'];

            if (isset($sort)) {
                if ($this->model->autorHasColumn($sort) && in_array(strtoupper($order), $acceptedOrders)) {
                    $orderQuery = 'ORDER BY ' . $sort . ' ' . $order;
                } else {
                    $this->view->response(['response' => 'Bad Request'], 400);
                    return;
                }
            }

            $autor = $this->model->getAutor($page, $orderQuery);
            if (isset($autor)) {
                $this->view->response($autor, 200);
            } else {
                $this->view->response(['response' => 'Bad Request'], 400);
            }
        } else {
            $autor = $this->model->getAutorById($params[':ID']);

            if (!empty($autor)) {
                $this->view->response($autor, 200);
            } else {
                $this->view->response(['response' => 'Not Found'], 404);
            }
        }
    }
    function add()
    {
        $body = $this->getData();
        $nombre = $body->nombre;
        $fecha_nacimiento = $body->fecha_nacimiento;
        $nacionalidad = $body->nacionalidad;
        $id = $this->model->addAutor($nombre, $fecha_nacimiento, $nacionalidad);

        if ($id) {
            $this->view->response(['response' => 'Autor added with id ' . $id], 200);
        } else {
            $this->view->response(['response' => 'Error on adding'], 404);
        }
    }

    function delete($params = [])
    {
        $autor = $this->model->getAutorById($params[':ID']);
        if ($autor) {
            $this->model->deleteAutor($params[':ID']);
            $this->view->response(['response' => 'Autor deleted'], 200);
        } else {
            $this->view->response(['response' => 'Not Found'], 404);
        }
    }

    function update($params = [])
    {
        $id_autor = $params[':ID'];
        $autor = $this->model->getAutorById($id_autor);

        if ($autor) {
            $body = $this->getData();
            $nombreautor = $body->nombreautor;
            $apellido = $body->apellido;

            $boolean = $this->model->editAutor($id_autor, $nombreautor, $apellido);
            if ($boolean) {
                $this->view->response(['response' => 'autor ' . $id_autor . ' updated'], 200);
            } else {
                $this->view->response(['response' => 'Error on updating'], 404);
            }
        }
    }
}
