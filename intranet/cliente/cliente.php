<?php
require('../../css/cabecera.php');
require("../../conexion/php_conexion.php");
?>
<html>
<head>
<title>sistema facturacion</title>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
		
     <script src="../../js/validar.js" type="text/javascript" language="javascript"></script> 
     <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
     <script type="text/javascript" src="http://getbootstrap.com/dist/js/bootstrap.js"></script>
     <link type="text/css" rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css"/>
     <link rel='stylesheet' type='text/css' href='../../css/index.html'/>
     <link href="../../css/css/bootstrap.min.css" rel="stylesheet">
     <link href="../../css/css/estilos.css" rel="stylesheet">
</head>
<body id="notas" align="center">
<?php
$var="";
$var1="";
$var2="";
$var3="";
$var4="";

if(isset($_POST["btn1"])){
	$btn=$_POST["btn1"];
	$bus=$_POST["txtbus"];
	if($btn=="Buscar"){
		
		$sql="select * from cliente where idcli='$bus'";
		$cs=mysql_query($sql,$conexion);
		while($resul=mysql_fetch_array($cs)){
			$var=$resul[0];
			$var1=$resul[1];
			$var2=$resul[2];
			$var3=$resul[3];
			$var4=$resul[4];
			}
			
			
		}
	if($btn=="Nuevo"){
		
					$sql="SELECT max(idcli +1) from cliente";
					$cs = mysql_query($sql,$conexion);
                      if ($row = mysql_fetch_row($cs)) {
                              $var = trim($row[0]);
                                        }
			
		}
		if($btn=="Agregar"){
		$cod=$_POST["txtcod"];
		$nom=$_POST["txtnom"];
		$dire=$_POST["txtdire"];
		$tel=$_POST["txtcel"];
		$dni=$_POST["txtdni"];
	
		$sql="insert into cliente values ('$cod','$nom','$dire','$tel','$dni')";
		
		$cs=mysql_query($sql,$conexion);
		echo "<script> alert('Se inserto; correctamente');</script>";
		}
		if($btn=="Actualizar"){
		$cod=$_POST["txtcod"];
		$nom=$_POST["txtnom"];
		$dire=$_POST["txtdire"];
		$tel=$_POST["txtcel"];
		$dni=$_POST["txtdni"];

		
		$sql="update cliente set nombres='$nom',direccion='$dire',telefono='$tel',dni='$dni' where idcli ='$cod'";
		
		$cs=mysql_query($sql,$conexion);
		echo "<script> alert('Se actualizo correctamente');</script>";
		}
		
		if($btn=="Eliminar"){
		$cod=$_POST["txtcod"];
			
		$sql="delete from cliente where idcli ='$cod'";
		
		$cs=mysql_query($sql,$conexion);
		echo "<script> alert('Se elimnino correctamente');</script>";
		}
	}

?>
<form action="cliente.php" method="POST">
<body>
  <div class="container">
	<div class="page-header">
	
     <table  class="table table-bordered table-striped" >
        <tr >

               <th width="90%"  >
     <center><h2>DATOS PERSONALES DEL CLIENTE</center></h2>
         </th>
                  </tr>
      </table>

    </div>
<table  class="table table-bordered table-striped" >
                  <tr >
               <th width="90%"  >
                    
                        <center>
                      	<form action="cliente.php" method="POST" class="form-search">
                        		<input type="text" name="txtbus"  SIZE="40"  autocomplete="off"  placeholder="Buscar por  codigo">
                         <button type="submit" name="btn1"  value="Buscar" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> BUSCAR</button>
                    	</form>
                        </center>
                    </th>
                  </tr>
                </table>
				
 

 <div class="col-md-6 form-group">
    <label  >CODIGO:</label>
    <input type="text" class="form-control" name="txtcod" id="txtcod" maxlength='50'  SIZE="50"value="<?php echo $var?>">
 </div>

<div class="col-md-6 form-group">
    <label  >NOMBRES O RAZON SOCIAL:</label>
    <input type="text" class="form-control" name="txtnom" id="txtnom" maxlength='50'  SIZE="50"value="<?php echo $var1?>" placeholder="ingrese aqui su nombres" >
 </div>
 
<div class="col-md-6 form-group">
<label >DIRECCION:</label>
<input type="text" class="form-control" name="txtdire" id="txtdire" value="<?php echo $var2?>" maxlength="9" placeholder="ingrese aqui su direccion" >
</div>



<div class="col-md-6 form-group">
<label >TELEFONO:</label>
<input type="text" class="form-control" name="txtcel"  id="txtcel"  value="<?php echo $var3?>" onKeyPress="keynumeros();" placeholder="ingrese aqui su telefono">
 </div>


<div class="col-md-6 form-group">
<label >CEDULA O RIF:</label>
 <input type="text"  class="form-control"   name="txtdni" id="txtdni" value="<?php echo $var4?>" placeholder="ingrese aqui su dni" >
  </div>
<div class="col-md-12 form-group">
 <button type="submit" name="btn1" value="Nuevo" class="btn btn-default"><span class="glyphicon glyphicon-file"></span> NUEVO</button>
 <button type="submit" name="btn1" value="Eliminar" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> ELIMINAR</button>
 <button type="submit" name="btn1" value="Actualizar" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> ACTUALIZAR</button>
 <button type="submit" name="btn1" value="Agregar" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved"></span> GUARDAR</button>


</div>

  </div>
</table>

</form>
</body>
</html>
