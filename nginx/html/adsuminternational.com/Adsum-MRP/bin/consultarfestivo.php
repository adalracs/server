<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
?>
<html> 
	<head> 
		<title>Consultar en Festivos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript"> 
		
			/**
			 * Function getNumMonth
			 * Funcion unicamente para el funcionamiento del modulo festivos. Enlista los dias de un mes
			 * @param month
			 */
			function getNumMonth(month)
			{
				var date = new Date();
				var year = (document.getElementById('festivano').value == '' ? date.getFullYear : document.getElementById('festivano').value );
				var lastDays = [31,29,31,30,31,30,31,31,30,31,30,31];
				var last = 0;
				var objDay = document.getElementById('festivdia');
				
				objDay.length = 1;
				objDay.options[0] = new Option("-dia-", "", true, true);
				
				if (month == 2)
				{ 
					objdate = new Date(year, month - 1, 29); 
					objmonth =  objdate.getMonth(); 
					
					if(objmonth != (month - 1))
						last = 28;
				}
				else
					last = lastDays[(month - 1)];
				
				for( var i=1; i<=last; i++)
				{
					if(i < 10)
						objDay.options[i] = new Option("0" + i, i, false, false);
					else
						objDay.options[i] = new Option(i, i, false, false);
				}
			} 
		</script>		
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">D&iacute;as Festivos</font></p> 
			<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;Celebraci&oacute;n</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="festivnombre" id="festivnombre"  size="50" value="<?php echo $festivnombre; ?>"></td> 
 							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>							
							<tr>
     							<td class="NoiseFooterTD">&nbsp;Tipo</td>
     							<td class="NoiseDataTD"><select name="festivtipo" id="festivtipo">
									<option value = "">-- Seleccione --</option>
									<option value = "1" <?php if($festivtipo == 1) echo 'selected'; ?>>D&iacute;a c&iacute;vico</option>
									<option value = "2" <?php if($festivtipo == 2) echo 'selected'; ?>>Fiesta religiosa</option>
									<option value = "3" <?php if($festivtipo == 3) echo 'selected'; ?>>Semana santa</option>
									<option value = "4" <?php if($festivtipo == 4) echo 'selected'; ?>>Pascua</option>
								</select></td>
							</tr>
							<tr>
     							<td class="NoiseFooterTD">&nbsp;D&iacute;a</td>
     							<td class="NoiseDataTD"><select name="festivano" id="festivano">
									<option value = "">-Todos los a&ntilde;os-</option>
									<?php
										for($a = date("Y"); $a >= 2011; $a--):
											echo '<option value="'.$a.'"';
											if($a == $festivano)
												echo ' selected';
											echo '>'.$a.'</option>';
										endfor;
									?>
								</select>
								<select name="festivmes" id="festivmes" onChange="getNumMonth(this.value);">
									<option value = "">-mes-</option>
									<option value = "1" <?php if($festivmes == 1) echo 'selected'; ?>>Enero</option>
									<option value = "2" <?php if($festivmes == 2) echo 'selected'; ?>>Febrero</option>
									<option value = "3" <?php if($festivmes == 3) echo 'selected'; ?>>Marzo</option>
									<option value = "4" <?php if($festivmes == 4) echo 'selected'; ?>>Abril</option>
									<option value = "5" <?php if($festivmes == 5) echo 'selected'; ?>>Mayo</option>
									<option value = "6" <?php if($festivmes == 6) echo 'selected'; ?>>Junio</option>
									<option value = "7" <?php if($festivmes == 7) echo 'selected'; ?>>Julio</option>
									<option value = "8" <?php if($festivmes == 8) echo 'selected'; ?>>Agosto</option>
									<option value = "9" <?php if($festivmes == 9) echo 'selected'; ?>>Septiembre</option>
									<option value = "10" <?php if($festivmes == 10) echo 'selected'; ?>>Octubre</option>
									<option value = "11" <?php if($festivmes == 11) echo 'selected'; ?>>Noviembre</option>
									<option value = "12" <?php if($festivmes == 12) echo 'selected'; ?>>Diciembre</option>
								</select>
								<select name="festivdia" id="festivdia">
									<option value = "">-dia-</option>
									<?php
										if($festivmes):
											$festivano == "" ? $year = date("Y") : $year = $festivano;
											
											$lastDay = date("t", strtotime($year.'-'.$festivmes));
											
											for($a = 1; $a <= $lastDay; $a++):
												echo '<option value = "'.$a.'"';
												if($a == $festivdia)
													echo ' selected';
												echo '>';
												
												if($a < 10) 
													echo '0'.$a;
												else
													echo $a;
												
												echo '</option>';
											endfor;
										endif;
									?>
								</select></td>
							</tr>
							<tr><td class="NoiseDataTD" colspan="2"><input type="checkbox" name="festivmovdia" id="festivmovdia" <?php if($festivmovdia) echo 'checked'; ?> value="1">Trasladarlo de su fecha original, al lunes siguiente</td></tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>							
 							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["festivdescri"] == 1){ $festivdescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="festivdescri" id="festivdescri" rows="3" cols="50" wrap="VIRTUAL"><?php if(!$flagnuevofestivo){echo $sbreg[festivdescri];}else {echo $festivdescri;}?></textarea></td></tr>
						</table>
  					</td> 
 				</tr> 
 				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
 			<input type="hidden" name="flagconsultarfestivo" value="1"> 
			<input type="hidden" name="accionconsultarfestivo">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="festivcodigo,festivnombre,festivdescri,festivdia,festivmes,festivano,festivtodano,festivmovdia,festivtipo"> 
			<input type="hidden" name="nombtabl" value="festivo"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>