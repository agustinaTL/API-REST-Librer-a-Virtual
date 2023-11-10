<?php

class TextosModel {
    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=libreria;charset=utf8', 'root', '');
    }


    function getTextosByCategoria($categoria){
        $query = $this->db->prepare('SELECT textos.*, categorias.nombre AS nombre_categoria FROM textos INNER JOIN categorias ON textos.categoriaID = categorias.categoriaID WHERE categorias.categoriaID=?');
        $query->execute([$categoria]);
        $textos = $query->fetchAll(PDO::FETCH_OBJ);
        return $textos;
    }


    function getTextosByAutor($autor){
        $query = $this->db->prepare('SELECT textos.*, categorias.nombre AS nombre_categoria FROM textos INNER JOIN categorias ON textos.categoriaID = categorias.categoriaID WHERE textos.autor= ?');
        $query->execute([$autor]);
        $textos = $query->fetchAll(PDO::FETCH_OBJ);
        return $textos;
    }

    function getTextoById($id){
        $  $query = $this->db->prepare('SELECT textos.*, categorias.nombre AS nombre_categoria FROM textos INNER JOIN categorias ON textos.categoriaID = categorias.categoriaID WHERE ID = ?');
        $query->execute([$id]);

        $texto = $query->fetch(PDO::FETCH_OBJ);
        return $texto;
    }




    function getTextos(){
        $query = $this->db->prepare('SELECT A.id,A.texto,A.autor,A.stock,B.Nombre FROM textos A INNER JOIN categorias B ON A.categoriaID=B.CategoriaID');
        $query-> execute();

        $textos =$query->fetchAll(PDO::FETCH_OBJ);

        return $textos;
    }
 
    function insertTexto($texto, $autor, $categoria) {        
    
        $query = $this->db->prepare('INSERT INTO textos (texto, autor, categoriaID) VALUES(?,?,?)');
        $query->execute([$texto, $autor, $categoria]);
    
        return $this->db->lastInsertId();
    }

    function deleteTexto($id){        
        
        $query = $this->db->prepare('DELETE FROM textos WHERE id=?');
        $query->execute([$id]);
    }

    function editTexto($texto, $autor, $categoria, $id){
        $query = $this->db->prepare('UPDATE textos SET texto=?, autor=?, categoriaID=? WHERE id=?');
        $query->execute([$texto, $autor, $categoria,$id]);

    }

    function borrarTexto($id){
        $query = $this->db->prepare('DELETE FROM textos WHERE id = ?');
        $query->execute([$id]);
    }
    


    function showError($error) {
        require 'templates/error.phtml';
    }

}