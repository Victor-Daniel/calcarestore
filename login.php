<?php
require_once "vendor/autoload.php";
session_start();
use store\util\controllerchecker;
use store\http\route\router;
use store\util\filechecker;
use store\controllers\controllerlogin;

// Instância do router e do filechecker
$rota = new router();
$file = new filechecker();
// Realiza uma verificação se existe uma tentativa de ataque XSS baseado em expressões regex
if($rota->MyURLFilter()){
    // Caso o resultado da verificação for verdadeira, será redirecionado para página de erro 403
    header("location: http://192.168.0.7/calcarestore/app/errorpages/page403.php",false);
}
else{
    // Caso a verificação for bem sucedida, será realizado uma nova verificação
    // Abaixo será executado uma verificação pra ver se a requisição realizada é do tipo GET

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        // Verificando qual é o controller resposável baseado na rota atual
        $controller= $rota->Verify_Routes_GET($rota->MyRoute());

        // Verificando a existencia desse controller
        if(controllerchecker::Checker($controller)){
            if($file->check("login")){
                // Verifica a sessão se existe. Se existir redireciona para a Home se não redireciona para login.
                if(controllerlogin::LoginSessionVerify("cpf")==true){
                   header("location: http://192.168.0.7/calcarestore/",false);
                }
                else{
                    echo controllerlogin::renderlogin();
                }
            }
            else{
                header("location: http://192.168.0.7/calcarestore/app/errorpages/page404.php",false);
            }
        }
        // Caso não exista um controller, será redirecionado para página de erro do controller
        else{
            header("location: http://192.168.0.7/calcarestore/app/errorpages/controller-error.php",false);
        }
    }
    else{
        // Caso a requisição não for GET, será redirecionado para página de erro 403
        header("location: http://192.168.0.7/calcarestore/app/errorpages/page400.php",false);

    }
}
?>
