<?php
include 'header.php';

session_start();

if (isset($_SESSION['user'])) {
    $id = $_GET["id"];

    $delete = "DELETE FROM budget WHERE id = '$id'";
    $deleteUpdate = mysqli_query($conn, $delete);

    if ($deleteUpdate) {
        header("Location: ./");
    } else {
        echo '<erro>Ops, algo deu errado</erro>' . mysqli_error($conn);
    }
} else {
    header('Location: login.php');
}
