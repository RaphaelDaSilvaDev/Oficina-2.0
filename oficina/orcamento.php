<?php
include 'header.php';

session_start();

if (isset($_SESSION['user'])) {

    if (isset($_POST['submit'])) {
        $clientName = $_POST['clientName'];
        $salemanName = $_POST['salemanName'];
        $description = nl2br($_POST['description']);
        $value = $_POST['value'];

        if ($clientName == '' or $salemanName == '' or $description == '' or $value == '') {
            echo '<h6>Preencha todos os campos</h6>';
        } else {
            $query = "INSERT INTO budget (clientName, salemanName, description, value) VALUES ('$clientName', '$salemanName', '$description', '$value')";
            $insert = mysqli_query($conn, $query);

            if ($insert) {
                header("Location: ./");
            } else {
                echo '<h6>Ops, algo deu errado</h6>' . mysqli_error($conn);
            }
        }
    }
} else {
    header('Location: login.php');
}
?>

<body>
    <form method="POST">
        <section id="addBudget">
            <div class="margin">
                <h1>Adicionar um novo orçamento</h1>
                <label for="clientName">Nome do Cliente</label>
                <input type="name" name="clientName" id="clientName">
                <label for="salemanName">Nome do Vendedor</label>
                <input type="name" name="salemanName" id="salemanName">
                <label for="description">Descrição do pedido</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
                <label for="value">Valor do orçamento</label>
                <div id="value-submit">
                    <input type="number" min="0.00" step="0.01" name="value" id="value" placeholder="100,00">
                    <input type="submit" name="submit" value="Enviar orçamento">
                </div>
            </div>
        </section>
    </form>
    <script>
        feather.replace()
    </script>
</body>