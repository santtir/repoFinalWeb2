<?php

class clientApiModel{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_pfy;charset=utf8', 'root', '');
    }
    

    function getTarjetas($id){
        $query=$this->db->prepare('SELECT * FROM tarjeta WHERE id_cliente=?');
        $query->execute([$id]);

        $tarjetas=$query->fetchAll(PDO::FETCH_OBJ);

        return $tarjetas;
    }

    function getTarjeta($id){
        $query=$this->db->prepare('SELECT * FROM tarjeta WHERE id=?');
        $query->execute([$id]);

        $tarjeta=$query->fetch(PDO::FETCH_OBJ);

        return $tarjeta;
    }


    function deleteTarjeta($id_tarjeta){
        $query=$this->db->prepare('DELETE FROM tarjeta WHERE id=?');
        $query->execute([$id_tarjeta]);
    }
}