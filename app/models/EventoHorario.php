<?php

namespace Models;

class EventoHorario extends Model {
    protected static $table = 'eventos';
    protected static $columnDB = ['id', 'categoria_id', 'dia_id', 'hora_id'];

    public $id;
    public $categoria_id;
    public $dia_id;
    public $hora_id;
}