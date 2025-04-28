<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblestado.php');
?> 
<html> 
	<head> 
		<title>Consultar registro en equipo temporal</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				$("#equtemfeccom").datepicker({changeMonth: true,changeYear: true});
				$("#equtemfeccom").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#equtemfeccom").datepicker($.datepicker.regional['es']);
				<?php if($equtemfeccom): ?>$("#equtemfeccom").datepicker("setDate", '<?php echo $equtemfeccom; ?>');<?php endif ?>
				
				$("#equtemfecins").datepicker({changeMonth: true,changeYear: true});
				$("#equtemfecins").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#equtemfecins").datepicker($.datepicker.regional['es']);
				<?php if($equipofecins): ?>$("#equtemfecins").datepicker("setDate", '<?php echo $equtemfecins; ?>');<?php endif ?>
				
				$("#equtemvengar").datepicker({changeMonth: true,changeYear: true});
				$("#equtemvengar").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#equtemvengar").datepicker($.datepicker.regional['es']);
				<?php if($equtemvengar): ?>$("#equtemvengar").datepicker("setDate", '<?php echo $equtemvengar; ?>');<?php endif ?>
			});

			function setEquCompleteSource()
			{
			    $("#equiponombre").autocomplete({ source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_equipolist.php?id=" + document.getElementById('idusua').value + "&sistemcodigo="  + document.getElementById('sistemcodigo').value });
			}
		</script>
		<style type="text/css">
			select, #equtemnombre {font-size: 12px;}
		</style>		
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Equipo temporal</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="600"> 
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
        				<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
        					<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;C&oacute;digo SRF</td> 
								<td width="85%" class="NoiseDataTD"><input name="equtemcodigo" type="text"	value="<?php echo $equtemcodigo; ?>" size="30"></td>
							</tr>
							<tr>
			            		<td class="NoiseFooterTD">&nbsp;Nombre</td>
			            		<td class="NoiseDataTD"><input name="equtemnombre"  id="equtemnombre" type="text"	value="<?php echo $equtemnombre; ?>" size="70"></td>
   							</tr>
   							<tr> 	
            					<td class="NoiseFooterTD">&nbsp;Estado</td>
            					<td class="NoiseDataTD"><select name="estadocodigo">
              						<option value ="">-- Seleccione --</option>
              						<?php
										include ('../src/FunGen/floadestado.php');
										$idcon = fncconn();
										floadestado($estadocodigo,$idcon);
										fncclose($idcon);
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
          						<td width="15%" class="NoiseFooterTD">&nbsp;Fabricante</td>
            					<td width="35%" class="NoiseDataTD"><input name="equtemfabric" type="text"	value="<?php echo $equtemfabric; ?>" size="20"></td>
            					<td width="15%" class="NoiseFooterTD">&nbsp;Marca</td>
            					<td width="35%" class="NoiseDataTD"><input name="equtemmarca" type="text"	value="<?php echo $equtemmarca; ?>" size="20"> </td>
          					</tr>
          					<tr> 
          						<td class="NoiseFooterTD">&nbsp;Modelo</td>
            					<td class="NoiseDataTD"><input name="equtemmodelo" type="text"	value="<?php echo $equtemmodelo; ?>" size="20"> </td>
            					<td class="NoiseFooterTD">&nbsp;No. serie</td>
            					<td class="NoiseDataTD"><input name="equtemserie" type="text"	value="<?php echo $equtemserie; ?>" size="20"> </td>
          					</tr>
          					<tr> 
            					<td class="NoiseFooterTD">&nbsp;No. inventario</td>
            					<td class="NoiseDataTD"><input name="equtempcinv" type="text"	value="<?php echo $equtempcinv; ?>" size="20"> </td>          							
            					<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
            					<td class="NoiseDataTD"><input name="equtemubicac" type="text"	value="<?php echo $equtemubicac; ?>" size="20"> </td>

          					</tr>
          					<tr> 
            					<td class="NoiseFooterTD">&nbsp;Vida &uacute;til</td>
            					<td class="NoiseDataTD"><input name="equtemviduti" type="text"	value="<?php echo $equtemviduti; ?>" size="17"> </td>
            					<td class="NoiseFooterTD">&nbsp;Fecha compra</td>
            					<td class="NoiseDataTD"><input type="text" name="equtemfeccom" id="equtemfeccom" size="14"></td>
          					</tr>
          					<tr> 
          						<td class="NoiseFooterTD">Fec. instalaci&oacute;n</td>
            					<td class="NoiseDataTD"><input type="text" name="equtemfecins" id="equtemfecins" size="14"></td>
            					<td class="NoiseFooterTD">&nbsp;Venc. garant&iacute;a</td>
            					<td class="NoiseDataTD"><input type="text" name="equtemvengar" id="equtemvengar" size="14"></td>
          					</tr>
          					<tr><td class="ui-state-default" colspan="4"></td></tr>
          					<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Descripci&oacute;n</td></tr>
          					<tr><td colspan="4" class="NoiseDataTD"><textarea name="equtemdescri" rows="3" wrap="VIRTUAL" cols="68"><?php echo $equtemdescri; ?></textarea></td></tr>
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
	 		<input type="hidden" name="flagconsultarequipotemp" value="1"> 
			<input type="hidden" name="accionconsultarequipotemp">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="equtemcodigo,
estadocodigo,
sistemcodigo,
cencoscodigo,
equtemnombre,
equtemdescri,
equtemfabric,
equtemmarca,
equtemmodelo,
equtemserie,
equtemlargo,
equtemancho,
equtemalto,
equtempeso,
equtemvolta,
equtemcorrie,
equtempoten,
equtemfeccom,
equtemcinv,
equtemvengar,
equtemviduti,
equtemfecins,
equtemubicac,
equtemvalhor,
equtemnohs,
equtemacti,
equtemtipo,
equtemnpas,
contracodigo,
tipequcodigo"> 
			<input type="hidden" name="nombtabl" value="equipotemp"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>