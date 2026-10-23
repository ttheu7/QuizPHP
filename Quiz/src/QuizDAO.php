<?php

require_once("ConexaoBD.php");
require_once "funcoes.php";

class QuizDAO
{

    public static function consultarQuestoes()
    {
        $conexao = ConexaoBD::conectar();

        $tema = $_SESSION['temas'] ?? 69;
        $sql = "select * from questoes where idtema = '$tema' limit 20";

        $questoes = $conexao->query($sql);

        return $questoes->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listar()
    {
        $conexao = ConexaoBD::conectar();

        $sql = "select * from questoes";
        $questoes = $conexao->query($sql);

        return $questoes->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function cadastrarQuestoes()
    {
        $conexao = ConexaoBD::conectar();

        $tema = 69;
        $questao = $_POST["questao"]; 
        $altA = $_POST["altA"];
        $altB = $_POST["altB"];
        $altC = $_POST["altC"];
        $altD = $_POST["altD"];
        $resposta = $_POST["resposta"];

        // Verifica se o arquivo foi enviado e não há erros
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $img = pegarImagem($_FILES);;
        } else {
            $img = null;
        }

        $sql = "INSERT INTO questoes (questao, opcaoA, opcaoB, opcaoC, opcaoD, resposta, idtema, imagem) 
        VALUES ('$questao', '$altA', '$altB', '$altC', '$altD', '$resposta', '$tema', '$img')";

        $conexao->exec($sql);
    }

    public static function deletar($id)
    {
        $conexao = ConexaoBD::conectar();

        $sql = "delete from questoes where idquestao = '$id'";

        $conexao->exec($sql);
    }

    public static function pesquisar($questao)
    {
        $conexao = ConexaoBD::conectar();

        $sql = "SELECT * FROM questoes WHERE questao LIKE '%$questao%'";

        return $conexao->query($sql);
    }

    public static function cadastrarRanking(){
        $conexao = ConexaoBD::conectar();
        $pontos = $_GET['pontos'];
        if (isset($_GET['nome']) && empty($_GET['nome']) == false) {
            $nome = $_GET["nome"];           
            $sql = "insert into betterranking (username, pontos) values ('$nome', '$pontos')";
        } else {
            $sql = "insert into betterranking (pontos) values ('$pontos')";
        }
        $conexao->exec($sql);
    }

    public static function consultarRanking(){
        $conexao = ConexaoBD::conectar();
        $sql = "select * from betterranking order by pontos desc";
        return $conexao->query($sql);
    }

    public static function pesquisarRank($nome)
    {
        $conexao = ConexaoBD::conectar();

        $sql = "select * from betterranking where username like '%$nome%' order by pontos desc";

        return $conexao->query($sql);
    }

    public static function verLogin()
    {
        $conexao = ConexaoBD::conectar();
        $username = $_SESSION['username'];
        $senha = md5($_SESSION['senha']);

        $sttm = $conexao->query('select * from administradores where id = 69');
        $users = $sttm->fetchAll(PDO::FETCH_ASSOC);
        $user = $users[0];

        if ($username == $user['username'] && $senha == $user['senha']) {
            return true;
        } else {
            return false;
        }
    }
}
