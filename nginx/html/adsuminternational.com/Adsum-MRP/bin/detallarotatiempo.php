<?php
	include("../src/FunPerPriNiv/pktblclienteot.php");
	include("../src/FunPerSecNiv/fncconn.php");
	include("../src/FunPerSecNiv/fncclose.php");
	
	if(!$accionnuevaotatimepo){
			
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
<?php if(!$codigo){ echo "<!--";} ?>

<body bgcolor="FFFFFF" text="#000000">
	<form name="form1" method="post"  enctype="multipart/form-data">
		<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
			<tr><td width="708" class="NoiseErrorDataTD">&nbsp;</td></tr>
  			<tr><td>
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
  					<tr><td><div align="left" class="NoiseFieldCaptionTD Estilo1">Informaci&oacute;n de la petici&oacute;n</div></td></tr> 
			  </table>
  				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
		  			<tr valign="top">
		    				<td width="149" class="NoiseDataTD" style="text-align:right">No. de petici&oacute;n:</td>
		    				<td width="233"><?php echo $arr_dataorden["no_peticion"];  ?></td>
	    					<td width="164" class="NoiseDataTD" style="text-align:right">Identificador PC Linea:</td>
	    					<td width="322"><?php echo $arr_dataorden["Identificador_pc_line"];  ?></td>
	  				</tr>
					<TR valign="top">
						<TD class="NoiseDataTD" style="text-align: right">Nombre:</TD>
						<TD><?php echo $arr_dataorden["nombre"];  ?></TD>
						<TD class="NoiseDataTD" style="text-align: right">Identificador PC TV:</TD>
						<TD><?php echo $arr_dataorden["indentificador_pc_tv"];  ?></TD>
					</TR>
					<tr valign="top">
	    					<td class="NoiseDataTD" style="text-align:right">Tipo Documento:</td>
	    					<td><?php echo $arr_dataorden["tipo_documento"];  ?></td>
	    					<td class="NoiseDataTD" style="text-align:right">No. de identificaci&oacute;n:</td>
	    					<td><?php echo $arr_dataorden["no_identificacion"];  ?></td>
	  				</tr>	   
	  				<tr valign="top">	    
	    					<td class="NoiseDataTD" style="text-align:right">Tel&eacute;fono de contacto:</td>
	    					<td><?php echo $arr_dataorden["telefono_contacto"];  ?></td>
	    					<td class="NoiseDataTD" style="text-align:right">Tipo Uso:</td>
	    					<td><?php echo $arr_dataorden["tipo_uso"];  ?></td>
	  				</tr>
	  				<tr valign="top">	    
	    					<td class="NoiseDataTD" style="text-align:right">Fecha de registro:</td>
	    					<td><?php echo $arr_dataorden["fecha_registro"];  ?></td>
	    					<td class="NoiseDataTD" style="text-align:right">Fecha de compromiso:</td>
	    					<td><?php echo $arr_dataorden["fecha_compromiso"];  ?></td>
	  				</tr>
	  				<tr valign="top">
	    					<td class="NoiseDataTD" style="text-align:right">Departamento:</td>
	    					<td><?php echo $arr_dataorden["departamento1"];  ?></td>
	    					<td class="NoiseDataTD" style="text-align:right">Descripci&oacute;n:</td>
	    					<td><?php echo $arr_dataorden["descripcion_depto"];  ?></td>
	  				</tr>
	  				<tr valign="top">
	    					<td class="NoiseDataTD" style="text-align:right">Localidad:</td>
	    					<td><?php echo $arr_dataorden["localidad"];  ?></td>
	    					<td class="NoiseDataTD" style="text-align:right">Descripci&oacute;n:</td>
	    					<td><?php echo $arr_dataorden["descripcion_local"];  ?></td>
	  				</tr>
	  				<tr valign="top">
	    					<td class="NoiseDataTD" style="text-align:right">Direcci&oacute;n de instalaci&oacute;n:</td>
	    					<td><?php echo $arr_dataorden["direccion_instalacion1"];  ?></td>
	    					<td class="NoiseDataTD" style="text-align:right">Barrio:</td>
	    					<td><?php echo $arr_dataorden["barrio"];  ?></td>
	  				</tr>
	  				<tr valign="top">
	    					<td class="NoiseDataTD" style="text-align:right">Segmento:</td>
	    					<td><?php echo $arr_dataorden["segmento"];  ?></td>
	    					<td class="NoiseDataTD" style="text-align:right">Descripci&oacute;n:</td>
	    					<td><?php echo $arr_dataorden["descripcion_segmento"];  ?></td>
	  				</tr>
	  					<tr valign="top">
	    					<td class="NoiseDataTD" style="text-align:right">SubSegmento:</td>
	    					<td><?php echo $arr_dataorden["subsegmento"];  ?></td>
	    					<td class="NoiseDataTD" style="text-align:right">Descripci&oacute;n:</td>
	    					<td><?php echo $arr_dataorden["descripcion_subsegmento"];  ?></td>
	    				</tr>
	  				<tr valign="top">
	    					<td class="NoiseDataTD" style="text-align:right">ODS:</td>
	    					<td><?php echo $arr_dataorden["ods"];  ?></td>
	     					<td class="NoiseDataTD" style="text-align:right">Canal Venta:</td>
	    					<td><?php echo $arr_dataorden["canal_venta"];  ?></td>
	  				</tr>
	  				<tr valign="top">
	    					<td class="NoiseDataTD" style="text-align:right">Observaci&oacute;n:</td>
	    					<td><?php echo $arr_dataorden["observacion"];  ?></td>
	    					<td class="NoiseDataTD" style="text-align:right">Cantidad Troncales:&nbsp;</td>
	    					<td><?php echo $arr_dataorden["cantid_troncales"];  ?></td>
	  				</tr>
			  </table>
				<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1">
					<tr><td><div align="left" class="NoiseFieldCaptionTD Estilo1">Estado de la tramitaci&oacute;n</div></td></tr>
			  </table>
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
	  				<tr valign="top">
	    					<td width="43" class="NoiseFooterTD">Estado:</td>
	    					<td width="57"><?php echo $arr_dataorden["estado"];  ?></td>
	    					<td width="73" class="NoiseFooterTD">Descripci&oacute;n:</td>
	    					<td width="160"><?php echo $arr_dataorden["descripcion_estado"];  ?></td>
	    					<td width="139" class="NoiseFooterTD">Fecha Ultima Actividad:</td>
	    					<td width="386"><?php echo $arr_dataorden["fecha_ultima_act"];  ?></td>
	  				</tr>
			  </table> 
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
					<tr><td><div align="left" class="NoiseFieldCaptionTD Estilo1">Informaci&oacute;n Planta Interna Linea</div></td></tr>
			  </table>
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
					<tr valign="top">
						<td width="46" align="right" class="NoiseFooterTD">Central:</td>
						<td width="176"><?php echo $arr_dataorden["central"];  ?></td>
	   					<td width="140" align="right" class="NoiseFooterTD">N&uacute;mero de Tel&eacute;fono:</td>
						<td width="101"><?php echo $arr_dataorden["no_telefono"];  ?></td>
						<td width="81" align="right" class="NoiseFooterTD">Len:</td>
						<td width="316"><?php echo $arr_dataorden["len"];  ?></td>
					</tr>
			  </table>
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
	  				<tr><td><div align="left" class="NoiseFieldCaptionTD Estilo1">Informaci&oacute;n Planta Externa Linea</div></td></tr>
			  </table>
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
					<tr valign="top"> 
						<td width="76" align="right" class="NoiseFooterTD">Distribuidor:</td>
						<td width="21"><?php echo $arr_dataorden["distribuidor"];  ?></td>  
						<td width="72" align="right" class="NoiseFooterTD">Descripci&oacute;n:</td>
						<td width="100"><?php echo $arr_dataorden["descripcion_ditribuidor"];  ?></td>
						<td width="133" align="right" class="NoiseFooterTD">Direcci&oacute;n Distribuidor:</td>
						<td width="165"><?php echo $arr_dataorden["direccion_distribuidor"];  ?></td>
						<td width="132" align="right" class="NoiseFooterTD">List&oacute;n:</td>
						<td width="46"><?php echo $arr_dataorden["liston"];  ?></td>
						<td width="61" align="right" class="NoiseFooterTD">Par List&oacute;n:</td>
						<td width="38" align="left"><?php echo $arr_dataorden["par_liston"];  ?></td>
					</tr>
					<tr valign="top">
						<td align="right" class="NoiseFooterTD">Cable:</td>
						<td><?php echo $arr_dataorden["cable"];  ?></td>    
						<td align="right" class="NoiseFooterTD">Par Cable:</td>
						<td><?php echo $arr_dataorden["par_cable"];  ?></td>
						<td align="right" class="NoiseFooterTD">Armario:</td>
						<td><?php echo $arr_dataorden["armario"];  ?></td>
						<td align="right" class="NoiseFooterTD">Direcci&oacute;n del Armario:</td>
						<td colspan="2"><?php echo $arr_dataorden["direccion_armario"];  ?></td>
						<td></td>
					</tr>
					<tr valign="top">
						<td align="right" class="NoiseFooterTD">C&oacute;digo Caja:</td>
						<td><?php echo $arr_dataorden["cod_caja"];  ?></td>
						<td align="right" class="NoiseFooterTD">Par Caja:</td>
						<td><?php echo $arr_dataorden["par_caja"];  ?></td>
						<td align="right" class="NoiseFooterTD">Direcci&oacute;n Caja:</td>
						<td><?php echo $arr_dataorden["direccion_caja"];  ?></td>
						<td align="right"></td>
						<td></td>
						<td align="right"></td>
						<td></td>
					</tr>
					<tr valign="top" class="NoiseFooterTD">
						<td align="right" colspan="10"><div align="left">Dslam:</div></td>
					</tr>
					<tr valign="top">
						<td align="center" colspan="10"><div align="left"><?php echo $arr_dataorden["dslam"];  ?></div></td>
					</tr>
				</table>
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
	  				<tr><td><div align="left" class="NoiseFieldCaptionTD Estilo1">Informaci&oacute;n de los PC</div></td></tr>
			  </table>
	  			<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
		  			<tr valign="top">
						<td colspan="4"><div align="left" class="NoiseColumnTD"><?php echo $arr_dataorden["info"];  ?></div></td>
		  			</tr>
		  			<tr valign="top">  			
		    				<td width="181"><div align="right" class="NoiseFooterTD">PS</div></td>
		    				<td width="190"><?php echo $arr_dataorden["ps"];  ?></td>
		    				<td width="182"><div align="right" class="NoiseFooterTD">Tipo PC / SubTipo PC</div></td>
		    				<td width="305"><?php echo $arr_dataorden["tipo_subtipo_pc"];  ?></td>
		  			</tr>
		  			<tr valign="top">
		    				<td><div align="right" class="NoiseFooterTD">Direcci&oacute;n de la Instalaci&oacute;n</div></td>
		    				<td colspan=3><?php echo $arr_dataorden["direccion_instalacion2"];  ?></td>
		  			</tr>
		  			<tr valign="top">
						<td><div align="right" class="NoiseFooterTD">Departamento</div></td>
						<td><?php echo $arr_dataorden["departamento2"];  ?></td>
						<td><div align="right" class="NoiseFooterTD">Localidad / Sub Localidad</div></td>
						<td><?php echo $arr_dataorden["localidad_sublocalidad"];  ?></td>
		  			</tr>
		  			<tr valign="top">
		    				<td><div align="right" class="NoiseFooterTD">Fecha de Compromiso</div></td>
		    				<td><?php echo $arr_dataorden["fecha_compromiso"];  ?></td>	  
		    				<td></td>
		    				<td></td>
		  			</tr>
 			  </table>
 			</td></tr>
 			<tr><td>&nbsp;</td></tr>
 			<tr>
				<td colspan="3"><div align="center">
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="window.close();" width="86" height="18" alt="Aceptar" border=0>
				</div></td>
			</tr>
			<tr><td width="708" class="NoiseErrorDataTD">&nbsp;</td></tr>
 		</table>
	  	<input type="hidden" name="accionnuevaotatimepo" value="1">
	</form>
</body>
<?php if(!$codigo){ echo "-->";} ?>
</html>
