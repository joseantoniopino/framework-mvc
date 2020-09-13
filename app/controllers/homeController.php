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
            'title' => 'Una página',
            'bg' => 'dark'
        ];
        View::render('bee', $data);
    }
}
