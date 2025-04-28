<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblotestadoot.php'); 
include ( '../src/FunPerPriNiv/pktblotestado.php'); 
if($accionborrarotestado) 
{ 
	include ( 'borraotestado.php'); 
} 
if(!$flagborrarotestado) 
{ 
	//include ( '../src/FunGen/sesion/fnccarga.php'); 
	$nuconn = fncconn();
	$sbreg = loadrecordotestado(intval($radiobutton),$nuconn); 
	fncclose($nuconn);
	if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
} 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Borrar registro de otestado</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
	<form name="form1" method="post"  enctype="multipart/form-data"> 
	<p><font class="NoiseFormHeaderFont">Estados de OT</font></p> 
	<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
  	<tr> 
    	<td class="NoiseErrorDataTD">&nbsp;</td> 
  	</tr> 
  	<tr> 
   		<td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td>
   	</tr> 
	<tr> 
  		<td> 
			<table width="85%" border="0" cellspacing="0" cellpadding="3" align="center"> 
          		<tr> 
                	<td width="41%"></td> 
					<td width="59%"></td>
				</tr> 
				<tr> 
 					<td width="41%">C&oacute;digo</td> 
 					<td width="59%"> 
  						<input type="text" name="otestacodigo" value="<?php if(!$flagborrarotestado){ echo $sbreg[otestacodigo];} ?>" onFocus="if (!agree)this.blur();" > 
 					</td> 
 				</tr> 
				<tr> 
 					<td width="41%">Nombre</td> 
 					<td width="59%"> 
  						<input type="text" name="otestanombre" value="<?php if(!$flagborrarotestado){ echo $sbreg[otestanombre];} ?>" onFocus="if (!agree)this.blur();" > 
 					</td> 
 				</tr> 
				<tr> 
	 					<td width="41%">Descripci&oacute;n</td> 
	 					<td width="59%"> 
	   						<textarea name="otestadescri" rows="3" cols="40" wrap="VIRTUAL"  onFocus="if (!agree)this.blur();"><?php if(!$flagborrarotestado){$sbreg[otestadescri];}else {echo $otestadescri;}?></textarea>
						</td> 
	 				</tr>
					<tr> 
	 					<td width="41%">Estado</td>
	 					<td width="59%" rowspan="2"> 
	   						<table width="100" border="0" cellpadding="0" cellspacing="0">
						   		<tr>
								     <td height="30" width="41%">Creada</td>
								     <td height="30"><input type="radio" name="otestatipo" value="1" <?php if(!$flagborrarotestado){ if($sbreg[otestatipo] == 1) echo "CHECKED";} ?>></td>
								     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								     <td height="30" width="41%">Ejecuci&oacute;n</td>
								     <td height="30"><input type="radio" name="otestatipo" value="2" <?php if(!$flagborrarotestado){ if($sbreg[otestatipo] == 2) echo "CHECKED";} ?>></td>
								     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								     <td height="30" width="41%">Reportada</td>
								     <td height="30"><input type="radio" name="otestatipo" value="3" <?php if(!$flagborrarotestado){ if($sbreg[otestatipo] == 3) echo "CHECKED";} ?>></td>
								</tr>
						   		<tr>
								     <td height="30" width="59%">Cerrada</td>
								     <td height="30"><input type="radio" name="otestatipo" value="4" <?php if(!$flagborrarotestado){ if($sbreg[otestatipo] == 4) echo "CHECKED";} ?>></td>
								     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								     <td height="30" width="59%">Anulada</td>
								     <td height="30"><input type="radio" name="otestatipo" value="5" <?php if(!$flagborrarotestado){ if($sbreg[otestatipo] == 5) echo "CHECKED";} ?>></td>
								     <td colspan="3"></td>
								</tr>
						    </table>
						</td> 
	 				</tr>
				</table> 
  			</td> 
 		</tr> 
		<tr> 
			<td>
				<div align="center">
	  			<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionborrarotestado.value =  1; "  width="86" height="18" alt="Aceptar" border=0> 
	  			<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablotestado.php';"  width="86" height="18" alt="Cancelar" border=0> 
				</div> 
			</td> 
	 	</tr> 
	 	<tr> 
	  		<td class="NoiseErrorDataTD">&nbsp;</td> 
	 	</tr> 
	</table> 
	<input type="hidden" name="flagborrarotestado" value="1"> 
	<input type="hidden" name="accionborrarotestado"> 
	<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
	</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
