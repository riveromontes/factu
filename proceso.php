<html lang="es">
<head>
<title>sistema facturacion"</title>


        
    
     
     <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
     <script type="text/javascript" src="http://getbootstrap.com/dist/js/bootstrap.js"></script>
     <link type="text/css" rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css"/>
     
     <link href="../css/css/bootstrap.min.css" rel="stylesheet">
     <link href="../css/css/estilos.css" rel="stylesheet">
</head>
<body>
<?php 
session_start();
$usu=$_POST["usuario"];
$pass=$_POST["clave"];

$cnn= mysql_connect("localhost","ssdoblec_factu","FacturacioN");
mysql_select_db("ssdoblec_facturaphp",$cnn);

$sql="select * from usuario where usuario='$usu' and clave='$pass'";

$fila=mysql_query($sql,$cnn);
$resultado=mysql_fetch_array($fila);
$valor=$resultado["usuario"];


if($valor=='')
{
 header('location:index.php');
}
else
{
 $_SESSION["autentificado"]=1;
 $_SESSION["usuario"]=$usu;
 $_SESSION["clave"]=$pass;
 
 header('location:inicio/inicio/inicio.php');
}


?>


    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../../css/js/responsive.js"></script>
    <script src="../../css/js/bootstrap.min.js"></script>

</body>
</html>
