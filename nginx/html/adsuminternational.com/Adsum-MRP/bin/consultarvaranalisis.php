<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblunimedida.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktbltipocalidad.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
?>
<html> 
	<head> 
		<title>Consultar registro de variables de analisis</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Variables de analisis</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["varanacodigo"] == 1){ $varanacodigo = null; echo "*";}?>&nbsp;C&oacute;digo</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="varanacodigo" size="20" value="<?php if(!$flagconsultarvaranalisis){ echo $sbreg[varanacodigo];}else {echo $varanacodigo; }?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["varananombre"] == 1){ $varananombre = null; echo "*";}?>&nbsp;Nombre</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="varananombre" size="20"	value="<?php if(!$flagconsultarvaranalisis){ echo $sbreg[varananombre];}else {echo $varananombre; }?>"></td> 
 							</tr>
      						<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["unidadcodigo"] == 1): $unidadcodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Unidad de Medida</td>
     							<td class="NoiseDataTD"><select name="unidadcodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										if(!$flagconsultarvaranalisis)
											unset($unidadcodigo);
											
										include ('../src/FunGen/floadunimedida.php');
										$idcon = fncconn();
										floadunimedidasel($unidadcodigo,$idcon);
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
 			<input type="hidden" name="flagconsultarvaranalisis" value="1"> 
			<input type="hidden" name="accionconsultarvaranalisis"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="varanacodigo,tipitemcodigo,tipcalcodigo,varananombre,varanafecha,varanatipespe,varanatolems,varanatolemn,varanadetesp">
			<input type="hidden" name="nombtabl" value="varanalisis"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>