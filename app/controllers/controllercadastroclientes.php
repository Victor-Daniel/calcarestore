<?php

namespace store\controllers;

use store\util\filereader;

// Controller usado para cadastrar clientes do site
class controllercadastroclientes
{
    public static function rendercadastrocliente()
    {   $render = filereader::reader("cadastrar-cliente");
        return $render;
    }
}