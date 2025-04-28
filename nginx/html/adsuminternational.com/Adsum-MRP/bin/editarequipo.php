<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblestado.php');
	include ( '../src/FunPerPriNiv/pktblcentcost.php');
//	include ( '../src/FunPerPriNiv/pktbltipoequipo.php');
	include ( '../src/FunPerPriNiv/pktblusuaequipo.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltipoequipo.php');
	include ( '../src/FunPerPriNiv/pktblnormaseguri.php');
	include ( '../src/FunPerPriNiv/pktblnormaseguriequipo.php');
	
	if($accioneditarequipo) 
	{ 
		include ( 'editaequipo.php'); 
		$flageditarequipo = 1;
	}
ob_end_flush();

	if(!$flageditarequipo)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

		$idcon = fncconn();
		
		$tipequcodigo = $sbreg['tipequcodigo'];
		$estadocodigo = $sbreg['estadocodigo'];
		$cencoscodigo = $sbreg['cencoscodigo'];
		$sistemcodigo = $sbreg['sistemcodigo'];
		
		$equipovengar = $sbreg['equipovengar'];
		$equipofecins = $sbreg['equipofecins'];
		$equipofeccom = $sbreg['equipofeccom'];
		
		$rs_usuaequipo = loadrecordusuaequipo1($sbreg[equipocodigo],$idcon);
		
		if($rs_usuaequipo[usuacodi])
		{
			$rs_usuario = loadrecordusuario($rs_usuaequipo[usuacodi],$idcon);
			$usuanombre = $rs_usuario[usuanombre]." ".$rs_usuario[usuapriape]." ".$rs_usuario[usuasegape];
			$usuacodigo = $rs_usuario[usuacodi];
		}
		
		//-----
	   	$arr_ext = array('.gif','.jpg','.jpeg','.png','.bmp','.GIF','.JPG','.JPEG','.PNG','.BMP');
	   	for($i = 0; $i < count($arr_ext); $i++)
	   	{
		   	if(file_exists('../img/pics_equipos/equipo'.$sbreg['equipocodigo'].$arr_ext[$i]))
		   	{
		   		$oldrutafoto = 'equipo'.$sbreg['equipocodigo'].$arr_ext[$i];
		   		break;
		   	}
	   	}
	   	//-----
		
		//-----
		include_once ('../src/FunPerPriNiv/pktbldocuequi.php');
		include_once ('../src/FunPerPriNiv/pktblplano.php');
		include_once ('../src/FunPerPriNiv/pktblmanual.php');
		
		$record_docu = loadrecorddocuequilist($sbreg[equipocodigo],$idcon);
		
		if($record_docu['plano'])
		{
			for($a = 0; $a < count($record_docu['plano']); $a++)
			{
				$planos = loadrecordplano($record_docu['plano'][$a], $idcon);
				
				if(!$file_plano)
					$file_plano = str_replace('../img/planos/', '', $planos['planoruta']);
				else
					$file_plano = $file_plano.':-:'.str_replace('../img/planos/', '', $planos['planoruta']);
			}
		}
	
		if($record_docu['manual'])
		{
			for($a = 0; $a < count($record_docu['manual']); $a++)
			{
				$manuales = loadrecordmanual($record_docu['manual'][$a], $idcon);
				if($file_manual == '')
					$file_manual = str_replace('../doc/manuales/', '', $manuales['manualruta']);
				else
					$file_manual = $file_manual.':-:'.str_replace('../doc/manuales/', '', $manuales['manualruta']);
			}
		}
		
		include_once '../src/FunPerPriNiv/pktblequipocamperequipo.php';
	
		$iRegequicampequipo["equipocodigo"] = $sbreg['equipocodigo'];
		$id_equipo = dinamicscanequipocamperequipo($iRegequicampequipo, $idcon);

		$numregtip = fncnumreg($id_equipo);
		$col = 1;
				
		for ($j=0; $j< $numregtip; $j++)
		{
			$arr_tipCam = fncfetch($id_equipo, $j);
			$iRegequicamper[$arr_tipCam["capeeqcodigo"]] = $arr_tipCam["capeeqvalor"]; 
			
			if($arreglo_cam)
				$arreglo_cam .= ':|:'.$arr_tipCam["capeeqcodigo"].':-:'.$arr_tipCam["capeeqvalor"];
			else
				$arreglo_cam = $arr_tipCam["capeeqcodigo"].':-:'.$arr_tipCam["capeeqvalor"];
		}
	}
	$link = 1; // No borrar::valida librerias para link
	
	
	// Exclusivo para saber si es posible modificar o no el codigo del equipo
