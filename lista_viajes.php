<?php 

session_start();

include './includes/header.php';

$origen = $_GET['origen'];
$destino = $_GET['destino'];
$fecha = strtotime($_GET['fecha']);
$hora = strtotime($_GET['hora']);

<<<<<<< HEAD
$res = file_get_contents("https://blablacariw.herokuapp.com//travels/search?origen=" . $origen . "&destino=" . $destino);
=======
$res = file_get_contents("https://blablacariw.herokuapp.com/travels/search?origen=" . $origen . "&destino=" . $destino);
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
$data = json_decode($res);
$viajes = array([]);

foreach ($data->viajes as $viaje){
    if ($fecha === $viaje->fecha_salida && $hora > $viaje->hora_salida){
        echo $viaje->lugar_salida;
    }
}
?>