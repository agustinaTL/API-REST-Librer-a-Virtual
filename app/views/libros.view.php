<?php
class LibrosView
{
    function showTexto($textos)
    {
        require_once './templates/textos.phtml';
    }
    function showTextos($textos)
    {
        require_once './templates/ListaTextos.phtml';
    }
    public function showHome()
    {
        require 'templates/home.phtml';
    }
    public function showError($error)
    {
        require 'templates/error.phtml';
    }
}
