<?php

namespace store\controllers;
use store\http\session\cookie;
use store\util\filereader;
use store\http\session\Session;
use store\model\datalogin;

// Controller usado para renderizar a página de login e outras funções relacionadas ao login.
class controllerlogin
{
    // Renderiza a página de login
    public static function renderlogin(string $user=null)
    {
        return filereader::reader("login");
    }
    //Verifica a existencia de uma sessão
    public static function LoginSessionVerify(string $index)
    {
        return Session::Exists($index);
    }
    //Solicita o login na classe de datalogin e trata os dados do login
    public static function LoginSystem($CPF,$PWD)
    {
        $login = new datalogin();
        $dados = $login->LoginExe();
        if(in_array($CPF,$dados) && in_array($PWD,$dados)){
            Session::Set("cpf",$dados["cpf"]);
            Session::Set("user",$dados["user"]);
            return true;
        }
        else{
            return false;
        }
    }

    // Realiza o logout
    public static function Logout()
    {
        Session::Delete_All();
    }

    public static function Session_Datas()
    {
        return Session::Get_All_Datas();
    }

}