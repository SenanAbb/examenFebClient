<?php
session_start();
<<<<<<< HEAD
$nombre = $_SESSION['usuario']->nombre;
$apellido = $_SESSION['usuario']->apellido;
$email = $_SESSION['usuario']->email;

$url = 'https://blablacariw.herokuapp.com//users/add';
=======
$nombre = $_SESSION['usuario']->usuario;
$apellido = $_SESSION['usuario']->apellido;
$email = $_SESSION['usuario']->email;

$url = 'https://blablacariw.herokuapp.com/users/add';
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
    
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);

$data = array(
    "nombre" => $nombre,
    "apellido" => $apellido,            
    "email" => $email,
    "password" => ''
);

$json = json_encode($data);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch); 
$result = json_decode($output);

unset($_SESSION['google_login']);

header('Location: ../index.php');