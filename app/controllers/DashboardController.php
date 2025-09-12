<?php

namespace Controllers;

use Models\Evento;
use Models\Usuario;
use Models\Paquete;
use Models\Registro;
use MVC\Router;

class DashboardController {
    public static function index(Router $router) {
        if(!isAdmin()) {
            header('Location: /login');
        }

        // Obtener ultimos registros
        $registros = Registro::get(5);

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

        // Calcular los ingresos
        /** @var Registro|null $virtuales */
        $virtuales = Registro::totalWhere('paquete_id', '2');
        
        /** @var Registro|null $presenciales */
        $presenciales = Registro::totalWhere('paquete_id', '1');
        
        $ingresos = ($virtuales * 49.9) + ($presenciales * 99);

        // Obtener eventos con más y menos lugares disponibles
        $menos_disponibles = Evento::ordenar('disponibles', 'ASC', 5);
        $mas_disponibles = Evento::ordenar('disponibles', 'DESC', 5);

        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administrador',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'menos_disponibles' => $menos_disponibles,
            'mas_disponibles' => $mas_disponibles
        ]);
    }
}