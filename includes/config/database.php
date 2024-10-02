<?php
 
function connectDB(){
    $db = mysqli_connect('localhost', 'root', 'root', 'devtools_hub_db');

    if(!$db){
        echo "Error en la conexion";
        exit;
    }

    return $db;
}