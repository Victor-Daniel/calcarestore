<?php

namespace store\http\session;

// Classe responsável por gerir os cookies
class cookie
{
    // Criando cookie
    public static function create_cookie(string $index, mixed $value)
    {
       setcookie($index,$value,strtotime("+1days"));
    }

    // Retorna o valor do coockie baseado no index.
    public static function show_cookie(string $index=null)
    {
        if(isset($_COOKIE[$index])){
            return $_COOKIE[$index];
        }
    }
    // remove cookie
    public static function remove_cookie(string $index)
    {
        setcookie($index,null,strtotime("-1days"));
    }

    // Verificar a existencia do cookie

    public static function verfify_cookie(string $index)
    {
        if (isset($_COOKIE[$index])){
            return true;
        }
        else{
            return false;
        }
    }
}