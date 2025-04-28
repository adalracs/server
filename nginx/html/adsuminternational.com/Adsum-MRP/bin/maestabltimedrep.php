<?php
ob_start();
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/sesion/fnccantrow1.php');
include ( '../src/FunPerPriNiv/limitscan.php');
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunGen/sesion/fncalmdat.php');
include ( '../src/FunGen/sesion/fnccaf.php');
include ( '../src/FunPerPriNiv/pktblvistatimedrep.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblestado.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblusuaequipo.php');
include ( '../src/FunGen/fnctimecmp.php');

$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
if($accionconsultarequipo)
{
//	include ( '../src/FunGen/sesion/fncalmdatc.php');
	$nusw = 0;
	$nombcamp = strtok ($columnas,",");
	while ($nombcamp)
	{
		$nombcamp = trim($nombcamp);
		$recarreglo[$nombcamp] = $$nombcamp;
		if($nombcamp=="usuacodi")
		$recarreglo[$nombcamp] = $usuacodigo;
		if($recarreglo[$nombcamp]){ $nusw =1;}
		$nombcamp = strtok(",");
	}
	if(!$nusw)
	{
		$accionconsultarequipo = 0;
	}
}
include ( '../src/FunGen/sesion/fncaumdec.php');
ob_end_flush();
?>
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1
Modificado
Fecha      |Autor                    | Motivo
05-09-2005  John Edward Cortes Loboa   Visualizar y escoger los equipos a los cuales se les generar� el tiempo
									   medio de reparaci�n
-->
<html> 
<head> 
<title>Registros de equipo</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" type="text/javascript">

var arreglo_aux = new Array;
function cargarcheck(cual)
{
	var arreglo = new Array;
	var nomVec = new Array;

	var x = 0;
	var flag = 0;
	for(var m = 0; m < cual.length; m++)
	{
		if(cual.elements[m].type == "checkbox" )
		{
			if(cual.elements[m].checked == true)
			{
				arreglo[x] = cual.elements[m].value;
				x = x + 1;
				document.form1.arreglo.value = arreglo;
			}
		}
	}
	if (document.form1.arreglo_aux.value == "")
	{
		document.form1.arreglo_aux.value = arreglo;
	}else
	{
		nomVec = document.form1.arreglo_aux.value.split(",");

		for (var m = 0; m < arreglo.length; m++)
		{
			flag = 0;
			var z = nomVec.length;
			for (var i = 0; i < z; i++)
			{
				if(nomVec[i] == arreglo[m])
				flag = 1;
			}
			if(flag == 0){
				nomVec[z] = arreglo[m];
			}
		}
		window.document.form1.arreglo_aux.value = nomVec;
		alert(window.document.form1.arreglo_aux.value );
	}
}
</script>
</head> 
<?php 
if(!$codigo)
{ echo "<!--";}
?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<!--<p><font class="NoiseFormHeaderFont">Listado de equipos</font><br>
  <br></p> -->
<table width="85%" border="0" cellspacing="1" cellpadding="2" align="center" 
> 
<!-- class="NoiseFormTABLE" -->
 <tr> 
 <td colspan="6" >&nbsp;</td> 
 <!-- class="NoiseErrorDataTD" -->
 </tr>  
 <tr><td align="center"><b>Tiempo medio de reparaci&oacute;n</b></td><tr>
 <tr><td align="center"><b>Periodo: <?php echo $ordtrafecini." a ".$cierotfecfin;?></b></td><tr>
 <tr><td>&nbsp;</td><tr>
 
 <tr> 
  <td colspan="5"> 
  <table width="100%" border="0" align="center" cellspacing="0" 
