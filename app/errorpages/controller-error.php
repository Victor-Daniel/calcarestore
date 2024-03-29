<?php
require_once "../../vendor/autoload.php";
use store\http\response\response;

echo "Controller não encontrado!";
response::send_response(500);
?>