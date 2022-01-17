<?php
session_start();
$busqueda = '';

if (isset($_GET['provincia']) && $_GET['provincia'] !== ''){
    $busqueda = 'provincia';
}else if (isset($_GET['autonomia']) && $_GET['autonomia'] !== ''){
    $busqueda = 'autonomia';
    echo $busqueda;
}else if (isset($_GET['carretera']) && $_GET['carretera'] !== ''){
    $busqueda = 'carretera';
}

if ($busqueda !== ''){
<<<<<<< HEAD
    $url = 'https://blablacariw.herokuapp.com//incidencia/' . $busqueda . '/' . strtoupper($_GET[$busqueda]);
=======
    $url = 'https://blablacariw.herokuapp.com/incidencia/' . $busqueda . '/' . strtoupper($_GET[$busqueda]);
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d

    $res = file_get_contents($url);
    $data = json_decode($res);

    $_SESSION['busqueda_incidencias'] = true;

    if (!empty($data->features)){
        $_SESSION['incidencias'] = $data->features;
    }else{
        $_SESSION['incidencias'] = null;
    }

    header('Location: ../../index.php');
}else{
    $_SESSION['incidencias'] = null;
    header('Location: ../../index.php');
}


