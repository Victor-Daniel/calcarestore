<?php

namespace store\controllers;
use store\util\filereader;
use store\model\dataproduct;
use store\util\filewriter;

//Controlador responsável pela manipulação da vitrine.
class controllervitrine
{
    public static function loader()
    {

        return self::loader_showrun();
    }

    public static function loader_showrun()
    {   $product = new dataproduct();
        $product_info = $product->poduct_data();
        $file = new filewriter();
        $file->writer("vitrine","");
        for($i=0;$i<count($product_info);$i++){
            $content = "<div class='card'>"."<img src='app/view/img/product/".$product_info[$i]["product"].".png'/>"."<h3>Limestone ".$product_info[$i]["product"]."</h3>"."<p>Tamanho: ".$product_info[$i]["info"]."</p>"."<button class='comprar'>$ Comprar</button>"."</div>";

            $file->writer_in_the_end("vitrine",$content);
        }

        return filereader::reader_showrun("vitrine");
    }
}