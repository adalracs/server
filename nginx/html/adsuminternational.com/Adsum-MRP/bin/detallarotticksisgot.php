<?php
	include ( 'cargaotsisgot.php');
ob_end_flush();
?>
<html>
<head>
<title>Detalle de registro de ot</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>
<?php
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
	<form name="form1" method="post"  enctype="multipart/form-data">
		<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
			<tr><td width="708" class="NoiseErrorDataTD">&nbsp;</td></tr>
  			<tr><td>
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
  					<tr><td><div align="left" class="NoiseFieldCaptionTD Estilo1">Informaci&oacute;n de la solicitud</div></td></tr> 
			  	</table>
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
		  			<tr valign="top">
		    				<td width="149" class="NoiseDataTD" style="text-align:right">Caso n&uacute;mero:</td>
		    				<td width="233"><?php echo $arr_dataorden['caso_numero']; ?></td>
	    					<td width="164" class="NoiseDataTD" style="text-align:right">Tipo de requerimiento:</td>
	    					<td width="322"><?php echo $arr_dataorden['tipo_requerimiento']; ?></td>
	  				</tr>				
		  			<tr valign="top">
		    				<td width="149" class="NoiseDataTD" style="text-align:right">Organizaci&oacute;n:</td>
		    				<td width="233"><?php echo $arr_dataorden['organizacion']; ?></td>
	    					<td width="164" class="NoiseDataTD" style="text-align:right">Sede:</td>
	    					<td width="322"><?php echo $arr_dataorden['sede']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td width="149" class="NoiseDataTD" style="text-align:right">Direcci&oacute;n:</td>
		    				<td width="233"><?php echo $arr_dataorden['direccion']; ?></td>
	    					<td width="164" class="NoiseDataTD" style="text-align:right">Responsable - Tipo de falla:</td>
	    					<td width="322"><?php echo $arr_dataorden['responsable']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td width="149" class="NoiseDataTD" style="text-align:right">Fecha creaci&oacute;n:</td>
		    				<td width="233"><?php echo $arr_dataorden['fecha_creacion']; ?></td>
	    					<td width="164" class="NoiseDataTD" style="text-align:right">Contacto:</td>
	    					<td width="322"><?php echo $arr_dataorden['contacto']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td width="149" class="NoiseDataTD" style="text-align:right">Datos contacto:</td>
		    				<td width="233"><?php echo $arr_dataorden['datos_contacto']; ?></td>
	    					<td width="164" class="NoiseDataTD" style="text-align:right">Estado caso:</td>
	    					<td width="322"><?php echo $arr_dataorden['estado_caso']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td width="149" class="NoiseDataTD" style="text-align:right">Creado por:</td>
		    				<td width="233"><?php echo $arr_dataorden['creado_por']; ?></td>
	    					<td width="164" class="NoiseDataTD" style="text-align:right">Estado del Servicio:</td>
	    					<td width="322"><?php echo $arr_dataorden['estado_servicio']; ?></td>
	  				</tr>
				</table>
	  		</td></tr>
 			<tr>
				<td colspan="3"><div align="center">
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="" width="86" height="18" alt="Aceptar" border=0>
				</div></td>
			</tr>
			<tr><td width="708" class="NoiseErrorDataTD">&nbsp;</td></tr>
	  	</table>
	</form>
</body>
<?php if(!$codigo){ echo "-->";} ?>
</html>


