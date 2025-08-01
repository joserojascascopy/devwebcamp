<?php

use Dotenv\Dotenv;

function connect() {
    if (!isset($_ENV['DB_HOST'])) {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
    }

    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $usuario = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASS'];

    $db = new mysqli($host, $usuario, $password, $dbname);

    if (!$db) {
        echo "400 Bad Request. No se ha podido establecer la conexión con la base de datos.";
    }

    return $db;
}
