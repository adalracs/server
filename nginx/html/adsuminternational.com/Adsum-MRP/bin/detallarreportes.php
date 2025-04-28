<?php
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerSecNiv/fncreport.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
if(!$flagdetallarreportes) 
{ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
} 
$select =  $sbreg[reportselect];
$y =  $sbreg[reportcolumn];

for($z = 0; $z < strlen($select); $z++)
{
	if($select[$z] == "*")
	{
		$select[$z] = "'";
	}
}
$idcon=fncconn();
$result = fncexecSql($idcon,$select);

if($result)
{
	$numReg = fnccountReg($result);
}

?> 
<html> 
<head> 
<title>Detalle de registro de Reportes</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="#FFFFFF" text="#000000" leftmargin="50" topmargin="20" 
marginwidth="0" marginheight="0"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<?php
/*
Propiedad intelectual de Adsum (c).
Funcion         : Ninguna
Decripcion      : Crea el listado de reportes.
Autor           : lfolaya
Fecha           : 23-jul-2004
*/

// Inicio banda 1 (Encabezado principal)

	$header1= "TiendaOFERTAS \n";
	echo "<br>";
	$header2= "Generador de reportes \n";

	echo "<div align='left'><img src='../img/Logosin18000.png' name='logo'></div><font size=2 face= tahoma><div align=center><b>".$header1."<br>";
	echo $header2."<br>";
	echo $header10."<br>"."</b></div></font>";
	echo "<font size=2 face= tahoma><div align=left >Nombre : ".$sbreg[reportnombre]."</div></font>";
	echo "<br>";
	echo "<font size=2 face= tahoma><div align=left >Fecha : ".$sbreg[reportdate]."</div></font>";
	echo "<br>";


// Fin banda 1

// Inicio banda 2 (Cuerpo del reporte)


$idcon=fncconn();

if ($idcon)
{
	echo "<br>";
	echo '<table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000066">';
	$encab = null;
	$encabPrin = null;
	
	$cols = explode("ç", $sbreg["reportencabe"]);
	sort($cols);
	
	for($d = 0; $d < count($cols)-1; $d++)
	{
	    $arrtabldata = loadrecordcamporep($cols[$d+1], $idcon);
		$encab = $encab.'<td><font face="Tahoma" size = "2" color="white">&nbsp;'.$arrtabldata["campdesc"].'&nbsp;</font></td>';
	}
	$encabPrin = '<tr bgcolor="#000066">'.$encab.'</tr>';
	echo $encabPrin;
	
	for ($i = 0; $i < $numReg; $i++)
	{
		$column = null;
		$row = fncfetchRow($result,$i);
		for($j = 0; $j < $y; $j++)
		{
		    $column = $column.'<td><font face="Tahoma" size ="2">'.$row[$j].'&nbsp;</font></td>';
		}
		$fila = '<tr>'.$column.'</tr>';
		echo $fila;
	}
	echo '</table>';
	echo "<br>";
	echo '<table width="70%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000066">';
	echo '<tr><td width="50%" align ="center"><b>Total</font></b></td><td width="20%" align ="center"><b>'.$numReg.'</b></td></tr>';
	echo '</table>';
	echo "<br>";
}

// Fin banda 2

// Inicio banda 3
?>
<br>
<table width="85%" border="0" cellspacing="0" cellpadding="0"
align="center">
<tr>
<td colspan="2"><div align="center">
<br>
<input type="image" name="imprimir"  src="../img/aceptar.gif"
onclick="form1.action='maestablreportes.php';"
width="86" height="18" alt="Aceptar" border=0>
</td>
</tr>
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="nuevo" value="<?php echo $nuevo; ?>"> 
<input type="hidden" name="borrar" value="<?php echo $borrar; ?>"> 
<input type="hidden" name="consultar" value="<?php echo $consultar; ?>"> 
<input type="hidden" name="detallar" value="<?php echo $detallar; ?>"> 
<input type="hidden" name="modificar" value="<?php echo $modificar; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
