<?php
// Responsável por receber as requisições via GET para analisar se existe a uma sessão ativa


require "../../../vendor/autoload.php";

use store\controllers\controllerlogin;
use store\http\route\router;
session_start();
$rota = new router();
if (!$rota->MyURLFilter()){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $response = array(
            "success" => true,
            "enabled"=>controllerlogin::LoginSessionVerify("cpf"),
            "code"=>200
        );
        echo json_encode($response);
    }
    else{
        $response = array(
            "success" => false,
            "code"=>403
        );

        echo json_encode($response);
    }
}
else{
    header("location: app/errorpages/page403.php",false);
}
