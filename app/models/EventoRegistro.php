<?php

namespace Models;

class EventoRegistro extends Model {
    protected static $table = 'eventos_registros';
    protected static $columnDB = ['id', 'evento_id', 'registro_id'];

    public $id;
    public $evento_id;
    public $registro_id;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->evento_id = $args['evento_id'] ?? '';
        $this->registro_id = $args['registro_id'] ?? '';
    }
}