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
    $data = file_get_contents("https://blablacariw.herokuapp.com/users/?email=" . $email);
    $user = json_decode($data);

    // Si existe -> me traigo su información y lo guardo
    if (!empty($user->data->usuarios)) {
        unset($_SESSION['google_login']);
        unset($user->data->usuarios[0]->password);
        $_SESSION['usuario'] = $user->data->usuarios[0];
    } else {
        // Si no existe -> lo inserto en la BD e inicializo sus valores
        header('Location: /funciones/nuevo_usuario.php');
    }
    error_reporting(E_ERROR | E_PARSE);
}

include 'includes/header.php';

?>

<div class="container">
    <form action="./servicios/viaje/buscar_viajes.php" method="GET">
        <div class="search__box">
            <input type="text" name="origen" placeholder="Origen *" required>
            <input type="text" name="destino" placeholder="Destino *" required>
            <input type="date" name="fecha">
            <input type="submit" value="Buscar">
        </div>
    </form>
</div>


<!-- Viajes encontrados -->
<?php
    if (isset($_SESSION['viajes_encontrados']) && !empty($_SESSION['viajes_encontrados'])) {
        $viajes = $_SESSION['viajes_encontrados'];
    } else {
        unset($_SESSION['viajes_encontrados']);
        $res = file_get_contents("http://blablacariw.herokuapp.com/travels");
        $viajes = json_decode($res)->data->viajes;
    } ?>
        <section class="container">

            
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
                foreach ($viajes as $viaje) {
                    // Me traigo el nombre del conductor
                    $data = file_get_contents("https://blablacariw.herokuapp.com/users/" . $_SESSION['usuario']->_id);
                    $nombre_conductor = json_decode($data)->data->usuario[0]->nombre;

                ?>
                    <tr>
                        <td><?php echo $nombre_conductor; ?></td>
                        <td><?php echo gmdate("d-m-Y", $viaje->fecha_salida); ?></td>
                        <td><?php echo gmdate("H:i", $viaje->hora_salida); ?></td>
                        <td><?php echo $viaje->lugar_salida; ?></td>
                        <td><?php echo $viaje->lugar_llegada; ?></td>
                        <td><?php echo $viaje->price; ?>€</td>
                        <form action="reservar_viaje.php" method="POST">
                            <input type="hidden" value="<?php echo $viaje->_id ?>" name="id">
                            <td><input type="submit" value="Reservar"></td>
                        </form>
                    </tr>

                <?php
                    unset($_SESSION['viajes_encontrados']);
                } ?>
            </table>
        </section>

<!-- .Viajes encontrados -->

<?php

include 'includes/footer.php';

?>