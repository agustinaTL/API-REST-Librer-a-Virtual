<?php
require_once './app/models/Texto.Model.php';
require_once './app/views/API.view.php';
require_once './app/controllers/API.controller.php';


// Clase para manejar el recurso textos

class LibrosApiController extends APIController
{
    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new TextoModel();
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
                if ($this->model->textoHasColumn($sort) && in_array(strtoupper($order), $acceptedOrders)) {
                    $orderQuery = 'ORDER BY ' . $sort . ' ' . $order;
                } else {
                    $this->view->response(['response' => 'Bad Request'], 400);
                    return;
                }
            }

            $textos = $this->model->getTextos($page, $orderQuery);

            if (isset($textos)) {
                $this->view->response($textos, 200);
            } else {
                $this->view->response(['response' => 'Bad Request'], 400);
            }
        } else {
            $texto = $this->model->getTexto($params[':ID']);

            if (!empty($texto)) {
                $this->view->response($texto, 200);
            } else {
                $this->view->response(['response' => 'Not Found'], 404);
            }
        }
    }
    function delete($params = [])
    {
        $texto = $this->model->getTexto($params[':ID']);

        if ($texto) {
            $this->model->deleteTexto($params[':ID']);
            $this->view->response(['response' => 'text deleted'], 200);
        } else {
            $this->view->response(['response' => 'Not Found'], 404);
        }
    }

    function add()
    {
        $body = $this->getData();
        $id_texto = $body->id_texto;
        $nombre = $body->nombre;
        $fecha = $body->fecha;
        $valor = $body->valor;
        $autor = explode(',', $body->autor);

        $boolean = $this->model->addTexto($id_texto, $nombre, $fecha, $valor, $autor);

        if ($boolean) {
            $this->view->response(['response' => 'text added'], 201);
        } else {
            $this->view->response(['response' => 'Error on adding'], 404);
        }
    }

    function update($params = [])
    {

        $id_texto = $params[':ID'];
        $texto = $this->model->getTexto($id_texto);

        if ($texto) {
            $body = $this->getData();
            $nombre = $body->nombre;
            $fecha = $body->fecha;
            $valor = $body->valor;
            $autor = explode(',', $body->autor);

            $boolean = $this->model->updateTexto($id_texto, $nombre, $fecha, $valor, $autor);

            if ($boolean) {
                $this->view->response(['response' => 'texto ' . $id_texto . ' updated'], 200);
            } else {
                $this->view->response(['response' => 'Error on updating'], 404);
            }
        }
    }
}
