<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunGen/fnctimecmp.php');
/*include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');*/
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblusuaequipo.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblvistatimedrep.php');
?> 
<html> 
<head> 
<title>Tiempo medio de reparaciones</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
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
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Tiempo medio de reparaci&oacute;n</font><br>
  <br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE" width="100%"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
 <tr>
 <td align="center"><b>TIEMPO MEDIO DE REPARACIONES</b></td>
 </tr>
 <tr>
 <td align="center"><b>PERIODO OBSERVADO: <?php echo $ordtrafecini." a ".$cierotfecfin;?></b></td>
 <td>
 	<br><br><br><br>
 </td>
 </tr>
 <tr> 
  <td colspan="6"> 
  <table width="100%" border="1" align="center" cellspacing="2" 
cellpadding="1">
<tr> 
<td width="10%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td> 
<td width="16.4%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Equipo</font></span></td> 
<td width="16.4%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Planta</font></span></td> 
<td width="16.4%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Sistema</font></span></td> 
<td width="16.4%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Encargado</font></span></td> 
<td width="16.4%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Tiempo medio de reparaci&oacute;n (Horas)</font></span></td>
</tr> 
<?php 
$equipocodigo = strtok($arreglo_aux,",");
$idconn = fncconn();
while ($equipocodigo)
{
	$sbregequipo = loadrecordequipo($equipocodigo,$idconn);
	$sbregsistema = loadrecordsistema($sbregequipo[sistemcodigo],$idconn);
	$sbregplanta = loadrecordplanta($sbregsistema[plantacodigo],$idconn);
	$sbregusuaequipo = loadrecordusuaequipo1($equipocodigo,$idconn);
	$sbregusuario = loadrecordusuario($sbregusuaequipo[usuacodi],$idconn);
	echo "<tr>";

	echo "<td>";
	echo $equipocodigo;
	echo "</td>";

	echo "<td>";
	echo $sbregequipo[equiponombre];
	echo "</td>";

	echo "<td>";
	echo $sbregplanta[plantanombre];
	echo "</td>";

	echo "<td>";
	echo $sbregsistema[sistemnombre];
	echo "</td>";

	echo "<td>";
	echo $sbregusuario[usuanombre]." ".$sbregusuario[usuapriape]." ".$sbregusuario[usuasegape];
	echo "</td>";


	$ircRecord[equipocodigo]=$equipocodigo;
	$ircRecord[ordtrafecini]=$ordtrafecini;
	$ircRecord[cierotfecfin]=$cierotfecfin;
	$nuResult = dinamicscanreportetimedrep($ircRecord,$idconn);
	$numrows = fncnumreg($nuResult);
	$sumatiempo = 0;
	for($j=0;$j<$numrows;$j++)
	{
		$sbregvista = fncfetch($nuResult,$j);
		$tiempo_ot_cierre = fnctimecmp($sbregvista["ordtrafecini"],$sbregvista["cierotfecfin"],
		$sbregvista["ordtrahorini"],$sbregvista["cierothorfin"]);
		$sumatiempo += $tiempo_ot_cierre;
	}
	$timedrep = $sumatiempo/$numrows;

	echo "<td>";
	echo $timedrep;
	echo "</td>";

	echo "</tr>";

	$equipocodigo = strtok(",");
}
fncclose($idconn);
?> 
   </table> 
   <table align="center">
	<tr>
	<td><br><br></td>
	</tr>
	<tr align="center">
	<td colspan="6" align="center">
	<input type="image" name="imprimir" src="../img/imprimir.gif" onclick="window.print();"  width="86" height="18" 
	alt="Imprimir" border=0>
	<input type="image" name="consultar" src="../img/consulta.gif" 
	onclick="form1.action='consultarequipotimedrep.php';"  width="86" height="18" alt="Consultar" border=0>
	</td>
	<tr>
   </table>
   </td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
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
 <input type="hidden" name="arreglo_aux" value="<?php  echo $arreglo_aux;?>">
 </form>
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html>
