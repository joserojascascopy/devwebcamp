<?php

function debug($variable) {
    echo "<pre>";
    echo var_dump($variable);
    echo "</pre>";
    exit;
}

function pagina_actual($path): bool {
    if (!isset($_SERVER['PATH_INFO'])) {
        return false;
    }

    return str_contains($_SERVER['PATH_INFO'], $path) ? true : false;
}

function isAuth() {
    if(!isset($_SESSION)) {
        session_start();
    }

    return isset($_SESSION['login']) && !empty($_SESSION);
}

function isAdmin() {
    if(!isset($_SESSION)) {
        session_start();
    }

    return isset($_SESSION['login']) && !empty($_SESSION['admin']);
}

function aos_animacion() : void {
    $efectos = [
        'fade-up',
        'fade-down',
        'fade-left',
        'fade-right',
        'zoom-in',
        'zoom-out',
        'flip-up',
        'flip-down',
        'flip-left',
        'flip-right'
    ];

    $efecto = $efectos[array_rand($efectos, 1)];

    echo $efecto;
}