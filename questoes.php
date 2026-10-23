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

<body class="font bg-dark bd-gradient text-white">
    <?php
        include "incs/nav.php";
    ?>
    <main>
        <div class="container w-100 mt-5 m-auto">

            <form class="form-floating mb-3">
                <div class="row">
                    <div class="col-11">
                        <?php
                        if (isset($_GET['key']) == false) {
                            $placeh = "Digite a questão:";
                        } else if ($_GET['key']) {
                            $placeh = $_GET['key'];
                        } else {
                            $placeh = "Digite a questão:";
                        }
                        ?>
                        <input type="text" class="form-control" id="floatingInput" placeholder="<?= $placeh ?>" name="key">
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn mb-3"><i class="bi bi-search text-white"></i></button>
                    </div>
                </div>
            </form>

            <table class="table table-striped table-dark">
                <tr class="text-center">
                    <th>Questão</th>
                    <th>Alternativa A</th>
                    <th>Alternativa B</th>
                    <th>Alternativa C</th>
                    <th>Alternativa D</th>
                    <th>Resposta</th>
                    <th>Imagem</th>
                    <th>...</th>
                </tr>

                <?php
                require "src/QuizDAO.php";

                if (isset($_GET['key'])) {
                    $questoes = QuizDAO::pesquisar($_GET['key']);
                } else {
                    $questoes = QuizDAO::listar();
                }

                foreach ($questoes as $questao) {
                ?>
                    <tr>
                        <td><?= $questao["questao"] ?></td>
                        <td><?= $questao["opcaoA"] ?></td>
                        <td><?= $questao["opcaoB"] ?></td>
                        <td><?= $questao["opcaoC"] ?></td>
                        <td><?= $questao["opcaoD"] ?></td>
                        <td><?= $questao["resposta"] ?></td>

                        <?php
                        if (!is_null($questao['imagem'])) {
                        ?>

                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Imagem
                                </button>
                            </td>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Imagem</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="w-100 img-fluid" src="data:image/jpeg;base64,<?=base64_encode($questao['imagem'])?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php
                        } else {
                        ?>

                            <td>Não possui imagem</td>

                        <?php
                        }
                        ?>

                        <td class="align-middle"><a class="text-decoration-none btn btn-outline-danger rounded-2" href="src/deletar.php?idquestao=<?= $questao['idquestao'] ?>">Excluir</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </main>
</body>

</html>