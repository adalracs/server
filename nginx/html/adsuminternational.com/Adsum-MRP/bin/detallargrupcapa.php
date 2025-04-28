<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	include ( '../src/FunPerPriNiv/pktblinsgrupcapa.php');
	include ( '../src/FunGen/cargainput.php');
	
	if(!$flagdetallargrupcapa) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');

		$idcon = fncconn();
		$rsInsgrupcapa = dinamicscaninsgrupcapa(array("grucapcodigo" => $sbreg[grucapcodigo]), $idcon);
		$nrInsgrupcapa = fncnumreg($rsInsgrupcapa);
	} 
?>
<html> 
	<head> 
		<title>Detalle de registro de grucaprias</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Grupos de capacitaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="700">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[grucapcodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[grucapnombre]; ?></td> 
 							</tr>  
						</table> 
					</td>
				</tr>
				<tr>
					<td>
						<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="98%">
  							<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Empleados</font></span></td></tr> 
							<tr> 
  								<td> 
            						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" > 
										<tr>
       										<td width="10%" class="NoiseFooterTD">&nbsp;Id</td> 
 											<td width="40%" class="NoiseFooterTD">&nbsp;Nombre</td> 
 											<td width="25%" class="NoiseFooterTD">&nbsp;Cargo</td>
 											<td width="25%" class="NoiseFooterTD">&nbsp;Departamento</td>
 										</tr>
 										<?php 
 											if($nrInsgrupcapa > 0)
 											{
 												for($a = 0; $a < $nrInsgrupcapa; $a++)
 												{
 													$rwInsgrupcapa = fncfetch($rsInsgrupcapa, $a);
 													$rsUsuario = loadrecordusuario($rwInsgrupcapa['usuacodi'], $idcon);
 										?>
 										<tr>
 											<td class="NoiseDataTD"><?php echo $rsUsuario['usuacodi'];?></td> 
											<td class="NoiseDataTD"><?php echo $rsUsuario['usuanombre'].' '.$rsUsuario['usuapriape'].' '.$rsUsuario['usuasegape'];?></td> 
											<td class="NoiseDataTD"><?php echo cargacargonombre($rsUsuario['cargocodigo'], $idcon) ?></td> 
											<td class="NoiseDataTD"><?php echo cargadepartnombre($rsUsuario['departcodigo'], $idcon) ?></td> 
						 				</tr>
 										<?php
 												}
 											}
 											else
 											{
										?>
										<tr>
 											<td class="NoiseDataTD" colspan="4" align="center">Sin integrantes</td> 
						 				</tr>
						 				<?php 
 											}
 										?>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr><td class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td class="NoiseDataTD"><p>&nbsp;<?php echo $sbreg[grucapdescri]; ?></p></td></tr>
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
 			<input type="hidden" name="flagdetallargrupcapa" value="1"> 
			<input type="hidden" name="acciondetallargrupcapa">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="grucapcodigo,grucapnombre,grucapdescri">
			<input type="hidden" name="grucapcodigo" value="<?php if($accionconsultargrupcapa) echo $grucapcodigo; ?>"> 
 			<input type="hidden" name="grucapnombre" value="<?php if($accionconsultargrupcapa) echo $grucapnombre; ?>"> 
 			<input type="hidden" name="grucapdescri" value="<?php if($accionconsultargrupcapa) echo $grucapdescri; ?>"> 
 			<input type="hidden" name="accionconsultargrupcapa" value="<?php echo $accionconsultargrupcapa; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>