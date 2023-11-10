<?php

class TextoView {

    function showTextos($textos, $autores){
        require_once './templates/ListaTextos.phtml';
    }

    function showTexto($texto, ){
        require_once './templates/Texto.phtml';
    }

    function showTextoAModificar($texto, $autores){
        require_once './templates/FormularioModificar.phtml';
    }

    public function showError($error) {
        require 'templates/Error.phtml';
    }

    public function showMensaje($mensaje) {
        require 'templates/MensajeCorrecto.phtml';
    }

}