<?php

namespace store\util;

// Classe responsável por escrever conteúdo em arquivo html
class filewriter
{
    //Esse método irá escrever conteúdo no arquivo de forma "sobrescrita"
    public function writer(string $filename, string $content=null)
    {
        $dir = __DIR__."../../view/showrun/$filename.html";
        file_put_contents($dir,$content);
    }
    //Esse método irá escrever conteúdo no final do arquivo
    public  function  writer_in_the_end(string $filename, string $content=null)
    {
        $dir = __DIR__."../../view/showrun/$filename.html";
        file_put_contents($dir,$content,FILE_APPEND);
    }
}