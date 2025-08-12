<?php

namespace Controllers;

use Models\Evento;
use Models\Hora;
use Models\Dia;
use Models\Categoria;
use MVC\Router;

class EventosController {
    public static function index(Router $router) {

        $router->render('admin/eventos/index', [
            'titulo' => 'Conferencias y Wokshops'
        ]);
    }

    public static function crear(Router $router) {
        $alertas = Evento::getAlertas();

        $categorias = Categoria::all();
        $dias = Dia::all();
        $horas = Hora::all();

        $evento = new Evento;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento->sincronizar($_POST);

            $alertas = $evento->validar();

            if(empty($alertas)) {
                $resultado = $evento->guardar();

                if($resultado) {
                    header('Location: /admin/eventos');
                }
            }
        }

        $router->render('admin/eventos/crear', [
            'titulo' => 'Registrar Evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }
}