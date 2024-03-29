<?php

namespace store\util;

//Classe responsável por verificar a existencia de um arquivo html
class filechecker
{
    //Esse método será responsável por verificar a existencia de um html tendo como parametro o nome do arquivo sem o .html
    public  function check(string $filename)
    {
        return file_exists(__DIR__."../../view/$filename.html");
    }
}