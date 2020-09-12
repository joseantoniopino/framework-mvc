<?php

use app\interfaces\ControllerInterface;

class errorController implements ControllerInterface {

    public function __construct()
    {
        //
    }

    public function index()
    {
        echo '<h1>Página no encontrada</h1>';
    }
}