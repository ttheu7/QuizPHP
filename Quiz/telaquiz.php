<?php
ob_start();
Session_start();
require_once 'src/QuizDAO.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Quiz</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>

    <script>
        let tempoRestante = 15;
        let cronometro;
        let cooldownAumento = parseInt(localStorage.getItem('cooldownAumento')) || 0;
        let cooldownDuplicador = parseInt(localStorage.getItem('cooldownDuplicador')) || 0;
        let cooldownCongelamento = parseInt(localStorage.getItem('cooldownCongelamento')) || 0;
        let cooldownDiminuir = parseInt(localStorage.getItem('cooldownDiminuir')) || 0;
        let freezeTime = false;
        let duplicador = false;

        function startCronometro() {
            cronometro = setInterval(function() {
                document.getElementById("timer").innerHTML = tempoRestante;

                if (tempoRestante <= 0) {
                    clearInterval(cronometro);
                    redirecionar();
                } else {
                    tempoRestante--;
                }
            }, 1000);
        }

        function atualizarCooldowns() {
            localStorage.setItem('cooldownAumento', cooldownAumento);
            localStorage.setItem('cooldownCongelamento', cooldownCongelamento);
            localStorage.setItem('cooldownDuplicador', cooldownDuplicador);
            localStorage.setItem('cooldownDiminuir', cooldownDiminuir);
        }

        function aumentarTempo() {
            if (cooldownAumento >= 2) {
                cooldownAumento = 0; // Reseta o contador
                tempoRestante += 10;
                document.getElementById("timer").innerHTML = tempoRestante;
                atualizarCooldowns();
            }
        }

        function diminuirCooldowns() {
            if(cooldownDiminuir >= 8){
                cooldownAumento++;
                cooldownCongelamento++;
                cooldownDuplicador++;
                cooldownDiminuir = 0;
                atualizarCooldowns();
            }
        }

        function tempoGelado() {
            if (cooldownCongelamento >= 6 && !freezeTime) {
                clearInterval(cronometro);
                freezeTime = true;
                cooldownCongelamento = 0; // Reseta o contador
                atualizarCooldowns();

                setTimeout(function() {
                    startCronometro();
                    freezeTime = false;
                }, 15000);
            }
        }

        function doubler() {
            if (cooldownDuplicador >= 4) {
                let xhr = new XMLHttpRequest();

                xhr.open("POST", "telaquiz.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("duplicador=true");

                xhr.onload = function() {
                    if (xhr.status == 200) {
                        duplicador = true;
                        cooldownDuplicador = 0; // Reseta o contador
                        atualizarCooldowns();
                    }
                };
            }
        }

        function redirecionar() {
            // Salva os contadores de perguntas antes do redirecionamento
            //atualizarCooldowns();
             window.location.href = "gameover.php"; 
        }

        // Atualizar o estado dos botões quando a página carrega
        function atualizarBotaoEstado() {
            document.getElementById("aumentarTempoBtn").classList.toggle("btn-disabled", cooldownAumento < 2);
            document.getElementById("tempoGeladoBtn").classList.toggle("btn-disabled", cooldownCongelamento < 6);
            document.getElementById("doublerBtn").classList.toggle("btn-disabled", cooldownDuplicador < 4);
            document.getElementById("diminuirBtn").classList.toggle("btn-disabled", cooldownDiminuir < 4);
        }

        window.onload = function() {
            startCronometro();
            atualizarBotaoEstado();
        }
    </script>
</head>

<body style="font-family: Poppins, Verdana, Geneva, Tahoma, sans-serif;" class="bg-dark bg-gradient text-white p-3 vh-100" onload="startCronometro()">
    <main>

        <?php
        $questions = QuizDAO::consultarQuestoes();
        $pontos = $_SESSION['pontos'] ?? 0;
        $duplicador = $_SESSION['duplicador'] ?? false;


        if (isset($_POST['duplicador'])) {
            $duplicador = true;
            $_SESSION['duplicador'] = $duplicador;
        }

        if (isset($_POST['i'])) {
            $i = $_POST['i'];
            $i++;
            $questao = $questions[$i - 1];



            if (isset($_POST['resposta'])) {
                $resposta = $_POST['resposta'];
                if ($resposta == $questao['resposta']) {
                    if ($duplicador == true) {
                        $duplicador = false;
                        $pontos += floor(rand(150, 250));
                    } else {
                        $pontos += 100;
                    }
                    $_SESSION['pontos'] = $pontos;
                    $_SESSION['duplicador'] = $duplicador;
                }
            }
        ?>

        <script>
            cooldownAumento++;
            cooldownCongelamento++;
            cooldownDuplicador++;
            cooldownDiminuir++;
            atualizarCooldowns();
            atualizarBotaoEstado();
        </script>

        <?php
            
        } else {
            $i = 0;
        }

        if ($i == count($questions) - 1) {
            header("Location:rankingCadastro.php?key=$pontos");
            $_SESSION['pontos'] = 0;
            $_SESSION['duplicador'] = false;
            session_destroy();
            ob_end_flush();
            die();
        }


        $questao = $questions[$i];
        ?>

        <div class="row align-items-center">
            <div id="countdown" class="col-3 mt-3 text-end align-middle">
                <p style="font-family: Poppins, Verdana, Geneva, Tahoma, sans-serif;" id="timer">15</p>
            </div>
            <div class="col-6 w-50">
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: <?= ($i / 20) * 100 ?>%"></div>
                </div>
            </div>
            <div class="col-3">
                <div style="font-family: Poppins, Verdana, Geneva, Tahoma, sans-serif;" class="score w-25 bg-light rounded-5 text-dark text-center"><?= $pontos ?></div>
            </div>
        </div>


        <?php
        if (isset($questao["imagem"])) {
            $imagemBlob = $questao["imagem"];
            $imagemBase64 = base64_encode($imagemBlob);
            $src = 'data:image/jpeg;base64,' . $imagemBase64;
        ?>
            <div class="row align-items-center">
                <div class="col-12 text-center pt-5 pb-3 img">
                    <img class="rounded-5" style="width:450px; height: 362px; object-fit:cover;" src="<?=$src?>" alt="A Imagem vai aqui.">
                </div>
            </div>
        <?php
        }
        ?>



        <div class="row">
            <p class="text-break text-center fs-3">
                <?= $questao['questao'] ?>
            </p>
        </div>

        <div class="row mt-3 align-items-center">
            <div class="col-1 pb-3">
                <button onclick="doubler()" id="doublerBtn" type="button" class="rounded-3 text-center btn w-100" style="height: 50px;">
                    <img src="img/dobro.jpg" alt="2x" class="rounded-3" style="height: 50px; width: 70px; object-fit:cover">
                </button>

            </div>

            <form method="POST" class="col-5">
                <button type="submit" class="bg-light rounded-3 text-dark text-center opcao d-flex align-items-center w-100 justify-content-center" style="height: 70px;">
                    <?= $questao['opcaoA'] ?>
                    <input type="hidden" name="resposta" value="A">
                    <input type="hidden" name="i" value="<?= $i ?>">
                </button>
            </form>


            <form method="POST" class="col-5">
                <button type="submit" class="bg-light rounded-3 text-dark text-center opcao d-flex align-items-center w-100 justify-content-center" style="height: 70px;">
                    <?= $questao['opcaoB'] ?>
                    <input type="hidden" name="resposta" value="B">
                    <input type="hidden" name="i" value="<?= $i ?>">
                </button>
            </form>

            <div class="col-1 pb-3">
                <button onclick="aumentarTempo()" id="aumentarTempoBtn" class="rounded-3 text-center btn w-100" style="height: 50px;">
                    <img src="img/+10.jpg" alt="+ tempo" class="rounded-3" style="height: 50px; width: 70px; object-fit:cover">
                </button>

            </div>
        </div>

        <div class="row mt-3 align-items-center pb-2 mb-5">
            <div class="col-1 pb-3">
                <button onclick="tempoGelado()" id="tempoGeladoBtn" class="rounded-3 text-center btn w-100" style="height: 50px;">
                    <img src="img/congela.jpg" alt="+ tempo" class="rounded-3" style="height: 50px; width: 70px; object-fit:cover">
                </button>

            </div>

            <form method="POST" class="col-5">
                <button type="submit" class="bg-light rounded-3 text-dark text-center opcao d-flex align-items-center w-100 justify-content-center" style="height: 70px;">
                    <?= $questao['opcaoC'] ?>
                    <input type="hidden" name="resposta" value="C">
                    <input type="hidden" name="i" value="<?= $i ?>">
                </button>
            </form>
            <form method="POST" class="col-5">
                <button type="submit" class="bg-light rounded-3 text-dark text-center opcao d-flex align-items-center w-100 justify-content-center" style="height: 70px;">
                    <?= $questao['opcaoD'] ?>
                    <input type="hidden" name="resposta" value="D">
                    <input type="hidden" name="i" value="<?= $i ?>">
                </button>
            </form>
            <div class="col-1 pb-3">
                <button class="rounded-3 text-center btn w-100" id="diminuirBtn" style="height: 50px;">
                    <img src="img/+10.jpg" onclick="diminuirCooldowns()" alt="+ tempo" class="rounded-3" style="height: 50px; width: 70px; object-fit:cover">
                </button>
            </div>
        </div>
    </main>
</body>

</html>