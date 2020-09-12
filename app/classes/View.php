<?php

declare(strict_types=1);


class View
{
    public static function render(string $view, array $data = [])
    {
        $d = to_object($data);
        if (!is_file(VIEWS . CONTROLLER . DS . $view . 'View.php')) {
            die(sprintf('No existe la vista %sView en el directorio %s', $view, CONTROLLER));
        } else {
            require_once VIEWS . CONTROLLER . DS . $view . 'View.php';
            exit();
        }
    }
}