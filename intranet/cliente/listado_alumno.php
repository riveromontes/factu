<?php 
	session_start();
	include_once "../../conexion/php_conexion.php";
	include_once "funciones.php";
	include_once "class_buscar.php";
	require("../../css/cabecera.php");
?>

<!DOCTYPE html>
<html lang="es">
  <head>
 	  <link rel='stylesheet' type='text/css' href='../../../css/index.html'/><?php /*index.html no existe*/ ?>
  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="http://getbootstrap.com/dist/js/bootstrap.js"></script>
    <link type="text/css" rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css"/>

    <link href="../../css/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/css/estilos.css" rel="stylesheet">
  </head>
  <div class="container">

              <h3></h3>
            	<table  class="table table-bordered table-striped" >
                  <tr >
               <th width="90%"  >
                    	<h1 align="center">Listado de Clientes</h1>
                        <center>
                      	<form name="form3" method="post" action="" class="form-search">
                        		<input type="text" SIZE="40"  name="buscar" autocomplete="off"  placeholder="Buscar por apellidos o codigo">
                         <button type="submit" name="buton" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> BUSCAR</button>
                    	</form>
                        </center>
                    </th>
                  </tr>
                </table>
            
                <br>
              <table class="table table-bordered table-striped">
                  <tr class='even'>
                    <th><strong>Codigo</strong></th>
                    <th><strong>Apellidos Y Nombres</strong></th>
					   <th><strong>Direccion</strong></th>
                    <th><strong>Telefono</strong></th>
					 <th><strong>Dni</strong></th>
                    
                  </tr>
                     <?php
				  	if(!empty($_POST['buscar'])){
						$buscar=limpiar($_POST['buscar']);
						$pame=mysql_query("SELECT * FROM cliente WHERE nombres LIKE '%$buscar%' or idcli='$buscar' ORDER BY idcli");	
					}else{
						$pame=mysql_query("SELECT * FROM cliente ORDER BY idcli");		
					}		
					while($row=mysql_fetch_array($pame)){
						$url=cadenas().encrypt($row['idcli'],'URLCODIGO');
				  ?>
                  <tr>
                    <td><?php echo $row['idcli']; ?></td>
                    <td><?php echo $row['nombres']; ?></td>
					 <td><?php echo $row['direccion']; ?></td>
                    <td><?php echo $row['telefono']; ?></td>
					  <td><?php echo $row['dni']; ?></td>			   
					  
                  </tr>
                  <?php } ?>
                </table>
            </td>
          </tr>
        </table>
    </div>
    
 <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../../css/js/responsive.js"></script>
    <script src="../../../js/bootstrap.min.js"></script><?php /*<--ESTO PARECE NO FUNCIONAR*/ ?>
    
  </body>
</html>
