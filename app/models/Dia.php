<?php

namespace Models;

class Dia extends Model {
    protected static $table = 'dias';
    protected static $columnDB = ['id', 'nombre'];

    public $id;
    public $nombre;
}