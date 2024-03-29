<?php
namespace store\http\route;

class router
{
        //Retorna o controler para cada rota.
       private function Get_Routes() :array
       {
           return [
               "/"=>"controllerindex",
               "/sobre"=>"controllerinfo",
               "/login.php" => "controllerlogin",
               "/cadastre-se.php"=>"controllercadastroclientes"
           ];
       }
       private function Post_Routes() :array
       {
           return [
               "/requestlogin.php"=>"controllerlogin"
           ];
       }
        //Função responsável por retornar a URI sem os parametros e sem prefixos.
       public  function MyRoute()
       {
           $URI = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
           $prefix = "/calcarestore";
           $newuri = explode($prefix,$URI);
           return end($newuri);
       }
        //Função responsável por retornar a URI do POST sem os parametros e sem prefixos.
        public  function MyRoutePOST()
        {
            $URI = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
            $prefix = "/calcarestore/app/http/request";
            $newuri = explode($prefix,$URI);
            return end($newuri);
        }

       //Verifica a existencia da rota GET e retorna o controller se existir
       public function Verify_Routes_GET(string $CurrentURI)
       {
            if(array_key_exists($CurrentURI,self::Get_Routes())){
                return self::Get_Routes()[$CurrentURI];
            }
       }
        //Verifica a existencia da rota POST e retorna o controller se existir
        public function Verify_Routes_POST(string $CurrentURI)
        {
            if(array_key_exists($CurrentURI,self::Post_Routes())){
            return self::Post_Routes()[$CurrentURI];
            }
        }
        //Faz a filtragem para evitar ataques XSS.
       public function MyURLFilter()
       {
           $regex = "/[&lt;|%3C][a-z]+[&gt;|%3E][a-zA-Z]*[();]*[&gt;|%3E]+/";
            $URL = $_SERVER["REQUEST_URI"];
            if(preg_match($regex,$URL)){
                return true;
            }
            else{
                return false;
            }
       }
}

?>