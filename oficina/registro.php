<?php
include 'db.php';
session_start();
if (isset($_POST['Registrar'])) {
    $user = $_POST['user'];
    $name = $_POST['name'];
    $pass = md5($_POST['pass']);

    $query = "INSERT INTO user (user, name, pass) VALUES ('$user', '$name', '$pass')";
    $data = mysqli_query($conn, $query) or die;
    if (isset($data)) {
        unset($_SESSION['error']);
        header('Location: login.php');
    } else {
        $_SESSION['errorRegister'] = "Algo saiu Errado";
        header('Location: registro.php');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="./assets/favicon.svg">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Oficina 2.0</title>
</head>

<body>
    <header>
        <div class="margin">
            <img src="./assets/Logo.svg" alt="CarRepair">
        </div>
    </header>

    <section id="login">
        <?php
        if (isset($_SESSION['errorRegister'])) {
            $value = $_SESSION['errorRegister'];
            echo "<p>$value</p>";
        }
        ?>
        <form method="post" class="margin">
            <div class="login">
                <h1>Login</h1>
                <label for="user">Usuário</label>
                <input type="text" name="user" id="user">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name">
                <label for="pass">Senha</label>
                <input type="password" name="pass" id="pass">
                <input type="submit" value="Registrar" name="Registrar" id="Registrar">
            </div>
        </form>
    </section>
</body>

</html>