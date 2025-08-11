<?php

namespace Models;

class Hora extends Model {
    protected static $table = 'horas';
    protected static $columnDB = ['id', 'hora'];

    public $id;
    public $hora;
}