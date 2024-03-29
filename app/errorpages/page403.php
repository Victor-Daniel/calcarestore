<?php
require_once "../../vendor/autoload.php";
use store\http\response\response;

echo "Erro 403 encontrado!";
response::send_response(403);
?>