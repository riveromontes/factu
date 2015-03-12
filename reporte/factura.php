<?php 
	require_once("dompdf/dompdf_config.inc.php");
	$conexion = mysql_connect("localhost","ssdoblec_factu","FacturacioN");
	mysql_select_db("ssdoblec_facturaphp",$conexion);	



$codigoHTML='
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lista</title>
</head>

<body>
<table width="100%" border="0">
<tr>
    <td><br /></td>
    <td align="left"><br /></td>
</tr>

<tr>
    <td><br /></td>
    <td align="left"><br /></td>
</tr>';


        $consulta=mysql_query("SELECT max(idventa) as num FROM venta");
        while($dato=mysql_fetch_array($consulta)){
            $factura=$dato['num'];
        }

$codigoHTML.='

<tr>
    <td><br /></td>
    <td align="right"><font size="1"><strong>FACTURA: </strong>'.$factura.'</font></td>
</tr>';





        $consulta=mysql_query("SELECT max(fecha) as fecha FROM venta");
        while($dato=mysql_fetch_array($consulta)){
            $fecha=$dato['fecha'];
        }
$codigoHTML.='



<tr>
    <td><br /></td>
    <td align="right"><font size="1"><strong>FECHA: </strong>'.date('d-m-Y', strtotime($fecha)).'</font></td>
</tr>';



        $consulta=mysql_query("SELECT cliente  as cla FROM venta ORDER BY idventa DESC LIMIT 1");
        while($dato=mysql_fetch_array($consulta)){
            $cliente=$dato['cla'];
        }
$codigoHTML.='

<tr>
    <td align="left"><font size="1"><strong>NOMBRE O RAZON SOCIAL: </strong>'.$cliente.'</font></td>';



$consulta=mysql_query("SELECT dni as dni FROM venta,cliente where nombres=cliente and cliente='".$cliente."' ORDER BY idventa DESC LIMIT 1");
        while($dato=mysql_fetch_array($consulta)){
            $dni=$dato['dni'];
        }
$codigoHTML.='


    <td align="right"><font size="1"><strong>RIF: </strong>'.$dni.'</font></td>
</tr>';


$consulta=mysql_query("SELECT direccion as direccion FROM venta,cliente where nombres=cliente and cliente='".$cliente."' ORDER BY idventa DESC LIMIT 1");
        while($dato=mysql_fetch_array($consulta)){
            $direccion=$dato['direccion'];
        }

$codigoHTML.='

<tr>
    <td align="left"><font size="1"><strong>DIRECCION: </strong>'.$direccion.'</font></td>
    <td><br /></td>
</tr>';




$consulta=mysql_query("SELECT telefono as telefono FROM venta,cliente where nombres=cliente and cliente='".$cliente."' ORDER BY idventa DESC LIMIT 1");
        while($dato=mysql_fetch_array($consulta)){
            $telefono=$dato['telefono'];
        }

$codigoHTML.='



<tr>
    <td align="left"><font size="1"><strong>TELEFONO: </strong>'.$telefono.'</font></td>
    <td></td>
</tr>

<tr>
    <td><br /></td>
    <td align="left"><br /></td>
</tr>


</table>





  
<div align="center">

    <table width="100%" border="0" frame="border" rules="rows">
      <tr>
        <td bgcolor="#FFFFFF"><font size="1"><strong>CODIGO</strong></font></td>
        <td bgcolor="#FFFFFF"><font size="1"><strong>DESCRIPCION</strong></font></td>
        <td bgcolor="#FFFFFF"><font size="1"><strong>CANTIDAD</strong></font></td>
        <td bgcolor="#FFFFFF"><font size="1"><strong>PRECIO/UNITARIO Bs.</strong></font></td>
        <td bgcolor="#FFFFFF"><font size="1"><strong>MONTO Bs.</strong></font></td>
    
      </tr>';

        $consulta=mysql_query("select * from detalleventa");
        while($dato=mysql_fetch_array($consulta)){
$codigoHTML.='
      <tr>
        <td><font size="1">'.$dato['codpro'].'</font></td>
        <td><font size="1">'.$dato['producto'].'</font></td>
        <td><font size="1">'.$dato['cantidad'].'</font></td>
        <td><font size="1">'.$dato['precio'].'</font></td>
        <td><font size="1">'.$dato['importe'].'</font></td>
      </tr>';
      } 
$codigoHTML.='
    </table>
</div><br><br>

      <table width="60%" border="0" align="right" frame="border" rules="rows">
      <tr>
        <td bgcolor="#FFFFFF"><font size="1"><strong>MONTO TOTAL (Base Imponible Bs.)</strong></font></td>';
  
        $consulta=mysql_query("SELECT ROUND(SUM(importe),2) as subtotal FROM detalleventa");
        while($dato=mysql_fetch_array($consulta)){
$codigoHTML.='
   
        <td align="right"><font size="1">'.$dato['subtotal'].'</font></td>
    
      </tr>';
      } 
$codigoHTML.='

<tr>
        <td bgcolor="#FFFFFF"><font size="1"><strong>Impuesto al Valor agregado IVA 12% (Bs)</strong></font></td>';
  
        $consulta=mysql_query("SELECT ROUND(SUM(importe)*12/100 ,2) as igv FROM detalleventa");
        while($dato=mysql_fetch_array($consulta)){
$codigoHTML.='
   
        <td align="right"><font size="1">'.$dato['igv'].'</font></td>
    
      </tr>';
      } 
$codigoHTML.='

<tr>
        <td bgcolor="#FFFFFF"><font size="1"><strong>VALOR TOTAL (Bs)</strong></font></td>';
  
        $consulta=mysql_query("SELECT ROUND(SUM(importe)*12/100+SUM(importe),2) as total FROM detalleventa");
        while($dato=mysql_fetch_array($consulta)){
$codigoHTML.='
   
        <td align="right"><font size="1">'.$dato['total'].'</font></td>
    
      </tr>';
      } 
$codigoHTML.='


    </table>
</body>
</html>';

//echo $codigoHTML;

$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","256M");
$dompdf->render();
$dompdf->stream("factura.pdf");
?>
