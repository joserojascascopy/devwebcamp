<?php

namespace Models;

class Paquete extends Model {
    // Atributos de la DB
    protected static $columnDB = ['id', 'nombre'];
    protected static $table = 'paquetes';

    public $id;
    public $nombre;
}