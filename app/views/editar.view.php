<?php

class EditarView {
    public function showEditar($id) {  
        require 'templates/editar.phtml';
    }  
    public function showError($error) {
        require 'templates/error.phtml';
    }
} 