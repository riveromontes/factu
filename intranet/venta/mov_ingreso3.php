<?php 
   include("php_conexion.php"); 
   $link=Conectarse(); 
 
 
   mysql_query("delete from detalleventa where idventa='$venta'",$link); 
   header("Location: mov_ingreso.php"); 
?> 
