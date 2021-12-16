<?php

class AuthHelper
{
    function __construct()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function checkLoggedIn() {
        if (empty($_SESSION['USER_ID']) ) {
            
            //header("Location: " . LOGIN);
            die();
        }
    }

    public function checkRol(){
        if(!empty($_SESSION['ROL'])){
            
            switch($_SESSION['ROL']){
                case'admin':
                    return true;
                break;
                case'user':
                   return false;
                break;
                default:
                die();
            }

        }
    }
}
