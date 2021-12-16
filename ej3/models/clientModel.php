<?php  

class clientModel{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_pfy;charset=utf8', 'root', '');
    }

    function sendKms($id_cliente,$kms){

        $query=$this->db->prepare('UPDATE actividad SET kms=? WHERE id_cliente=?');
        $query->execute([$id_cliente,$kms]);
    }

    function verifyFounds($id_user){
        $query=$this->db->prepare('SELECT kms FROM actividad WHERE id_cliente=?');
        $query->execute([$id_user]);

        $kmsAvaiable=$query->fetch(PDO::FETCH_OBJ);
    
        return $kmsAvaiable;
    }

    function verifyAddresse($dni){

        $query=$this->db->prepare('SELECT id FROM cliente where dni=?');
        $query->execute([$dni]);

        $id_addresse=$query->fetch(PDO::FETCH_OBJ);

        return $id_addresse;
    }
}