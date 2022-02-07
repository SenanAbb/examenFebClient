<?php 

session_start();

echo "Hola";

$origen = trim($_GET['origen']);
$destino = trim($_GET['destino']);
$fecha = strtotime($_GET['fecha']);

echo $origen;
echo $destino;
echo $fecha;

$res = file_get_contents("http://blablacariw.herokuapp.com/travels?origen=" . $origen . "&destino=" . $destino);
$data = json_decode($res, true);

$_SESSION['viajes_encontrados'] = $data->data->viajes;
var_dump($_SESSION['viajes_encontrados']);
//header('Location: ../../index.php');
?>