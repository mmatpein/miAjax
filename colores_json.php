<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $consulta = file_get_contents('php://input');
    
    $objetoRecibido = json_decode($consulta,true);

    $color = $objetoRecibido["color"];
    
    $db = new mysqli("localhost","colores","Perro20","Colores");
    $resultado = $db->query("INSERT INTO colores VALUES ('".$color."');");    
    
    if ($resultado){
        echo $consulta;
    } else {
        echo json_encode(["error" => "El color no se ha añadido"]);
    }
}