//	include_once '../src/FunPerPriNiv/pktblcomponen.php';
//	$rsComponen = dinamicscancomponen(array('equipocodigo' => $equipocodigo), $idcon);
//	if($rsComponen > 0)
	
	
	
?> 



<html> 
	<head> 
		<title>Editar registro de equipo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript"></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarNorSegselec.js" type="text/javascript"></script>
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
		</script>
		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.uloadmanualplano.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.delfileequ.js"></script>
		<script language="Javascript" type="text/javascript">
			function loadpicture(direccionpiv)
			{
				document.form1.rutafoto.value = direccionpiv; 
			}
		</script>
		<style type="text/css">
			ul {list-style-type:square}
			ul li {padding: 2px;}
			select {font-size: 12px;}
		</style>
		
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Equipo</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Editar registro</font></span></td></tr>
				<tr> 
  					<td>
  						<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  							<tr> 
								<td class="NoiseFooterTD"><?php if($campnomb["sistemcodigo"] == 1){ $sistemcodigo = null;echo "*";}?>&nbsp;Ubicaci&oacute;n / Proceso</td>
								<td class="NoiseDataTD"><select name="sistemcodigo" id="sistemcodigo">
									<option value ="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadsistema.php');
										$idcon = fncconn();
										floadsistema($sistemcodigo,$idcon);
									?>
								</select></td>
								<td class="NoiseErrorDataTD" rowspan="8" width="27%" align="center">
            						<img name="fotoimage" name="fotoimage" alt="Buscar imagen..." width="185" height="175" src="../img/pics_equipos/<?php if(!$rutafoto): if(!$oldrutafoto): ?>no_image.png<?php else: echo $oldrutafoto; endif; else: echo $rutafoto; endif; ?>">
            						<a href="#" id="cargar" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-circle-close"></span>Subir imagen</a>
            					</td>
							</tr>
  							<tr> 	
            					<td class="NoiseFooterTD" width="18%"><?php if($campnomb["tipequcodigo"] == 1){ $tipequcodigo = null;echo "*";}?>&nbsp;Tipo equipo</td>
            					<td class="NoiseDataTD" width="55%"><select name="tipequcodigo" id="tipequcodigo" onChange="accionCamposPer(this.value,'equipo','equi');">
              						<option value ="">-- Seleccione --</option>
              						<?php
										include ('../src/FunGen/floadtipoequipo.php');
										floadtipoequipo($idcon, $tipequcodigo);
									?>
            					</select></td>
          					</tr>
          					<tr> 
								<td class="NoiseFooterTD"><div class="ui-buttonset"><button id="manttecnico">Mantenedor</button></div></td>
								<td class="NoiseDataTD"><?php if($campnomb["usuacodi"] == 1){ $usuacodigo = null;echo "*";}?><input name="usuacodigo" type="text" value="<?php if(!$flageditarequipo){ echo $usuacodigo;} else {echo $usuacodigo;} ?>" size="8" onFocus="if(!agree)this.blur();"><input name="usuanombre" type="text"	value="<?php if(!$flageditarequipo){ echo $usuanombre;} else {echo $usuanombre;} ?>" size="45" onFocus="if (!agree)this.blur();"></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["equipocodigo"] == 1){ $equipocodigonv=null;echo "*";}?>&nbsp;C&oacute;digo SIGMA</td>
								<td class="NoiseDataTD"><input name="equipocodigonv" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipocodigo];} else {echo $equipocodigonv;}?>" size="30"></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["codigosrf"] == 1){ $codigosrf=null;echo "*";}?>&nbsp;Codigo SRF</td>
								<td class="NoiseDataTD"><input name="codigosrf" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[codigosrf];} else {echo $codigosrf;}?>" size="30"></td>
							</tr>
							<tr> 
								<td class="NoiseFooterTD"><?php if($campnomb["equiponombre"] == 1){ $equiponombre=null;echo "*";}?>&nbsp;Nombre</td>
								<td class="NoiseDataTD"><input name="equiponombre" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equiponombre];} else {echo $equiponombre;}?>" size="65"></td>                	
							</tr>         
							<tr>
								<td class="NoiseFooterTD" ><?php if($campnomb["estadocodigo"] == 1){ $estadocodigo=null;echo "*";}?>&nbsp;Estado</td>
								<td class="NoiseDataTD"><select name="estadocodigo" id="estadocodigo">
									<option value ="">-- Seleccione --</option>
              						<?php
										include ('../src/FunGen/floadestado.php');
										floadestado($estadocodigo,$idcon);
									?>
								</select></td>
							</tr>  
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["cencoscodigo"] == 1){ $cencoscodigo = null;echo "*";}?>&nbsp;Centro de costo</td>
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
  						<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr> 
								<td class="NoiseFooterTD" width="20%"><?php if($campnomb["equipofabric"] == 1){ $equipofabric=null;echo "*";}?>&nbsp;Fabricante</td>
								<td class="NoiseDataTD" width="30%"><input name="equipofabric" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipofabric];} else {echo $equipofabric;}?>" size="20"></td>
								<td class="NoiseFooterTD" width="20%"><?php if($campnomb["equipomarca"] == 1){ $equipomarca=null;echo "*";}?>&nbsp;Marca</td>
								<td class="NoiseDataTD" width="30%"><input name="equipomarca" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipomarca];} else {echo $equipomarca;}?>" size="20"></td>
							</tr>
							<tr> 
								<td class="NoiseFooterTD"><?php if($campnomb["equipomodelo"] == 1){ $equipomodelo=null;echo "*";}?>&nbsp;Modelo</td>
								<td class="NoiseDataTD"><input name="equipomodelo" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipomodelo];} else {echo $equipomodelo;}?>" size="20"></td>
								<td class="NoiseFooterTD"><?php if($campnomb["equiposerie"] == 1){ $equiposerie=null;echo "*";}?>&nbsp;No. serie</td>
								<td class="NoiseDataTD"><input name="equiposerie" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equiposerie];} else {echo $equiposerie;}?>" size="20"></td>
							</tr>
							<tr> 
								<td class="NoiseFooterTD"><?php if($campnomb["equipocinv"] == 1){ $equipocinv=null;echo "";}?>&nbsp;No. inventario</td>
								<td class="NoiseDataTD"><input name="equipocinv" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipocinv];} else {echo $equipocinv;}?>" size="20"></td>
								<td class="NoiseFooterTD"><?php if($campnomb["equipoubicac"] == 1){ $equipoubicac=null;echo "*";}?>&nbsp;Ubicaci&oacute;n</td>
								<td class="NoiseDataTD"><input name="equipoubicac" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipoubicac];} else {echo $equipoubicac;}?>" size="20"></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["equipoviduti"] == 1){ $equipoviduti=null;echo "*";}?>&nbsp;Vida util</td>
								<td class="NoiseDataTD"><input name="equipoviduti" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipoviduti];} else {echo $equipoviduti;}?>" size="14"></td>
								<td class="NoiseFooterTD"><?php if($campnomb["equipofeccom"] == 1){ $equipofeccom=null; echo "*";}?>&nbsp;Fecha compra</td>
								<td class="NoiseDataTD"><input type="text" id="equipofeccom" name="equipofeccom" size="14" ></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["equipofecins"] == 1){ $equipofecins=null; echo "";}?>&nbsp;Fecha instalaci&oacute;n</td>
								<td class="NoiseDataTD"><input type="text" id="equipofecins" name="equipofecins" size="14" ></td>
								<td class="NoiseFooterTD"><?php if($campnomb["equipovengar"] == 1){ $equipovengar=null; echo "";}?>&nbsp;Venc. garant&iacute;a</td>
								<td class="NoiseDataTD"><input type="text" id="equipovengar" name="equipovengar" size="14" ></td>
							</tr>
							<tr> 
								<td class="NoiseFooterTD"><?php if($campnomb["equiponpas"] == 1){ $equiponpas=null;echo "";}?>&nbsp;NPAS </td>
								<td class="NoiseDataTD"><input name="equiponpas" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equiponpas];} else {echo $equiponpas;}?>" size="20"></td>
								<td class="NoiseFooterTD" colspan="2"><!--DWLayoutEmptyCell-->&nbsp;</td>
							</tr>
							<tr><td colspan="4" class="ui-state-default"></td></tr>
							<tr>
		                  		<td class="NoiseFooterTD">&nbsp;Manuales</td>
		                  		<td colspan="3" class="NoiseDataTD" valign="middle">
		                  			<a href="#" id="examinar_manual">Examinar...</a>
								</td>
	                		</tr> 
							<tr>
		                  		<td colspan="4" class="NoiseDataTD">
			                  		<ul id="lista_manuales" class="example">
			                  		<?php 
			                  			if($file_manual)
			                  			{
			                  				$manual = explode(':-:', $file_manual);
			                  				for($b = 0; $b < count($manual); $b++)
												if($manual[$b]) echo "<li><b>".$manual[$b]."</b>&nbsp;&nbsp;".'<a href="javascript:void(0);" onclick="'."list_files(document.getElementById('file_manual').value,'lista_manuales', 'file_manual', '../doc/manuales/', '".$b."');".'">Quitar</a></li>';                  					
			                  			}
			                  		?>
			                  		</ul>
								</td>
	                		</tr>
	                		<tr><td colspan="4" class="ui-state-default"></td></tr> 
							<tr>
		                  		<td class="NoiseFooterTD">&nbsp;Planos</td>
		                  		<td colspan="3" class="NoiseDataTD" valign="middle">
		                  			<a href="#" id="examinar_plano">Examinar...</a>
								</td>
	                		</tr> 
							<tr>
		                  		<td colspan="4" class="NoiseDataTD">
		                  			<ul id="lista_planos" class="example">
			                  		<?php 
			                  			if($file_plano)
			                  			{
			                  				$plano = explode(':-:', $file_plano);
			                  				for($b = 0; $b < count($plano); $b++)
												if($plano[$b]) echo "<li><b>".$plano[$b]."</b>&nbsp;&nbsp;".'<a href="javascript:void(0);" onclick="'."list_files(document.getElementById('file_plano').value,'lista_planos', 'file_plano', '../img/planos/', '".$b."');".'">Quitar</a></li>';                  					
			                  			}
			                  		?>
			                  		</ul>
								</td>
	                		</tr> 
	                		<tr><td colspan="4" class="ui-state-default"></td></tr>
							<tr> 
								<td class="NoiseFooterTD">&nbsp;Normas de Seguridad&nbsp;&nbsp; <input type="radio" name="opnNormSeguri" onFocus="cargarNorSegselec(document.form1.arreglo_aux.value);" onClick="window.open('consultarnormaseguriequipo.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" <?php if(($flageditarequipo) && !(empty($arreglo_aux))) echo "checked"; ?>></td>
								<td colspan="3" class="NoiseDataTD"><select name="norsegselec" size="4">
								<?php 
								  	if(!$flageditarequipo)
								  	{
										include("../src/FunGen/floadnormaseguriequipoSel.php");
									  	$idcon = fncconn();
									  	$arreglo_aux = floadnormaseguriequipoSel($sbreg["equipocodigo"], $idcon, true);
									  	fncclose($idcon);
									}
								?>
								</select></td>
							</tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["equipodescri"] == 1){ $equipodescri=null;echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="4" class="NoiseDataTD"><textarea name="equipodescri" rows="3" wrap="VIRTUAL" cols="87"><?php if(!$flageditarequipo){ echo $sbreg[equipodescri];} else {echo $equipodescri;}?></textarea></td></tr>
						</table> 
					</td>
				</tr>
				<tr> 
  					<td>
  						<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr> 
								<td class="NoiseFooterTD" width="20%">&nbsp;Voltaje</td>
								<td class="NoiseDataTD" width="30%"><input name="equipovolta" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipovolta];} else {echo $equipovolta;}?>" size="20"></td>
								<td class="NoiseFooterTD" width="20%">&nbsp;Corriente</td>
								<td class="NoiseDataTD" width="30%"><input name="equipocorrie" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipocorrie];} else {echo $equipocorrie;}?>" size="20"></td>
							</tr>
							<tr> 
								<td class="NoiseFooterTD">&nbsp;Potencia</td>
								<td class="NoiseDataTD"><input name="equipopoten" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipopoten];} else {echo $equipopoten;}?>" size="20"></td>
								<td class="NoiseFooterTD">&nbsp;Nivel de tensi&oacute;n</td>
								<td class="NoiseDataTD"><input name="equiponivten" type="text"	value="<?php if(!$flageditarequipo){ echo $sbreg[equiponivten];} else {echo $equiponivten;}?>" size="20"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<span id="camppersonalizado">
						<?php
							if($flageditarequipo)
							{
								if($arreglo_cam)
								{
									$arr_campper = explode(':|:', $arreglo_cam);
									for($a = 0; $a < count($arr_campper); $a++)
									{
										$_subarr = explode(":-:", $arr_campper[$a]);
										$iRegequicamper[$_subarr[0]] = $_subarr[1];
									}
								}
							}
							
							include('../src/FunGen/floadtipoequicamperequipo.php');
							$idcon = fncconn();
							floadtipoequicamperequipo($tipequcodigo, $campnomb, 1, $idcon, $iRegequicamper);
							fncclose($idcon);
						?>
						</span>
					</td>
				</tr>
 	  			<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="equipocodigo"	value="<?php if(!$flageditarequipo){ echo $sbreg[equipocodigo];} else {echo $equipocodigo;}?>">
