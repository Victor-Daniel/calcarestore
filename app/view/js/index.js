const login = document.getElementById("user");

login.addEventListener("click",function (){
    $.ajax({
        url: "http://192.168.0.7/calcarestore/app/http/request/requestsession.php",
        type:"POST",
        dataType: 'json',
        success: function (data){
           if(data.enabled==false && data.code==200){
                window.location.href="http://192.168.0.7/calcarestore/login.php";
            }
            else if(data.code == 403){
               window.location.href="../../errorpages/page403.php";
            }

        }
    });
});