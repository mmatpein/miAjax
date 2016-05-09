<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $consulta = file_get_contents("php://input");
    $objetoRecibido = json_decode($consulta,true);
    $baseDatos = new mysqli("localhost","colores","Perro20","Colores");
        
    if (array_key_exists("color",$objetoRecibido)){
    
        $resultado = $baseDatos->query("INSERT INTO colores VALUES ('".$objetoRecibido["color"]."');");
        if ($resultado){
            echo $consulta;
        } else {
            echo json_encode(["error" => "El color no se ha podido añadir"]);
        }
    } else if (array_key_exists("colores",$objetoRecibido)){
        $resultado = $baseDatos->query("SELECT * FROM colores;");
        // $resultado es de tipo mysqli_result.
        // Se puede ver información sobre mysqli_result en 
        // http://php.net/manual/es/class.mysqli-result.php
        
        // Preparo el array asociativo que voy a devolver.
        $devolver = ["colores" => []];
        
        // Recorro el resultado, añadiendo uno a uno los colores en 
        // el array (que inicialmente está vacío.
        for ($i=0;$i<$resultado->num_rows;$i++){
            $fila = $resultado->fetch_row(); // Devuelve un array enumerado con los campos.
                                             // En este caso sería algo así como ["0" => "Rojo"]
            array_push($devolver["colores"],$fila[0]);
        }
        echo json_encode($devolver);
    }

}