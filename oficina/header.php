<?php
include 'db.php';
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
            <a href="./"><img src="./assets/Logo.svg" alt="CarRepair"></a>
            <form method="POST" action="signout.php" class="out">
                <a href="orcamento.php">Adicionar Orçamento</a>
                <button><i data-feather="log-out"></i></button>
            </form>
        </div>
    </header>
</body>

</html>