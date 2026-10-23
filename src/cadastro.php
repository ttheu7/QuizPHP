<?php
require_once "QuizDAO.php";
QuizDAO::cadastrarQuestoes();
header("Location:../questoes.php");