<?php
ob_start(); 

//include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblvistaotservicioest.php');
include ( '../src/FunPerPriNiv/pktblclienteot.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');


include ( '../src/FunPerPriNiv/pktbldepartamento.php');
include ( '../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblservicio.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');

include('../src/FunPerSecNiv/fncclose.php');
include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncnumreg.php');
include('../src/FunPerSecNiv/fncfetch.php');

include('detallaclienteot.php');
if($accionnuevotareot){
	include ("grabareagendamiento.php");
}

ob_end_flush();
?>
<html>
<head>
<title>Detalle de cliente de la ot</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<SCRIPT LANGUAGE="JavaScript">
function load_datacuadrilla(cuadrilla){
	document.all("detall").src="detallacuadrillaagendada.php?ccuadrilla="+ cuadrilla;
}
</script>
<script language="JavaScript" src="motofech.js"></script>
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<?php
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
	<form name="form1" method="post"  enctype="multipart/form-data">
		<p><font class="NoiseFormHeaderFont">Reagendamiento de Orden de trabajo</font></p>
		<table width="708" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE">
			<tr><td width="872" class="NoiseErrorDataTD">&nbsp;</td></tr>
  			<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr>
			<tr>
				<td height="214">
					<table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
 						<tr><td colspan="5">
 							<table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
 								<tr>
									<td class="NoiseFieldCaptionTD"><span class="Estilo1">&nbsp;N&uacute;mero de OT </span></td>
  									<td class="NoiseFieldCaptionTD"><span class="Estilo1">&nbsp;	<?php if(!$flagdetallarclienteot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo;} ?></span></td>
  									<td colspan="3"><div align="right">Fecha de carga:&nbsp;&nbsp;<?php if(!$flagdetallarclienteot){echo $annogen."-".$mesgen."-".$diagen;}else{ echo $annogen;}?>&nbsp;<span class="style1" onFocus="if (!agree)this.blur();"></span>- <?php if(!$flagdetallarclienteot){echo $horcarg.":".$minutogen; if($inPm==true){echo " p.m.";}else{echo " a.m.";}}else{ echo $horagen.":".$minutogen;}?></div> </td>
  								</tr>
								<tr><td colspan="4" class="NoiseFieldCaptionTD Estilo1">&nbsp;Datos de la orden </td></tr>
							  	<tr>
									<td width="17%" class="NoiseFooterTD">&nbsp;ODS</td>
									<td width="35%" class="NoiseDataTD">&nbsp;<?php echo $sbregclienteot[clientsolici]; ?></td>
									<td width="15%" class="NoiseFooterTD">&nbsp;Fecha ODS</td>
									<td width="33%" class="NoiseDataTD">&nbsp;<?php echo $sbregclienteot[clientfecsol]; ?></td>
  								</tr>
								<tr>
									<td width="17%" class="NoiseFooterTD">&nbsp;Nombre cliente</td>
									<td width="35%">&nbsp;<?php echo $sbregclienteot[clientnombre]; ?></td>
									<td width="15%" class="NoiseFooterTD">&nbsp;Direccion</td>
									<td width="33%">&nbsp;<?php echo $sbregclienteot[clientdirecc]; ?></td>
  								</tr>
  								<tr>
									<td class="NoiseFooterTD">&nbsp;Telefono</td>
									<td>&nbsp;<?php echo $sbregclienteot[clienttelefo]; ?></td>
									<td class="NoiseFooterTD">&nbsp;Contacto</td>
									<td>&nbsp;<?php echo $sbregclienteot[clientcontac]; ?></td>  									
								</tr>
  								<tr>
									<td class="NoiseFooterTD">&nbsp;Telefono contacto</td>
									<td>&nbsp;<?php echo $sbregclienteot[clienttelcon]; ?></td>
									<td class="NoiseFooterTD">&nbsp;Celular contacto</td>
									<td>&nbsp;<?php echo $sbregclienteot[clientcelcon]; ?></td>  									
  								</tr>
  								<tr class="NoiseFooterTD"><td colspan="4">&nbsp;Datos adicionales</td></tr>
  								<tr><td colspan="4">&nbsp;<?php echo $sbregclienteot[clientdatcon]; ?></td></tr>
						  	</table>
 						</td></tr>
 						<tr><td>
							<table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
								<tr class="NoiseFooterTD">
									<td>&nbsp;Tipo de orden</td>
									<td>&nbsp;Servicio</td>
  									<td width="13%">&nbsp;Prioridad</td>
									<td width="12%">&nbsp;Departamento</td>
  									<td width="20%">&nbsp;Ciudad</td>
  								</tr>
								<tr class="NoiseDataTD">
									<td >&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbregtarea;}else{ echo $sbregtarea;} ?></td>
									<td>&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbregservicio;}else{ echo $sbregservicio;} ?></td>
									<td>&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbregpriorida;}else{ echo $sbregpriorida;} ?></td>
									<td>&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbregdepto;}else{ echo $sbregdepto;} ?></td>
									<td>&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbregciudad;}else{ echo $sbregciudad;} ?></td>
								</tr>
							  </table>
						</td></tr>
 						<tr><td colspan="5">&nbsp;</td></tr>
 						<tr>
						  <td colspan="5">
			    <table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
			    					<tr>
			    						<td colspan="5"><table width="100%" border="0" cellspacing="1" align="center">
			    								  					<?php
					  						include('../src/FunGen/floadusuariotareot.php');
					  						floadusuariotareot($sbreg[ordtracodigo]);
										?>  
 									<tr><td colspan="5"><hr></td></tr>
			    						</table></td>
			    					</tr>
 									<tr>
 										<td width="22%" class="NoiseFooterTD">&nbsp;Fecha agendamiento<?php if($flagnuevotareot && !$fecha_agen){ echo '<font color="Red"> *</font>';} ?></td>
 										<td width="20%"><input name="fecha_agen" type="text" size="10" onFocus="if (!agree)this.blur();" value="<?php echo $fecha_agen ?>">
									  <!--<img src="../img/cal.gif" border="0" align="absmiddle" onClick="window.open('formcalendario.php?calencodigo=fecha_agen','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">--></td>
 										<td width="20%" class="NoiseFooterTD">&nbsp;Rango de tiempo<?php if($flagnuevotareot && !$rango){ echo '<font color="Red"> *</font>';}else{$dsbrango[$rango]="selected";} ?></td>
 										<td width="38%"><label>
 										<select name="rango" size="1">
 										  <option value="">Seleccione</option>
 										  <option value="7" <?php echo $dsbrango[7]; ?>>7:00 a.m.  -  9:00 a.m.</option>
 										  <option value="9" <?php echo $dsbrango[9]; ?>>9:00 a.m. -  11:00 a.m.</option>
 										  <option value="11" <?php echo $dsbrango[11]; ?>>11:00 a.m.  -  01:00 p.m.</option>
 										  <option value="13" <?php echo $dsbrango[13]; ?>>01:00 p.m.  -  03:00 p.m.</option>
 										  <option value="15" <?php echo $dsbrango[15]; ?>>03:00 p.m.  -  05:00 p.m.</option>
 										  <option value="17" <?php echo $dsbrango[17]; ?>>05:00 p.m.  -  07:00 p.m.</option>
 										  <option value="19" <?php echo $dsbrango[19]; ?>>07:00 p.m.  - 07:00 a.m</option>
						                </select>
									  </label></td>
 									</tr>
 									<tr>
 										<td rowspan="3" valign="top" class="NoiseFooterTD">&nbsp;Nota<?php if($flagnuevotareot && !$nota){ echo '<font color="Red"> *</font>';} ?></td>
 									<td colspan="3" rowspan="3">
 											<label>
 										  <textarea name="nota" cols="50"></textarea>
 										</label>
 										</td>
 									</tr>
 									
						    </table>

 							<label></label></td>
 						
 						</tr>
 						
 						
						
						<tr><td align="right"><input type="button" name="asig_tec" onfocus="load_datacuadrilla(form1.ccuadrilla.value);"  onClick="window.open('maestablagendacuadrilla.php?dcod=<?php echo $sbregclienteot[deptocodigo]; ?>&ccod=<?php echo $sbregclienteot[ciudadcodigo]; ?>&cserv=<?php echo $sbreg[servicicodigo]; ?>','','status=no,menubar=yes,scrollbars=yes,resizable=yes,left=20,top=20,width=900,height=480');" value="Reasignar técnico"></td></tr>
						<tr>
                        							<td colspan="5" align="center">
                        								<table width="100%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White">                            
                            								<tr>
                              									<td colspan="4" bgcolor="White"><iframe src="detallacuadrillaagendada.php?ccuadrilla=<?php echo $ccuadrilla; ?>" frameborder="0" name="detall"  height="150" width="100%" align="absmiddle"></iframe></td>
                            								</tr>
                       								</table>
                       							</td>
       				  			</tr>
			  </table> 				</td>
			</tr>

 			<tr>
				<td><div align="center">
  					<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accionnuevotareot.value=1;"  width="86" height="18" alt="Aceptar" border=0>
  					<input type="image" name="cancelar"  src="../img/cancelar.gif" onClick="form1.action='maestablagendadespacho.php';"  width="86" height="18" alt="Cancelar" border=0>
				</div></td>
 			</tr>
 			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
	  </table>
		<input type="hidden" name="flagdetallarot">
		<input type="hidden" name="accionnuevotareot">
		<input type="hidden" name="ordtracodigo" value="<?php echo $ordtracodigo; ?>">
		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		<input type="hidden" name="arr_cuadrilla">
		<input type="hidden" name="cjornada">
		<input type="hidden" name="ccuadrilla" value="<?php echo $ccuadrilla; ?>">
	</form>
</body>
<?php	if(!$codigo){ echo " -->"; } ?>
</html>