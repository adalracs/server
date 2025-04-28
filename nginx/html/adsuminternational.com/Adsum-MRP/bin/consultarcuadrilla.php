<?php
ob_start(); 
	include ('../src/FunGen/sesion/fncvalses.php');	
	include ('../src/FunPerPriNiv/pktblservicio.php');
	include('../src/FunPerPriNiv/pktbldepartam.php');
	include('../src/FunPerPriNiv/pktblareafuncio.php');
	
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Consultar en cuadrilla</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Cuadrilla</font></p> 
			<table width="500" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr>
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="cuadricodigo" id="cuadricodigo"  size="8" value="<?php echo $cuadricodigo; ?>"></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Cuadrilla</td> 
 								<td class="NoiseDataTD"><input type="text" name="cuadrinombre" id="cuadrinombre"  size="50" value="<?php echo $cuadrinombre; ?>"></td> 
 							</tr> 
							<tr>
     							<td class="NoiseFooterTD">&nbsp;Servicio</td>
     							<td class="NoiseDataTD"><select name="servicicodigo" id="servicicodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										include ('../src/FunGen/floadservicio.php');
										$idcon = fncconn();
										floadservicionegocio($idcon, $servicicodigo, $negocicodigo);
									?>
    							</select></td>
							</tr>   
							<tr>
     							<td class="NoiseFooterTD">&nbsp;Departamento</td>
     							<td class="NoiseDataTD"><select name="departcodigo" id="departcodigo" onChange="accionCmbxAreaFuncio(this.value,'');">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										include ('../src/FunGen/floaddepartam.php');
										floaddepartamnegocio($departcodigo,$negocicodigo, $idcon);
									?>
    							</select></td>
							</tr>
							<tr>
     							<td class="NoiseFooterTD">&nbsp;&Aacute;rea funcional</td>
     							<td class="NoiseDataTD"><span id="cmbxareafuncio"><select name="arefuncodigo" id="arefuncodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										include ('../src/FunGen/floadareafuncio.php');
										floadareafunciodep($idcon, $departcodigo, $arefuncodigo);
									?>
    							</select></span></td>
							</tr>
							<tr>
     							<td class="NoiseFooterTD">&nbsp;Estado</td>
     							<td class="NoiseDataTD"><select name="cuadriacti" id="cuadriacti">
     								<option value = "">-- Seleccione --</option>
     								<option value = "1" <?php if($cuadriacti == 1) echo 'selected'; ?>>Activo</option>
     								<option value = "2" <?php if($cuadriacti == 2) echo 'selected'; ?>>Inactivo</option>
    							</select></td>
							</tr>   
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
			<input type="hidden" name="accionconsultarcuadrilla">
			<input type="hidden" name="flagconsultarcuadrilla" value="1"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="cuadricodigo,cuadrinombre,cuadriacti,servicicodigo,departcodigo,arefuncodigo"> 
			<input type="hidden" name="nombtabl" value="cuadrilla"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>