<?php

namespace store\util;

//Classe responsável por verificar a existencia de um controller
class controllerchecker
{
    //Método responsável por verificar a existencia de controller .php baseado no nome do arquivo.
    public static function Checker(string $file)
    {
        if(file_exists(__DIR__."../../controllers/$file.php")){
            return true;
        }
        else{
            return false;
        }
    }
}