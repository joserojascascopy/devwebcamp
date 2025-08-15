<?php

namespace Controllers;

use Libraries\Paginacion;
use Models\Evento;
use Models\Hora;
use Models\Dia;
use Models\Categoria;
use Models\Ponentes;
use MVC\Router;

class EventosController {
    public static function index(Router $router) {
        isAdmin();

        $pagina_actual = $_GET['page'] ?? '';
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) header('Location: /admin/eventos?page=1');

        $registros_por_pagina = 10;

        // Consultar el total de registros
        $total_registro = Evento::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registro);

        $eventos = Evento::paginar($registros_por_pagina, $paginacion->offset());
        
        // Convertir cada objeto del array a stdClass, para poder agregar atributos dinamicamente
        $eventos = array_map(fn($evento) => (object) get_object_vars($evento), $eventos);

        foreach($eventos as $evento) {
            /** @var Categoria|null $categoria */
            $categoria = Categoria::find($evento->categoria_id);
            $evento->categoria = $categoria->nombre;

            /** @var Dia|null $dia */
            $dia = Dia::find($evento->dia_id);
            $evento->dia = $dia->nombre;

            /** @var Hora|null $hora */
            $hora = Hora::find($evento->hora_id);
            $evento->hora = $hora->hora;

            /** @var Ponentes|null $ponente */
            $ponente = Ponentes::find($evento->ponente_id);
            $evento->ponente = $ponente->nombre . ' ' . $ponente->apellido;
        }
        
        $router->render('admin/eventos/index', [
            'titulo' => 'Conferencias y Wokshops',
            'eventos' => $eventos,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        isAdmin();

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

    public static function editar(Router $router) {
        isAdmin();

        $alertas = Evento::getAlertas();

        $evento_id = $_GET['id'] ?? '';

        if(!$evento_id) header('Location: /admin/eventos');

        $categorias = Categoria::all();
        $dias = Dia::all();
        $horas = Hora::all();

        /** @var Evento|null $evento_model */
        $evento_model = Evento::find($evento_id);

        if(!$evento_model) header('Location: /admin/eventos');

        // Convertir el objeto a stdClass, para poder agregar atributos dinamicamente
        $evento = (object) get_object_vars($evento_model);
        
        /** @var Ponentes|null $ponente */
        $ponente = Ponentes::find($evento->ponente_id);
        $evento->ponente = $ponente->nombre . ' ' . $ponente->apellido;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento_model->sincronizar($_POST);

            $alertas = $evento_model->validar();

            if(empty($alertas)) {
                $resultado = $evento_model->guardar();

                if($resultado) {
                    header('Location: /admin/eventos');
                }
            }
        }

        $router->render('admin/eventos/editar', [
            'titulo' => 'Editar Evento',
            'alertas' => $alertas,
            'evento' => $evento,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            isAdmin();

            $id = $_POST['id'];
            /** @var Evento|null $evento */
            $evento = Evento::find($id);

            if(empty($evento)) {
                header('Location: /admin/eventos');
            }

            $resultado = $evento->eliminar();

            if($resultado) {
                header('Location: /admin/eventos');
            }
        }
    }
}