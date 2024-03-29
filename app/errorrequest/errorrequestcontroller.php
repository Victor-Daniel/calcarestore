<?php

namespace store\errorrequest;

class errorrequestcontroller
{
    public static function ErrorController404()
    {
        return[
          "errorcode"=>404,
          "desc"=>"controller não encontrado!"
        ];
    }
}