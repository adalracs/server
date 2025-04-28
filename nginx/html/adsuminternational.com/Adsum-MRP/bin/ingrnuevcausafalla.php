<?php
	ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	if($accionnuevocausafalla)
	{ 
		include ( 'grabacausafalla.php');
	}
	ob_end_flush();
?> 
<html> 
	<head> 
		<title>Nuevo registro de Causa</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Causa de Falla</font></p>
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Ingresar Nuevo Registro</font></span></td></tr>
				<tr>
  					<td>
            			<table width="85%" border="0" cellspacing="1" cellpadding="1" align="center">
             				<tr>
             					<td width="41%" class="NoiseFooterTD"> <?php if($campnomb["caufallnombre"] == 1){ $caufallnombre=null; echo "*";} ?>Nombre</td>
               					<td width="59%" class="NoiseDataTD"><input type="text" name="caufallnombre"	value="<?php if(!$flagnuevocausafalla){ echo $sbreg[caufallnombre];}else {echo $caufallnombre;}?>"></td>
             				</tr>
             				<tr>
 								<td width="41%" class="NoiseFooterTD"> <?php if($campnomb["caufalldescri"] == 1){ $caufalldescri=null; echo "*";} ?>Descripci&oacute;n</td>
  								<td width="59%" class="NoiseDataTD" rowspan="2"><textarea name="caufalldescri" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevocausafalla){ echo $sbreg[caufalldescri];}else {echo $caufalldescri;}?></textarea></td>
 							</tr>
 							<tr class="NoiseFooterTD"><td class="NoiseFooterTD">&nbsp;</td></tr> 
						</table>
  					</td>
 				</tr>
 				<tr>
					<td><div align="center">
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionnuevocausafalla.value =  1;"  width="86" height="18" alt="Aceptar" border=0> 
  						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablcausafalla.php';"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
<?php if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';} ?>
 			<input type="hidden" name="caufallcodigo" value="<?php if(!$flagnuevocausafalla){ echo $sbreg[caufallcodigo];}else{ echo $caufallcodigo;} ?>">
			<input type="hidden" name="accionnuevocausafalla">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>
