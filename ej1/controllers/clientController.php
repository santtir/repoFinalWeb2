<?php

require_once 'models/clientModel.php';
require_once 'helpers/authHelper.php';

class clientController
{
    private $model;
    private $view;
    private $authHelper;



    function __construct()
    {
        $this->model = new clientModel();
        $this->authHelper = new  AuthHelper();
        //$this->view=new clientView();

    }

    function addClient()
    {
        $this->authHelper->checkLoggedIn();
        $admin = $this->authHelper->checkRol();
        if ($admin == true) {
            if (
                !empty($_POST['nombre']) && isset($_POST['nombre']) &&
                !empty($_POST['dni']) && isset($_POST['dni']) &&
                !empty($_POST['telefono']) && isset($_POST['telefono']) &&
                !empty($_POST['direccion']) && isset($_POST['direccion']) &&
                !empty($_POST['ejecutivo']) && isset($_POST['ejecutivo'])
            ) {
                $nombre = $_REQUEST['nombre'];
                $dni = $_REQUEST['dni'];
                $telefono = $_REQUEST['telefono'];
                $direccion = $_REQUEST['direccion'];
                $ejecutivo = $_REQUEST['ejecutivo'];

                $allDni=$this->model->getDniClients();
                $repetido=false;
                $kilometros=200;
        
                for($i=0;$i<count($allDni);$i++){
                    if($allDni[$i]==$dni){
                        $repetido=true;
                    }
                }
                if($repetido==false){
                    $this->model->insertClient($nombre, $dni, $telefono, $direccion, $ejecutivo);
                    //con esta funcion me traigo el ultimo id de la tabla clientes
                    $lastId=$this->model->getLastId();
                    $this->model->addKilometros($lastId,$kilometros);
                    $this->view->successfulAggregate('se agrego el cliente de forma correcta');
                    if($ejecutivo==true){

                        $this->cardHelper->getBussinesCard;
                        $fecha_alta=$_REQUEST['fecha_alta'];
                        $nro_tarjeta=$_REQUEST['nro_tarjeta'];
                        $fecha_nacimiento=$_REQUEST['fecha_nacimiento'];
                        $tipo_tarjeta='ejecutiva';
                        $id_cliente=$_REQUEST['id_cliente'];


                        $this->model->addTarjet($fecha_alta,$nro_tarjeta,$fecha_nacimiento,$tipo_tarjeta,$id_cliente);
                    }
                }else{
                    $this->view->error('ERROR, ese dni ya esta registrado');
                }

            } else {
                $this->view->Error('Error, campos invalidos o vacios');
            }
        }else{
            $this->view->error('No eres un administrador');
        }
    }
}
