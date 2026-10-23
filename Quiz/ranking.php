<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Consultar</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="font bg-dark bg-gradient text-white p-3">
    <?php
    include "incs/nav.php";
    ?>
    <main class="d-flex justify-content-center align-items-center vh-100">
        <div class="container w-100 mt-5 m-auto">

            <form class="ms-5 form-floating mb-3">
                <div class="row">
                    <div class="col-11">
                        <?php
                        if (isset($_GET['key']) == false) {
                            $placeh = "Digite o nome:";
                        } else if ($_GET['key']) {
                            $placeh = $_GET['key'];
                        } else {
                            $placeh = "Digite o nome:";
                        }
                        ?>
                        <input type="text" class="form-control" id="floatingInput" placeholder="<?= $placeh ?>" name="key">
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn mb-3"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>

            <table class="table table-dark table-striped-columns table-hover">
                <thead class="text-center">
                    <th>Rank</th>
                    <th>Usuário</th>
                    <th>Pontuação</th>
                </thead>

                <tbody>
                <?php
                require "src/QuizDAO.php";
                $i = 0;

                if (isset($_GET['key'])) {
                    $ranking = QuizDAO::pesquisarRank($_GET['key']);
                } else {
                    $ranking = QuizDAO::consultarRanking();
                }

                foreach ($ranking as $rank) {
                    $i++;
                ?>
                    <tr class="text-center">
                        <td><?=$i?>º</td>
                        <td><?= $rank["username"] ?></td>
                        <td><?= $rank["pontos"] ?></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>