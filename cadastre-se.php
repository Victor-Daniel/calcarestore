<?php
require_once "vendor/autoload.php";

use store\util\controllerchecker;
use store\http\route\router;
use store\util\filechecker;
use store\controllers\controllercadastroclientes;

// Instância do router e do filechecker
$rota = new router();
$file = new filechecker();

// Realiza uma verificação se existe uma tentativa de ataque XSS baseado em expressões regex
if($rota->MyURLFilter()){
    // Caso o resultado da verificação for verdadeira, será redirecionado para página de erro 403
    header("location: app/errorpages/page403.php",false);
}
else{
// Caso a verificação for bem sucedida, será realizado uma nova verificação
// Abaixo será executado uma verificação pra ver se a requisição realizada é do tipo GET

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        // Verificando qual é o controller resposável baseado na rota atual
        $controller= $rota->Verify_Routes_GET($rota->MyRoute());

        // Verificando a existencia desse controller
        if(controllerchecker::Checker($controller)){
            if($file->check("cadastrar-cliente")){
                echo controllercadastroclientes::rendercadastrocliente();
            }
            else{
                header("location: app/errorpages/page404.php",false);
            }
        }
        // Caso não exista, será redirecionado para página de erro do controller
        else{
            header("location: app/errorpages/controller-error.php",false);
        }
    }
    else{
        // Caso a requisição não for GET, será redirecionado para página de erro 403
        header("location: app/errorpages/page403.php",false);
    }
}
?>
