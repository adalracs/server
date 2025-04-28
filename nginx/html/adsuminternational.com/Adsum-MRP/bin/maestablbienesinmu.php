<?php
ob_start();
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblvistabieninmutemp.php');
	include ( '../src/FunPerPriNiv/pktblbienesinmueble.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');

	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionborrarbienesinmueble)
		include ( 'borrabienesinmueble.php');
	else
	{
		if($accionconsultarbienesinmueble)
		{
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				$recarreglo[$nombcamp] = $$nombcamp;
				if($recarreglo[$nombcamp]){ $nusw =1;}
				$nombcamp = strtok(",");
			}
			if(!$nusw)
				$accionconsultarbienesinmueble = 0;
		}
	}
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
  	$intervalo = fncaumdec('vistabieninmutemp',$inicio,$fin,$mov,$accionconsultarbienesinmueble,$recarreglo);
  	$cantrow = $intervalo[total];
  	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
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
		<title>Registros de Bienes inmuebles temporales</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Listado Bienes inmuebles temporales</font><br><br></p>
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="65%">
 				<tr><td colspan="6" class="NoiseErrorDataTD" align="right"><?php page_position($intervalo,'maestablbienesinmueble.php',$flagcheck); ?></td></tr>
  				<tr>
  					<td>
  						<?php if($reccomact[modificar]): ?>
  						<b><input type="image" name="adicionar"  src="../img/adicionar.gif" onclick="form1.action='editarbienesinmu.php'" width="87" height="19" alt="Modificar Registro" border=0></b>
  						<?php endif; ?>
  						<?php if($reccomact[consultar]): ?>
  						<b><input type="image" name="consultar" src="../img/consulta.gif" onclick="form1.action='consultarbienesinmu.php'"  width="86" height="18" alt="Consultar" border=0 ></b>
  						<?php endif; ?>
  						<?php if($reccomact[detallar]): ?>
							<b><input type="image" name="detallar"  src="../img/verdetal.gif" onclick="form1.action='detallarbienesinmu.php';"  width="87" height="19" alt="Ver detalle" border=0></b>
						<?php endif; ?>
					</td>
 					<td width="42"> <input type="image" name="adelanta"  src="../img/adelanta.gif" onclick="form1.mov.value = 'menos';form1.action='maestablbienesinmu.php';" alt="Anterior"></td>
 					<td width="46"><font size="2" color="#CC9900">Anterior</font></td>
 					<td width="50"><?php echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; ?></td>
 					<td width="53"><div align="right"><font color="#CC9900">Siguiente</font></div></td>
 					<td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" onclick="form1.mov.value = 'mas';form1.action='maestablbienesinmu.php';" alt="Siguiente"></td>
 				</tr>
 				<tr>
  					<td colspan="6"><div align="right">&nbsp;</div></td>
 				</tr>
 				<tr>
 					<td colspan="6">
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1">
  							<tr>
								<td width="4%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Sel.</font></span></td>
								<td width="10%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">C&oacute;digo</font></span></td>
								<td width="46%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Nombre</font></span></td>
								<td width="40%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Descripci&oacute;n</font></span></td>
							</tr>
							<?php
								include ( '../src/FunGen/sesion/fncvisregbieninmutemp.php');
								$reg[0] = 'bieninmucodigo';
								$reg1[0] = 's';
								$nureturn = fncvisregbieninmutemp('vistabieninmutemp',$reg,$reg1,$idtrans,$arr_borrar,$flagcheck);
							?>
   						</table>
   					</td>
  				</tr>
  				<tr>
   					<td colspan="6">
   						<div align="right"></div>
   						<div align="right">
						<?php if($reccomact[detallar]): ?>
							<b><input type="image" name="detallar"  src="../img/verdetal.gif" onclick="form1.action='detallarbienesinmu.php';"  width="87" height="19" alt="Ver detalle" border=0></b>
						<?php endif;
							  if($reccomact[borrar]): ?>
							<b><input type="image" name="borrar"  src="../img/borrar.gif" onclick="form1.action='borrarbienesinmu.php';"  width="87" height="19" alt="Borrar Registro" border=0></b>
						<?php endif; ?>
  						</div>
  					</td>
  				</tr>
  				<tr>
   					<td><a href="javascript:;" ><img src="../img/ayuda.gif" name="Ayuda" onclick="window.open('navegacion.htm','ambinave','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Ayuda" border=0 ></a></td>
   					<td width="42"><input type="image" name="primero"  src="../img/primero.gif" onclick="form1.mov.value = 'primero';form1.action='maestablbienesinmu.php';" alt="Primero"></td>
   					<td width="46"><input type="image" name="adelanta" src="../img/adelanta.gif" onclick="form1.mov.value = 'menos';form1.action='maestablbienesinmu.php';" alt="Anterior"></td>
   					<td width="50"><font color="#006699" size="2" face="Arial, Helvetica,sans-serif"><?php echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; ?></font></td>
   					<td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" onclick="form1.mov.value = 'mas';form1.action='maestablbienesinmu.php';" alt="Siguiente"></td>
   					<td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" onclick="form1.mov.value = 'ultimo';form1.action='maestablbienesinmu.php';" alt="Ultimo"></td>
  				</tr>
  				<tr><td colspan="6" class="NoiseErrorDataTD" align="right"><?php page_position($intervalo,'maestablbienesinmu.php',$flagcheck); ?></td></tr>
 			</table>
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>">
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="nombtabl" value="vistabieninmutemp">
			<input type="hidden" name="columnas" value="bieninmucodigo,bieninmunombre,bieninmudescri">
 			<input type="hidden" name="bieninmucodigo" value="<?php echo $bieninmucodigo; ?>">
 			<input type="hidden" name="bieninmunombre" value="<?php echo $bieninmunombre; ?>">
 			<input type="hidden" name="bieninmudescri" value="<?php echo $bieninmudescri; ?>">
 			<input type="hidden" name="accionconsultarbienesinmueble" value="<?php echo $accionconsultarbienesinmueble; ?>">
 			<input type="hidden" name="mov">
 		</form>
 	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>
