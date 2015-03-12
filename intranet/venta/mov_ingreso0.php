<?php

if(isset($_POST["btn1"])){
	$btn=$_POST["btn1"];
	$cliente=$_POST["cliente"];
	
	}
	  
?>
<form method="post" action="mov_ingreso.php">
<table border="1">
</tr>
<th align='left'>CLIENTE:</th>
<td align="left">
<?php 

   $link = mysql_connect("localhost","ssdoblec_factu","FacturacioN");
	mysql_select_db("ssdoblec_facturaphp",$link);
	$c="SELECT nombres FROM cliente";
$res=@mysql_query($c);
if(!$res){
echo " fallo";
}
else{
echo "<select name='cboaula' id='cboaula'>";
while ($fila=mysql_fetch_array($res)){
echo "<option>", $fila['nombres'], "</option>";
}
echo "</select>";
}
?>
</td>

</tr>

</table>
<INPUT TYPE="submit" NAME="btn1" VALUE="Enviar">
</form>
