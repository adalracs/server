<?php 
   	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	 
   	include('../src/FunPerPriNiv/pktblcargo.php');
   	include( '../src/FunPerPriNiv/pktblciudad.php');
	include( '../src/FunPerPriNiv/pktbldepartamento.php');
	include('../src/FunPerPriNiv/pktbldepartam.php');
	include('../src/FunPerPriNiv/pktbltipousuario.php');
	
	$idcon = fncconn();
	
	$flagcheck = 1;
	
	if($id)
		$arr_borrar = str_replace(',','|n,', $id).'|n';
	
?> 
<html> 
	<head> 
		<title>Consultar en usuario</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="#FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Usuario</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Consultar usuario</font></span></td></tr>
  				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
       						<tr class="NoiseErrorDataTD">	
								<td width="20%">&nbsp;Registro</td>
       							<td><input name="usuacodigo" type="text" value="<?php echo $usuacodigo; ?>" size="14"></td>
        					</tr>
          					<tr>
            					<td class="NoiseFooterTD">&nbsp;Tipo de usuario</td>
            					<td class="NoiseDataTD"><select name="tipusucodigo">
            						<option value = "">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadtipousuario.php');
										floadtipousuario($tipusucodigo,$idcon);
									?>
    							</select></td>
          					</tr>
          					<tr>
            					<td class="NoiseFooterTD">&nbsp;Depart&aacute;mento</td>
            					<td class="NoiseDataTD"><select name="departcodigo">
            						<option value = "">-- Seleccione --</option>
	            					<?php
										include ('../src/FunGen/floaddepartam.php');
										floaddepartamnegocio($departcodigo, $negocicodigo, $idcon);
									?>
            					</select></td>
          					</tr>   
       					</table>
       				</td>
       			</tr>
    			<tr>
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
      						<tr><td class="ui-state-default">&nbsp;Datos Basicos</td></tr>
      						<tr>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
										<tr class="NoiseErrorDataTD">
			           						<td>&nbsp;No. de Identidad</td>
			           						<td colspan="3"><input name="usuadocume" type="text" value="<?php echo $usuadocume; ?>" size="20" onkeypress="if(event.keyCode < 45 || event.keyCode > 57){ event.returnValue = false; }"></td>
			     						</tr>  
			   							<tr>
			           						<td class="NoiseFooterTD" width="20%">&nbsp;Nombre</td>
			           						<td class="NoiseDataTD" width="30%"><input name="usuanombre" type="text" value="<?php echo $usuanombre; ?>" size="25"></td>
			           						<td class="NoiseFooterTD" width="20%">&nbsp;Apellido</td>
			           						<td class="NoiseDataTD" width="30%"><input name="usuapriape" type="text" value="<?php echo $usuapriape; ?>" size="25"></td>
			      						</tr>
			      						<tr>
			           						<td class="NoiseFooterTD">&nbsp;Seg. Apellido</td>
			           						<td class="NoiseDataTD" colspan="3"><input name="usuasegape" type="text" value="<?php echo $usuasegape; ?>" size="25"></td>
			           					</tr>
			           					<tr>
			           						<td class="NoiseFooterTD">&nbsp;Cargo</td>
			           						<td class="NoiseDataTD" colspan="3"><select name="cargocodigo1">
			            						<option value = "">-- Seleccione --</option>
				              					<?php
													include ('../src/FunGen/floadcargo.php');
													floadcargo($cargocodigo1,$idcon);
												?>
			            					</select></td>
			           					</tr>
									</table>
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			           					<tr>
			           						<td class="NoiseFooterTD" width="20%">&nbsp;Tel&eacute;fono</td>
			           						<td class="NoiseDataTD" width="30%"><input name="usuatelefo" type="text" value="<?php echo $usuatelefo; ?>" size="20"></td>
           	           						<td class="NoiseFooterTD" width="20%">&nbsp;Celular</td>
           									<td class="NoiseDataTD" width="30%"><input name="usuatelef2" type="text" value="<?php echo $usuatelef2; ?>" size="20"></td>
			       						</tr>
			         					<tr>
			           						<td class="NoiseFooterTD">&nbsp;E-mail</td>
			           						<td class="NoiseDataTD" colspan="3"><input name="usuaemail" type="text" value="<?php echo $usuaemail; ?>" size="46">            </td>
			         					</tr>
			         					<!--<tr>
			     							<td class="NoiseFooterTD">&nbsp;Departamento</td>
			     							<td class="NoiseDataTD"><select name="deptocodigo" onChange="accionLoadListGen(document.getElementById('ciudadcodigo').value, this.value, 'ciudad');">
			     								<option value = "">-- Seleccione --</option>
				     							<?php
//													include ('../src/FunGen/floaddepartamento.php');
//													floaddepartamento($deptocodigo,$idcon);
												?>
			    							</select></td>
			     							<td class="NoiseFooterTD">&nbsp;Ciudad</td>
			     							<td class="NoiseDataTD"><span id="ciudad"><select name="ciudadcodigo" id="ciudadcodigo">
			     								<option value = "">-- Seleccione --</option>
				     							<?php
//													include ('../src/FunGen/floadciudad.php');
//													floadtociudad($ciudadcodigo, $deptocodigo, $idcon);
												?>
			    							</select></span></td>
										</tr>
			         					--><tr><td class="NoiseFooterTD" colspan="4">&nbsp;Direcci&oacute;n</td></tr>
			           					<tr><td colspan="4" class="NoiseDataTD" align="center"><textarea name="usuadirecc" cols="75" rows="2" wrap="VIRTUAL"><?php echo $usuadirecc; ?></textarea></td></tr>
			           					<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
			           				</table>
								</td>
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
			<input type="hidden" name="flagconsultarcuadrillausuario" value="1">
			<input type="hidden" name="negocicodigo" value="<?php echo $negocicodigo; ?>"> 
			<input type="hidden" name="typesource" value="<?php echo $typesource; ?>"> 
			<input type="hidden" name="accionconsultarcuadrillausuario">
			<input type="hidden" name="sourcetable" value="cuadrillausuario">
			<input type="hidden" name="sourceaction" value="consultar"> 				
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="columnas" value="usuacodigo,
cargocodigo,
departcodigo,
tipusucodigo,
usuaacti,
usuadocume,
usuanombre,
usuapriape,
usuasegape,
usuatelefo,
usuatelef2,
usuadirecc,
usuaemail,
usuaactiot,
ciudadcodigo">
			<input type="hidden" name="nombtabl" value="vistacuadrillausuario">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>