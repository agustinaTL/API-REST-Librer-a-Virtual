<?php

require_once './config.php';

class TextoModel {
    private $dataBase;

    function __construct(){
        $this->dataBase = new PDO('mysql:host=localhost;dbname=libreria2;charset=utf8', 'root', '');
    }

    function getTextosAutores(){
        $query = $this->dataBase->prepare('SELECT textos.*, autores.nombre AS nombre_autor FROM textos INNER JOIN autores ON textos.id_autor = autores.id_autor');
        $query->execute();

        $textos = $query->fetchAll(PDO::FETCH_OBJ);
        return $textos;
    }

    function getTextoById($id){
        $query = $this->dataBase->prepare('SELECT textos.*, autores.nombre AS nombre_autor FROM textos INNER JOIN autores ON textos.id_autor = autores.id_autor WHERE id_texto = ?');
        $query->execute([$id]);

        $texto = $query->fetch(PDO::FETCH_OBJ);
        return $texto;
    }

    function agregarTexto($nombre, $fecha, $stock, $valor, $autor_id){
        $query = $this->dataBase->prepare('INSERT INTO textos (nombre, fecha, stock, valor, id_autor) VALUES (?,?,?,?,?)');
        $query->execute([$nombre, $fecha, $stock, $valor, $autor_id]);
        
        return $this->dataBase->lastInsertId();
    }

    function modificarTexto($id,$nombre, $fecha, $stock, $valor, $autor_id){
        $query = $this->dataBase->prepare('UPDATE textos SET nombre = ?, fecha = ?, stock = ?, valor = ?, id_autor = ? WHERE id_texto = ?');
        $query->execute([$nombre, $fecha, $stock, $valor, $autor_id, $id]);
    }

    function borrarTexto($id){
        $query = $this->dataBase->prepare('DELETE FROM textos WHERE id_texto = ?');
        $query->execute([$id]);
    }

}