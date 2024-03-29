let inputuser = document.getElementById("inptcpf");
let inputpwd = document.getElementById("passwd");
let btnlogin = document.getElementById("iniciar");
let btncadastro = document.getElementById("cadastrar");


inputuser.addEventListener("input",function (){
    let regex = /[<>\/.-]*/g;
    inputuser.value = inputuser.value.replace(regex,"");
});

btncadastro.addEventListener("click",function (){
    window.location.href="/calcarestore/cadastre-se.php";
});

btnlogin.addEventListener("click", function (){
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

});

class Login{
    static Response;
    static setResult(result){
        this.Response = result;
    }

    static GetResultado(){
        return this.Response;
    }

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