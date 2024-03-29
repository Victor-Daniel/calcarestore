<?php
require_once "../../vendor/autoload.php";
use store\http\response\response;
echo "Error 400";

response::send_response(400);
?>