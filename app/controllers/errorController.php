<?php

use app\interfaces\ControllerInterface;

class errorController implements ControllerInterface {

    public function __construct()
    {
        //
    }

    public function index()
    {
        $data = [
            'title' => 'Página no encontrada',
            'bg' => 'dark'
        ];
        View::render('404', $data);
    }
}