<?php


require_once './config.php';

class AutorModel {
    private $dataBase;

    function __construct(){
        $this->dataBase = new PDO('mysql:host=localhost;dbname=libreria2;charset=utf8', 'root', '');
    }
 
    function getAutores(){
        $query = $this->dataBase->prepare('SELECT * FROM autores');
        $query->execute();

        $autores = $query->fetchAll(PDO::FETCH_OBJ);
        return $autores;
    }

    function getAutorById($id){
        $query = $this->dataBase->prepare('SELECT * FROM autores WHERE id_autor = ?');
        $query->execute([$id]);

        $autor = $query->fetch(PDO::FETCH_OBJ);
        return $autor;
    }

    function getTextosIdByAutorId($id){
        $query = $this->dataBase->prepare('SELECT id_texto FROM textos WHERE id_autor = ?');
        $query->execute([$id]);

        $textosId = $query->fetch(PDO::FETCH_OBJ);
        return $textosId;
    }

    function insertAutor($nombre, $fecha_nacimiento, $nacionalidad  ) {
        $query = $this->dataBase->prepare('INSERT INTO autores (nombre, fecha_nacimiento, nacionalidad) VALUES(?,?,?)');
        $query->execute([$nombre, $fecha_nacimiento, $nacionalidad  ]);
        //spuede fallar
        
        return $this->dataBase->lastInsertId();
    }

    function modificarAutor($id, $nombre, $fecha_nacimiento  ){
        $query = $this->dataBase->prepare('UPDATE autores SET nombre = ?, fecha_nacimiento = ? WHERE id_autor = ?');
        $query->execute([$nombre, $fecha_nacimiento, $id]);
    }


    function borrarAutorById($id){
        $query = $this->dataBase->prepare('DELETE FROM textos WHERE id_autor = ?');
        $query->execute([$id]);
        $query = $this->dataBase->prepare('DELETE FROM autores WHERE id_autor = ?');
        $query->execute([$id]);
    }
}