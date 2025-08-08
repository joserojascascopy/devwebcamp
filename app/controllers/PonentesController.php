<?php

namespace Controllers;

use MVC\Router;
use Models\Ponentes;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PonentesController {
    public static function index(Router $router) {
        isAdmin();

        $ponentes = Ponentes::all();

        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponentes
        ]);
    }

    public static function crear(Router $router) {
        isAdmin();

        $alertas = Ponentes::getAlertas();

        $ponente = new Ponentes;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = 'imagenes/speakers';

                // Crear la carpeta si no existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $manager = new ImageManager(new Driver());

                // Leer la imagen original
                $imagen = $manager->read($_FILES['imagen']['tmp_name']);
                // Escalar la imagen a 800px de ancho
                $imagen = $imagen->scale(width: 800);
                // Crear nombre único
                $nombre_base = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_base;

                // Convertir a PNG
                $imagen_png = $imagen->encodeByExtension('png');

                // Convertir a WebP
                $imagen_webp = $imagen->encodeByExtension('webp');
            }

            // foreach ($_POST['redes'] as $key => $value) {
            //     if ($value === '') {
            //         unset($_POST['redes'][$key]);
            //     }
            // }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);
            // Validar
            $alertas = $ponente->validar();
            // Guardar el registro
            if (empty($alertas)) {
                // Guardar la imagen como PNG
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_base . '.png');
                // Guardaar la imagen como WEBP
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_base . '.webp');

                // Guardar en la DB
                $resultado = $ponente->guardar();

                if ($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router) {
        isAdmin();

        $alertas = Ponentes::getAlertas();
        // Validar el Id
        $ponente_id = $_GET['id'];
        $ponente_id = filter_var($ponente_id, FILTER_VALIDATE_INT);
        
        if(!$ponente_id) header('Location: /admin/ponentes');

        // Obtener ponente a editar
        /** @var Ponentes|null $ponente */
        $ponente = Ponentes::where('id', $ponente_id);

        if(!$ponente) header('Location: /admin/ponentes');

        $redes = json_decode($ponente->redes);

        // Asignamos la imagen a la variable $imagen_actual para no modificar el objeto de $ponente
        $imagen_actual = $ponente->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = 'imagenes/speakers';

                // Crear la carpeta si no existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $manager = new ImageManager(new Driver());

                // Leer la imagen original
                $imagen = $manager->read($_FILES['imagen']['tmp_name']);
                // Escalar la imagen a 800px de ancho
                $imagen = $imagen->scale(width: 800);
                // Crear nombre único
                $nombre_base = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_base;

                // Convertir a PNG
                $imagen_png = $imagen->encodeByExtension('png');

                // Convertir a WebP
                $imagen_webp = $imagen->encodeByExtension('webp');

            }else {
                $_POST['imagen'] = $imagen_actual;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            $alertas = $ponente->validar();

            if(empty($alertas)) {
                if(isset($nombre_base)) {
                    // Guardar la imagen como PNG
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_base . '.png');
                    // Guardaar la imagen como WEBP
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_base . '.webp');
                }

                $resultado = $ponente->guardar();

                if($resultado) header('Location: /admin/ponentes');
            }
        }

        $router->render('admin/ponentes/editar', [
            'titulo' => 'Actualizar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'imagen_actual' => $imagen_actual,
            'redes' => $redes
        ]);
    }

    public static function eliminar() {
        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            /** @var Ponentes|null $ponente */
            $ponente = Ponentes::find($id);

            if(empty($ponente)) {
                header('Location: /admin/ponentes');
            }

            if(file_exists('imagenes/speakers')) {
                $path_imagen_png = 'imagenes/speakers/' . $ponente->imagen . '.png';
                $path_imagen_webp = 'imagenes/speakers/' . $ponente->imagen . '.webp';
                
                unlink($path_imagen_png);
                unlink($path_imagen_webp);
            }

            $resultado = $ponente->eliminar();

            if($resultado) {
                header('Location: /admin/ponentes');
            }
        }
    }
}