<?php 
   include("php_conexion2.php"); 
   //$conexion=Conectarse(); 
   $id=$_GET['id'];
   mysql_query("delete from detalleventa where codpro = $id",$conexion); 
   mysql_query("delete from temporal where codpro = $id",$conexion); 
   header("Location: mov_ingreso.php"); 
?> 