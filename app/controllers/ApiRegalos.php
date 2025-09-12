<?php

namespace Controllers;

use Models\Regalo;
use Models\Registro;

class ApiRegalos {
    public static function index() {
        if(!isAdmin()) {
            echo json_encode([]);

            return;
        }

        $regalos = Regalo::all();
        
        // Convertir cada objeto del array a stdClass, para poder agregar atributos dinamicamente
        $regalos = array_map(fn($regalo) => (object) get_object_vars($regalo), $regalos);
        
        foreach($regalos as $regalo) {
            $regalo->total = Registro::totalArray(['regalo_id' => $regalo->id]);
        }

        echo json_encode($regalos);
    }
}