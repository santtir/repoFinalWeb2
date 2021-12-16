<?php

require_once 'models/clientModel.php';


class clientController
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new clientModel();
        //$this->view=new View();

    }

    function accountSummary()
    {

        if (!empty($_POST['nombre'])) {

            $nombre=$_REQUEST['nombre'];
            //verifico que el usuario con ese nombre exista
            $clienteExiste=$this->model->getClientByName($nombre);

            if(isset($clienteExiste) && !empty($clienteExiste)){
               $clientActivity=$this->model->accountMovements($nombre);
                $this->view->movements($clientActivity);

            }else{
                $this->view->error('el nombre de cliente no existe');
            }

        }else{
            $this->view->error('ERROR,campos vacios');
        }
    }
}
