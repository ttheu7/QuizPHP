<?php

require_once("ConexaoBD.php");

class TemasDAO
{

    public static function consultarTemas()
    {
        $conexao = ConexaoBD::conectar();
        $sql = "select * from temas";
        return $conexao->query($sql);
    }

}
