<?php

require_once './config.php';

class UserModel {
    private $dataBase;

    function __construct(){
        $this->dataBase = new PDO('mysql:host=localhost;dbname=libreria2;charset=utf8', 'root', '');
    }

    function getUserByUsername($username){
        $query = $this->dataBase->prepare('SELECT * FROM users WHERE username = ?');
        $query->execute([$username]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

}