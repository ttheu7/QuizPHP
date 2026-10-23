<?php
session_start();

$_SESSION['pontos'] = 0;

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
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <title>Game Over</title>
 
</head>

<body class="bg-dark bg-gradient text-white">
    <?php
    include "incs/nav.php";
    ?>
    <main class="d-flex flex-column justify-content-center align-items-center vh-100 text-center">
        <h1 class="game-over mb-4">GAME OVER</h1>
        <p class="lead mb-4">Você não conseguiu completar o quiz. Não desista!</p>
        <a href="index.php" class="btn btn-primary btn-custom">Voltar ao Início</a>
    </main>
</body>

</html>