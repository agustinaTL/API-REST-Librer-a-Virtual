<?php

require_once './app/models/model.php';

class TextoModel extends Model
{

    function getTextos($page = 1, $orderQuery = '')
    {
        $query = $this->db->prepare('SELECT * FROM textos ' . $orderQuery . ' LIMIT 5 OFFSET ' . (($page - 1) * 5));
        $query->execute();

        $textos = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($textos as $texto) {
            $texto->autor = $this->getAutorFromTexto($texto->id_texto);
        }

        return $textos;
    }

    function addTexto($id, $nombre, $fecha, $valor, $autor)
    {

        try {
            $query = $this->db->prepare('INSERT INTO `textos` (`id_texto`, `nombre`, `fecha`, `valor`) VALUES ( ? , ? , ? , ?)');
            $query->execute([$id, $nombre, $fecha, $valor]);



            return true;
        } catch (PDOException $e) {
            return null;
        }
    }



    function deleteTexto($id)
    {
        $query = $this->db->prepare('DELETE FROM textos WHERE id_texto = ?');
        $query->execute([$id]);
    }

    function updateTexto($id, $titulo, $fecha, $valor, $autor)
    {

        try {


            $query = $this->db->prepare('UPDATE textos SET nombre = ?, fecha = ? , valor = ? WHERE id_texto = ?');
            $query->execute([$titulo, $fecha, $valor, $id]);




            return true;
        } catch (PDOException $e) {
            return null;
        }
    }

    function getTexto($id)
    {

        $query = $this->db->prepare('SELECT * FROM textos WHERE id_texto = ?');
        $query->execute([$id]);

        $tex = $query->fetch(PDO::FETCH_OBJ);
        if (!empty($tex)) {
            $tex->autor = $this->getAutorFromTexto($tex->id_texto);
        }

        return $tex;
    }

    function getAutorFromTexto($id)
    {
        $query = $this->db->prepare('SELECT id_autor FROM textos WHERE id_texto = ?');
        $query->execute([$id]);
        $autor = $query->fetch(PDO::FETCH_OBJ);
        return $autor;
    }
    function textoHasColumn($column)
    {
        $query = $this->db->prepare("FECHA");
        $query->execute();
        $columnas = $query->fetchAll(PDO::FETCH_COLUMN);

        return in_array($column, $columnas);
    }
}
