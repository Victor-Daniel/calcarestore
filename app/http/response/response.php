<?php

namespace store\http\response;

// Classe responsável por ajustar a resposta de uma solicitação
class response
{
    // Envia uma resposta de código http ao navegador
    public static function send_response(int $code)
    {
        http_response_code($code);
    }
}