<?php 
	include ( '../src/FunPerPriNiv/pktblcurso.php');
	include ( '../src/FunPerPriNiv/pktblgrupcapa.php');
	include ( '../src/FunPerPriNiv/pktblmateapoy.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltema.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	
	include ( '../src/FunPerPriNiv/pktblubicaccapaci.php'); 
	include ( '../src/FunPerPriNiv/pktblsaloncapaci.php'); 
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');	
	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	if($accionnuevocapacitacion){
		include ( 'grabacapacitacion.php');} 
		
	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Nuevo registro de capacitacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		 
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.fnccapacitacion.js"></script>
<!--		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_cursogrupo.js"></script>-->
		
		
		<script type="text/javascript">
			$(function(){
				<?php if(!$capacifecini) $capacifecini = date("Y-m-d");  ?>$("#capacifecini").datepicker("setDate", '<?php echo $capacifecini; ?>');
			});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Capacitaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="800">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["cursocodigo"] == 1){ $cursocodigo = null; echo "*";}?>&nbsp;Curso</td>
								<td width="30%" class="NoiseDataTD"><select name="cursocodigo" id="cursocodigo">
									<option value="">-- Seleccione --</option>
									<?php 
										include '../src/FunGen/floadcurso.php';
										floadcurso($cursocodigo,$idcon);
								?>
								</select></td> 
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["ubicapcodigo"] == 1){ $cursoubicac = null; echo "*";}?>&nbsp;Ubicaci&oacute;n&nbsp;</td>
								<td class="NoiseDataTD" colspan="2"><select name="ubicapcodigo" id="ubicapcodigo" onchange="accionLoadSelect(this.value, 'saloncapaci', 'salcapcodigo');">
									<option value="">-- Seleccione --</option>
									<?php 
										include '../src/FunGen/floadubicaccapaci.php';
										floadubicaccapaci($ubicapcodigo,$idcon);
									?>
								</select></td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["salcapcodigo"] == 1){ $salcapcodigo = null; echo "*";}?>&nbsp;Salon&nbsp;</td>
								<td class="NoiseDataTD" colspan="2"><select name="salcapcodigo" id="salcapcodigo">
									<option value="">-- Seleccione --</option>
									<?php 
										include '../src/FunGen/floadsaloncapaci.php';
										floadsaloncapaci($salcapcodigo, $ubicapcodigo, $idcon);
									?>
								</select></td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["capacifecini"] == 1){ $capacifecini = null; echo "*";}?>&nbsp;Fecha&nbsp;</td>
								<td class="NoiseDataTD">
									<input type="text" name="capacifecini" id="capacifecini" size="20">
									<select name="horini"><?php floadtimehours($horini); ?></select>:<select name="minini"><?php floadtimeminut($minini); ?></select>
									<select name="pasadmerini">
										<option value="" <?php if(!$pasadmerini) echo 'selected' ?>>am</option>
										<option value="1" <?php if($pasadmerini) echo 'selected' ?>>pm</option>
									</select>
								</td>
 							</tr>
 							<tr><td colspan="2" class="ui-state-default"></td></tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["departcodigo"] == 1){ $departcodigo1 = null; echo "*";}?>&nbsp;<b>Departamento</b>&nbsp;</td>
 								<td width="30%" class="NoiseDataTD"><div id="tecnico">
	        						<input type="hidden" name="departcodigo1" id="departcodigo1" value="<?php if($flagnuevocapacitacion){ echo $departcodigo1; } ?>" size="7">
	        						<input type="text" name="departnombre" id="departnombre" value="<?php if($flagnuevocapacitacion){ echo $departnombre; } ?>" size="40" >
	        					</div></td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["usuacodi"] == 1){ $usuacodigo = null; echo "*";}?>&nbsp;<b>Responsable</b>&nbsp;</td>
 								<td width="30%" class="NoiseDataTD"><div id="tecnico">
	        						<input type="text" name="usuacodigo" id="usuacodigo" value="<?php if($flagnuevocapacitacion){ echo $usuacodigo; } ?>" size="7" >
	        						<input type="text" name="usuanombre" id="usuanombre" value="<?php if($flagnuevocapacitacion){ echo $usuanombre; } ?>" size="40" >
	        					</div></td>
 							</tr>
	 					</table>
	 				</td>
	 			</tr>
	 			<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
            				<tr>
            					<td>
            						<div style="width:778px; height: 16px; margin:0 auto;" class="ui-state-default">&nbsp;&nbsp;
										<a onClick="return verocultar('instructor',1);" href="javascript:animatedcollapse.toggle('instructor');"><img id="row1" align="middle" align="top"  src="temas/Noise/AscOn.gif" border="0">&nbsp;Instructor</a>
									</div>
									<div style="width:778px; height: 35px; margin:0 auto;" class="ui-widget-content">
										<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
											<tr> 
												<td style="height: 35px;">
													<div class="ui-buttonset">
														&nbsp;<span style="font-size: 12px;">Instructor</span>&nbsp;<input name="usuanombre1" id="usuanombre1" type="text" size="50"><input type="hidden" name="usuacodigo1" id="usuacodigo1">
				            							<button id="anxinstructor">Agregar funcionario</button>
				            							<button id="retinstructor">Quitar funcionarios</button>
				            							<button id="anxcontratrista">Contratista</button>
			            							</div>
			            						</td>
			            					</tr>
			            				</table>
									</div>
		  							<div id="instructor">
									<?php 
										$noAjax = true;
										include '../src/FunjQuery/jquery.visors/jquery.instructor.php'; 
									?>
									</div>
									<div id="totalhoras">Total tiempo: 0 hr. / 0 min. </div>
									<input type="hidden" name="alllstinstructortmp" id="alllstinstructortmp" value="<?php echo $alllstinstructortmp; ?>">
									<input type="hidden" name="arrcontratista" id="arrcontratista" value="<?php  echo $arrcontratista; ?>">
									<input type="hidden" name="valcontratista" id="valcontratista" value="<?php  echo $valcontratista; ?>">
									<input name="lstinstructor" id="lstinstructor" type="hidden" value="<?php echo $lstinstructor ?>" />
								</td>
							</tr>
            			</table>
            		</td>
            	</tr>
	 			<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
 							<tr>
								<td colspan="2">
									<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
										<tr>
  											<td>
	  											<div style="width:778px; height: 14px; margin:0 auto;" class="ui-state-default">
													<a onClick="return verocultar('involucrados',2);" href="javascript:animatedcollapse.toggle('involucrados');"><img id="row2" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Empleados involucrados en la capacitacion</a>
												</div>
												<div class="NoiseDataTD">
													<div class="ui-buttonset">
														&nbsp;&nbsp;<span style="font-size: 12px;">Empleado</span>&nbsp;<input name="usuanombre2" id="usuanombre2" type="text" size="50"><input type="hidden" name="usuacodigo2" id="usuacodigo2">
								            			<button id="anxottecnico">Agregar funcionario</button>&nbsp;
				            							<button id="retottecnico">Quitar funcionarios</button>&nbsp;&nbsp;&nbsp;
				            							<button id="anxotgrupo">Agregar Grupo</button>
			            							</div>
												</div>
	  											<div id="involucrados">
												<?php 
													include_once '../src/FunPerPriNiv/pktblcalendario.php';
													include_once '../src/FunPerPriNiv/pktblcuadrilla.php';
													include_once '../src/FunPerPriNiv/pktblcuadrillausuario.php';
													include_once '../src/FunPerPriNiv/pktblcargo.php';
													include_once '../src/FunPerPriNiv/pktblusuanovedad.php';
													include_once '../src/FunPerPriNiv/pktblestadonoveda.php';
													include_once '../src/FunGen/floaddepartam.php';
												
													$fecini = $ordtrafecini;
													$fecfin = $ordtrafecfin;
													$iRegArray = $lsttecnicoot;
													$noAjax = true;
													include '../src/FunjQuery/jquery.visors/jquery.emplecapaci.php'; 
												?>
												</div>
												<input type="hidden" name="alllsttecnicoottmp" id="alllsttecnicoottmp" value="<?php echo $alllsttecnicoottmp; ?>">
												<input type="hidden" name="usualider" id="usualider" value="<?php  echo $usualider;?>" >
												<input type="hidden" name="typesource" id="typesource" value="<?php  echo $typesource;  ?>">
												<input type="hidden" name="negocicodigo" id="negocicodigo" value="<?php  echo $negocicodigo;  ?>">
												<input type="hidden" name="arrgrupcapa" id="arrgrupcapa" value="<?php  echo $arrgrupcapa;  ?>">
											</td>
										</tr>
									</table>
								</td>
							</tr>
 							
 							<tr><td colspan="2" class="ui-state-default">&nbsp;<small>Material de apoyo</small></td></tr>
							<tr>
							<td colspan="2" class="NoiseDataTD"><div class="ui-buttonset-fe">
								<button id="ingresaritem">Agregar item</button>
								<button id="quitaritem">Quitar item</button>
							</div></td>
							</tr>
							<tr>
								<td colspan="2">
 									<div id="listadoitemreceta">
 									<?php 
										$noAjax = true;
 										include '../src/FunjQuery/jquery.visors/jquery.mateapoy.php';
 									?>
 									</div>
								</td>
							</tr>
							<!--<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["curgrufecini"] == 1){ $curgrufecini = null; echo "*";}if($campnomb["curgrufecfin"] == 1){ $curgrufecfin = null; echo "*";}?>&nbsp;Fecha&nbsp;</td>
								<td width="10%" class="NoiseDataTD">
								<b>inicio&nbsp;</b><input type="text" name="curgrufecini" id="curgrufecini"size="15"	value="<?php if(!$flagnuevocapacitacion){echo $sbreg[curgrufecini];}else{echo $curgrufecini;}?>"/>
								<b>fin&nbsp;</b><input type="text" name="curgrufecfin" id="curgrufecfin"size="15"	value="<?php if(!$flagnuevocapacitacion){echo $sbreg[curgrufecfin];}else{echo $curgrufecfin;}?>"/>
								</td>
							</tr>
							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["curgruhorini"] == 1){ $curgrufecini = null; echo "*";}if($campnomb["curgruhorfin"] == 1){ $curgruhorfin = null; echo "*";}?>&nbsp;Hora&nbsp;</td>
								<td width="10%" class="NoiseDataTD">
								<b>inicio&nbsp;</b><input type="text" name="curgruhorini" id="curgruhorini" size="15"	value="<?php if(!$flagnuevocapacitacion){echo $sbreg[curgruhorini];}else{echo $curgruhorini;}?>"/>
								<b>fin&nbsp;</b><input type="text" name="curgruhorfin" id="curgruhorfin"  size="15"	value="<?php if(!$flagnuevocapacitacion){echo $sbreg[curgruhorfin];}else{echo $curgruhorfin;}?>"/>
								</td>
							</tr>
 							--><tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["capaciobjeti"]	 == 1){$capaciobjeti = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="capaciobjeti" rows="3" cols="63"><?php if(!$flagnuevocapacitacion){ echo $sbreg[capaciobjeti];}else{ echo $capaciobjeti;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevocapacitacion">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">			
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
		
		<div id="msgwindowerror" title="Adsum Kallpa"><span id="msgerror"></span></div>
		<div id="msgwindowcont" title="Adsum Kallpa - [Contratista - Capacitador]"><span id="msg"></span>
			<div id="content">
				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
					<tr>	
						<td width="35%" class="NoiseFooterTD">&nbsp;Identificaci&oacute;n</td>
  						<td width="65%" class="NoiseDataTD"><input type="text" name="usuadocume" id="usuadocume" value="<?php echo $usuadocume ?>"/></td>
					</tr>
					<tr>	
						<td width="35%" class="NoiseFooterTD">&nbsp;Nombre </td>
  						<td width="65%" class="NoiseDataTD"><input type="text" name="usuanombree" id="usuanombree" value="<?php echo $usuanombree ?>"/></td>
					</tr>
					<tr>	
						<td width="35%"class="NoiseFooterTD">&nbsp;Apellido 1</td>
  						<td width="65%" class="NoiseDataTD"><input type="text" name="usuapriape"  id="usuapriape"value="<?php echo $usuapriape ?>"/></td>
					</tr>
					<tr>	
						<td width="35%" class="NoiseFooterTD">&nbsp;Apellido 2</td>
  						<td width="65%" class="NoiseDataTD"><input type="text" name="usuasegape" id="usuasegape"value="<?php echo $usuasegape?>"/></td>
					</tr>
					<tr>	
						<td width="35%"class="NoiseFooterTD">&nbsp;Telefono 1 </td>
  						<td width="65%" class="NoiseDataTD"><input type="text" name="usuatelefo" id="usuatelefo" value="<?php echo $usuatelefo ?>"/></td>
					</tr>
					<tr>	
						<td width="35%" class="NoiseFooterTD">&nbsp;Telefono 2 </td>
  						<td width="65%" class="NoiseDataTD"><input type="text" name="usuatelef2" id="usuatelef2" value="<?php echo $usuatelef2 ?>"/></td>
					</tr>
					<tr>	
						<td width="35%" class="NoiseFooterTD">&nbsp;Contacto </td>
  						<td width="65%" class="NoiseDataTD"><input type="text" name="usuacontac" id="usuacontac" value="<?php echo $usuacontac ?>"/></td>
					</tr>
					<tr>	
						<td width="35%" class="NoiseFooterTD">&nbsp;Direccion </td>
  						<td width="65%" class="NoiseDataTD"><input type="text" name="usuadirecc" id="usuadirecc" value="<?php echo $usuadirecc ?>"/></td>
					</tr>
					<tr>	
						<td width="35%" class="NoiseFooterTD">&nbsp;Mail </td>
  						<td width="65%" class="NoiseDataTD"><input type="text" name="usuamail" id="usuamail" value="<?php echo $usuamail ?>"/></td>
					</tr>
				</table>
			</div>
		</div>
		<div id="msgwindowform" title="Adsum Kallpa [Material de apoyo]"><span id="msgform"></span></div>
		<div id="usuanovmsg"></div>
		<div id="msgwindowformc" title="Adsum Kallpa [Grupos de capacitacion]"><span id="msgformc"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>