<!--			<input type="hidden" name="codigosrf"	value="<?php if(!$flageditarequipo){ echo $sbreg[codigosrf];} else {echo $codigosrf;}?>">-->
			<input type="hidden" name="accioneditarequipo"> 
			<input type="hidden" name="equipoacti" value="<?php echo $equipoacti; ?>"> 
			<input type="hidden" name="equipotipo" value="<?php echo $equipotipo; ?>">
			
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" id="file_plano" name="file_plano" value="<?php echo $file_plano; ?>"> 
			<input type="hidden" id="file_manual" name="file_manual" value="<?php echo $file_manual; ?>"> 
			<!--					-->
			<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux?>">
			<input type="hidden" name="arreglo_cam" value="<?php echo $arreglo_cam?>">
			<!--					-->
			<!--			Udado para 'disparar' la funcion que carga el formulario			-->
			<input type="text" name="auxtrigger" size="1" style="border:none; color:#FFFFFF;" onFocus="form1.flageditarequipo.value=1; form1.submit(); this.blur();">
			<input type="hidden" name="rutafoto" id="rutafoto" value="<?php echo $rutafoto; ?>">
			<input type="hidden" name="oldrutafoto" id="oldrutafoto" value="<?php echo $oldrutafoto; ?>">
			<!--								-->
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>
