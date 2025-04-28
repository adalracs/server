<?php 
include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncclose.php');
include('../src/FunPerSecNiv/fncnumreg.php');
include('../src/FunPerSecNiv/fncfetch.php');
include('../src/FunPerPriNiv/pktblcentcost.php');
?> 
<html> 
<head> 
<title>Consultar Herramienta</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
	<form name="form1" method="post"  enctype="multipart/form-data"> 
	<p><font class="NoiseFormHeaderFont">Herramientas</font></p> 
		<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
  			<tr> 
    			<td width="390" class="NoiseErrorDataTD">&nbsp;</td> 
  			</tr> 
  			<tr> 
          		<td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td>
          	</tr> 
			<tr> 
  				<td> 
            		<table width="97%" border="0" cellspacing="1" cellpadding="1" align="center"> 
						<tr> 
 							<td>C&oacute;digo</td> 
  							<td><input type="text" name="herramcodigo"	value="<?php if(!$flagconsultarherramie){ echo $sbreg[herramcodigo];}else{ echo $herramcodigo;} ?>" size="15"></td> 
 						</tr> 
             			<tr>
                			<td width="20%">Nombre</td>
                			<td colspan="3"><input name="herramnombre" type="text"	value="<?php if(!$flagconsultarherramie){ echo $sbreg[herramnombre];} else {echo $herramnombre;}?>" size="30"></td>
              			</tr>
            			<tr>
				 			<td width="20%">C&oacute;digo financiero</td>
				 			<td colspan="3"><select name="cencoscodigo">
				 				<option value="">Seleccione</option>
				 				<?php
									include ('../src/FunGen/floadcentcost.php');
									$idcon = fncconn();
									floadcentcost($idcon);
									fncclose($idcon);
								 ?></select>
							</td>
						</tr>
						<tr>
                			<td width="20%">Valor</td>
                			<td colspan="3"><input type="text" name="herramvalor"	value="<?php if(!$flagconsultarherramie){ echo $sbreg[herramvalor];} else {echo $herramvalor;}?>" size="15"></td>
              			</tr>
              			<tr>
                			<td width="20%">Cantidad disponible</td>
                			<td colspan="3"><input type="text" name="herramdispon"	value="<?php if(!$flagconsultarherramie){ echo $sbreg[herramdispon];} else {echo $herramdispon;}?>" size="15"></td>
              			</tr>
             			<tr> 
 							<td width="20%">Descripci&oacute;n</td> 
  							<td colspan="3" rowspan="2"><textarea name="herramdescri" cols="30" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarherramie){ echo $sbreg[herramdescri];} else {echo $herramdescri;}?></textarea></td> 
 						</tr>
              		</table> 
  				</td> 
 			</tr> 
 			<tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarherramie.value =  1; 
form1.action='maestablherramietransac.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
<input type="image" name="nuevo"  src="../img/cancelar.gif"
onclick="window.close();"  width="86" height="18" 
alt="Cancelar" border=0>
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarherramie" value="1"> 
<input type="hidden" name="accionconsultarherramie"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="herramcodigo, 
cencoscodigo, 
herramnombre, 
herramvalor, 
herramdescri, 
herramdispon 
"> 
<input type="hidden" name="nombtabl" value="herramie"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
