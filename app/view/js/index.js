// Selecionando o Botão de ID user.
const login = document.getElementById("user");

// Função responsável por enviar e receber dados relacionado com a sessão do servidor PHP. Essa função será executada quando realizarmos o Click.
login.addEventListener("click",function (){
    $.ajax({
        url: "http://192.168.0.7/calcarestore/app/http/request/requestsession.php",
        type:"POST",
        dataType: 'json',
        success: function (data){
            // Verifica o resultado do request e caso retornado um código 403, será realizado o tratamento do erro.
           if(data.enabled==false && data.code==200){
                window.location.href="http://192.168.0.7/calcarestore/login.php";
            }
           // Falta tratar esse erro.
            else if(data.code == 403){
               window.location.href="../../errorpages/page403.php";
            }

        }
    });
});