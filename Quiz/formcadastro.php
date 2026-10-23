<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
    include "incs/nav.php";
    ?>

    <div class="font container w-75 m-auto mt-3 border rounded-3 p-3">
        <h4 class="my-2 text-center">Cadastro de Perguntas</h4>
        <form action="src/cadastro.php" class="row" method="POST" enctype="multipart/form-data">
            <div class="col-10 mb-3">
                <label class="form-label" for="">Pergunta:</label>
                <input type="text" class="form-control" name="questao" placeholder="Digite a pergunta:">
            </div>

            <div class="col-2 mb-3">
                <label class="form-label" for="resposta">Resposta:</label>
                <input type="text" class="form-control" name="resposta" id="resposta" placeholder="Certa:">
            </div>

            <div class="col-2 mb-3" style="margin-top: 35px;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Possui imagem
                    </label>
                </div>
            </div>

            <div class="col-10 mb-3">
                <label for="formFile" class="form-label">Selecione sua imagem</label>
                <input class="form-control" type="file" name="img" id="formFile">
            </div>

            <div class="col-6 mb-3">
                <label class="form-label" for="altA">Alternativa A:</label>
                <input type="text" class="form-control" name="altA" id="altA" placeholder="Digite a alternativa A:">
            </div>

            <div class="col-6 mb-3">
                <label class="form-label" for="altB">Alternativa B:</label>
                <input type="text" class="form-control" name="altB" id="altB" placeholder="Digite a alternativa B:">
            </div>

            <div class="col-6 mb-3">
                <label class="form-label" for="altC">Alternativa C:</label>
                <input type="text" class="form-control" name="altC" id="altC" placeholder="Digite a alternativa C:">
            </div>

            <div class="col-6 mb-3">
                <label class="form-label" for="altD">Alternativa D:</label>
                <input type="text" class="form-control" name="altD" id="altD" placeholder="Digite a alternativa D:">
            </div>

            <div class="col-12 d-grid">
                <button type="submit" class="btn btn-dark px-5">Cadastrar</button>
            </div>
        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>