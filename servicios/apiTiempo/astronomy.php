<?php
    session_start();
<<<<<<< HEAD
    $res = file_get_contents("https://blablacariw.herokuapp.com//weather/astronomy/".$_GET['location']."&".$_GET['day']);
=======
    $res = file_get_contents("https://blablacariw.herokuapp.com/weather/astronomy/".$_GET['location']."&".$_GET['day']);
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
    $data = json_decode($res);

    include '../../includes/header.php';
?>

<h1>Datos astronomicos de <?php echo $_GET['location']?> para el día <?php echo $_GET['day']?></h1>
<br>
<br>
<p>Salida del sol: <?php echo $data->astronomy->astro->sunrise?></p>
<p>Puesta de sol: <?php echo $data->astronomy->astro->sunset?></p>
<p>Salida y puesta de la luna: <?php echo $data->astronomy->astro->moonrise?> - <?php echo $data->astronomy->astro->moonset?></p>
<p>Fase lunar: <?php echo $data->astronomy->astro->moon_phase?></p>
