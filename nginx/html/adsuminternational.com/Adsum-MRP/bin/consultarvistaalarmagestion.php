<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblvistaalarmagestion.php');
	include ( '../src/FunPerPriNiv/pktbltipoalarma.php');
	include ( '../src/FunPerPriNiv/pktblnivelalarma.php');
	include ( '../src/FunPerPriNiv/pktblalarma.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include "../src/FunGen/cargainput.php";
	
	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Consultar Registro de Alarma</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				//ObjDatepicker
				$("#alarmafecelb").datepicker({changeMonth: true,changeYear: true});
				$("#alarmafecelb").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#alarmafecelb").datepicker($.datepicker.regional['es']);
				
				$("#modulonombre").autocomplete({
					source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_modulo.php",
					minLength: 1,
					select: function(event, ui) {
						ui.item ? document.getElementById('modulonombre').value = ui.item.id : document.getElementById('modulonombre').value = "";
					}
				});
		
				$("#alarmafecelb").datepicker("setDate","<?php echo $alarmafecelb ?>");			
		 });
		</script>
		
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Alarma</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr>
  				  <td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
		    <tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Fecha Elaboracion</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="alarmafecelb" size="30" id="alarmafecelb"	value="<?php echo $alarmafecelb; ?>"></td> 
 							</tr>
 							
 							<tr>						
								<td width="17%" class="NoiseFooterTD">&nbsp;Tipo Restriccion</td>
								<td width="83%" class="NoiseDataTD"><select name="tipoalacodigo" id="estalacodigo"> 
								<option value="">--Seleccione--</option>
								<?php 
									//$idcon = fncconn();
									include "../src/FunGen/floadtipoalarma.php";
									floadtipoalarma($tipoalacodigo,$idcon)
								?>
								</select> 
								</td>
 							</tr>
 							
 							<tr>						
								<td width="17%" class="NoiseFooterTD">&nbsp;Nivel</td>
								<td width="83%" class="NoiseDataTD"><select name="nivalacodigo" id="nivalacodigo"> 
								<option value="">--Seleccione--</option>
								<?php 
									
									include "../src/FunGen/floadnivelalarma.php";
									floadnivelalarma($nivalacodigo,$idcon)
								?>
								</select> 
								</td>
 							</tr>
                            
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Modulo Responsable</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="modulos_respo" id="modulonombre" size="30"	value="<?php echo $modulos_respo; ?>" ></td> 
 							</tr>
                            
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Usuario</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="usuanombre" size="30"	value="<?php echo $usuanombre; ?>"></td> 
 							</tr>
 							
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
 			<input type="hidden" name="flagconsultarvistaalarmagestion" value="1"> 
			<input type="hidden" name="accionconsultarvistaalarmagestion"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="alarmafecelb, tipoalacodigo, nivalacodigo, usuanombre, modulos_respo ">
			<input type="hidden" name="nombtabl" value="vistaalarmagestion"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>