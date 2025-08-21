<?php

namespace MVC;

class Router {
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function handleRequest() {
        $currentUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if (!in_array($method, ['GET', 'POST'])) {
            http_response_code(405);
            echo "Método HTTP no permitido.";
            return;
        }

        $funcion = match($method) {
            'GET' => $this->rutasGET[$currentUrl] ?? null,
            'POST' => $this->rutasPOST[$currentUrl] ?? null,
        };

        if($funcion) {
            call_user_func($funcion, $this);
        }else {
            http_response_code(404);
            header('Location: /404');
        }
    }

    public function render($views, $datos=[]) {
        foreach($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once __DIR__ . "/../app/views/$views.php";
        $root = ob_get_clean();

        // Utilizar el layout de acuerdo a la URL
        $currentUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';

        if(str_contains($currentUrl, '/admin')) {
            include_once __DIR__ . "/../app/views/admin-layout.php";
        }else {
            include_once __DIR__ . "/../app/views/main.php";
        }
    }
}