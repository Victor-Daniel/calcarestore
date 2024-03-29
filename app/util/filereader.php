<?php

namespace store\util;

// Classe responsável por ler arquivos.
class filereader
{
    // Método responsável por retornar o conteúdo de um arquivo html localizado em view.
    public static function reader($foundfile)
    {   $file = __DIR__."../../view/$foundfile.html";
        return file_get_contents($file);
    }

    //Método responsável por retornar o conteúdo de um arquivo html do showrun localizado em view/showrun.
    public static function reader_showrun($foundfile)
    {   $file = __DIR__."../../view/showrun/$foundfile.html";
        return file_get_contents($file);
    }
}