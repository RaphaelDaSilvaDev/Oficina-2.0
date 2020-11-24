<?php
include 'header.php';


session_start();

if (isset($_SESSION['user'])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM budget WHERE id = '$id'";
    $queryResult = mysqli_query($conn, $query);

    if (isset($_POST['submit'])) {
        $clientName = $_POST['clientName'];
        $salemanName = $_POST['salemanName'];
        $description = nl2br($_POST['description']);
        $value = $_POST['value'];

        $result = mysqli_fetch_assoc($queryResult);

        if ($clientName == '') {
            $clientName = $result['clientName'];
        }
        if ($salemanName == '') {
            $salemanName = $result['salemanName'];
        }
        if ($description == '') {
            $description = nl2br($result['description']);
        }
        if ($value == '') {
            $value = $result['value'];
        }

        $query = "UPDATE budget SET clientName = '$clientName', salemanName = '$salemanName', description = '$description',
            value = '$value', modificationDate = SYSDATE() WHERE id = $id";
        $insert = mysqli_query($conn, $query);

        if ($insert) {
            header("Location: ./");
        } else {
            echo '<erro>Ops, algo deu errado</erro>' . mysqli_error($conn);
        }
    }
} else {
    header('Location: login.php');
}
?>

<body>
    <?php
    if ($result = mysqli_fetch_assoc($queryResult)) {
        $clientName = $result['clientName'];
        $salemanName = $result['salemanName'];
        $descriptionText = str_replace(array("<", "br", "/", ">"), '', $result['description']);
        $description = '"' . $descriptionText . '"';

        $value = $result['value'];

        echo "<form method='POST'>
            <section id='addBudget'>
                <div class='margin'>
                    <h1>Editar orçamento</h1>
                    <label for='clientName'>Nome do Cliente</label>
                    <input type='name' name='clientName' id='clientName' placeholder=" . $clientName . ">
                    <label for='salemanName'>Nome do Vendedor</label>
                    <input type='name' name='salemanName' id='salemanName' placeholder=" . $salemanName . ">
                    <label for='description'>Descrição do pedido</label>
                    <textarea name='description' id='description' cols='30' rows='10' placeholder=" . $description . "></textarea>
                    <label for='value'>Valor do orçamento</label>
                    <div id='value-submit'>
                        <input type='number' min='0.00' step='0.01' name='value' id='value' placeholder=" . $value . ">
                        <input type='submit' name='submit' value='Enviar orçamento'>
                    </div>
                </div>
            </section>
       </form>";
    }
    ?>
    <script>
        feather.replace()
    </script>
</body>