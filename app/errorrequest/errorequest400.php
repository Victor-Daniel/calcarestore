<?php

namespace store\errorrequest;

class errorequest400
{
    public static function BadRequest()
    {
        return[
            "httpcode"=>400,
            "content"=>"Bad Request: Servidor não pode processar esse tipo de requisição."
        ];
    }
}