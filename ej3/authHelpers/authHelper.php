<?php

class AuthHelper
{
    function __construct()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function checkLoggedIn()
    {
        if (empty($_SESSION['USER_ID'])) {

            //header("Location: " . LOGIN);
            die();
        }
    }

    public function obtenerId(){
        $user= $_SESSION['USER_ID'];
        return $user;
     }
}