cellpadding="3"> 
<tr> 
<td width="20%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Planta</font></span></td> 
<td width="20%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Sistema</font></span></td> 
<td width="20%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Equipo</font></span></td>
<td width="20%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Encargado</font></span></td> 
<td width="20%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Resultado</font></span></td> 
</tr> 
<?php
$idcon = fncconn();
$nuResult=dinamicscanvistatimedrep1($recarreglo,$idcon);
$num=fncnumreg($nuResult);
$sumatotal = 0;
for($i=0;$i<$num;$i++)
{
	$sbregvista=fncfetch($nuResult,$i);
	$tiempo_ot_cierre = fnctimecmp($sbregvista["ordtrafecini"],$sbregvista["cierotfecfin"],
	$sbregvista["ordtrahorini"],$sbregvista["cierothorfin"]);
	$sumatotal += $tiempo_ot_cierre;
}
$tmr = $sumatotal /$num;
echo "<td width='20%'>";
if($plantacodigo)
{
	$sbregplanta = loadrecordplanta($plantacodigo,$idcon);
	echo $sbregplanta['plantanombre'];
}
echo "</td>";

echo "<td width='20%'>";
if($sistemcodigo)
{
	$sbregsistema = loadrecordsistema($sistemcodigo,$idcon);
	echo $sbregsistema['sistemnombre'];
}
echo "</td>";

echo "<td width='20%'>";
if($equipocodigo)
{
	echo $equiponombre;
}
echo "</td>";

echo "<td width='20%'>";
if($equipocodigo)
{
	$sbregusuaequipo = loadrecordusuaequipo1($equipocodigo,$idcon);
	$sbregusuario = loadrecordusuario($sbregusuaequipo[usuacodi],$idcon);
	echo $sbregusuario['usuanombre']." ".$sbregusuario['usuapriape']." ".$sbregusuario['usuasegape'];
}
echo "</td>";

echo "<td width='20%'>";
echo $tmr;
echo "</td>";
fncclose($idcon);
?> 
   </table> 
   </td> 
  </tr> 
  <tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
  <tr align="center"> 
   <td align="center">
   <input type="image" src="../img/imprimir.gif" onclick="window.print();" border="0" 
alt="Imprimir" name="imprimir">
  <input type="image" nam1="consultar"  src="../img/consulta.gif" onclick="form1.action='consultartimedrep.php';" 
width="86" height="18" alt="Consultar" border=0>
  </td> 
  </tr> 
  <tr> 
   <td colspan="6" >&nbsp;</td> 
   <!-- class="NoiseErrorDataTD" -->
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="equipo"> 
 <input type="hidden" name="columnas" value="
ordtrafecini,
ordtrahorini,
cierotfecfin,
cierothorini,
plantacodigo,
sistemcodigo, 
equipocodigo, 
equiponombre, 
estadocodigo, 
cencoscodigo, 
equipofabric, 
equipomarca, 
equiposerie, 
equipomodelo, 
usuacodi
"> 
 <input type="hidden" name="ordtrafecini" value="<?php echo $ordtrafecini; ?>">
 <input type="hidden" name="ordtrafhorini" value="<?php echo $ordtrafhorini; ?>"> 
 <input type="hidden" name="cierotfecfin" value="<?php echo $cierotfecfin; ?>"> 
 <input type="hidden" name="cierothorfin" value="<?php echo $cierothorfin; ?>"> 
 <input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>"> 
 <input type="hidden" name="sistemcodigo" value="<?php echo $sistemcodigo; ?>"> 
 <input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo; ?>"> 
 <input type="hidden" name="equiponombre" value="<?php echo $equiponombre; ?>"> 
 <input type="hidden" name="estadocodigo" value="<?php echo $estadocodigo; ?>"> 
 <input type="hidden" name="cencoscodigo" value="<?php echo $cencoscodigo; ?>"> 
 <input type="hidden" name="equipofabric" value="<?php echo $equipofabric; ?>"> 
 <input type="hidden" name="equipomarca" value="<?php echo $equipomarca; ?>"> 
 <input type="hidden" name="equiposerie" value="<?php echo $equiposerie; ?>"> 
 <input type="hidden" name="equipomodelo" value="<?php echo $equipomodelo; ?>"> 
 <input type="hidden" name="usuacodi" value="<?php echo $usuacodi; ?>">
 <input type="hidden" name="accionconsultarequipo" value="<?php echo $accionconsultarequipo; ?>"> 
 <input type="hidden" name="mov">
 <input type="hidden" name="arreglo">
 <input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux;?>">
 </form>
 </body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>
