<?php

require 'app.php';

function includeTemplate(string $name, bool $inicio = false){
    include TEMPLATES_URL . "/{$name}.php";
}

function debug($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}

function isAuth() : bool {
    session_start();

    $auth = $_SESSION['login'];
    if($auth) {
        return true;
    }
    return false;
}