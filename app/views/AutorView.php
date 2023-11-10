<?php

class AutorView {

    function showAutores($autores, $posMsj, $autorNew){
        switch ($posMsj) {
            case '0':
                require_once './templates/Header.phtml';  
                require_once './templates/ListaAutores.phtml';
                require_once './templates/FormAgregarAutor.phtml';
                require_once './templates/Footer.phtml'; 
                break;
            case '1':
                require_once './templates/Header.phtml';  
                require_once './templates/ListaAutores.phtml';
                require_once './templates/MensajeCorrectoAgregarAutor.phtml';
                require_once './templates/FormAgregarAutor.phtml';
                require_once './templates/Footer.phtml'; 
                break;
            case '2':
                require_once './templates/Header.phtml';  
                require_once './templates/ListaAutores.phtml';
                require_once './templates/AdvertenciaEliminarAutor.phtml';
                require_once './templates/FormAgregarAutor.phtml';
                require_once './templates/Footer.phtml'; 
                break;
            case '3':
                require_once './templates/Header.phtml';  
                require_once './templates/ListaAutores.phtml';
                require_once './templates/MensajeCorrectoEliminarAutor.phtml';
                require_once './templates/FormAgregarAutor.phtml';
                require_once './templates/Footer.phtml'; 
                break;
            default: 
                require_once './templates/Header.phtml';  
                require_once './templates/ListaAutores.phtml';
                require_once './templates/FormAgregarAutor.phtml';

                require_once './templates/Footer.phtml'; 
                break;
        }
    }

    function showAutor($autor, $posMsj=0){
        switch ($posMsj) {
            case '0':
                require_once './templates/Header.phtml';  
                require_once './templates/Autor.phtml';
                require_once './templates/Footer.phtml';
                break;
            case '1':
                require_once './templates/Header.phtml';  
                require_once './templates/Autor.phtml';
                require_once './templates/MensajeCorrectoModificarAutor.phtml';
                require_once './templates/Footer.phtml';
                break;
            default: 
                require_once './templates/Header.phtml';  
                require_once './templates/Autor.phtml';
                require_once './templates/Footer.phtml';
                break;
        } 
    }

    function showAutorModificar($autor){
        require_once './templates/FormularioModificarAutor.phtml';
    }

    function showError($error) {
        require_once './templates/error.phtml';
    }
}