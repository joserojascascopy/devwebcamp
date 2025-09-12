<?php

namespace Controllers;

use Models\Paquete;
use Models\Usuario;
use Libraries\Paginacion;
use Models\Registro;
use MVC\Router;

class RegistradosController {
    public static function index(Router $router) {
        if(!isAdmin()) {
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        
        $registros_por_pagina = 10;

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/registrados?page=1');
        }

        $total_registro = Registro::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registro);

        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/registrados?page=1');
        }

        $registros = Registro::paginar($registros_por_pagina, $paginacion->offset());
        
        // Convertir cada objeto del array a stdClass, para poder agregar atributos dinamicamente
        $registros = array_map(fn($registro) => (object) get_object_vars($registro), $registros);

        foreach($registros as $registro) {
            /** @var Usuario|null $usuario */
            $usuario = Usuario::find($registro->usuario_id);

            /** @var Paquete|null $paquete */
            $paquete = Paquete::find($registro->paquete_id);

            $registro->usuario = $usuario;
            $registro->paquete = $paquete;
        }

        $router->render('admin/registrados/index', [
            'titulo' => 'Usuarios Registrados',
            'registros' => $registros,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
}