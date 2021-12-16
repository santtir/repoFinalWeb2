<?php 

class clientModel{
    private $db;

    function __construct()
    {
       $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_pfy;charset=utf8', 'root', '');
        
    }

    function insertClient($nombre,$dni,$telefono,$direccion,$ejecutivo){

        $query=$this->db->prepare('INSERT INTO cliente (nombre,dni,telefono,direccion,ejecutivo) VALUES (?,?,?,?,?)');
        $query->execute([$nombre,$dni,$telefono,$direccion,$ejecutivo]);

        return $this->db->lastInsertId();
    }

    function getDniClients(){

        $query=$this->db->prepare('SELECT dni FROM cliente');
        $query->execute();

        $dniClients=$query->fetchAll(PDO::FETCH_OBJ);

        return $dniClients;
    }

    function getLastId(){

        $query=$this->db->prepare('SELECT MAX(id) FROM cliente');
        $query->execute();

        $lastId=$query->fetch(PDO::FETCH_OBJ);

        return $lastId;
    }

    function addKilometros($lastId,$kilometros){

        $query=$this->db->prepare('INSERT INTO actividad (kms) VALUES(?) WHERE id_cliente=?');
        $query->execute([$lastId,$kilometros]);

        return $this->db->lastInsertId();
    }

    function addTarjet($fecha_alta,$nro_tarjeta,$fecha_nacimiento,$tipo_tarjeta,$id_cliente){

        $query=$this->db->prepare('INSERT INTO tarjeta (fecha_alta,nro_tarjeta,fecha_nacimiento,tipo_tarjeta,id_cliente) 
        VALUES (?,?,?,?,?)');

        $query->execute([$fecha_alta,$nro_tarjeta,$fecha_nacimiento,$tipo_tarjeta,$id_cliente]);
    }
}