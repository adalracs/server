<?php 
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblmedidoequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	
	$idcon = fncconn();
?> 
<html>
	<head>
		<title>Parametros de Informe - Servicios Solicitados por Areas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<script language="JavaScript" src="motofech.js"></script>
		<script type="text/javascript">
			/**
			 * Function reload
		 	 * Valida y emite mensaje o carga grafico
 	 		 */
			function reload()
			{
				var err = '';
				
				if(document.getElementById('medequcodigo').value == '')
					err = err + '* Debe especificar el Equipo/Medidor.\n';
				if(document.getElementById('consulfecfin').value == '' || document.getElementById('consulfecini').value == '')
					err = err + '* Debe especificar la fecha de inicio y fecha fin.';
				else if(document.getElementById('consulfecfin').value < document.getElementById('consulfecini').value)
					err = err + '* La fecha de inicio debe se mayor a la fecha fin.';

				if(err == '')
				{
					document.form1.action = 'detallagraconequi.php';
					document.form1.submit();
				}
				else
					alert('Error: \n' + err);

				return false;
			}
		</script>
	</head>
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Grafica de consumo de Equipo</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="NoiseFormTABLE" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr>
	  			<tr>
	    			<td>
	    				<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr> 
 								<td width="20%" class="NoiseFooterTD">*&nbsp;Equipo/Medidor</td> 
  								<td width="80%" class="NoiseDataTD"><select name="medequcodigo" id="medequcodigo">
					  				<option value = "">-- Seleccione --</option>
									<?php
						     			include ('../src/FunGen/floadmedicion.php');
						     			floadmedicion($medequcodigo,$idcon);
									?>
								</select></td>  
							</tr>
						</table>
					</td>
				</tr>	      			
	  			<tr>
	    			<td>
	    				<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr><td colspan="2" class="NoiseFooterTD">*&nbsp;Periodo</td></tr>
							<tr class="NoiseDataTD">
								<td>
									&nbsp;Desde&nbsp;&nbsp;
									<input type="text" name="consulfecini" id="consulfecini" size="8" onFocus="if (!agree)this.blur();">&nbsp;
	              					<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=consulfecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
								</td>
								<td>
									&nbsp;Hasta&nbsp;&nbsp;
									<input type="text" name="consulfecfin" id="consulfecfin" size="8" onFocus="if (!agree)this.blur();">&nbsp;
	              					<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=consulfecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
								</td>
							</tr>
						</table>
					</td>
				</tr>	      			
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center">
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="reload();"  width="86" height="18" alt="Aceptar" border=0>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>