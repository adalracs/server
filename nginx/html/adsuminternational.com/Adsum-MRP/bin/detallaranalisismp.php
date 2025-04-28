<?php 
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktblmpvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblfabricante.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');	
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbllote.php');
	include ( '../src/FunGen/cargainput.php');	
	
	if(!$flagdetallaranalisismp)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();

		$analiscodigo = $sbreg["analiscodigo"];
		$tipitemcodigo = $sbreg["tipitemcodigo"];
		$lotecodigo = $sbreg["lotecodigo"];
		$itedescodigo = $sbreg["itedescodigo"];
		$usuacodigo = $sbreg["usuacodi"];
		$analisfecha = $sbreg["analisfecha"];
		$estanacodigo = $sbreg["estanacodigo"];
		$analisdescri = $sbreg["analisdescri"];
		$analistipo = $sbreg["analistipo"];
		$analiscantap = $sbreg["analiscantap"];
		$analiscantre = $sbreg["analiscantre"];

		$rwLote = loadrecordlote($lotecodigo,$idcon);
		$rwItemdesa = loadrecorditemdesa($itedescodigo,$idcon);

		$lotenumero = $rwLote["lotenumero"];
		$proveecodigo = $rwLote["proveecodigo"];
		$fabricodigo = $rwLote["fabricodigo"];

		$rsMpvaranalisis = dinamicscanopmpvaranalisis(array("analiscodigo" => $analiscodigo), array("analiscodigo" => "="), $idcon);
		$nrMpvaranalisis = fncnumreg($rsMpvaranalisis);

		for( $a = 0; $a < $nrMpvaranalisis; $a++){

			$rwMpvaranalisis = fncfetch($rsMpvaranalisis,$a);

			$varValor = 'txtvalor'.$rwMpvaranalisis['varanacodigo'];
			$$varValor = $rwMpvaranalisis["mpvaravalor"];

		}

		
		fncclose($idcon);
	
	}

	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Detalle registro de analisis Mp</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Analisis de materias primas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($analiscodigo)? $analiscodigo : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Responsable</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($usuacodigo)? cargausuanombre($usuacodigo,$idcon) : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($analisfecha)? $analisfecha : "---" ;?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Proveedor</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($proveecodigo)? cargaprovnombre($proveecodigo,$idcon) : "---" ;  ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fabricante</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($fabricodigo)? carganombrefabricante($fabricodigo,$idcon) : "---" ;  ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Lote</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($lotenumero)? $lotenumero : "---" ;  ?></td> 
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Item</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($rwItemdesa > 0)? $rwItemdesa["itedescodigo"]. " - ".$rwItemdesa["itedesnombre"] : "---" ; ?></td> 
 							</tr>
							<tr>
								<td width="20%" width="20%" class="NoiseFooterTD">&nbsp;Estado</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($estanacodigo)? carganombreestado($estanacodigo,$idcon) : "---" ;?></td> 
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad Aprobada</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($analiscantap)? number_format($analiscantap, 2, ",", ".") : "---" ; ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad Rechazada</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($analiscantre)? number_format($analiscantre, 2, ",", ".") : "---" ; ?></td>
							</tr>
							<tr>
								<td width="20%" width="20%" class="NoiseFooterTD">&nbsp;Plan de Inspecc&oacute;n</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($tipitemcodigo)? carganombretipoitemdesa($tipitemcodigo, $idcon) : "---" ; ?></td> 
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Re Analisis ?</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($analistipo == 1)? "Si" : "No" ; ?></td>
							</tr>
							<tr>
								<td colspan="2">
 									<div class="ui-buttonset ui-state-default NoiseDataTD">&nbsp;Especificaciones&nbsp;</div>
 										<div id="filtrlistavaranalisis">
											<?php
												$flagDetallar=1;
												$noAjax = true;
												include '../src/FunjQuery/jquery.visors/jq.vanalisismp.php';  
											?>
										</div>
									</div>
 								</td>
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $analisdescri; ?></td> 
 							</tr>
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
 			<input type="hidden" name="analiscodigo" value="<?php echo $analiscodigo; ?>">
			<input type="hidden" name="acciondetallaranalisismp">
			<input type="hidden" name="flagdetallaranalisismp" value="1">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>