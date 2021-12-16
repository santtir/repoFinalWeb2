<?php

require_once 'models/clientModel.php';
require_once 'helpers/authHelper.php';



class clientController{

    private $model;
    private $view;
    private $authHelper;

    function __construct()
    {
        $this->model = new clientModel();
        //$this->view=new View();
        $this->authHelper=new AuthHelper();
    }

    function sendKms(){
        $this->authHelper->checkLoggedIn();

        if(!empty($_POST['kms-send']) && !empty($_POST['dni'])){
            $kmsSend=$_REQUEST['kms-send'];
            $dni=$_REQUEST['dni'];
            $id_user=$this->authHelper->obtenerId();
            $this->verifyFounds($id_user,$kmsSend);
            $idClientAddresse=$this->verifyAddresse($dni);
            $this->model->sendKms($idClientAddresse,$kmsSend);
        }else{
            $this->view->error('Campos vacios');
        }
    }

    function verifyFounds($id_user,$kmsSend){

        $kmsAvaiable=$this->model->verifyFounds($id_user);

        if($kmsAvaiable<$kmsSend){
            $this->view->error('KILOMETROS INSUFICIENTES');
        }
    }

    function verifyAddresse($dni){

        $clientAddresse=$this->model->verifyAddresse($dni);

        if(empty($clientAddresse) && !isset($clientAddresse)){
            $this->view->error('El destinatario no existe');
        }else{
            return $clientAddresse;
        }

    }
}