<?php

namespace Controllers;

use MVC\Router;
use Models\Evento;
use Models\Hora;
use Models\Dia;
use Models\Categoria;
use Models\Ponentes;

class PaginasController {
    public static function index(Router $router) {
        $eventos = Evento::orderBy('hora_id', 'ASC');
        // Convertir cada objeto del array a stdClass, para poder agregar atributos dinamicamente
        $eventos = array_map(fn($evento) => (object) get_object_vars($evento), $eventos);

        $eventos_formateados = [];

        foreach ($eventos as $evento) {
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
            $evento->ponente_imagen = $ponente->imagen;

            if ($evento->dia_id === '1' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias']['viernes'][] = $evento;
            } elseif ($evento->dia_id === '2' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias']['sabado'][] = $evento;
            } elseif ($evento->dia_id === '1' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops']['viernes'][] = $evento;
            } elseif ($evento->dia_id === '2' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops']['sabado'][] = $evento;
            }
        }

        // Obtener el total de cada bloque
        $total_conferencias = count($eventos_formateados['conferencias']['viernes']) + count($eventos_formateados['conferencias']['sabado']);
        $total_workshops = count($eventos_formateados['workshops']['viernes']) + count($eventos_formateados['workshops']['sabado']);
        $total_ponentes = Ponentes::total();

        // Obtener todos los ponentes
        $ponentes = Ponentes::all();

        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            'eventos' => $eventos_formateados,
            'total_conferencias' => $total_conferencias,
            'total_workshops' => $total_workshops,
            'total_ponentes' => $total_ponentes,
            'ponentes' => $ponentes
        ]);
    }

    public static function evento(Router $router) {

        $router->render('paginas/devwebcamp', [
            'titulo' => 'Sobre DevWebCamp'
        ]);
    }

    public static function paquetes(Router $router) {

        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes DevWebCamp'
        ]);
    }

    public static function conferencias(Router $router) {
        $eventos = Evento::orderBy('hora_id', 'ASC');

        // Convertir cada objeto del array a stdClass, para poder agregar atributos dinamicamente
        $eventos = array_map(fn($evento) => (object) get_object_vars($evento), $eventos);

        $eventos_formateados = [];

        foreach ($eventos as $evento) {
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
            $evento->ponente_imagen = $ponente->imagen;

            if ($evento->dia_id === '1' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias']['viernes'][] = $evento;
            } elseif ($evento->dia_id === '2' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias']['sabado'][] = $evento;
            } elseif ($evento->dia_id === '1' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops']['viernes'][] = $evento;
            } elseif ($evento->dia_id === '2' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops']['sabado'][] = $evento;
            }
        }

        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias & Workshops',
            'eventos' => $eventos_formateados
        ]);
    }

    public static function error(Router $router) {

        $router->render('paginas/error', [
            'titulo' => 'Página no encontrada'
        ]);
    }
}
