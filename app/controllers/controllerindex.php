<?php

namespace store\controllers;
use store\util\filereader;
use store\controllers\controllervitrine;

//Classe responsável por Ler o conteúdo do index e retornar para a rota.
class controllerindex
{
    public static function renderhome($user=null)
    {   $render = filereader::reader("index");
        $values = [
            "{user}"=>$user,
            "{vitrine}"=>controllervitrine::loader()
        ];
        return strtr($render,$values);
    }
}