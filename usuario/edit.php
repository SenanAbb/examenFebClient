<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
<<<<<<< HEAD
        $url = 'https://blablacariw.herokuapp.com//users/edit/'.$_POST['id'];
=======
        $url = 'https://blablacariw.herokuapp.com/users/edit/'.$_POST['id'];
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($_POST['modo'] === '1') {
            $data = array(
                "nombre" => $_POST['nombre'],
                "apellido" => $_POST['apellido'],            
                "email" => $_POST['email'],
                "password" => $_POST['password'],
            );
        } else {
            $data = array(
                "foto" => $_POST['foto']
            );
        }

        $json = json_encode($data);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch); 
        $result = json_decode($output);
        
        $_SESSION['server_msg'] = $result->data->msg;
        
        header('Location: ../index.php');
    }
    else {
<<<<<<< HEAD
        $res = file_get_contents("https://blablacariw.herokuapp.com//users/edit/".$_GET['id']);
=======
        $res = file_get_contents("https://blablacariw.herokuapp.com/users/edit/".$_GET['id']);
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
        $data = json_decode($res); 
        include '../includes/header.php';
    }
?>

<h1>Editar usuario</h1>

<form action="edit.php" method="POST">
    <input value="<?php echo $data->data->usuario[0]->_id?>" name="id" type="hidden">
    <input value="<?php echo $data->data->usuario[0]->nombre?>" name="nombre">
    <input value="<?php echo $data->data->usuario[0]->apellido?>" name="apellido">
    <input value="<?php echo $data->data->usuario[0]->email?>" name="email">
    <input value="<?php echo $data->data->usuario[0]->password?>" name="password">
    <input type="hidden" name="modo" value="1">
    <input type="submit" value="Editar">
</form>

<a href="../index.php" class="btn btn-danger">Cancelar</a>
<br/>
<div class="box">
    <form enctype="multipart/form-data" action="../funciones/enviar_imagen.php" method="POST">
        <h3>Subir imagen</h3>
        <input type="file" name="imagen" type="image/jpeg, image/jpg, image/png">
        <input value="<?php echo $data->data->usuario[0]->_id?>" id="id" name="id" type="hidden">
        <input type="submit" value="Enviar">
    </form>
</div>
    

<?php include '../includes/footer.php' ?>