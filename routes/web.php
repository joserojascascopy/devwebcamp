<?php

use Controllers\AuthController;
use MVC\Router;

$router = new Router;

// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

// Crear cuenta
$router->get('/registrarse', [AuthController::class, 'registro']);
$router->post('/registrarse', [AuthController::class, 'registro']);

// Olvidé mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Reestablecer password
$router->get('reestablecer', [AuthController::class, 'reestablecer']);
$router->post('reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);