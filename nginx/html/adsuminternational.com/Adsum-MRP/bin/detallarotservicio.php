<?php
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php');
//include ( '../src/FunPerPriNiv/pktblvistaotservicioest.php');
include ( '../src/FunPerPriNiv/pktblclienteot.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');


include ( '../src/FunPerPriNiv/pktbldepartamento.php');
include ( '../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblservicio.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktblotestado.php');

if(!$flagdetallarclientot){ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
	
	if (!$sbreg){ 
		$nombtabl = "otservicio";
		include( '../src/FunGen/fnccontfron.php'); 
	} 
	$nombtabl = "otservicio";
	include('detallaotservicio.php');	
} 

ob_end_flush();
?>
<html>
	<head>
		<title>Detalle de registro de ot servicio</title>
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
		.Estilo1 {
			color: #FFFFFF;
			font-weight: bold;
		}
		-->
		</style>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p>
			<table width="643"  border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE">
				<tr><td width="635" class="NoiseErrorDataTD">&nbsp;</td>
				</tr>
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Detallar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td colspan="2">
 								<table width="99%" border="0" cellspacing="2" cellpadding="0" align="center">
 									<tr>
										<td width="22%" class="NoiseFieldCaptionTD Estilo1">&nbsp;Numero OT</td>
										<td class="NoiseFieldCaptionTD Estilo1">&nbsp;<?php if(!$flagdetallarclientot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo; }?></td>
										<td colspan="2">&nbsp;Fecha de creación:&nbsp;&nbsp;<?php echo $annogen."-".$mesgen."-".$diagen."  ".$horgen.":".$minutogen; if($horagen > 11){ echo " p.m.";}else{ echo " a.m.";} ?> </td>
  									</tr>
									<tr>
									  <td class="NoiseFooterTD">Estado Actual </td>
									  <td class="NoiseErrorDataTD"><?php echo $sbregestado ?></td>
									  <td>&nbsp;</td>
									  <td>&nbsp;</td>
								  </tr>
									<tr>
									  <td class="NoiseFooterTD">ODS</td>
								      <td class="NoiseDataTD"><?php if(!$flagdetallarclientot){ echo $sbreg[clientsolici];}else{ echo $clientsolici; }?></td>
								      <td class="NoiseFooterTD">Fecha Solicitud </td>
								      <td>
								          <?php if(!$flagdetallarclientot){ echo  $anno."-".$mes."-".$dia."  ".$horsol.":".$minuto; if($hora > 11){ echo " p.m.";}else{ echo " a.m.";} }else{ echo $clientfecsol; }?>
								      </td>
								  </tr>
								  									<tr>
									  <td class="NoiseFooterTD">Servcicio</td>
								      <td class="NoiseDataTD"><?php echo $sbregtarea ?></td>
								      <td class="NoiseFooterTD">Tipo de orden </td>
								      <td class="NoiseDataTD"><?php echo $sbregtarea ?></td>
								  </tr>
								  									<tr>
									  <td class="NoiseFooterTD">Departamento</td>
								      <td><?php echo $sbregdepto ?> </td>
								      <td class="NoiseFooterTD">Ciudad</td>
								      <td><?php echo $sbregciudad ?></td>
								  </tr>
								  									<tr>
									  <td class="NoiseFooterTD">Fecha de Inicio</td>
								      <td class="NoiseDataTD"><?php if(!$flagdetallarclientot){ echo  $sbregtareot[9]." ".$horaorini1.":".$minutoorini  ; if($horaorini > 11){ echo " p.m.";}else{ echo " a.m.";} }else{ echo $clientfecsol; }?></td>
								      <td class="NoiseFooterTD">Fecha terminaci&oacute;n </td>
								      <td class="NoiseDataTD"><?php if(!$flagdetallarclientot){ echo  $sbregtareot[11]." ".$horaorfin1.":".$minutoorfin  ; if($horaorfin > 11){ echo " p.m.";}else{ echo " a.m.";} }else{ echo $clientfecsol; }?></td>
								  </tr>
								  									<tr>
									  <td class="NoiseFooterTD">Duraci&oacute;n hrs. </td>
								      <td class="NoiseDataTD"><?php echo $sbregtareot[5] ?></td>
								      <td>&nbsp;</td>
								      <td>&nbsp;</td>
								  </tr>
								  									<tr>
								  									  <td class="NoiseFooterTD">Implantador Ingacon </td>
								                                      <td colspan="3"><?php echo $sbregimplantador ?></td>
                                  </tr>
								  									<tr>
									  <td colspan="4">&nbsp;</td>
								  </tr>
									<tr><td colspan="4" class="NoiseFieldCaptionTD Estilo1">&nbsp;Datos B&aacute;sicos </td></tr>
									<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;Fecha solicitud</td>
										<td class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo  $anno."-".$mes."-".$dia."  ".$horsol.":".$minuto; if($hora > 11){ echo " p.m.";}else{ echo " a.m.";} }else{ echo $clientfecsol; }?></td>
								  		<td width="22%" class="NoiseFooterTD">&nbsp;Fecha compromiso</td>
										<td class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo  $anno1."-".$mes1."-".$dia1."  ".$horco.":".$minuto1; if($hora1 > 11){ echo " p.m.";}else{ echo " a.m.";} }else{ echo $clientfecco; }?></td>
									</tr>
									<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;Nombre cliente</td>
										<td colspan = "3" class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo $sbregclienteot[clientnombre];}else{ echo $clientnombre; }?></td>
  									</tr>
									<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;Direcci&oacute;n</td>
										<td colspan = "3" class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo $sbregclienteot[clientdirecc];}else{ echo $clientdirecc; }?></td>
									</tr>
  									<tr>
  										<td class="NoiseFooterTD" width="22%">&nbsp;Tel&eacute;fono</td>
									  	<td width="26%" class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo $sbregclienteot[clienttelefo];}else{ echo $clienttelefo; }?></td>
										<td class="NoiseFooterTD" width="22%">&nbsp;Movil</td>
									  	<td width="30%" class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo $sbreg[clientmovil];}else{ echo $clientmovil; }?></td>
  									</tr>
									<tr>
										<td class="NoiseFooterTD" width="22%">&nbsp;Contacto</td>
										<td colspan = "3" class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo $sbregclienteot[clientcontac];}else{ echo $clientcontac; }?></td> 
									</tr>
  									<tr>
  										<td class="NoiseFooterTD">&nbsp;Tel&eacute;fono contacto</td>
										<td class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo $sbregclienteot[clienttelcon];}else{ echo $clienttelcon; }?></td>
										<td class="NoiseFooterTD">&nbsp;Movil contacto</td>
										<td>&nbsp;<?php if(!$flagdetallarclientot){ echo $sbregclienteot[clientcelcon];}else{ echo $clientcelcon; }?></td>  									
  									</tr>
									<tr>
										<td class="NoiseFooterTD" width="22%">&nbsp;Implantador Telecom </td>
										<td colspan = "3" class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo $sbregclienteot[clientimplan];}else{ echo $clientimplan; }?></td> 
									</tr>
  									 <tr class="NoiseFooterTD"><td colspan="4">&nbsp;Datos adicionales</td></tr>
  									 <tr class="NoiseButton">
  										<td colspan="4" class="NoiseDataTD"><?php if(!$flagdetallarclientot){ echo $sbregclienteot[clientdatcon];}else{ echo $clientdatcon; }?></td>
								  </tr>
					  		  </table>
 							</td>
 						</tr>
 						<tr>
							<td colspan="2">
								<table width="99%" border="0" cellspacing="2" cellpadding="0" align="center">
									<tr>
										<td class="NoiseFooterTD">&nbsp;Prioridad</td>
										<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $sbregpriorida ?></td>
									</tr>
									<tr>
										<td width="20%" class="NoiseFooterTD">&nbsp;Direcci&oacute;n baja</td>
										<td width="80%" colspan = "3" class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo $sbregclienteot[clientdirecb];}else{ echo $clientdirecb; }?></td>
									</tr>
									<tr>
										<td width="20%" class="NoiseFooterTD">&nbsp;Direcci&oacute;n alta</td>
										<td colspan = "3" class="NoiseDataTD">&nbsp;<?php if(!$flagdetallarclientot){ echo $sbregclienteot[clientdireca];}else{ echo $clientdireca; }?></td>
									</tr>
						  	  </table>
							</td>
						</tr>
			 		</table> 	
			 	</td>
			</tr>
 			<tr>
				<td><div align="center">
  					<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.action='maestablotservicio.php';"  width="86" height="18" alt="Cancelar" border=0>
				</div></td>
 			</tr>
 			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
	  	</table>
		<input type="hidden" name="ordtracodigo" value="<?php if(!$flagdetallarclientot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo; } ?>"> 
		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
	</form>
</body>
<?php	if(!$codigo){ echo " -->"; } ?>
</html>