<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Consultar</title>
</head>

<body class="font d-flex justify-content-center align-items-center vh-100 bg-dark bg-gradient text-white">
    <main>
        <?php
        $pontos = $_GET['key'];
        ?>

        <div >
            <h4 class="my-2 text-center">Cadastro de Pontuação</h4>
            <form action="src/cadastroRanking.php?pontos=<?= $pontos ?>" class="row">
                <div class="col-12 mb-3">
                    <label class="form-label" for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome:">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label" for="resposta">Pontuação:</label>
                    <br>
                    <?= $pontos ?>
                    <input type="hidden" class="form-control" name="pontos" value="<?= $pontos ?>" aria-label="Disabled input example" readonly>
                </div>

                <div class="col-12 d-grid">
                    <button type="submit" class="btn btn-success px-5">Ver Ranking</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>