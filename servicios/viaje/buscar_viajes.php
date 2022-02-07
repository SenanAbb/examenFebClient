<?php 

session_start();

$origen = trim($_GET['origen']);
$destino = trim($_GET['destino']);
$fecha = strtotime($_GET['fecha']);

$res = file_get_contents("http://blablacariw.herokuapp.com/travels?origen=" . $origen . "&destino=" . $destino);
$data = json_decode($res);
$viajes = array();

foreach ($data->data->viajes as $viaje){
    if (empty($fecha) || (!empty($fecha) && $fecha === $viaje->fecha_salida)){
        array_push($viajes, $viaje);
    }
}

$_SESSION['viajes_encontrados'] = $viajes;

$count = count($array);

if ($count == 0) {
    $msg = "No se han encontrado resultados.";
} else {
    $msg = $count." resultados encontrados.";
}

$_SESSION['msgBusqueda'] = $msg; 

header('Location: ../../index.php');
?>