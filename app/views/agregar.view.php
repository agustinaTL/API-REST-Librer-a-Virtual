
<?php

class AgregarView {
    public function showAgregar($id =  null){
        require_once './templates/agregar.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
} 