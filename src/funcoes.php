<?php

function pegarImagem(Array $files):string{
    $nome_img = $files['img']['name'];
    $tipo_img = $files['img']['type'];
    $tam_img = $files['img']['size'];
    $imagem = $files['img']['tmp_name'];

    $fp = fopen($imagem, "rb");
    $imagem = fread($fp, $tam_img);
    $imagem = addslashes($imagem);
    fclose($fp);

    return $imagem;
}