<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	$idcon = fncconn();
?> 
<html> 
	<head> 
		<title>Consultar en Programacion Equipo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin 
			agree = 0; 
			//  End --> 
		</script> 
		<script language="JavaScript" src="motofech.js"></script> 
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript"></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript"></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Programaci&oacute;n Equipo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="NoiseFormTABLE" width="80%"> 
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
        						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
          						<!--DWLayoutTable-->
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo Equipo</td>
								<td width="30%" class="NoiseFooterTD"><input name="equipocodigo1" type="text"	value="<?php echo $equipocodigo; ?>" size="14"></td>
								<td width="20%" class="NoiseFooterTD">C&oacute;digo programaci&oacute;n</td>
								<td width="30%" class="NoiseFooterTD"><input name="progracodigo" type="text"	value="<?php echo $progracodigo; ?>" size="14"></td>
							</tr>
							<tr>
					            		<td width="20%" class="NoiseFooterTD">&nbsp;Planta</td>
					            		<td colspan="3" class="NoiseFooterTD"><select name="plantacodigo" onChange="cargarSistemas(this.value);">
								<?php
									echo '<option value = "">-- Seleccione --</option>';
									
									include ('../src/FunGen/floadplanta.php');
									floadplanta($plantacodigo,$idcon);
								?>
								</select></td>
          							</tr>							
          							<tr>
					            		<td width="20%" class="NoiseFooterTD">&nbsp;Proceso</td>
					            		<td colspan="3" class="NoiseFooterTD"><select name="sistemcodigo" onChange="cargarEquipos(this.value);">
              							<?php
            								echo '<option value="">-- Seleccione --</option>';

									include ('../src/FunGen/floadsistemaot.php');
									floadsistemaot($sistemcodigo,$plantacodigo,$idcon);
            							?>
            							</select></td>
          							</tr>							<tr>
					            		<td width="20%" class="NoiseFooterTD">&nbsp;Equipo</td>
					            		<td colspan="3" class="NoiseFooterTD"><select name="equipocodigo"  onChange="document.form1.equipocodigo1.value = this.value;">
          								<?php
	    								echo '<option value="">-- Seleccione --</option>';
					
									include ('../src/FunGen/floadequipoot.php');
									floadequipoot($equipocodigo, $sistemcodigo,$idcon);
	    							?>
        								</select></td>
          							</tr>
          							<tr>
					            		<td width="20%" class="NoiseFooterTD">&nbsp;Tipo Mantenimiento</td>
					            		<td colspan="3" class="NoiseFooterTD"><select name="tipmancodigo">
								<?php
			  						echo '<option value="">-- Seleccione --</option>';
									
									include ('../src/FunGen/floadtipomant.php');
									floadtipomant($tipmancodigo,$idcon);
								?>
								</select></td>
          							</tr>
          							<tr>
					            		<td width="20%" class="NoiseFooterTD">&nbsp;Tipo trabajo</td>
					            		<td colspan="3" class="NoiseFooterTD"><select name="tiptracodigo">
								<?php
			  						echo '<option value="">-- Seleccione --</option>';
									
									include ('../src/FunGen/floadtipotrab.php');
									floadtipotrab($tiptracodigo,$idcon);
								?>
								</select></td>
          							</tr>
        						</table>  
  					</td> 
 				</tr> 
 				<tr> 
					<td> 
						<div align="center"> 
  							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionconsultarvistaprogramm.value =  1; form1.action='maestablprogramacionequipos.php';"  width="86" height="18" alt="Aceptar" border=0> 
  							<input type="image" name="cancelar" src="../img/cancelar.gif" onclick=" form1.action='maestablprogramacionequipos.php';"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
	 		<input type="hidden" name="flagconsultarprogramacionequipos" value="1"> 
			<input type="hidden" name="accionconsultarvistaprogramm"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="plantacodigo,
			sistemcodigo,
			equipocodigo,
			tipmancodigo,
			tiptracodigo,
			progracodigo
			"> 
			<input type="hidden" name="nombtabl" value="vistagrupprogram"> 
		</form> 
	</body> 
<?php 
	if(!$codigo){ echo " -->"; } 
	fncclose($idcon);
?> 
</html> 
