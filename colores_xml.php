<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    
    $color = $_GET["color"];
    
    $document = new DOMDocument();
    $document->load("colores.xml");
    
    $colorXML = $document->createElement("color",$color);
    
    $raizColor = $document->getElementsByTagName("colores")->item(0);
    $raizColor->appendChild($colorXML);
    
    $document->save("colores.xml");
    echo $document->saveXML(); 
    
    
}