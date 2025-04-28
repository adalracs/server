<?php
ob_start();
	include ( '../src/FunGen/sesion/fnccantrownew.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');
	include ( '../src/FunPerPriNiv/pktblvistarepcierre.php');  
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

	if($accionconsultarvistaot)
	{
		//include ( '../src/FunGen/sesion/fncalmdatc.php');
		$accionconsultarvistaot = 1;
		$nusw = 0;
		$nombcamp = strtok ($columnas,",");
		while ($nombcamp)
		{
			$nombcamp = trim($nombcamp);
			if($nombcamp == "usuacodi")
			$recarreglo[$nombcamp] = $empleacod;
		else
			$recarreglo[$nombcamp] = $$nombcamp;
		if($recarreglo[$nombcamp] != null){ $nusw =1;}
		$nombcamp = strtok(",");
	}
	if(!$nusw){
		$accionconsultarvistaot = 0;
	}
}
if(!$recarreglo){
	unset($recarreglo);
	$recarreglo = $GLOBALS[usuaplanta][sistemcodigo];
	$accionconsultarvistaot = 1;
}

include ( '../src/FunGen/sesion/fncaumdec.php');
include('../src/FunGen/fncpageposition.php');

$intervalo = fncaumdec('vistarepcierre',$inicio,$fin,$mov,$accionconsultarvistaot,$recarreglo);

$cantrow = $intervalo[total];
if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans];}
ob_end_flush();
?>
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 -->
<html>
<head>
<title>Registros de reportes de ordenes de trabajo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<script language="JavaScript" type="text/javascript"
	src="../src/FunGen/jsrsClient.js"></script>
<script language="JavaScript" type="text/javascript"
	src="../src/FunGen/cargarReporteot.js"></script>
</head>
<?php
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="FFFFFF" class="NoisePageBODY">
<form name="form1" method="post" enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Listado de reportes de ordenes de
trabajo</font><br>
<br>
</p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
	class="NoiseFormTABLE">
	<tr>
		<td colspan="6" class="NoiseErrorDataTD">&nbsp;</td>
	</tr>
	<tr>
		<td><?php
		//if($reccomact[consultar]){
		echo '       <input type="image" name="consultar"  src="../img/consulta.gif"
onclick="form1.action='."'".'consultarotsecunddos.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0>'; 
		//}
		?></td>
		<td width="42"><input type="image" name="adelanta"
			src="../img/adelanta.gif"
			onclick="form1.mov.value = 'menos';form1.action='maestablotsecunddos.php';"
			alt="Anterior"></td>
		<td width="46"><font size="2" color="#CC9900">Anterior</font></td>
		<td width="50"><?php  
		echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total];
		?></td>
		<td width="53">
		<div align="right"><font color="#CC9900">Siguiente</font></div>
		</td>
		<td width="53"><input type="image" name="atras"
			src="../img/atrasa.gif"
			onclick="form1.mov.value = 'mas';form1.action='maestablotsecunddos.php';"
			alt="Siguiente"></td>
	</tr>
	<tr>
		<td colspan="6">
		<div align="right"></div>
		</td>
	</tr>
	<tr>
		<td colspan="6">
		<table width="100%" border="0" align="center" cellspacing="2"
			cellpadding="1">
			<tr>
				<td width="8%" class="NoiseFieldCaptionTD"><span class="style5"><font
					color="#FFFFFF">Selec.</font></span></td>
				<td width="10%" class="NoiseFieldCaptionTD"><span class="style5"><font
					color="#FFFFFF">C&oacute;digo</font></span></td>
				<td width="31%" class="NoiseFieldCaptionTD"><span class="style5"><font
					color="#FFFFFF">Encargado</font></span></td>

			</tr>
			<?php
			include ( '../src/FunGen/sesion/fncvisregotaux.php');
			$reg[0] = 'ordtracodigo';
			$reg1[0] = 'n';
			$nureturn = fncvisregrepcierreotaux('ot',$reg,$reg1,$idtrans);
			?>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="6">
		<div align="right"></div>
		<div align="right"></div>
		</td>
	</tr>
	<tr>
		<td><img src="../img/ayuda.gif" border="0" alt="Ayuda"></td>
		<td width="42"><input type="image" name="primero"
			src="../img/primero.gif"
			onclick="form1.mov.value = 'primero';form1.action='maestablotsecunddos.php';"
			alt="Primero"></td>
		<td width="46"><input type="image" name="adelanta"
			src="../img/adelanta.gif"
			onclick="form1.mov.value = 
'menos';form1.action='maestablotsecunddos.php';"
			alt="Anterior"></td>
		<td width="50"><?php 
		echo '<font color="#006699" size="2" face="Arial, Helvetica,
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font>'; 
		?></td>
		<td width="53"><input type="image" name="atras2"
			src="../img/atrasa.gif"
			onclick="form1.mov.value = 'mas';form1.action='maestablotsecunddos.php';"
			alt="Siguiente"></td>
		<td width="53"><input type="image" name="ultimo"
			src="../img/ultimo.gif"
			onclick="form1.mov.value = 'ultimo';form1.action='maestablotsecunddos.php';"
			alt="Ultimo"></td>
	</tr>
	<tr>
		<td colspan="6" class="NoiseErrorDataTD">&nbsp;</td>
	</tr>
</table>
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>">
			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
			<input type="hidden" name="columnas" value="ordtracodigo, 
ordtrafecgen, 
plantacodigo,
sistemcodigo,
equipocodigo,
componcodigo,
tipmancodigo, 
prioricodigo, 
ordtrafecini,  
ordtrafecfin,  
tiptracodigo,
tareacodigo
			"> 
			<input type="hidden" name="nombtabl" value="ot"> 
			<input type="hidden" name="ordtracodigo" value="<?php echo $ordtrafecgen; ?>"> 
			<input type="hidden" name="ordtrafecgen" value="<?php echo $ordtrafecgen; ?>"> 
			<input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>"> 
			<input type="hidden" name="sistemcodigo" value="<?php echo $sistemcodigo; ?>"> 
			<input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo; ?>"> 
			<input type="hidden" name="componcodigo" value="<?php echo $componcodigo; ?>"> 
			<input type="hidden" name="tipmancodigo" value="<?php echo $tipmancodigo; ?>"> 
			<input type="hidden" name="prioricodigo" value="<?php echo $prioricodigo; ?>"> 
			<input type="hidden" name="ordtrafecini" value="<?php echo $ordtrafecini; ?>"> 
			<input type="hidden" name="ordtrafecfin" value="<?php echo $ordtrafecfin; ?>"> 
			<input type="hidden" name="tiptracodigo" value="<?php echo $tiptracodigo; ?>"> 
			<input type="hidden" name="tareacodigo" value="<?php echo $tareacodigo; ?>"> 
			<input type="hidden" name="accionconsultarvistaot" value="<?php echo $accionconsultarvistaot; ?>"> 
			<input type="hidden" name="mov">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>