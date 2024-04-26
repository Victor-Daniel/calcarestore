
// Iniciando os Elementos
let inputuser = document.getElementById("inptcpf");
let inputpwd = document.getElementById("passwd");
let btnlogin = document.getElementById("iniciar");
let btncadastro = document.getElementById("cadastrar");

//Função para validar o campo do CPF
function Analizer(){
    let regex = /[a-zA-Z%$#@+-/?!.,={}<>''""¨¨&]+/g;
    let cpf = inputuser.value;
    if(regex.test(cpf)){
        alert("Preencha os campos corretamente!");
        inputuser.value="";
        inputpwd.value="";
        return false;
    }
    else{
        return true;
    }

}

// Redirecionando o usuário para a página de cadastro de Usuário.
btncadastro.addEventListener("click",function (){
    window.location.href="/calcarestore/cadastre-se.php";
});

// Solicita a verificação do campo User, Verifica se existe sessão Ativa, e senão existir, chama o método que manda o Usuário e Senha para Autenticar no servidor.
btnlogin.addEventListener("click", function (){

    let preenchimento = Analizer();
    if(preenchimento == true){
        $.ajax({
            url:"http://192.168.0.7/calcarestore/app/http/request/requestsession.php",
            type:"post",
            dataType:"json"
        }).done(function (response){
            if(response.enabled==false && response.code==200){
                Login.RequestLogin(inputuser.value,inputpwd.value,Logincallback);
                function Logincallback(){
                    let Result = Login.GetResultado();
                    console.log(Result.httpcode);
                    if(Result.httpcode=200){
                        window.location.href="http://192.168.0.7/calcarestore/";
                    }
                }
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Falha na requisição:",textStatus,errorThrown);
        });
    }
});

// Class de login.
class Login{
    static Response;
    static setResult(result){
        this.Response = result;
    }

    static GetResultado(){
        return this.Response;
    }
// Método que manda o Usuário e Senha para Autenticar o login
    static RequestLogin(user,pwd,callbackfunction){
        $.ajax({
            url:"http://192.168.0.7/calcarestore/app/http/request/requestlogin.php",
            type:"post",
            data:{
                user: user,
                pwd: pwd
            },
            contentType: "application/json",
            dataType:"json"
        }).done(function (response){
            //console.log(response);
            Login.setResult(response);
            callbackfunction();
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Falha na requisição:",textStatus,errorThrown);
        });
    }

}