<?php 

session_start();

$origen = $_GET['origen'];
$destino = $_GET['destino'];
$fecha = strtotime($_GET['fecha']);
$hora = strtotime($_GET['hora']);

$res = file_get_contents("https://blablacariw.herokuapp.com/travels/search?origen=" . $origen . "&destino=" . $destino);
$data = json_decode($res);
<<<<<<< HEAD:buscar_viajes.php
$viajes = array();
=======
var_dump($data);
$viajes = array([]);
>>>>>>> 36a282454f499bf0706db9ef816a7f1c06feba55:lista_viajes.php

foreach ($data->viajes as $viaje){
    if ($fecha === $viaje->fecha_salida && $hora > $viaje->hora_salida){
        $viajes[] = $viaje;
    }
}

$_SESSION['viajes_encontrados'] = $viajes;
header('Location: ./index.php');
?>