<?php

namespace Models;

class Regalo extends Model {
    // Atributos de la DB
    protected static $columnDB = ['id', 'nombre'];
    protected static $table = 'regalos';

    public $id;
    public $nombre;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
    }
}