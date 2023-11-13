<?php

require_once './app/models/model.php';

class AutorModel extends Model
{


    function getAutor($page = 1, $orderQuery = '')
    {

        $query = $this->db->prepare('SELECT * FROM autores ' . $orderQuery . ' LIMIT 5 OFFSET ' . (($page - 1) * 5));
        $query->execute();
        $autor = $query->fetchAll(PDO::FETCH_OBJ);

        return $autor;
    }

    function addAutor($nombre, $fecha_nacimiento, $nacionalidad)
    {

        $query = $this->db->prepare('INSERT INTO autores (nombre, fecha_nacimiento, nacionalidad) VALUES ( ? , ? , ?)');
        $query->execute([$nombre, $fecha_nacimiento, $nacionalidad]);
        return $this->db->lastInsertId();
    }

    function editAutor($id, $nombre, $fecha_nacimiento, $nacionalidad)
    {
        try {
            $query = $this->db->prepare('UPDATE autores SET nombre = ?, fecha_nacimiento = ?, nacionalidad = ? WHERE id_autor = ?');
            $query->execute([$nombre, $fecha_nacimiento, $nacionalidad, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    function deleteAutor($id)
    {
        $query = $this->db->prepare('DELETE FROM autores WHERE id_autor = ?');
        $query->execute([$id]);
    }

    public function getAutorById($id)
    {
        $query = $this->db->prepare('SELECT * FROM autores WHERE id_autor = ?');
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    function autorHasColumn($column)
    {
        $query = $this->db->prepare("DESCRIBE autores");
        $query->execute();
        $columnas = $query->fetchAll(PDO::FETCH_COLUMN);

        return in_array($column, $columnas);
    }
}
