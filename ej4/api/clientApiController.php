<?php

require_once 'clientApiModel.php';

class clientApiController{

    private $model;
    private $view;

    function __construct()
    {
        $this->model = new clientApiModel();
        //$this->view=new apiView();
    }


    function getTarjetas($params=null){
        if(isset($params[':ID']) && !empty($params[':ID'])){
            $id_user=$params[':ID'];

            $tarjetas=$this->model->getTarjetas($id_user);
            if($tarjetas){
                $this->view->reponse($tarjetas,200);
            }else{
                $this->view->response('ERROR',404);
            }
        }
    }

    function deleteTarjeta($params=null){
        if(isset($params[':ID']) && !empty($params[':ID'])){
            $id=$params[':ID'];

            $id_tarjeta=$this->model->getTarjeta($id);
            if($id_tarjeta){
                $this->model->deleteTarjeta($id_tarjeta);
                $this->view->reponse('Tarjeta eliminada',200);
            }else{
                $this->view->reponse('Tarjeta inexistente',404);

            }

        }
    }
}