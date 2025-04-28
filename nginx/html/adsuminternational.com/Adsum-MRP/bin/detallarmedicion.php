<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblmedidoequipo.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktbltipomedi.php');

if(!$flagdetallarmedicion){

	if ($radiobutton){
		$idcon = fncconn();
		$sbregmedidoequipo = loadrecordmedidoequipo($radiobutton,$idcon);
		
		$sbregequiponombre = loadrecordequipo($sbregmedidoequipo[equipocodigo],$idcon);
		$sbregtipomednombre = loadrecordtipomedi($sbregmedidoequipo[tipmedcodigo],$idcon);
	}else{
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
		<title>Detalle de registro de medicion</title> 
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
		if(!$codigo){ echo "<!--";}
	?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Medici&oacute;n</font></p> 
			<table width="500" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            					<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="30%" class="NoiseDataTD">Equipo</td> 
 								<td width="70%"><?php echo $sbregequiponombre[equiponombre]; ?> </td> 
 							</tr> 
							<tr> 
 								<td width="30%" class="NoiseDataTD">Tipo de Medidor</td> 
 								<td width="70%"><?php echo $sbregtipomednombre[tipmednombre]; ?> </td> </td> 
 							</tr> 
 							<tr> 
  								<td width="30%">&nbsp;</td> 
 							</tr> 
 							<!--Detalle-->
      		  					<tr>
	  	  						<td colspan="6" align="center">
	  	  		 					 <table width="100%" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="White">
	  	  								<tr>
					  						<td bgcolor="White"><iframe src="detallemedicion.php?medequcodigo=<?php echo $radiobutton;?>" frameborder="0" name="detallemedicion" frameborder="0"  height="200" width="100%" align="absmiddle"></iframe></td>
	  	  								</tr>
				 					</table>	  	  		
				  				</td>
			 				 </tr>
							<!--Consola detalle-->
						</table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td> 
						<div align="center">
  							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.action='maestablmedicion.php';"  width="86" height="18" alt="Aceptar" border=0> 
						</div> 
					</td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallarmedicion" value="1"> 
			<input type="hidden" name="acciondetallarmedicion"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
	<?php if(!$codigo){ echo " -->"; }?> 
</html> 
