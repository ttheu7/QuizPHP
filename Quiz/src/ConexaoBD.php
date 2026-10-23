<?php

class ConexaoBD{

    public static function conectar(){
        $conexao = new PDO("mysql:host=172.16.1.85;dbname=ifquiz","Aluno","Coringa");
        // $conexao = new PDO("mysql:host=localhost;dbname=ifquiz","root","Batman");
        return $conexao;
    }
}