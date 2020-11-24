<?php
include 'db.php';
session_start();
if (isset($_POST['entrar'])) {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);

    $query = "SELECT * FROM user WHERE user = '$user' && pass = '$pass'";
    $data = mysqli_query($conn, $query) or die;
    $dataResult = mysqli_fetch_assoc($data);
    if (isset($dataResult)) {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        unset($_SESSION['error']);
        header('Location: index.php');
    } else {
        $_SESSION['error'] = "Usuário ou senha inválidas";
        unset($_SESSION['user']);
        unset($_SESSION['pass']);
        header('Location: login.php');
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
        if (isset($_SESSION['error'])) {
            $value = $_SESSION['error'];
            echo "<p>$value</p>";
        }
        ?>
        <form method="post" class="margin">
            <div class="login">
                <h1>Login</h1>
                <label for="user">Usuário</label>
                <input type="text" name="user" id="user">
                <label for="pass">Senha</label>
                <input type="password" name="pass" id="pass">
                <input type="submit" value="Entrar" name="entrar" id="entrar">
            </div>
        </form>
    </section>
</body>

</html>