<?php 
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblanalisismp.php');	
	include ( '../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
?>
<html> 
	<head> 
		<title>Consultar registro de historial de analisis de producto en proceso</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Analisis de producto en proceso</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["analiscodigo"] == 1){ $analiscodigo = null; echo "*";}?>&nbsp;C&oacute;digo</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="analiscodigo" size="20" value="<?php if(!$flagconsultaranalisispr){ echo $sbreg[analiscodigo];}else {echo $analiscodigo; }?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["ordoppcodigo"] == 1){ $ordoppcodigo = null; echo "*";}?>&nbsp;OPP</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="ordoppcodigo" size="20" value="<?php if(!$flagconsultaranalisispr){ echo $sbreg[ordoppcodigo];}else {echo $ordoppcodigo; }?>"></td> 
 							</tr>
      						<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["estanacodigo"] == 1): $estanacodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Estado</td>
     							<td class="NoiseDataTD"><select name="estanacodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										if(!$flagconsultaranalisispr)
											unset($estanacodigo);
											
										include ('../src/FunGen/floadestadoanalisis.php');
										$idcon = fncconn();
										floadestadoanalisis($estanacodigo,$idcon);
										fncclose($idcon);
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
 			<input type="hidden" name="flagconsultarhistorialapr" value="1"> 
			<input type="hidden" name="accionconsultarhistorialapr"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="analiscodigo,procedcodigo,ordoppcodigo,usuacodi,analisfecha,estanacodigo,analisdescri,analisestado">
			<input type="hidden" name="nombtabl" value="historialapr"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>