<?php 


class BD{

    public static $instancia=null;
    public static function crearInstancia(){

         if (self::$instancia === null) { // como arriba instancia es igual null, entonces de va ejecutar este codigo
 
              $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; //Esto es si falla la conexion lance un error y no lo haga silenciosamente incluso opciones esta abajo
              self::$instancia = new PDO('mysql:host=localhost;dbname=aplicacion', 'root', '', $opciones);
              // echo "conectando...";
          }
         return self::$instancia;
    }
}  

?>