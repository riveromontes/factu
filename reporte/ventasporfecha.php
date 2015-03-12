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
<h1 ><center>REPORTE DE VENTAS POR FECHA</center></h1>
<div align="center">
    <table width="100%" border="0" frame="border" rules="rows">';

        $consulta=mysql_query("SELECT venta.idventa,producto,cantidad,precio,importe,cliente,fecha FROM temporal,venta WHERE temporal.idventa=venta.idventa order by venta.idventa");

$fila_consulta = mysql_fetch_assoc($consulta);
$total_filas_consulta = mysql_num_rows($consulta);

do{
    $grupoant=$grupo;
    $grupo=$fila_consulta['idventa'];

    if($grupoant != $grupo){

        $codigoHTML.='<tr>
        <td colspan="1" align="center" bgcolor="#CCCCCC"><font size="2"><strong>Num.Factura:'.$fila_consulta['idventa'].'</strong></font></td>
        <td colspan="1" align="center" bgcolor="#CCCCCC"><font size="2"><strong>Cliente:'.$fila_consulta['cliente'].'</strong></font></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><font size="2"><strong>Fecha:'.date('d-m-Y', strtotime($fila_consulta['fecha'])).'</strong></font></td>
        </tr>

      <tr>
        <td align="center" bgcolor="#FFFFFF"><font size="2"><strong>Cantidad</strong></font></td>
        <td align="center" bgcolor="#FFFFFF"><font size="2"><strong>Producto</strong></font></td>
        <td align="center" bgcolor="#FFFFFF"><font size="2"><strong>Precio Unitario</strong></font></td>
        <td align="center" bgcolor="#FFFFFF"><font size="2"><strong>Monto</strong></font></td>
     
      </tr>';
   
    }


    $codigoHTML.='
      <tr>
        <td align="center"><font size="2">'.$fila_consulta['cantidad'].'</font></td>
        <td align="center"><font size="2">'.$fila_consulta['producto'].'</font></td>
        <td align="center"><font size="2">'.$fila_consulta['precio'].'</font></td>
        <td align="center"><font size="2">'.$fila_consulta['importe'].'</font></td>
      </tr>';
}while ($fila_consulta = mysql_fetch_assoc($consulta)); 


$codigoHTML.='
    </table>
</div>
</body>
</html>';

/*echo $codigoHTML;            x*/

$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Listadodeventas.pdf");
?>
