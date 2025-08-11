<?php

namespace Models;

class Categoria extends Model {
    protected static $table = 'categorias';
    protected static $columnDB = ['id', 'nombre'];

    public $id;
    public $nombre;
}