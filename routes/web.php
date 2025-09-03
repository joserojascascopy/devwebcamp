<?php

use Controllers\ApiEventos;
use Controllers\ApiPonentes;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\PonentesController;
use Controllers\EventosController;
use Controllers\PaginasController;
use Controllers\RegalosController;
use Controllers\RegistradosController;
use Controllers\RegistroController;
use MVC\Router;

$router = new Router;

// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear cuenta
$router->get('/registrarse', [AuthController::class, 'registro']);
$router->post('/registrarse', [AuthController::class, 'registro']);

// Olvidé mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Reestablecer password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar', [AuthController::class, 'confirmar']);

// Dashboard para administrador
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

// Ponentes
$router->get('/admin/ponentes', [PonentesController::class, 'index']);
$router->get('/admin/ponentes/crear', [PonentesController::class, 'crear']);
$router->post('/admin/ponentes/crear', [PonentesController::class, 'crear']);
$router->get('/admin/ponentes/editar', [PonentesController::class, 'editar']);
$router->post('/admin/ponentes/editar', [PonentesController::class, 'editar']);
$router->post('/admin/ponentes/eliminar', [PonentesController::class, 'eliminar']);

// Eventos
$router->get('/admin/eventos', [EventosController::class, 'index']);
$router->get('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->post('/admin/eventos/crear', [EventosController::class, 'crear']);
$router->get('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/editar', [EventosController::class, 'editar']);
$router->post('/admin/eventos/eliminar', [EventosController::class, 'eliminar']);

// Registrados
$router->get('/admin/registrados', [RegistradosController::class, 'index']);

// Regalos
$router->get('/admin/regalos', [RegalosController::class, 'index']);

// API
$router->get('/api/eventos-horario', [ApiEventos::class, 'index']);
$router->get('/api/ponentes', [ApiPonentes::class, 'index']);

// Área Pública
$router->get('/', [PaginasController::class, 'index']);
$router->get('/devwebcamp', [PaginasController::class, 'evento']);
$router->get('/paquetes', [PaginasController::class, 'paquetes']);
$router->get('/workshops-conferencias', [PaginasController::class, 'conferencias']);

// Registro de Usuarios
$router->get('/finalizar-registro', [RegistroController::class, 'crear']);
$router->post('/finalizar-registro/gratis', [RegistroController::class, 'gratis']);
$router->post('/finalizar-registro/pagar', [RegistroController::class, 'pagar']);
$router->get('/finalizar-registro/conferencias', [RegistroController::class, 'conferencias']);

// Boleto Virtual
$router->get('/boleto', [RegistroController::class, 'boleto']);

// 404
$router->get('/404', [PaginasController::class, 'error']);