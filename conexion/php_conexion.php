<?php
	
	$conexion = mysql_connect("localhost","ssdoblec_factu","FacturacioN");
	mysql_select_db("ssdoblec_facturaphp",$conexion);
  mysql_query("SET NAMES utf8");
	 mysql_query("SET CHARACTER_SET utf"); 
	$s='$'; 
	
	function limpiar($tags){
	 $tags = strip_tags($tags);
		return $tags;
	} 

	
?>
