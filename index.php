<?php
require_once "vendor/autoload.php";
session_start();
use store\http\route\router;
use store\util\controllerchecker;
use store\controllers\controllerindex;
use store\http\session\cookie;
use store\util\filechecker;
use store\http\response\response;
use store\controllers\controllerlogin;
// Instância do router e do filechecker
$rota = new router();
$file = new filechecker();
// Realiza uma verificação se existe uma tentativa de ataque XSS baseado em expressões regex
if($rota->MyURLFilter()==true){
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

            //Verificando a existencia do arquivo index
            if($file->check("index")){

                //Verificando se existe uma sessão ativa
                if(controllerlogin::LoginSessionVerify("cpf")){
                    $Sessao = controllerlogin::Session_Datas();
                    echo controllerindex::renderhome("Seja bem-vindo usuário ".$Sessao["user"]);
                    response::send_response(200);
                }
                //Caso não exista, será carregado a página do index e será enviado um código http 200
                else{
                    echo controllerindex::renderhome("Login | Cadastre-se");
                    response::send_response(200);
                }
            }
            // Caso o arquivo index não exista, será redirecionado para a página 404
            else{
                header("location: http://192.168.0.7/calcarestore/app/errorpages/page404.php",false);
            }
        }
        // Caso não exista, será redirecionado para página de erro do controller
        else{
            header("location: http://192.168.0.7/calcarestore/app/errorpages/controller-error.php",false);
        }
    }
    // Caso a requisição não for GET, será redirecionado para página de erro 403
    else{
        header("location: http://192.168.0.7/calcarestore/app/errorpages/page400.php",false);
    }

}

?>


