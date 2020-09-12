<?php

/*
 * Función para convertir un array en un objeto
 */
function to_object(array $array): object
{
    return json_decode(json_encode($array));
}
