<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktbltipoequipo.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblestado.php');
	include ( '../src/FunPerPriNiv/pktblcentcost.php');
?> 
<html> 
	<head> 
		<title>Consultar registro en equipo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				//Botones Visor Tecnicos
				/**
				 * Boton Tecnico Mantenedor
				 */
				$('#manttecnico').button({ icons: { primary: "ui-icon-person" } }).click(function() {
					window.open('maestablusuariequipo.php?codigo=<?php echo $codigo?>','usuariequipo','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
					return false;
				});

				$("#equipofeccom").datepicker({changeMonth: true,changeYear: true});
				$("#equipofeccom").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#equipofeccom").datepicker($.datepicker.regional['es']);
				<?php if($equipofeccom): ?>$("#equipofeccom").datepicker("setDate", '<?php echo $equipofeccom; ?>');<?php endif ?>
				
				$("#equipofecins").datepicker({changeMonth: true,changeYear: true});
				$("#equipofecins").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#equipofecins").datepicker($.datepicker.regional['es']);
				<?php if($equipofecins): ?>$("#equipofecins").datepicker("setDate", '<?php echo $equipofecins; ?>');<?php endif ?>
				
				$("#equipovengar").datepicker({changeMonth: true,changeYear: true});
				$("#equipovengar").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#equipovengar").datepicker($.datepicker.regional['es']);
				<?php if($equipovengar): ?>$("#equipovengar").datepicker("setDate", '<?php echo $equipovengar; ?>');<?php endif ?>
			});

			function setEquCompleteSource()
			{
			    $("#equiponombre").autocomplete({ source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_equipolist.php?id=" + document.getElementById('idusua').value + "&sistemcodigo="  + document.getElementById('sistemcodigo').value });
			}
		</script>
		<style type="text/css">
			select, #equiponombre {font-size: 12px;}
		</style>		
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Equipo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="600"> 
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr> 
				<tr> 
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  							<tr> 
            					<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n / Proceso</td>
            					<td class="NoiseDataTD"><select name="sistemcodigo" id="sistemcodigo" onchange="setEquCompleteSource();">
              						<option value ="">-- Seleccione --</option>
              						<?php
              							$idcon = fncconn();
										include ('../src/FunGen/floadsistema.php');
										floadsistema($sistemcodigo,$idcon);
									?>
            					</select></td>
          					</tr>
  							<tr> 	
            					<td class="NoiseFooterTD" width="15%">&nbsp;Tipo equipo</td>
            					<td class="NoiseDataTD" width="85%"><select name="tipequcodigo" id="tipequcodigo">
              						<option value ="">-- Seleccione --</option>
              						<?php
										include ('../src/FunGen/floadtipoequipo.php');
										floadtipoequipo($idcon, $tipequcodigo);
									?>
            					</select></td>
          					</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo SIGMA</td>
								<td class="NoiseDataTD"><input name="equipocodigo" id="equipocodigo" type="text"	value="<?php echo $equipocodigo; ?>" size="30"> </td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo SRF</td> 
								<td class="NoiseDataTD"><input name="codigosrf" type="text"	value="<?php echo $codigosrf; ?>" size="30"></td>
							</tr>
							<tr>
			            		<td class="NoiseFooterTD">&nbsp;Nombre&nbsp;<img src="../img/icon_filter.png" border=0></td>
			            		<td class="NoiseDataTD">
			            			<input name="equiponombre" id="equiponombre" type="text" value="<?php echo $equiponombre; ?>" size="70">
			            			<input type="hidden" name="idusua" id="idusua" value="<?php echo $usuacodi ?>">
			            			<script type="text/javascript">
				            			$("#equiponombre").autocomplete({
	            							source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_equipolist.php?id=" + document.getElementById('idusua').value + "&sistemcodigo="  + document.getElementById('sistemcodigo').value,
	            							minLength: 1,
	            							select: function(event, ui) {
	            								ui.item ? document.getElementById('equipocodigo').value = ui.item.id : document.getElementById('equipocodigo').value = "";
	            							}
	            						});
			            			</script>
			            		</td>
          					</tr>
							<tr> 
								<td class="NoiseFooterTD"><div class="ui-buttonset"><button id="manttecnico">Mantenedor</button></div></td>
								<td class="NoiseDataTD"><input name="usuanombre" type="text"	value="<?php echo $usuanombre; ?>" size="50" onFocus="this.blur();"></td>
							</tr>
          					<tr> 	
            					<td class="NoiseFooterTD">&nbsp;Estado</td>
            					<td class="NoiseDataTD"><select name="estadocodigo" id="estadocodigo">
              						<option value ="">-- Seleccione --</option>
              						<?php
										include ('../src/FunGen/floadestado.php');
										floadestado($estadocodigo,$idcon);
									?>
            					</select></td>
          					</tr>
          					<tr> 
            					<td class="NoiseFooterTD">&nbsp;Centro de costo</td>
            					<td class="NoiseDataTD"><select name="cencoscodigo" id="cencoscodigo">
                					<option value ="">-- Seleccione --</option>
                					<?php
										include ('../src/FunGen/floadcentcost.php');
										floadcentcost($cencoscodigo,$idcon);
									?>
              					</select></td>
          					</tr>
          				</table>
          			</td>
          		</tr>
          		<tr> 
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
          					<tr> 
          						<td class="NoiseFooterTD" width="20%">&nbsp;Fabricante</td>
            					<td class="NoiseDataTD" width="30%"><input name="equipofabric" type="text" value="<?php echo $equipofabric; ?>" size="20"></td>
            					<td class="NoiseFooterTD" width="20%">&nbsp;Marca</td>
            					<td class="NoiseDataTD" width="30%"><input name="equipomarca" type="text"	value="<?php echo $equipomarca; ?>" size="20"> </td>
          					</tr>
          					<tr> 
          						<td class="NoiseFooterTD">&nbsp;Modelo</td>
            					<td class="NoiseDataTD">  <input name="equipomodelo" type="text"	value="<?php echo $equipomodelo; ?>" size="20"> </td>
            					<td class="NoiseFooterTD">&nbsp;No. serie</td>
            					<td class="NoiseDataTD"><input name="equiposerie" type="text"	value="<?php echo $equiposerie; ?>" size="20"> </td>
          					</tr>
          					<tr>
          						<td class="NoiseFooterTD">&nbsp;Nivel de tensi&oacute;n</td>
								<td class="NoiseDataTD"><input name="equiponivten" type="text"	value="<?php echo $equiponivten; ?>" size="20"></td>
            					<td class="NoiseFooterTD">&nbsp;Vida &uacute;til</td>
            					<td class="NoiseDataTD"><input name="equipoviduti" type="text"	value="<?php echo $equipoviduti; ?>" size="17"> </td>
            				</tr>
            				<tr>	
            					<td class="NoiseFooterTD">&nbsp;No. inventario</td>
            					<td class="NoiseDataTD"><input name="equipocinv" type="text"	value="<?php echo $equipocinv; ?>" size="20"> </td>          							
            					<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
            					<td class="NoiseDataTD"><input name="equipoubicac" type="text"	value="<?php echo $equipoubicac; ?>" size="20"> </td>
            				</tr>
            				<tr>
            					<td class="NoiseFooterTD">&nbsp;Fecha compra</td>
            					<td class="NoiseDataTD"><input type="text" name="equipofeccom"	id="equipofeccom" size="14"></td>
          						<td class="NoiseFooterTD">&nbsp;Fecha instalaci&oacute;n</td>
            					<td class="NoiseDataTD"><input type="text" name="equipofecins"	id="equipofecins" size="14"></td>
            				<tr>
            					<td class="NoiseFooterTD">&nbsp;Venc. garant&iacute;a</td>
            					<td class="NoiseDataTD"><input type="text" name="equipovengar" id="equipovengar" size="14"></td>
            					<td class="NoiseFooterTD" colspan="2"></td>
          					</tr>
          					<tr>
								<td class="NoiseFooterTD">&nbsp;NPAS </td>
								<td class="NoiseDataTD"><input name="equiponpas" type="text"	value="<?php echo $equiponpas; ?>" size="20"></td>
								<td class="NoiseFooterTD" colspan="2"></td>
          					</tr>
          					<tr><td class="ui-state-default" colspan="4"></td></tr>
          					<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Descripci&oacute;n</td></tr>
          					<tr><td colspan="4" class="NoiseDataTD"><textarea name="equipodescri" rows="3" wrap="VIRTUAL" cols="68"><?php echo $equipodescri; ?></textarea></td></tr>
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
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 			
	 		<input name="usuacodigo" type="hidden"	value="<?php echo $usuacodigo; ?>">
	 		<input type="hidden" name="flagconsultarequipo" value="1"> 
			<input type="hidden" name="accionconsultarequipo"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="equipocodigo,
estadocodigo,
sistemcodigo,
cencoscodigo,
equiponombre,
equipodescri,
equipofabric,
equipomarca,
equipomodelo,
equiposerie,
equipolargo,
equipoancho,
equipoalto,
equipopeso,
equipovolta,
equipocorrie,
equipopoten,
equipofeccom,
equipocinv,
equipovengar,
equipoviduti,
equipofecins,
equipoubicac,
equipovalhor,
equiponohs,
equipoacti,
equipotipo,
codigosrf,
equiponpas,
equiponivten,
tipequcodigo,
usuacodigo"> 
			<input type="hidden" name="nombtabl" value="equipo"> 
			<input type="hidden" name="usuequcodigo" value="<?php echo $usuequcodigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>