<?php 
ini_set('display_errors',1);
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunPerPriNiv/pktblanalisispr.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblprvaranalisis.php');
	include ( '../src/FunGen/cargainput.php');
	if($accionnuevoanalisispr)
		include ( 'grabaanalisispr.php');
ob_end_flush();
$idcon = fncconn();


?>
<html> 
	<head> 
		<title>Nuevo registro de analisis de producto en proceso</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_analisispr.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Analisis de producto en proceso</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
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
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td  width="25%" class="NoiseFooterTD"><?php if($campnomb["usuario"] == 1){ $usuario = null; echo "*";}?>&nbsp;Usuario</td>
								<td  class="NoiseDataTD"><?php echo cargausualogin($usuacodi,$idcon); ?></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["analisfecha"] == 1){ $analisfecha = null; echo "*";}?>&nbsp;Fecha</td>
								<td  class="NoiseDataTD"><?php echo date("Y-m-d"); ?></td> 
 							</tr>
            				 <tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["procedcodigo"] == 1): $procedcodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Procedimiento</td>
     							<td class="NoiseDataTD"><select id="procedcodigo" name="procedcodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										include ('../src/FunGen/floadprocedimiento.php');
										floadprocedimiento($procedcodigo,$idcon);
									?>
    							</select></td>
							</tr>
							<tr>
 								<td colspan="2">
 									<div class="ui-buttonset ui-state-default NoiseDataTD">&nbsp;Especificaciones&nbsp</div>
 									<div id="filtrlistavaranalisis">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jq.vanalisispr.php';  
										?>
									</div>
 								</td>
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["ordoppcodigo"] == 1){ $ordoppcodigo = null; echo "*";}?>&nbsp;Orden de produccion</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="ordoppcodigo" size="20" id="ordoppcodigo"	value="<?php if(!$flagnuevoanalisispr){ echo $sbreg[ordoppcodigo];}else {echo $ordoppcodigo; }?>"><span id="cargaropp"></span></td> 
 							</tr>
 							<tr>
								<td colspan="4" >
									<div id="fltropp">
									</div>
								</td>
 							</tr>

      						<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["estanacodigo"] == 1): $estanacodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Estado</td>
     							<td class="NoiseDataTD"><select name="estanacodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										include ('../src/FunGen/floadestadoanalisis.php');
										floadestadoanalisis($estanacodigo,$idcon);
									?>
    							</select></td>
							</tr>

							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["analisdescri"]== 1){$analisdescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="analisdescri" rows="3" cols="90"><?php if(!$flagnuevoanalisispr){ echo $sbreg[analisdescri];}else{ echo $analisdescri;} ?></textarea>  </td></tr>
						</table> 
  					</td> 
 				</tr> 
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="accionnuevoanalisispr">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>
