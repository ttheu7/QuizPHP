<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['temas'])) {
    $_SESSION['temas'] = $_POST['temas'];
    header('Location: telaquiz.php'); // Redireciona para a página do quiz
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Início</title>
</head>

<body class="font bg-dark bg-gradient text-white p-3">
    <?php
        include "incs/nav.php";
    ?>
    <main class="d-flex justify-content-center align-items-center vh-100">
        <div>
            <h3 class="mb-5">BEM-VINDO(A) AO IFQUIZ!</h3>
            <label class="text-start">Escolha o tema abaixo:</label>
            <form action="index.php" method="post">
                <select name="temas" class="form-select mb-3">
                    <option value="">Escolha o tema</option>
                    <?php
                    require 'src/TemasDAO.php';
                    $temas = TemasDAO::consultarTemas();
                    foreach ($temas as $tema) {
                    ?>
                        <option value="<?= $tema['idtema'] ?>">
                            <?= $tema['tema'] ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
                <p class="text-center mt-5 d-grid">
                    <button type="submit" class="btn btn-success">INICIAR</button>
                </p>
            </form>
        </div>
    </main>
</body>

</html>
