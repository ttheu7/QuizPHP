<?php
require_once "QuizDAO.php";

if(isset($_GET['idquestao'])){
    $id = $_GET['idquestao'];
    
    QuizDAO::deletar($id);

    header("Location:../questoes.php");
}