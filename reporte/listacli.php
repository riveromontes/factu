<?php 
	require_once("dompdf/dompdf_config.inc.php");
	$conexion = mysql_connect("localhost","ssdoblec_factu","FacturacioN");
	mysql_select_db("ssdoblec_facturaphp",$conexion);	



$codigoHTML='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lista</title>
</head>

<body>
<h1 ><center>REPORTE DE PRODUCTOS</center></h1>
<div align="center">
    <table width="100%" border="0" frame="border" rules="rows">
      <tr>
        <td bgcolor="#FFFFFF"><strong>Codigo</strong></td>
        <td bgcolor="#FFFFFF"><strong>Descripciom</strong></td>
        <td bgcolor="#FFFFFF"><strong>Stock</strong></td>
        <td bgcolor="#FFFFFF"><strong>Precio</strong></td>
        <td bgcolor="#FFFFFF"><strong>Fecha Vencimiento</strong></td>
      </tr>';

        $consulta=mysql_query("SELECT * FROM productos");
        while($dato=mysql_fetch_array($consulta)){
$codigoHTML.='
      <tr>
        <td>'.$dato['codpro'].'</td>
        <td>'.$dato['descripcion'].'</td>
        <td>'.$dato['stock'].'</td>
        <td>'.$dato['precio'].'</td>
        <td>'.$dato['fecha'].'</td>
     
      </tr>';
      } 
$codigoHTML.='
    </table>
</div>
</body>
</html>';
/*echo $codigoHTML;*/

$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Listadodeproductos.pdf");
?>
