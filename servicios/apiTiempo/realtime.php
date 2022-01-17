<?php
    session_start();
<<<<<<< HEAD
    $res = file_get_contents("https://blablacariw.herokuapp.com//weather/realtime/".$_GET['location']);
=======
    $res = file_get_contents("https://blablacariw.herokuapp.com/weather/realtime/".$_GET['location']);
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
    $data = json_decode($res);

    include '../../includes/header.php';
?>
<div class="d-flex justify-content-around">
    <h1><?php echo $data->location->name?>, <?php echo $data->location->region?>, <?php echo $data->location->country?></h1>
    <div class="d-flex justify-content-start">
        <h1><?php echo $data->current->temp_c?>ºC</h1>
        <img src=<?php echo $data->current->condition->icon?>>
    </div>
</div>

<div>
    <p>Precipitaciones: <?php echo $data->current->precip_mm?>mm</p>
    <p>Presión atmosferica: <?php echo $data->current->pressure_mb?>mb</p>
    <p>Viento: <?php echo $data->current->wind_kph?> Km/h direccion <?php echo $data->current->wind_dir?></p>
    <p>Humedad: <?php echo $data->current->humidity?>%</p>
</div>