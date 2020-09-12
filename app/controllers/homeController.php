<?php

use app\interfaces\ControllerInterface;

class homeController implements ControllerInterface {

    public function __construct()
    {
        //
    }


    public function index()
    {
        require_once VIEWS.'testView.php';
    }
}
