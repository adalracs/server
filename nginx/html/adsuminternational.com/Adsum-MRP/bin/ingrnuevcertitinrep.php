<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include_once ('../src/FunPerSecNiv/fncconn.php');
	include_once ('../src/FunPerSecNiv/fncclose.php');
	include_once ('../src/FunPerSecNiv/fncsqlrun.php');
	include_once ('../src/FunPerSecNiv/fncfetch.php');
	include_once ('../src/FunPerSecNiv/fncnumreg.php');
	include_once ('../src/FunPerPriNiv/pktblvistaitemdispe.php');
	
	if($accionnuevocertitinrep)
		include ( 'grabacertitinrep.php');
		
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de informe produccion tinta/reproceso</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.dispensing.js"></script>
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Informe produccion tinta/reproceso</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="800">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr> 
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td colspan="4" class="ui-state-default" align="center"><small>R.DI.04</small></td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["formulcodigo"] == 1){ $formulcodigo = null; echo "*";}?>&nbsp;Formula &nbsp;</td>
								<td width="20%" class="NoiseDataTD"><input type="hidden" name="formulcodigo" id="formulcodigo" value="<?php echo $formulcodigo ?>" /><input type="text" name="formulnumero" id="formulnumero" value="<?php echo $formulnumero ?>" /></td>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["certirlote"] == 1){ $certirlote = null; echo "*";}?>&nbsp;Lote &nbsp;</td>
								<td width="55%" class="NoiseDataTD"><input type="text" name="certirlote" id="certirlote" value="<?php echo $certirlote ?>" size="10" /></td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["certirpeso"] == 1){ $certirpeso = null; echo "*";}?>&nbsp;Peso <b>(kgs)</b> &nbsp;</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="certirpeso" id="certirpeso" value="<?php echo $certirpeso ?>" size="7" onkeyup="validaPeso(this.value);" /></td>
							</tr>
							<tr>
								<td colspan="4" class="ui-state-default" align="center"><small>Materia prima</small></td>
							</tr>
							<tr>
								<td colspan="4">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center"> 
										<tr>
											<td width="15%" class="NoiseFooterTD">&nbsp;Componente &nbsp;</td>
											<td width="20" class="NoiseDataTD"><input type="hidden" name="itedescodigo" id="itedescodigo" value="<?php echo $itedescodigo ?>" /><input type="text" name="itedesnombre" id="itedesnombre" value="<?php echo $itedesnombre ?>" /></td>
											<td width="10%" class="NoiseFooterTD">&nbsp;Lote &nbsp;</td>
											<td width="15%" class="NoiseDataTD"><input type="text" name="lote" id="lote" value="<?php echo $lote ?>" size="10" /></td>
											<td width="10%" class="NoiseFooterTD">&nbsp;<b>kgs</b>&nbsp;</td>
											<td width="30%" class="NoiseDataTD"><input type="text" name="kilos" id="kilos" value="<?php echo $kilos ?>" size="7" /></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4" class="NoiseDataTD">
		  				<div class="ui-buttonset" align="left">
							<button id="ingresaritem">Agregar</button>&nbsp;&nbsp;
		            		<button id="quitaritem">Quitar</button>
						</div>
		  			</td>
				</tr>
				<tr>
					<td colspan="4">
						<div id="filtrlistavistaitemdispe">
						<?php
							$noAjax = true;
							include '../src/FunjQuery/jquery.visors/jquery.vistaitemdispe.php';  
						?>
						</div>
					</td>
				</tr>
				<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
				<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["certirdescri"] == 1){$certirdescri = null; echo "*";}?>&nbsp;Nota</td></tr>
				<tr><td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="certirdescri" rows="3" cols="95"><?php echo $certirdescri ?></textarea>  </td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="accionnuevocertitinrep">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="certirfecha" value="<?php echo date("Y-m-d H:i:s"); ?>">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>