<?php
// Página responsável por gerenciar as requisições feitas para o login.
require "../../../vendor/autoload.php";

use store\controllers\controllerlogin;
use store\errorrequest\errorequest400;
use store\errorrequest\errorrequestcontroller;
use store\http\route\router;
use store\util\controllerchecker;

session_start();

//Habilitando o corpo content-type das requisições.
header("Access-Control-Allow-Headers: Content-Type");
// Habilitando as rotas.
$router = new router();

// Fazendo as validação da URL enviada.
if ($router->MyURLFilter()){
    header("location: https://192.168.0.7/app/errorpages/page403.php",false);
}
else{
    // Verificando o se o Método é do tipo POST
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //Resgatando os dados via POST
        $json = file_get_contents("php://input");

        // Parseando o Json para dados legíveis em array
        parse_str($json,$data);
        // Verificando qual é o controlador dessa rota POST
        $controller = $router->Verify_Routes_POST($router->MyRoutePOST());

        //Verificando a Existência do controller.
        if(controllerchecker::Checker($controller)){
            //Realizando login no systema.
            $result=controllerlogin::LoginSystem($data["user"],$data["pwd"]);
            if($result){
                echo json_encode(["httpcode"=>200,"desc"=>"Login realizado com sucesso!"]);
            }
            else{
                echo json_encode(["httpcode"=>403,"desc"=>"Não foi possível realizar login!"]);
            }
        }
        else{
            echo json_encode(errorrequestcontroller::ErrorController404());
        }
    }
    else{
        echo json_encode(errorequest400::BadRequest());
    }
}

?>