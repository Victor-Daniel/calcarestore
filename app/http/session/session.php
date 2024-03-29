<?php
namespace store\http\session;
class Session
{
    // Criando uma sessão e Adicionando indice a ela. Serve também para adicionar outros valores na sessão
    public static function Set(string $index,mixed $value) :void
    {
        $_SESSION[$index] = $value;
    }

    //Verificando a Existência de um indice no array session.
    public static function Exists(string $index=null)
    {
        return isset($_SESSION[$index]);
    }

    //Pegando dados da sessão caso exista.
    public static function Get(string $index)
    {
       if(self::Exists($index)){
           return $_SESSION[$index];
       }
    }

    //Pegando todos os dados da Sessão
    public static function Get_All_Datas()
    {
        return $_SESSION;
    }

    //Excluindo dados de um indice da sessão.
    public static function Delete(string $index)
    {
        if(self::Exists($index)){
            unset($_SESSION[$index]);
        }
    }
    //Deletando todas as Sessões e seus dados.
    public static function Delete_All()
    {
        unset($_SESSION);
        session_destroy();
    }

    //Criando Mensagens Flag
    public static function Flash_Message(string $index, mixed $value)
    {
        $_SESSION["__flash"][$index] = $value;
    }
    //Removendo Mensagens Flag
    public static function Remove_Flas_Message()
    {
        if($_SERVER["REQUEST_METHOD"]=="GET" && self::Exists("__flash")){
            unset($_SESSION["__flash"]);
        }
    }
}