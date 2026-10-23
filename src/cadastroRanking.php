<?php
require_once "QuizDAO.php";
QuizDAO::cadastrarRanking();
header("Location:../ranking.php");