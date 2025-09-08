<?php

namespace Controllers;

use Models\Regalo;
use Models\Ponentes;
use Models\Hora;
use Models\Dia;
use Models\Categoria;
use Models\Evento;
use Models\Paquete;
use Models\Usuario;
use Models\Registro;
use MVC\Router;

class RegistroController {
    public static function crear(Router $router) {
        if (!isAuth()) header('Location: /');

        // Verificar si el usuario ya esta registrado
        $usuario_id = $_SESSION['id'];

        /** @var Registro|null $registro */
        $registro = Registro::where('usuario_id', $usuario_id);

        if (isset($registro) && $registro->paquete_id) {
            header('Location: /boleto?token=' . urlencode($registro->token));
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro',
        ]);
    }

    public static function gratis() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAuth()) header('Location: /login');

            // Verificar si el usuario ya esta registrado
            $usuario_id = $_SESSION['id'];

            /** @var Registro|null $registro */
            $registro = Registro::where('usuario_id', $usuario_id);

            if (isset($registro) && $registro->paquete_id) {
                header('Location: /boleto?token=' . urlencode($registro->token));
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);

            $datos = [
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            ];

            $registro = new Registro($datos);

            $resultado = $registro->guardar();

            if ($resultado) {
                header('Location: /boleto?token=' . urlencode($registro->token));
            }
        }
    }

    public static function pagar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isAuth()) header('Location: /login');

            // Validar que POST no venga vacio
            if(empty($_POST)) {
                echo json_encode([]);

                return;
            }

            // Crear el registro
            $token = substr(md5(uniqid(rand(), true)), 0, 8);

            $datos = $_POST;
            $datos['token'] = $token;
            $datos['usuario_id'] = $_SESSION['id'];

            try {
                $registro = new Registro($datos);

                $resultado = $registro->guardar();
                
                echo json_encode($resultado);
            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }

        }
    }

    public static function boleto(Router $router) {
        // Validar la URL
        $token = $_GET['token'];

        if (!$token || strlen($token) !== 8) {
            header('Location: /');
        }

        /** @var Registro|null $registro */
        $registro = Registro::where('token', $token);

        if (!$registro) {
            header('Location: /');
        }

        // Convertir el objeto a stdClass, para poder agregar atributos dinamicamente
        $registro = (object) get_object_vars($registro);

        // Llenar la tabla con la referencia
        /** @var Usuario|null $usuario */
        $usuario = Usuario::find($registro->usuario_id);
        /** @var Paquete|null $paquete */
        $paquete = Paquete::find($registro->paquete_id);

        $registro->nombre = $usuario->nombre . ' ' . $usuario->apellido;
        $registro->paquete = $paquete->nombre;

        $router->render('registro/boleto', [
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro
        ]);
    }

    public static function conferencias(Router $router) {
        if(!isAuth()) header('Location: /login');

        // Validar que el usuario tenga el plan presencial
        $usuario_id = $_SESSION['id'];

        /** @var Registro|null $registro */
        $registro = Registro::where('usuario_id', $usuario_id);

        if($registro->paquete_id !== '1') header('Location: /');

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

        $regalos = Regalo::all();

        $router->render('registro/conferencias', [
            'titulo' => 'Elige Workshops y Conferencias',
            'eventos' => $eventos_formateados,
            'regalos' => $regalos
        ]);
    }
}
