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
                    	<h1 align="center">Listado de Productos</h1>
                        <center>
                      	<form name="form3" method="post" action="" class="form-search">
                        		<input type="text" SIZE="40"  name="buscar" autocomplete="off"  placeholder="Buscar por descripcion o codigo">
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
                    <th><strong>Descripcion</strong></th>
					   <th><strong>Precio</strong></th>
                    <th><strong>Stock</strong></th>   
                  </tr>
                     <?php
				  	if(!empty($_POST['buscar'])){
						$buscar=limpiar($_POST['buscar']);
						$pame=mysql_query("SELECT * FROM productos WHERE descripcion LIKE '%$buscar%' or codpro='$buscar' ORDER BY codpro");	
					}else{
						$pame=mysql_query("SELECT * FROM productos ORDER BY codpro");		
					}		
					while($row=mysql_fetch_array($pame)){
						$url=cadenas().encrypt($row['codpro'],'URLCODIGO');
				  ?>
                  <tr>
                    <td><?php echo $row['codpro']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
					 <td><?php echo $row['precio']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
					   		  
                  </tr>
                  <?php } ?>
                </table>
            </td>
          </tr>
        </table>
          <center><a href="../../intranet/venta/mov_ingreso.php" class="btn btn-primary">REGISTRAR FACTURA</a></center>>
 
    </div>
    
 <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../../css/js/responsive.js"></script>
    <script src="../../../js/bootstrap.min.js"></script><?php /*<--ESTO PARECE NO FUNCIONAR*/ ?>
    
  </body>
</html>
