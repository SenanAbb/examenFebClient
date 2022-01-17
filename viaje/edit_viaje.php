<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
<<<<<<< HEAD
        $url = "https://blablacariw.herokuapp.com//travels/edit/".$_POST['id'];
=======
        $url = "https://blablacariw.herokuapp.com/travels/edit/".$_POST['id'];
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        $data = array(
            "id_pasajeros" => [],
            "fecha_salida" => $_POST['fecha_salida'],
            "hora_salida" => $_POST['hora_salida'],            
            "lugar_salida" => $_POST['lugar_salida'],
            "lugar_llegada" => $_POST['lugar_llegada'],
            "price" => $_POST['price'],
            "currency" => $_POST['currency']
        );
        

        $json = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        $result = json_decode($output);
        $_SESSION['server_msg'] = $result->data->msg;
        
        header('Location: edit_viaje.php');
    }
    else {
<<<<<<< HEAD
        $res = file_get_contents("https://blablacariw.herokuapp.com//travels/edit/".$_GET['id']);
        $data = json_decode($res); 
        $resUsers = file_get_contents("https://blablacariw.herokuapp.com//");
=======
        $res = file_get_contents("https://blablacariw.herokuapp.com/travels/edit/".$_GET['id']);
        $data = json_decode($res); 
        $resUsers = file_get_contents("https://blablacariw.herokuapp.com/");
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
        $dataUsers = json_decode($resUsers);
        include "../includes/header.php";
    }
?>

<form action="edit_viaje.php" method="POST">
    <input value="<?php echo $data->data->viaje[0]->_id?>" name="id" type="hidden">
    <?php
    if(!empty($data->data->viaje[0]->id_pasajeros)){
        echo "Lista de pasajeros:";
        echo "<br>";
        foreach($data->data->viaje[0]->id_pasajeros as $pasajero){
            if(!empty($pasajero)){
<<<<<<< HEAD
                $resAux = file_get_contents("https://blablacariw.herokuapp.com//users/edit/".$pasajero);
=======
                $resAux = file_get_contents("https://blablacariw.herokuapp.com/users/edit/".$pasajero);
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
                $dataAux = json_decode($resAux); 
                ?>
                <p> - <?php echo $dataAux->data->usuario[0]->nombre. " ".$dataAux->data->usuario[0]->apellido; ?></p> <br>
            <?php }
            
        } 
    } else{
        echo "No hay pasajeros";
        echo "<br>";
    }
    ?>


    <input value="<?php echo $data->data->viaje[0]->fecha_salida?>" name="fecha_salida">
    <input value="<?php echo $data->data->viaje[0]->hora_salida?>" name="hora_salida">
    <input value="<?php echo $data->data->viaje[0]->lugar_salida?>" name="lugar_salida">
    <input value="<?php echo $data->data->viaje[0]->lugar_llegada?>" name="lugar_llegada">
    <input value="<?php echo $data->data->viaje[0]->price?>" name="price">
    <input type="submit" value="Editar">
</form>

<?php include '../includes/footer.php' ?>