<?php
if(!$accionnuevaotsisgot){
	include ( 'cargaotsisgot.php');	
}

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
		    				<td width="149" class="NoiseDataTD" style="text-align:right">No. de solicitud:</td>
		    				<td width="233"><?php echo $arr_dataorden['solicitud_numero']; ?></td>
	    					<td width="164" class="NoiseDataTD" style="text-align:right">Fecha creaci&oacute;n:</td>
	    					<td width="322"><?php echo $arr_dataorden['fecha_creacion']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Cliente:</td>
		    				<td ><?php echo $arr_dataorden['cliente']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Creada por:</td>
	    					<td ><?php echo $arr_dataorden['creada_por']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Estado solicitud:</td>
		    				<td ><?php echo $arr_dataorden['estado_solicitud']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Servicio:</td>
	    					<td ><?php echo $arr_dataorden['servicio']; ?></td>
	  				</tr>	  				
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Segmento:</td>
		    				<td ><?php echo $arr_dataorden['segmento']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Area solicitante:</td>
	    					<td ><?php echo $arr_dataorden['area_solicitante']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Ejecutivo de Cuenta:</td>
		    				<td ><?php echo $arr_dataorden['ejecutivo_cuenta']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Portafolio:</td>
	    					<td ><?php echo $arr_dataorden['portafolio']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Medio UK:</td>
		    				<td ><?php echo $arr_dataorden['medio_uk']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Ciudad origen:</td>
	    					<td ><?php echo $arr_dataorden['ciudad_origen']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Ciudad Destino:</td>
		    				<td ><?php echo $arr_dataorden['ciudad_destino']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Direcci&oacute;n origen:</td>
	    					<td ><?php echo $arr_dataorden['direccion_origen']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Direcci&oacute;n Destino:</td>
		    				<td ><?php echo $arr_dataorden['direccion_destino']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Fecha / Hora compromiso:</td>
	    					<td ><?php echo $arr_dataorden['fecha_hora_compromiso']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Tipo de canal:</td>
		    				<td ><?php echo $arr_dataorden['tipo_canal']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">DS de la principal:</td>
	    					<td ><?php echo $arr_dataorden['ds_principal']; ?></td>
	  				</tr>			
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Unidad de negocio:</td>
		    				<td ><?php echo $arr_dataorden['unidad_negocio']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Responsable:</td>
	    					<td ><?php echo $arr_dataorden['responsable']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Concecutivo requerimiento:</td>
		    				<td ><?php echo $arr_dataorden['consecutivo_requerimiento']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Solicitud asociada:</td>
	    					<td ><?php echo $arr_dataorden['solicitud_asociada']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">N&uacute;mero de puntos:</td>
		    				<td ><?php echo $arr_dataorden['numero_puntos']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Fecha / Hora cierre:</td>
	    					<td ><?php echo $arr_dataorden['fecha_cierre']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Cerrado por:</td>
		    				<td ><?php echo $arr_dataorden['cerrado_por']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Solicitada por:</td>
	    					<td ><?php echo $arr_dataorden['solicitada_por']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Fecha / Hora solicitud:</td>
		    				<td ><?php echo $arr_dataorden['fecha_hora_solicitud']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">ANS:</td>
	    					<td ><?php echo $arr_dataorden['ans']; ?></td>
	  				</tr>
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Prioridad:</td>
		    				<td ><?php echo $arr_dataorden['prioridad']; ?></td>
	    					<td  class="NoiseDataTD" style="text-align:right">Orden transporte SIL:</td>
	    					<td ><?php echo $arr_dataorden['orden_transporte']; ?></td>
	  				</tr>	  				
	  				<tr valign="top">
		    				<td class="NoiseDataTD" style="text-align:right">Tipo:</td>
		    				<td ><?php echo $arr_dataorden['tipo']; ?></td>
	  				</tr>
	  			</table>
	  		</td></tr>
	  		 <tr>
				<td colspan="3"><div align="center">
						<input type="image" name="aceptar" onclick="window.close();"  src="../img/aceptar.gif" onClick="" width="86" height="18" alt="Aceptar" border=0>
				</div></td>
			</tr>
			<tr><td width="708" class="NoiseErrorDataTD">&nbsp;</td></tr>
	  	</table>
	  	<input type="hidden" name="accionnuevaotsosgot" value="1">
	</form>
</body>
<?php 
if(!$codigo)
{ echo "-->";}
?>
</html>