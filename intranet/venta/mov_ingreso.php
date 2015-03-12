<?php
require('../../css/cabecera.php');
include_once('php_conexion2.php');
?>
<!DOCTYPE html>
<html lang="es"> 
<head>
<title>sistema facturacion</title>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://getbootstrap.com/dist/js/bootstrap.js"></script>
<link type="text/css" rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css"/>
     <link href="../../css/css/bootstrap.min.css" rel="stylesheet">
     <link href="../../css/css/estilos.css" rel="stylesheet">
</head>
<body> 
<?php
/* $link = mysql_connect("localhost","root","");
mysql_select_db("prueba",$link);
   $sql="SELECT MAX(idventa)as maximo FROM venta";
        $cs=mysql_query($sql,$link);
        if($row=mysql_fetch_array($cs)){
			if($row['maximo']==NULL){
				$factura='000001';
			}else{
				$factura=$row['maximo']+1;
			}
			
		} */
			
		
$var="";
$var1="";
$var2="";
$var3="";
$var0=""; 

if(isset($_POST["btn1"])){
	$btn=$_POST["btn1"];
     $bus=$_POST["codpro"];
	
	include_once('php_conexion2.php');
	
		if($btn=="Nuevo"){

			
			 mysql_query("truncate table detalleventa",$conexion); 
		}
		
			if($btn=="Buscar"){
		
		$sql="select * from productos where codpro='$bus'";
		$cs=mysql_query($sql,$conexion);
		while($resul=mysql_fetch_array($cs)){
			$var=$resul[0];
			$var1=$resul[1];
			$var2=$resul[2];
			$var3=$resul[3];

			}		
		}
	
	if($btn=="agrega"){
  include_once('php_conexion2.php');
	
   $producto=$_POST['producto'];
   $cantidad=$_POST['cantidad']; 
   $venta=$_POST['venta'];
//   $cliente=$_POST['cliente'];
   $codpro=$_POST['codpro'];
   $precio=$_POST['precio'];
   $importe=$cantidad*$precio;

   mysql_query("insert into detalleventa (codpro,idventa,producto,cantidad,precio,importe) values ('$codpro','$venta','$producto','$cantidad','$precio','$importe')",$conexion);
   mysql_query("insert into temporal (codpro,idventa,producto,cantidad,precio,importe) values ('$codpro','$venta','$producto','$cantidad','$precio','$importe')",$conexion);		   
	
   }
   
   if($btn=="guarda"){
include_once('php_conexion2.php');
	
   $venta=$_POST['venta'];
   $cliente=$_POST['cliente'];
   $fecha=$_POST['fecha'];

   mysql_query("insert into venta (idventa,cliente,fecha) values ('$venta','$cliente','$fecha')",$conexion);

   $sql=mysql_query("SELECT * FROM detalleventa ");  
            while($p=mysql_fetch_array($sql)){
            $cant=$p['cantidad'];
            $cod=$p['codpro'];  			
   mysql_query("update productos set stock=stock-$cant where codpro=$cod",$conexion);
  }

   echo "<script> alert('Venta realizada con Exito');</script>";	
   // mysql_query("truncate table detalleventa",$link);   
   }
    
	// if($btn=="Limpiar"){
	// $link = mysql_connect("localhost","root","");
	// mysql_select_db("prueba",$link);

   // $venta=$_POST['venta'];
    // mysql_query("delete from detalleventa where idventa='$venta'",$link);
	    
	  // echo "<script> alert('listo para una nueva venta; correctamente');</script>";	
// }

}
?>
<FORM  action="mov_ingreso.php" method="post" enctype="multipart/form-data" >
<div class="container">
<div style="width:112%; height:245px; overflow:auto">

<table class="table table-bordered">

<TR width="50%">
   <TD class="info">EMPLEADO:</TD> 
   	<td ><b><input type="text" readonly="readonly" value="<?php 
session_start();
$usu=$_SESSION["usuario"];
echo $usu;?>"/>
</td>
   <TD class="info">VENTA:</TD> 

   <TD><b><INPUT TYPE="text" NAME="venta" SIZE="20" MAXLENGTH="30" value="<?php 
   $pa=mysql_query("SELECT MAX(idventa)as maximo FROM venta");				
        if($row=mysql_fetch_array($pa)){
			if($row['maximo']==NULL){
				$factura='1001';
			}else{
				$factura=$row['maximo']+1;
			}
		}
   echo   $factura; ?>" > 

   
   		
   </TD>

   </TR>
   <TR>
   <TD class="info">CLIENTE:</TD> 

<td><b><?php 
$conexion="SELECT nombres FROM cliente";
$res=mysql_query($conexion);
if(!$res){
echo " fallo";
}
else{
echo "<select  name='cliente' >";
while ($fila=mysql_fetch_array($res)){
    if($_POST['cliente']==$fila['nombres'])
        echo "<option selected='selected'>".$fila['nombres']."</option>";
    else
        echo "<option>".$fila['nombres']."</option>";

}
echo "</select>";
}
?></td>

  <TD class="info">FECHA:</TD> 
   <TD><b><INPUT TYPE="text" NAME="fecha" value="<?php echo (date('Y-m-d')); ?>"></TD>     
