<?php

class clientModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_pfy;charset=utf8', 'root', '');
    }

    function getClientByName($nombre){
        $query=$this->db->prepare('SELECT * FROM cliente WHERE nombre=?');
        $query->execute([$nombre]);

        $cliente=$query->fetchAll(PDO::FETCH_OBJ);

        return $cliente;
    }

    function accountMovements($nombre){

        $query=$this->db->prepare('SELECT c.nombre AS nombre, c.dni AS dni, 
        a.kms AS kilometros, a.fecha AS fecha, a.tipo_operacion AS operacion, 
        t.nro_tajerta AS numero_tarjeta, t.fecha_vencimiento AS vencimiento 
        FROM cliente AS c 
        INNER JOIN actividad AS a
        INNER JOIN tarjeta AS t
        WHERE c.nombre=?');
        
        $query->execute([$nombre]);

        $clientActivity=$query->fetchAll(PDO::FETCH_OBJ);

        return $clientActivity;

    }
}
