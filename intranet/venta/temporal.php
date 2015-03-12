<?php 
   include("php_conexion.php"); 
   $link=Conectarse(); 
   $producto=$_GET['producto']; 
   $cantidad=$_GET['cantidad']; 
   $venta=$_GET['venta'];
   $cliente=$_GET['cliente'];
   $codigo=$_GET['codigo'];
  
   mysql_query("delete from detalleventa where='$venta'",$link);  
   header("Location: mov_ingreso.php"); 
?> 