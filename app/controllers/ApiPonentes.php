<?php

namespace Controllers;

use Models\Ponentes;

class ApiPonentes {
    public static function index() {
        $ponentes = Ponentes::all();

        echo json_encode($ponentes);
    }
}