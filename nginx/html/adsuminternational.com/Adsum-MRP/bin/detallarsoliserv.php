<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblsoliservestado.php');
	include ( '../src/FunGen/cargainput.php');
	include('validasesion.php');
	
	if(!$flageditarsoliserv)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
?> 
<html> 
	<head> 
		<title>Editar registro de solicitud de servicio</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?> 
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<style type="text/css">
			.row-soliserv { font-size: 90%; } 
		</style>
	</head> 
<?php if(!$codigo) { echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
    	<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Solicitud de servicio</font></p> 
			<table width="750" border="0" align="center" cellpadding="2" cellspacing="1" class="ui-widget-content"> 
        		<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
        		<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>
        		<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Solicitud de servicio No.&nbsp;<?php echo $sbreg['solsercodigo']; ?></td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $sbreg['solserfecha'] ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Datos de la solicitud</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="20%">&nbsp;Ubicaci&oacute;n</td>
								<td class="NoiseDataTD"><?php echo cargaplantanombre($sbreg['plantacodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Proceso</td>
								<td class="NoiseDataTD"><?php echo cargasistemnombre($sbreg['sistemcodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Equipo</td>
								<td class="NoiseDataTD"><?php echo cargaequiponombre($sbreg['equipocodigo'], $idcon); ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
  								<td class="ui-state-default" colspan="2">&nbsp;<a onClick="return verocultar('filtrdatosequipo',0);" href="javascript:animatedcollapse.toggle('filtrdatosequipo');"><img id="row0" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Datos del equipo</a>
									<div id="filtrdatosequipo" style="padding: 2px 2px 2px 2px; display:none" >
				        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
				                   			<tr>
			                   					<td height="190"  class="ui-widget-content"><iframe  frameborder="0" name="detalleotequipo" id="detalleotequipo"  height="190" width="100%" align="absmiddle" src="detallarotequipo.php?equipocodigo=<?php $sbreg['equipocodigo']; ?>&usuaplanta=<?php echo $GLOBALS['usuaplanta'];  ?>"></iframe></td>
				                   			</tr>
				                   		</table>
				                   	</div> 
								</td>
							</tr>
							<?php if($sbreg['componcodigo']): ?>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Componente</td>
								<td class="NoiseDataTD"><?php echo cargacomponnombre($sbreg['componcodigo'], $idcon); ?></td>
							</tr>
							<tr>
  								<td class="ui-state-default" colspan="2">&nbsp;<a onClick="return verocultar('filtrdatoscomponen',1);" href="javascript:animatedcollapse.toggle('filtrdatoscomponen');"><img id="row1" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Datos del componente</a>
									<div id="filtrdatoscomponen" style="padding: 2px 2px 2px 2px; display:none" >
				        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
				                   			<tr>
			                   					<td height="190"  class="ui-widget-content"><iframe  frameborder="0" name="detalleotcomponen" id="detalleotcomponen"  height="190" width="100%" align="absmiddle" src="detallarotcomponen.php?componcodigo=<?php echo $sbreg['componcodigo']; ?>&equipocodigo=<?php echo $sbreg['equipocodigo']; ?>&usuaplanta=<?php echo $GLOBALS['usuaplanta'];  ?>"></iframe></td>
				                   			</tr>
				                   		</table>
				                   	</div> 
								</td>
							</tr>
							<?php endif ?>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Solicitante</td>
								<td class="NoiseDataTD"><?php echo cargausuanombre($sbreg['usuacodi'], $idcon); ?></td>
							</tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="20%">&nbsp;Tipo de trabajo</td>
								<td class="NoiseDataTD"><?php echo cargatiptrabnombre($sbreg['tiptracodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD" width="20%">&nbsp;Tipo de falla</td>
								<td class="NoiseDataTD"><?php echo cargatipfalnombre($sbreg['tipfalcodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD" width="20%">&nbsp;Estado</td>
								<td class="NoiseDataTD"><?php echo cargaestsolnombre($sbreg['estsolcodigo'], $idcon); ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="ui-state-default" width="30%">Usuario</td>
								<td class="ui-state-default" width="18%">Fecha</td>
								<td class="ui-state-default" width="52%">Motivo / Aclaraci&oacute;n</td>
							</tr>
							<?php 
								$texto = split("::", $sbreg['solsermotivo']);
								for($i = 0; $i < count($texto); $i++):
									if(trim($texto[$i])):
										$texto1 = split("--", $texto[$i]);
							?>
							<tr>
								<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $texto1[0] ?></td>
								<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo date("Y-m-d h:i a", strtotime($texto1[1].' '.$texto1[2])) ?></td>
								<td class="NoiseDataTD row-soliserv">&nbsp;<?php echo $texto1[3] ?></td>
							</tr>
							<?php
									endif; 
								endfor; ?>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
     		</table> 
          	<input type="hidden" name="flagdetallarsoliserv" value="1"> 
			<input type="hidden" name="acciondetallarsoliserv">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
     		<input type="hidden" name="columnas" value="solsercodigo,usuacodi,tipfalcodigo,estsolcodigo,solsermotivo,solserfecha,plantacodigo,sistemcodigo,equipocodigo,componcodigo,ordtracodigo">
 			<input type="hidden" name="solsercodigo" value="<?php if($accionconsultarhistsoliserv) echo $solsercodigo; ?>">
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarhistsoliserv) echo $usuacodigo; ?>">
  			<input type="hidden" name="tipfalcodigo" value="<?php if($accionconsultarhistsoliserv) echo $tipfalcodigo; ?>">
 			<input type="hidden" name="estsolcodigo" value="<?php if($accionconsultarhistsoliserv) echo $estsolcodigo; ?>">
 			<input type="hidden" name="solsermotivo" value="<?php if($accionconsultarhistsoliserv) echo $solsermotivo; ?>">
 			<input type="hidden" name="solserfecha" value="<?php if($accionconsultarhistsoliserv) echo $solserfecha; ?>">
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarhistsoliserv) echo $plantacodigo; ?>">
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarhistsoliserv) echo $sistemcodigo; ?>">
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarhistsoliserv) echo $equipocodigo; ?>">
 			<input type="hidden" name="accionconsultarhistsoliserv" value="<?php echo $accionconsultarhistsoliserv; ?>">
     		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
	   	</form> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>