</TR>
<TR>
  <TD class="info">CODIGO:</TD> 
   <TD><INPUT TYPE="text" NAME="codpro" SIZE="20" MAXLENGTH="30" value="<?php echo $var?>"></TD> 
   <TD>
   <button type="submit" NAME="btn1" VALUE="Buscar"class="btn btn-success"><span class="glyphicon glyphicon-search"></span> BUSCAR</button></TD> 
    <TD>

	     <button type="button" class="btn btn-default" onClick="location.href='../../intranet/producto/listado_alumno.php'" ><span  class="glyphicon glyphicon-th-list"></span> LISTAR</button>
	   </TD>  
   <TD class="info">PRODUCTO:</TD> 
   <TD><INPUT TYPE="text" NAME="producto" SIZE="40" MAXLENGTH="70" value="<?php echo $var1?>"/></TD>
   </TR> 
   <TR><TD class="info">CANTIDAD:</TD> 
   <TD><INPUT TYPE="text" NAME="cantidad" SIZE="20" MAXLENGTH="30" ></TD>
   <TD class="info">PRECIO:</TD> 
   <TD><INPUT TYPE="text" NAME="precio" SIZE="20" MAXLENGTH="30" value="<?php echo $var3?>"></TD> 
   <TD class="info">STOCK:</TD> 
   <TD><INPUT TYPE="text" NAME="stock" SIZE="20" MAXLENGTH="30" value="<?php echo $var2?>" ></TD>    
</TR>
 
</TABLE> 

<center>
 <button type="submit" name="btn1" value="Nuevo" class="btn btn-default"><span class="glyphicon glyphicon-file"></span> NUEVO</button>
 
  <button type="submit" name="btn1" value="guarda" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved"></span>GUARDAR</button>
  <button type="button"   class="btn btn-warning" onClick="location.href='../../reporte/factura.php'" ><span class="glyphicon glyphicon-save"></span>IMPRIMIR</button>
  <button type="submit" name="btn1" value="agrega" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>AGREGAR</button>
 </center>
  </div>
</div>
</FORM> 
<?php 
  require('php_conexion2.php');
   $result=mysql_query("select * from detalleventa",$conexion); 
?> 
<div class="container">
<div style="width:80%; height:165px; overflow:auto">
  <table class="table table-bordered table-striped" width="50%">
      <TR class="active"><TD>&nbsp;<B>codpro</B></TD><TD>&nbsp;<B>Descripcion</B></TD> <TD>&nbsp;<B>Cantidad</B>&nbsp;</TD>
	 <TD>&nbsp;<B>Precio Unitario</B>&nbsp;</TD><TD>&nbsp;<B>Precio Total</B>&nbsp;</TD> <TD>&nbsp;</TD></TR> 
<?php       
   while($row = mysql_fetch_array($result)) { 
      printf("<tr>
	  <td>&nbsp;%s</td>
	  <td>&nbsp;%s</td>
	  <td>&nbsp;%s&nbsp;</td>
	   <td>&nbsp;%s&nbsp;</td>
	   <td>&nbsp;%s&nbsp;</td>
	    
	  <td ><a href=\"borra.php?id=%d\"class='btn btn-danger'><span class='glyphicon glyphicon-minus'></span> Borra</a></td>
	  </tr>", 
	 $cod=$row["codpro"],$pro=$row["producto"],$cant=$row["cantidad"],$pre=$row["precio"],$imp=$row["importe"],$row["codpro"]); 
     
				
   }    
   mysql_free_result($result); 
   //mysql_close($conexion);    
?>
</table >
</div  >
</div>
 <div class="span6" align="right">
<div style="width:27%;  height:200px;" >
<table class="table table-bordered">
<tr>
<td class="info" ><B>SUBTOTAL </td>
<td ><B><input type='text' name='cboaula' id='cboaula' value='<?php 

include_once('php_conexion2.php');
$conexion="SELECT ROUND(SUM(importe),2) as subtotal FROM detalleventa";
$res=@mysql_query($conexion);
if(!$res){
echo " fallo";
}
else{
while ($fila=mysql_fetch_array($res)){
echo  $fila['subtotal'];
}
}
?>'>
</td>
</tr>
<tr>
<td class="info"><B>IVA 12%    </td>
<td><B><input type='text' name='cboaula' id='cboaula' value='<?php 
include_once('php_conexion2.php');
$conexion="SELECT ROUND(SUM(importe)*12/100 ,2) as igv FROM detalleventa";
$res=@mysql_query($conexion);
if(!$res){
echo " fallo";
}
else{
while ($fila=mysql_fetch_array($res)){
echo  $fila['igv'];
}
}
?>'>
</td>
</tr>
<tr>
<td class="info"><B>TOTAL   </td>
<td ><B><input type='text' name='cboaula' id='cboaula' value='<?php 

include_once('php_conexion2.php');
$conexion="SELECT ROUND(SUM(importe)*12/100+SUM(importe),2) as total FROM detalleventa";
$res=@mysql_query($conexion);
if(!$res){
echo " fallo";
}
else{
while ($fila=mysql_fetch_array($res)){
echo  $fila['total'];
}
}
?>'>
</td>
</tr>
</table>

</div> 
</div> 
</div>
</body> 
</html> 
