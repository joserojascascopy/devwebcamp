<?php

namespace Models;

class Registro extends Model {
    // Atributos de la DB
    protected static $columnDB = ['id', 'paquete_id', 'pago_id', 'token', 'usuario_id', 'regalo_id'];
    protected static $table = 'registros';

    public $id;
    public $paquete_id;
    public $pago_id;
    public $token;
    public $usuario_id;
    public $regalo_id;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->paquete_id = $args['paquete_id'] ?? '';
        $this->pago_id = $args['pago_id'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? '';
        $this->regalo_id = $args['regalo_id'] ?? 1;
    }
}