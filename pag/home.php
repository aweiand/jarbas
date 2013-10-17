<?php
@session_start();

if (isset($_SESSION['usu'])) {
    ?>
    <h3 style="text-align: center">Bem Vindo <?= $_SESSION['usu'] ?>!</h3>
    <?php
} else {
    include "pag/login.php";
}