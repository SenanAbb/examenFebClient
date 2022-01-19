<?php
session_start();

if (isset($_SESSION['server_msg'])) {
    echo $_SESSION['server_msg'];
    unset($_SESSION['server_msg']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = 'https://blablacariw.herokuapp.com/travels/add';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);

    $data = array(
        "id_pasajeros" => [],
        "id_conductor" => trim($_POST['id_conductor']),
        "fecha_salida" => strtotime($_POST['fecha_salida']),
        "hora_salida" => strtotime($_POST['hora_salida']),
        "lugar_salida" => trim($_POST['lugar_salida']),
        "lugar_llegada" => trim($_POST['lugar_llegada']),
        "price" => intval($_POST['price']),
        "currency" => 'EUR'
    );

    $json = json_encode($data);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $result = json_decode($output);

    $_SESSION['server_msg'] = $result->data->msg;

    header('Location: ../../index.php');
}

include "../../includes/header.php";
?>

<div class="container">

    <h1>Crear viaje</h1>

    <form action="crear_viaje.php" method="POST">

        <input type="text" placeholder="lugar_salida" name="lugar_salida" required>
        <input type="text" placeholder="lugar_llegada" name="lugar_llegada" required>
        <input type="date" placeholder="fecha_salida" name="fecha_salida" required>
        <input type="time" placeholder="hora_salida" name="hora_salida" required>
        <input type="number" placeholder="precio (EUR)" name="price" required>
        <input type="hidden" value=<?php echo $_SESSION['usuario']->_id ?> name="id_conductor">
        <input type="submit" value="Crear">
    </form>

    <a href="../index.php" class="btn btn-danger">Cancelar</a>
</div>

<?php include '../../includes/footer.php' ?>