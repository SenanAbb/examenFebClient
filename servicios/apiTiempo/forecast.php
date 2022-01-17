<?php
    session_start();
<<<<<<< HEAD
    $res = file_get_contents("https://blablacariw.herokuapp.com//weather/forecast/".$_GET['location']."&".$_GET['days']);
=======
    $res = file_get_contents("https://blablacariw.herokuapp.com/weather/forecast/".$_GET['location']."&".$_GET['days']);
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
    $data = json_decode($res);

    include '../../includes/header.php';
?>

<h1>Tiempo en <?php echo $_GET['location']?> para los proximos <?php echo $_GET['days']?> dias</h1>
<br>
<br>


<table>
    <tr>
        <?php for ($i=0; $i<24; $i++){ ?>    
            <th><?php echo $i ?>:00</th>
        <?php }?>
    </tr>
    <?php foreach ($data->forecast->forecastday as $day){ ?>
        <tr>
            <?php foreach ($day->hour as $hour){ ?>
                <td><?php echo $hour->temp_c ?>ºC<img src=<?php echo $hour->condition->icon?>></td>
            <?php }?>            
        </tr>
    <?php }?>
</table>