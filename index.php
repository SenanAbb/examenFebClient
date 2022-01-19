<?php
session_start();

if (isset($_SESSION['server_msg'])) {
    echo $_SESSION['server_msg'];
    unset($_SESSION['server_msg']);
}
error_reporting(E_ERROR | E_PARSE);

if (isset($_SESSION['usuario'])) {
    $email = $_SESSION['usuario']->email;

    // Compruebo si el email existe en la BD
    $data = file_get_contents("https://blablacariw.herokuapp.com/findUserByEmail/" . $email);
    $user = json_decode($data);

    // Si existe -> me traigo su información y lo guardo
    if (!empty($user->data->usuarios)) {
        unset($_SESSION['google_login']);
        unset($user->data->usuarios[0]->password);
        $_SESSION['usuario'] = $user->data->usuarios[0];
    } else {
        // Si no existe -> lo inserto en la BD e inicializo sus valores
        //header('Location: /funciones/nuevo_usuario.php');
    }
    error_reporting(E_ERROR | E_PARSE);
}

include 'includes/header.php';

?>

<div class="container">
    <form action="buscar_viajes.php" method="GET">
        <div class="search__box">
            <input type="text" name="origen" placeholder="Origen" required>
            <input type="text" name="destino" placeholder="Destino" required>
            <input type="date" name="fecha" required>
            <input type="time" name="hora" required>
            <input type="submit" value="Buscar">
        </div>
    </form>
</div>

<?php

if (isset($_SESSION['viajes_encontrados'])) {
    if (!empty($_SESSION['viajes_encontrados'])) {
        $viajes = $_SESSION['viajes_encontrados'] ?>
        <section class="container">
            <h1>Viajes</h1>

            <table>
                <tr>
                    <th>Conductor</th>
                    <th>Fecha Salida</th>
                    <th>Hora Salida</th>
                    <th>Lugar Salida</th>
                    <th>Lugar Llegada</th>
                    <th>Precio</th>
                </tr>
                <?php
                foreach ($viajes as $viaje) { ?>
                    <tr>
                        <td><?php echo $viaje->nombre_conductor; ?></td>
                        <td><?php echo gmdate("d-m-Y", $viaje->fecha_salida); ?></td>
                        <td><?php echo gmdate("H:i", $viaje->hora_salida); ?></td>
                        <td><?php echo $viaje->lugar_salida; ?></td>
                        <td><?php echo $viaje->lugar_llegada; ?></td>
                        <td><?php echo $viaje->price; ?></td>
                        <form action="delete_viaje.php" method="POST">
                            <input type="hidden" value="<?php echo $viaje->_id ?>" name="id">
                            <th><input type="submit" value="Eliminar"></th>
                        </form>
                    </tr>

                <?php
                    unset($_SESSION['viajes_encontrados']);
                } ?>
            </table>
        </section>
<?php } else {
        echo "No se han encontrado viajes";
        unset($_SESSION['viajes_encontrados']);
    }
}

include 'includes/footer.php';

?>