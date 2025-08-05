<?php

function debug($variable) {
    echo "<pre>";
    echo var_dump($variable);
    echo "</pre>";
}

function pagina_actual($path) : bool {
    return str_contains($_SERVER['PATH_INFO'], $path) ? true : false;
}