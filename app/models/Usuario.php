<?php

namespace Models;

class Usuario extends Model {
    // Atributos de la DB
    protected static $columnDB = ['id', 'nombre', 'apellido', 'email', 'password', 'confirmado', 'token', 'admin'];
    protected static $table = 'usuarios';

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $password2;
    public $confirmado;
    public $token;
    public $admin;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? 0;
    }

    // Validar el formulario de "Crear una nueva cuenta"
    public function createAccountValidation() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre no puede estar vacio';
        }

        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }else {
            // Validación por cantidad de carácteres
            if(strlen($this->password) < 6) {
                self::$alertas['error'][] = 'La contraseña debe contener al menos 6 carácteres';
            }

            // Validación de que ambas contraseñas sean iguales
            if($this->password !== $this->password2) {
                self::$alertas['error'][] = 'Las contraseñas no coinciden';
            }
        }

        return self::$alertas;
    }

    // Valildar el formulario de "Iniciar Sesión"
    public function loginValidation() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email no es válido';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }

    // Validar el formulario de la sección "Olvide mi contraseña"
    public function emailValidation() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email no es válido';
        }

        return self::$alertas;
    }

    // Verificar que la contraseña sea la correcta
    public function passwordVerify($password) {
        $resultado = password_verify($password, $this->password);

        return $resultado;
    }

    // Validar el formulario de la sección "Reestablecer contraseña"
    public function passwordValidation() {
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }else {
            // Validación por cantidad de carácteres
            if(strlen($this->password) < 6) {
                self::$alertas['error'][] = 'La contraseña debe contener al menos 6 carácteres';
            }
        }

        return self::$alertas;
    }

    //  Validar el formulario de la sección "Perfil"
    public function perfilValidation() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre no puede estar vacio';
        }

        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email no es válido';
        }

        return self::$alertas;
    }

    // Hashea el password
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un token unico
    public function tokenGenerate() {
        $this->token = uniqid();

        // Token mas seguro (Debo modificar la base de datos porque md5 devuelve 32 carácteres)
        // $this->token = md5(uniqid());
    }
}