<?php

use app\interfaces\ControllerInterface;

class homeController implements ControllerInterface {

    public function __construct()
    {
        //
    }


    public function index()
    {
        $data = [
            'id' => 1,
            'titulo' => 'Una página'
        ];
        View::render('test', $data);
    }
}
