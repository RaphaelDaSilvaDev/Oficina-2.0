<?php
include 'header.php';
session_start();

if (isset($_SESSION['user'])) {
    $budget = "SELECT * FROM budget ORDER by id Desc";
    $budgetResult = mysqli_query($conn, $budget);

    if (isset($_GET['searchText'])) {
        $search = true;
        $searchText = $_GET['searchText'];
        $searchDate = $_GET['dateSearch'];

        if ($searchDate == null) {
            $query = "SELECT * FROM budget WHERE clientName like ('%" . $searchText . "%') or salemanName like ('%" . $searchText . "%') ORDER BY id Desc";
            $queryResult = mysqli_query($conn, $query);
            if ($queryResult = mysqli_query($conn, $query)) {
                $row = mysqli_num_rows($queryResult);
            }
        } elseif ($searchText == null) {
            $searchDateConvert = date("Y-m-d", strtotime($_GET['dateSearch']));
            $query = "SELECT * FROM budget WHERE date like ('%" . $searchDateConvert . "%') ORDER BY id Desc";
            $queryResult = mysqli_query($conn, $query);
            if ($queryResult = mysqli_query($conn, $query)) {
                $row = mysqli_num_rows($queryResult);
            }
        } else {
            $searchDateConvert = date("Y-m-d", strtotime($_GET['dateSearch']));
            $query = "SELECT * FROM budget WHERE clientName like ('%" . $searchText . "%') or salemanName like ('%" . $searchText . "%') and date like ('%" . $searchDateConvert . "%') ORDER BY id Desc";
            if ($queryResult = mysqli_query($conn, $query)) {
                $row = mysqli_num_rows($queryResult);
            }
        }
    } else {
        $search = false;
    }

    if (isset($_POST['submit'])) {
        $id = $_POST['submit'];

        $delete = "DELETE FROM budget WHERE id = 1";
        $deleteUpdate = mysqli_query($conn, $delete);

        if ($deleteUpdate) {
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
    <form method="get">
        <section id="searchInput">
            <div class="margin">
                <input type="text" name="searchText" id="searchText" placeholder="Pesquisar Orçamento">
                <input type="date" name="dateSearch" id="dateSearch">
                <div id="btnSearch">
                    <button type="submit"><i data-feather="search"></i></button>
                </div>
            </div>
        </section>
    </form>

    <section id="itens">
        <div class="margin">

            <?php
            if (mysqli_num_rows($budgetResult) < 1) {
                echo "<h6>Nenhum orçamento encontrado</h6>";
            } else {
                if ($search) {
                    if ($row == 0) {
                        echo "<h6>Nenhum orçamento encontrado</h6>";
                    } else {
                        while ($rowSearch = mysqli_fetch_array($queryResult)) {
                            $id = $rowSearch['id'];
                            $clientName = $rowSearch['clientName'];
                            $salemanName = $rowSearch['salemanName'];
                            $description = $rowSearch['description'];
                            $date =  date("H:i:s d-m-Y", strtotime($rowSearch['date']));
                            $value = str_replace('.', ',', $rowSearch['value']);

                            echo " <div class='item'>
                            <div id='head'>
                                <h1>" . $clientName . "</h1>
                                <label for='" . $id . "'><i data-feather='more-vertical'></i></label>
                            </div>
                                <input type='checkbox' name='trigger-input' class='trigger-input' id='" . $id . "'>
                            <div class='container'>
                                <div class='containt'>
                                    <h2>" . $salemanName . "</h2>
                                    <span>" . $description . "</span>
                                    <p>" . $date . "</p>
                                    <h3>R$" . $value . "</h3>
                                </div>
    
                                <div class='options'>
                                    <div class='option'>
                                        <a href='editar.php?id=" . $id . "'><i data-feather='edit'></i><h1>Editar</h1></a>
                                    </div>
                                    <div class='option'>
                                        <a href='remove.php?id=" . $id . "'><i data-feather='trash-2'></i><h1>Deletar</h1></a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        }
                    }
                } else {
                    while ($rowBudget = mysqli_fetch_array($budgetResult)) {
                        $id = $rowBudget['id'];
                        $clientName = $rowBudget['clientName'];
                        $salemanName = $rowBudget['salemanName'];
                        $description = $rowBudget['description'];
                        $date =  date("H:i:s d-m-Y", strtotime($rowBudget['date']));
                        $value = str_replace('.', ',', $rowBudget['value']);

                        echo " <div class='item'>
                        <div id='head'>
                            <h1>" . $clientName . "</h1>
                            <label for='" . $id . "'><i data-feather='more-vertical'></i></label>
                        </div>
                            <input type='checkbox' name='trigger-input' class='trigger-input' id='" . $id . "'>
                        <div class='container'>
                            <div class='containt'>
                                <h2>" . $salemanName . "</h2>
                                <span>" . $description . "</span>
                                <p>" . $date . "</p>
                                <h3>R$" . $value . "</h3>
                            </div>

                            <div class='options'>
                                <div class='option'>
                                    <a href='editar.php?id=" . $id . "'><i data-feather='edit'></i><h1>Editar</h1></a>
                                </div>
                                <div class='option'>
                                    <a href='remove.php?id=" . $id . "'><i data-feather='trash-2'></i><h1>Deletar</h1></a>
                                </div>
                            </div>
                        </div>
                    </div>";
                    }
                }
            }
            ?>

        </div>
    </section>

    <script>
        feather.replace()
    </script>
</body>