<?php
require_once "../../vendor/autoload.php";
use store\http\response\response;
echo "Error 404";

response::send_response(404);
?>