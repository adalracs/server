<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblitem.php');
	include ( '../src/FunPerPriNiv/pktbloperacio.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblherramie.php');
	include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
?>
<html> 
	<head> 
		<title>Consultar registro en ordenes de programadas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
		<style type="text/css">
			select, #equiponombre {font-size: 12px;}
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="#FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Orden de trabajo progragamda</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="800">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr>
  				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr>
          						<td width="20%" class="NoiseFooterTD">&nbsp;Numero OTP</td>
          						<td width="80%" class="NoiseDataTD"><input type="text" name="ordtranumpro" id="ordtranumpro" value="<?php echo $ordtranumpro ?>"></td>
          					</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
          						<td width="20%" class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
          						<td width="80%" class="NoiseDataTD"><select name="plantacodigo" id="plantacodigo" onChange="cargarSistemas(this.value);">
          							<option value = "">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadplanta.php');
										$idcon = fncconn();
										floadplanta($plantacodigo,$idcon);
									?>
            					</select></td>
          					</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD">&nbsp;Tarea</td>
								<td colspan="3" class="NoiseDataTD"><select name="tareacodigo">
									<option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadtarea.php');
										floadtarea($tareacodigo,$idcon);
									?>
          						</select></td>
          					</tr>
          					<tr>
          						<td class="NoiseFooterTD">&nbsp;Tipo de trabajo</td>
								<td colspan="3" class="NoiseDataTD"><select name="tiptracodigo">
									<option value="">-- Seleccione --</option>
            						<?php
										include ('../src/FunGen/floadtipotrab.php');
										floadtipotrab($tiptracodigo,$idcon, $usuatipotrab);
									?>
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
  			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 			
	 		<input type="hidden" name="flagconsultarotp" value="1"> 
			<input type="hidden" name="accionconsultarotp"> 
			<input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" id="negocicodigo" name="negocicodigo" value="<?php echo $negocicodigo; ?>"> 
			<input type="hidden" name="columnas" value="ordtranumpro,plantacodigo,tiptracodigo,tareacodigo"> 
			<input type="hidden" name="nombtabl" value="otp"> 
			<input type="hidden" name="usutarcodigo" value="<?php echo $usutarcodigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>