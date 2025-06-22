<?php
 namespace DAL;
 use PDO;
  class conexao{
     private static $dbnome = 'cardapio';
     private static $dbhost = 'localhost';
     private static $dbusuario = 'root';
     private static $dbsenha = '';
     private static $con = null;
    public function conectar(){
     if(self::$con == null){
        try {
            self::$cont = new PDO("mysql:host=" . self::$dbhost . ";dbname=" . self::$dbnome,  self::$dbusuario , self::$dbsenha); 
        } catch (\PDOException $exception) {
             die($exception->getmessage());
        }
     }
       return self::$con;
    }
    public function desconectar(){
        self::$con == null;
        return self::$con;
    }
  }
?>