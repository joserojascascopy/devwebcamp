<?php

namespace Controllers;

use Models\EventoHorario;

class ApiEventos {
    public static function index() {
        $dia_id = (int) $_GET['dia_id'] ?? '';
        $categoria_id = (int) $_GET['categoria_id'] ?? '';

        $dia_id = filter_var($dia_id, FILTER_VALIDATE_INT);
        $categoria_id = filter_var($categoria_id, FILTER_VALIDATE_INT);

        if($dia_id === false || $categoria_id === false) {
            echo json_encode([]);

            return;
        }

        // Consultar la DB
        $eventos = EventoHorario::whereArray(['categoria_id' => $categoria_id, 'dia_id' => $dia_id]);

        echo json_encode($eventos);
    }
}