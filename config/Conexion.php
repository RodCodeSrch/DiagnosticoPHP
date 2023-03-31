<?php
require_once 'config.php';
require_once 'config_public.php';

class Conexion
{
    //mysql v8.2.0
    public static function conectar(){
      $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
      $con->set_charset(DB_CHARSET);
      if(mysqli_connect_errno()){
        echo "Error en la conexion: ".mysqli_connect_errno();
      } 
      return $con;
    }
}
// print_r(Conexion::conectar());
?>
