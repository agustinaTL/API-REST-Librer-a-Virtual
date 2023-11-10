<?php

class CategoriasView {
    public function mostrarCategorias($categorias) {
        require './templates/categorias.phtml';
    }

    public function mostrarTextoXCategortia($textos) {
        require './templates/textosXCategoria.phtml';
    }

} 