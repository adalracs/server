<?php
ob_start(); 

include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblvistaotservicioest.php');
include ( '../src/FunPerPriNiv/pktblclienteot.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');


include ( '../src/FunPerPriNiv/pktblotestado.php');
include ( '../src/FunPerPriNiv/pktbldepartamento.php');
include ( '../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblservicio.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');

include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');

if($accionnuevotareot){
	include ("grabatareotserv.php");
}

if(!$flagnuevotareot){ 

	include ( '../src/FunGen/sesion/fnccarga.php');
	include ( '../src/FunPerPriNiv/pktbltareot2.php');
	
	
	$nuConn = fncconn();
	//$codtareot=loadcodigotareot($radiobutton,$nuConn);
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg){
		$nombtabl = "tareotserv";
		include( '../src/FunGen/fnccontfron.php');
	}
	 $ordtracodigo = $sbreg[ordtracodigo];
	 $tareacodigo = $sbreg[tareacodigo];
	 $prioricodigo = $sbreg[prioricodigo];
	 
}

include('detallaclienteot.php');
$ordtrafecgen = $sbreg[ordtrafecgen];
$ordtrahorgen = $sbreg[ordtrahorgen];	

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
		<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p>
		<table width="708" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE">
			<tr><td width="872" class="NoiseErrorDataTD">&nbsp;</td></tr>
  			<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr>
			<tr>
				<td height="214">
					<table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
 						<tr><td colspan="5">
 							<table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
 								<tr>
									<td class="NoiseFieldCaptionTD" width="17%"><span class="Estilo1">&nbsp;N&uacute;mero de OT </span></td>
  									<td class="NoiseFieldCaptionTD" width="20%"><span class="Estilo1">&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo;} ?></span></td>
  									<td colspan="3"><div align="right">Fecha de carga:&nbsp;&nbsp;<?php if(!$flagdetallarclienteot){echo $annogen."-".$mesgen."-".$diagen;}else{ echo $annogen;}?>&nbsp;<span class="style1" onFocus="if (!agree)this.blur();"></span>- <?php if(!$flagdetallarclienteot){echo $horcarg.":".$minutogen; if($inPm==true){echo " p.m.";}else{echo " a.m.";}}else{ echo $horagen.":".$minutogen;}?></div> </td>
  								</tr>
								<!--<tr><td colspan="4" class="NoiseFieldCaptionTD Estilo1">&nbsp;Datos de la orden </td></tr>-->
							  	<tr>
									<td width="17%" class="NoiseFooterTD">&nbsp;ODS</td>
									<td width="20%" class="NoiseDataTD">&nbsp;<?php echo $sbregclienteot[clientsolici]; ?></td>
									<td width="15%" class="NoiseFooterTD">&nbsp;Fecha solicitud</td>
									<td width="33%" class="NoiseDataTD">&nbsp;<?php echo $sbregclienteot[clientfecsol]; ?></td>
  								</tr>
						  	</table>
 						</td></tr>
 						<tr><td>
							<table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
								<tr class="NoiseFooterTD">
									<td width="20%">&nbsp;Tipo de orden</td>
									<td width="20%">&nbsp;Servicio</td>
  									<td width="12%">&nbsp;Prioridad</td>
									<td width="28%">&nbsp;Departamento</td>
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

					  					<?php
					  						include('../src/FunGen/floadusuariotareot.php');
					  						floadusuariotareot($sbreg[ordtracodigo]);
										?>  
 									<tr><td colspan="5"><hr></td></tr>
      								<tr class="NoiseErrorDataTD">
      						 			<td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;Estado&nbsp;&nbsp;
      						  				<select name="otestacodigo">
      						  					<?php
      						  						include('../src/FunGen/floadotestadootservicio.php');
      						  						$idcon = fncconn();
      						  						floadotestadoot($idcon,$sbreg[otestacodigo]);
      						  						fncclose($idcon);
												?> 

      						  				</select>
      						 			</td>
 										<tr>	
 											<td class="NoiseFooterTD"><?php if($flagnuevotareot && !$clientfecsol){ echo '<font color="Red"> *</font>';} ?>&nbsp;Fecha / Hora</td>
 															<td colspan="2">
											<input type="text" name="clientfecsol" size="12" value="<?php if(!$flagnuevotareot){ echo $sbreg[fecha_agen];}else{ echo $clientfecsol; }?>" onFocus="if (!agree)this.blur();">
										    	<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=clientfecsol','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
              										<select name="horini">
                										<?php
				 								if($flagnuevotareot)
				 									echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
												floadtimehours();
				  							?>
   										  	</select>:<select name="minini">
                										<?php
												if($flagnuevotareot)
											 		echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
				 								floadtimeminut();
					 						?>
            											</select>
            											<input type="checkbox" name="pasadmerini" <?php if($flagnuevotareot){if($pasadmerini)echo "CHECKED";}?>>&nbsp;p.m									  </td>
								  </tr>
							
								   									<tr>
 										<td rowspan="3" valign="top" class="NoiseFooterTD"><?php if($flagnuevotareot && !$nota){ echo '<font color="Red"> *</font>';} ?>&nbsp;Nota</td>
 									<td colspan="3" rowspan="3">
 											<label>
 										  <textarea name="nota" cols="50"><?php echo $nota; ?></textarea>
 										</label>
 										</td>
 									</tr>
 									
						    </table>

 							</td>
 						
 						</tr>
 
 			<tr>
				<td><div align="center">
  					<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accionnuevotareot.value=1;"  width="86" height="18" alt="Aceptar" border=0>
  					<input type="image" name="cancelar"  src="../img/cancelar.gif" onClick="form1.action='maestabltareotserv.php';"  width="86" height="18" alt="Cancelar" border=0>
				</div></td>
 			</tr>
 			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
	  </table>
		<input type="hidden" name="flagnuevotareot">
		<input type="hidden" name="accionnuevotareot">
		<input type="hidden" name="ordtracodigo" value="<?php echo $ordtracodigo; ?>">
		<input type="hidden" name="tareacodigo" value="<?php echo $tareacodigo; ?>">
		<input type="hidden" name="prioricodigo" value="<?php echo $prioricodigo; ?>">
		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		<input type="hidden" name="ordtrafecini" value="<?php echo $ordtrafecgen; ?>">
		<input type="hidden" name="ordtrahorgen" value="<?php echo $ordtrahorgen; ?>">
	</form>
</body>
<?php	if(!$codigo){ echo " -->"; } ?>
</html>