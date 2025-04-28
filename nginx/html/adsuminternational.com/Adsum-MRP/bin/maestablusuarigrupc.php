<?php 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblusuario.php'); 
include ( '../src/FunPerPriNiv/pktbldepartam.php'); 
include ( '../src/FunPerPriNiv/pktblcargo.php'); 
include ( '../src/FunGen/sesion/fncalmdat.php'); 
include ( '../src/FunGen/sesion/fnccaf.php'); 

$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 
if($accionconsultarusuario)
{
//	include ( '../src/FunGen/sesion/fncalmdatc.php');
	$nusw = 0;
	$nombcamp = strtok ($columnas,",");
	while ($nombcamp)
	{
		$nombcamp = trim($nombcamp);
		if($nombcamp == "usuacodi")
		$recarreglo[$nombcamp] = $usuacodigo;
		else
		$recarreglo[$nombcamp] = $$nombcamp;
		if($recarreglo[$nombcamp] != null){ $nusw =1;}
		$nombcamp = strtok(",");
	}
	if(!$nusw){
		$accionconsultarusuario = 0;
	}
}
include ( '../src/FunGen/sesion/fncaumdec.php');
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Registros de empleados</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" src="../src/FunGen/fncmoveselectoptions.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/cargarUsuagrupcapaBusqueda.js" type="text/javascript"></script>
</head>
<?php 
    if(!$codigo)
    { echo "<!--";}
?>

<body 
onload="
var recarreglo = new Array;
var i=0;
<?php 
while($elementos = each($recarreglo))
{
	echo "recarreglo[i] = new Array('". $elementos[0]."','".$elementos[1]."');";
	echo "i++;";
}
?>
cargarUsuagrupcapaBusqueda('<?php  echo $nombtabl?>','<?php  echo $accionconsultarusuario?>',recarreglo);
"
bgcolor="FFFFFF" class="NoisePageBODY">
</body> 
<?php 
if(!$codigo) 
{ echo " -->"; } 
?> 
</html> 
