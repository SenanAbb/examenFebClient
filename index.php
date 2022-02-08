<?php
session_start();
if (isset($_SESSION['server_msg'])) {
    echo $_SESSION['server_msg'];
    unset($_SESSION['server_msg']);
}
error_reporting(E_ERROR | E_PARSE);

include 'includes/header.php';

?>

<h1>Inicio</h1>

<?php

include 'includes/footer.php';

?>