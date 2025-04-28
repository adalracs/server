<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunPerPriNiv/pktbldepartamento.php');
	if($accionnuevoinventecnico)
		include ( 'grababodegatecnico.php');
ob_end_flush();
?>
<html> 
	<head> 
		<title>Nuevo registro de inventario tecnico</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Inventario t&eacute;cnico</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
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
							<!-- <tr>
								<td width="17%" class="NoiseFooterTD"><?php if($campnomb["bodegacodigo"] == 1){ $bodegacodigo = null; echo "*";}?>&nbsp;C&oacute;digo</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="bodegacodigo" size="30"	value="<?php if(!$flagnuevobodega){ echo $sbreg[bodegacodigo];}else {echo $bodegacodigo; }?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD"><?php if($campnomb["bodeganombre"] == 1){ $bodeganombre = null; echo "*";}?>&nbsp;Nombre</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="bodeganombre" size="50"	value="<?php if(!$flagnuevobodega){ echo $sbreg[bodeganombre];}else {echo $bodeganombre; }?>"></td> 
 							</tr>-->
 							<tr>
	        					<td class="NoiseFooterTD"><?php if($campnomb["bodegaencargado"] == 1){ $usuacodigo = null; echo "*";}?>&nbsp;T&eacute;cnico</td>
	        					<td class="NoiseDataTD">
	        						<input type="text" name="usuacodigo" id="usuacodigo" value="<?php if($flagnuevobodega){ echo $usuacodigo; } ?>" size="10" >
	        						<input type="text" name="usuanombre" id="usuanombre" value="<?php if($flagnuevobodega){ echo $usuanombre; } ?>" size="50" >
	        					</td>
      						</tr>
      						<!-- 
      						<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["ciudadcodigo"] == 1): $ciudadcodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Departamento</td>
     							<td class="NoiseDataTD"><select name="deptocodigo" onChange="accionLoadListGen(document.getElementById('ciudadcodigo').value, this.value, 'ciudad');">
     								<option value = "">-- Seleccione --</option>
	     							<?php
//										if(!$flagnuevobodega)
//											unset($deptocodigo);
//										
//										$idcon = fncconn();
//										include ('../src/FunGen/floaddepartamento.php');
//										floaddepartamento($deptocodigo,$idcon);
									?>
    							</select></td>
    						</tr>
      						<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["ciudadcodigo"] == 1): $ciudadcodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Ciudad</td>
     							<td class="NoiseDataTD"><span id="ciudad"><select name="ciudadcodigo" id="ciudadcodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
//										if(!$flagnuevobodega)
//											unset($ciudadcodigo);
//										
//										include ('../src/FunGen/floadciudad.php');
//										floadciudaddep($ciudadcodigo, $deptocodigo, $idcon);
									?>
    							</select></span></td>
							</tr> -->
      						<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["bodegaubicac"] == 1){ $bodegaubicac = null; echo "*";}?>&nbsp;Ubicaci&oacute;n</td>
								<td class="NoiseDataTD"><input type="text" name="bodegaubicac" size="65"	value="<?php if(!$flagnuevobodega){ echo $sbreg[bodegaubicac];}else {echo $bodegaubicac; }?>"></td> 
 							</tr>
      						<!--<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["bodegacapaci"] == 1){ $bodegacapaci = null; echo "*";}?>&nbsp;&Aacute;rea</td>
								<td class="NoiseDataTD"><input type="text" name="bodegacapaci" size="8"	value="<?php if(!$flagnuevobodega){ echo $sbreg[bodegacapaci];}else {echo $bodegacapaci; }?>">&nbsp;&nbsp;mts&sup2;</td> 
 							</tr>-->
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["bodeganota"]	 == 1){$bodeganota = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="bodeganota" rows="3" cols="63"><?php if(!$flagnuevobodega){ echo $sbreg[bodeganota];}else{ echo $bodeganota;} ?></textarea>  </td></tr>
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
 			<input type="hidden" name="bodegatipo" value="2">
			<input type="hidden" name="accionnuevoinventecnico">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="negocicodigo" id="negocicodigo" value="<?php echo $negocicodigo; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>