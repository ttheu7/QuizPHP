<?php
session_start();
require_once "src/QuizDAO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['senha'] = $_POST['senha'];
    if(QuizDAO::verLogin() === true){
        header('Location: questoes.php'); // Redireciona para a página do quiz
    } else {
        echo "Usuário e/ou senha errada!";
        header("Refresh:5; url=" . $_SERVER['PHP_SELF']);
    }
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
    <main class="d-flex justify-content-center align-items-center vh-100">
        <div class="w-50 bg-opacity-50 bg-">
            <h3 class="mb-5">LOGIN</h3>
            <form method="post">
                <label for="username" class="form-label">Username:</label>
                <input class="form-control" type="text" id="username" name="username" placeholder="Digite o nome de usuário: " required>
                <label for="senha" class="form-label">Senha:</label>
                <input class="form-control" type="password" id="senha" name="senha" placeholder="Digite sua senha: " required>
                <p class="text-center mt-5 d-grid">
                    <button type="submit" class="btn btn-success">Login</button>
                </p>
            </form>
        </div>
    </main>
</body>

</html>