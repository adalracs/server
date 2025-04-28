<?php
	include ('../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerPriNiv/pktblservicioplanta.php');
	include ('../src/FunPerPriNiv/pktblciudad.php');
	include ('../src/FunPerPriNiv/pktblunimedida.php');
	if ($accioneditarplanta) 
	{
		include ('editaplanta.php');
		$flageditarplanta = 1;
	}
	$idcon = fncconn ();
	
if (! $flageditarplanta) 
	{
		include ('../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga ( $nombtabl, $radiobutton );
		if (! $sbreg)
			include ('../src/FunGen/fnccontfron.php');
		$arrciudad = loadrecordciudad ( $sbreg [ciudadcodigo], $idcon );
		$arrunimedida = loadrecordunimedida ( $sbreg [unidadcodigo], $idcon );
		$plantacodigo = $sbreg [plantacodigo];
		
		include_once '../src/FunPerPriNiv/pktblplanoplanta.php';
		include_once '../src/FunPerPriNiv/pktblplano.php';
		
		$idcon = fncconn ();
		$arr_planos = loadrecordplanoplanta($sbreg[plantacodigo], $idcon);
		
		foreach($arr_planos as $value)
		{
			$planos = loadrecordplano($value, $idcon);
			$file_plano .= str_replace('../img/planos/', '', $planos['planoruta']).':-:';
		}
	}
?>
<html>
	<head>
		<title>Editar registro de Planta</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<script language="JavaScript" src="motofech.js"></script>
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript"></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarServiciselec.js" type="text/javascript"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery-1.3.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.ajax_upload.1.0.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.delfileequ.js"></script>
		<script type="text/javascript">	
			function list_files(arr_file, lista, tipo, ruta, del_reg)
			{
				var new_arr = '';
				var arr_doufile = '';
				var html_code = '';
				var contnew = 0;

				arr_doufile = arr_file.split(':-:');
				
				if (arr_doufile != "")
				{
					for(var i=0; i < (arr_doufile.length); i++)
					{
						if(del_reg == i)
						{
							accionDeleteFiel(ruta + arr_doufile[i], tipo);
							alert('Borrado');
						}
						else
						{
							if(arr_doufile[i] != '')
							{
								html_code = html_code + '<li><b>' + arr_doufile[i] + '</b>&nbsp;&nbsp;<a target="_blank" href="../img/planos/' + arr_doufile[i] + '">Ver</a>&nbsp;<a href="javascript:void(0);" onclick="list_files(' + "document.getElementById('file_plano').value,'" + lista + "', '" + tipo + "', '" + ruta + "', '" + contnew +"'" + ');">[Quitar]</a></li>';
								contnew ++;

								if(new_arr == '')
									new_arr = arr_doufile[i];
								else
									new_arr = new_arr + ':-:' + arr_doufile[i];
							}
						}
					}
					
					if(new_arr != '')
						document.getElementById('file_plano').value = new_arr + ':-:';
					else
						document.getElementById('file_plano').value = '';
					document.getElementById(lista).innerHTML = html_code;
				}
			}
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				new Ajax_upload('#examinar_plano', {
					action: 'uploadfileplanoplanta.php?plantacodigo=<?php echo  $plantacodigo ?>', // I disabled uploads in this example for security reaaons
					data : {
						'key1' : "This data won't",
						'key2' : "be send because",
						'key3' : "we will overwrite it"
					},
					onSubmit : function(file , ext){
						if (ext && /^(txt|pdf|gif|jpg|jpeg|dwg|png|bmp)$/.test(ext)){
							/* Setting data */
							this.set_data({
								'key': 'This string will be send with the file'
							});
							
							$('#lista_planos .text').text('Archivo: ' + file);	
						} else {
							// extension is not allowed
							alert('Error: \n Solo se permiten archivos en formato \n [.txt] texto \n [.pdf] Portable Document File \n [.dwg] Drawing \n [.jpg|.jpeg|.gif|.png|.bmp] Archivos Formato de Imagen');
							// cancel upload
							return false;				
						}
					},
					onComplete : function(file, response){
						if(response == 'error_exist')
						{
							alert('El archivo con el nombre "' + file + '" ya existe');
						}
						else
						{
							if (response == 'error')
							{
								alert('Ocurrio un error mientras se subia el archivo al sevidor, intentelo de nuevo mas tarde');
							}
							else
							{
								if(document.getElementById('file_plano').value != '')
									var arr_file = document.getElementById('file_plano').value + file;
								else
									var arr_file = file;
		
								var arr_doufile = '';
								var html_code = '';
		
								arr_doufile = arr_file.split(':-:');
		
								if (arr_doufile != "")
								{
									for(var i=0; i < (arr_doufile.length); i++)
									{
										if(arr_doufile[i] != '')
											html_code = html_code + '<li><b>' + arr_doufile[i] + '</b>&nbsp;&nbsp;<a target="_blank" href="../img/planos/' + arr_doufile[i] + '">Ver</a>&nbsp;<a href="javascript:void(0);" onclick="list_files(' + "document.getElementById('file_plano').value,'lista_planos', 'file_planoplanta', '../img/planos/', '" + i +"'" + ');">[Quitar]</a></li>';
									}
								}
								document.getElementById('file_plano').value = arr_file + ':-:';
								document.getElementById('lista_planos').innerHTML = html_code;
							}
						}
					}
				});
			});		
		</script>
		<style type="text/css">
			ul {list-style-type:square}
			ul li {padding: 2px;}
			a { margin-left:4px; color:#444444; text-decoration:none; }
		</style>		
	</head> 
<?php if (! $codigo) { echo "<!--"; } ?> 
	<body bgcolor="FFFFFF" text="#000000" <?php if (($flageditarplanta) && ! (empty ( $arreglo_aux ))) echo "onload=\"cargarServiciselec(window.document.form1.arreglo_aux.value);\""; ?>>
		<form name="form1" method="post" enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Ubicaciones</font></p>
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
				<tr><td width="500" class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if ($campnomb ["plantabieninmu"] == 1) { $plantabieninmu = null; echo "*"; } ?>Codigo Inmueble</td>
								<td colspan="2" bgcolor="#f0f6ff">
									<input type="text" name="plantabieninmu" value="<?php if (! $flageditarplanta) { echo $sbreg [plantabieninmu]; } else { echo $plantabieninmu; } ?>">
									<input type="button" value=" Bienes Inmueble " name="radio1" onClick="window.open('maestablbienesinmugen.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" href="#" target="_parent">
								</td>
							</tr>
							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if ($campnomb ["plantanombre"] == 1) { $plantanombre = null; echo "*"; } ?>Nombre</td>
								<td colspan="2" bgcolor="#f0f6ff"><input type="text" name="plantanombre" value="<?php if (! $flageditarplanta) { echo $sbreg [plantanombre]; } else { echo $plantanombre; } ?>" size="40"></td>
							</tr>
							<tr>
								<td width="35%" class="NoiseFooterTD"> <?php if ($campnomb ["plantaencarg"] == 1) { $plantaencarg = null; echo "*"; } ?>Profesional de Operaci&oacute;n</td>
								<td colspan="2" bgcolor="#f0f6ff"><input type="text" name="plantaencarg" value="<?php if (! $flageditarplanta) { echo $sbreg [plantaencarg]; } else { echo $plantaencarg; } ?>" size="40"></td>
							</tr>
							<tr>
								<td width="35%" class="NoiseFooterTD"> <?php if ($campnomb ["plantaencman"] == 1) { $plantaencman = null; echo "*"; } ?>Profesional de Mantenimiento</td>
								<td colspan="2" bgcolor="#f0f6ff"><input type="text" name="plantaencman" value="<?php if (! $flageditarplanta) { echo $sbreg [plantaencman]; } else { echo $plantaencman; } ?>" size="40"></td>
							</tr>
							<tr>
								<td width="35%" class="NoiseFooterTD"> <?php if ($campnomb ["ciudadcodigo"] == 1) { $ciudadcodigo = null; echo "*"; } ?>Ciudad</td>
								<td colspan="2" bgcolor="#f0f6ff"><select name="ciudadcodigo">
   								<?php
									if (! $flageditarplanta) 
									{
	echo '<option value = "' . $arrciudad [ciudadcodigo] . '">' . $arrciudad [ciudadnombre];
										echo '<option value = "">Seleccione';
									} 
									else if ($accioneditarplanta)
									{
										if ($ciudadcodigo)
											echo '<option value = "' . $ciudadcodigo . '">' . $arrciudad [ciudadnombre];
										else
											echo '<option value = "">Seleccione';
									}
									
									echo '</OPTION>';
		
									include ('../src/FunGen/floadciudad.php');
									floadciudad ($idcon);
								?>
    							</select></td>
							</tr>
							<tr>
								<td width="35%" class="NoiseFooterTD"> <?php if ($campnomb ["plantaubicac"] == 1) { $plantaubicac = null; echo "*"; } ?>Ubicaci&oacute;n</td>
								<td colspan="2" bgcolor="#f0f6ff"><input type="text" name="plantaubicac" value="<?php if (! $flageditarplanta) { echo $sbreg [plantaubicac]; } else { echo $plantaubicac; } ?>" size="40"></td>
							</tr>
							<tr>
								<td width="35%" class="NoiseFooterTD"> <?php if ($campnomb ["plantacapaci"] == 1) { $plantacapaci = null; echo "*"; } ?>Capacidad</td>
								<td colspan="2" bgcolor="#f0f6ff">
									<input type="text" name="plantacapaci" value="<?php if (! $flageditarplanta) { echo $sbreg [plantacapaci]; } else { echo $plantacapaci; } ?>" size="13">&nbsp;&nbsp; 
									<select name="unidadcodigo">
   									<?php
										if (! $flageditarplanta) 
										{
											echo '<option value = "' . $arrunimedida [unidadcodigo] . '">' . $arrunimedida [unidadacra];
											echo '<option value = "">Seleccione';
										}
										else if ($accioneditarplanta)
										{	
											if ($unidadcodigo)
												echo '<option value = "' . $unidadcodigo . '">' . $arrunimedida [unidadacra];
											else
												echo '<option value = "">Seleccione';
										}
										echo '</OPTION>';
			
										include ('../src/FunGen/floadunimedida.php');
										floadunimedida ( $idcon );
									?>
   									</select>
   								</td>
							</tr>
							<tr>
								<td width="35%" class="NoiseFooterTD"> <?php if ($campnomb ["plantadescri"] == 1) { $plantadescri = null; echo "*"; } ?>Descripci&oacute;n</td>
								<td colspan="2" bgcolor="#f0f6ff"><textarea name="plantadescri" cols="35" rows="3" wrap="VIRTUAL"><?php if (! $flageditarplanta) { echo $sbreg [plantadescri]; } else { echo $plantadescri; } ?></textarea></td>
							</tr>
							<tr><td colspan="3"><hr></td></tr>
							<tr>
								<td class="NoiseFooterTD">Servicios&nbsp;&nbsp;<input type="radio" name="opnServicio" onfocus="cargarServiciselec(document.form1.arreglo_aux.value);" onclick="window.open('consultarservicioplanta.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" <?php if (($flagnuevoplanta) && ! (empty ( $arreglo_aux ))) echo "checked"; ?>></td>
								<td align="center" bgcolor="#f0f6ff"><select name="serviciselec" size="4">
  								<?php
									if (! $flageditarplanta) 
									{
										include ("../src/FunGen/floadservicioplanta.php");
										$arreglo_aux = floadservicioplanta ( $sbreg ["plantacodigo"], $idcon, true );
									}
									fncclose ( $idcon );
								?>
  								</select></td>
							</tr>
							<tr><td colspan="3">&nbsp;</td></tr>
							<tr><td colspan="3" class="NoiseFooterTD"><a href="#" id="examinar_plano" >Planos&nbsp;&nbsp;<b>Click aqui para subir plano...</b></a></td></tr>
							<tr>
								<td colspan="3" class="NoiseDataTD">
									<ul id="lista_planos" class="example">
			                  		<?php 
			                  			if($file_plano)
			                  			{
			                  				$plano = explode(':-:', $file_plano);
			                  				for($b = 0; $b < count($plano); $b++)
												if($plano[$b]) echo "<li><b>".$plano[$b]."</b>&nbsp;&nbsp;".'<a target="_blank" href="../img/planos/'.$plano[$b].'">Ver</a>&nbsp;<a href="javascript:void(0);" onclick="'."list_files(document.getElementById('file_plano').value,'lista_planos', 'file_planoplanta', '../img/planos/', '".$b."');".'">[Quitar]</a></li>';                  					
			                  			}
			                  		?>
			                  		</ul>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><div align="center">
						<input type="image" name="aceptar" src="../img/aceptar.gif" onclick="form1.accioneditarplanta.value =  1;" width="86" height="18" alt="Aceptar" border=0> 
						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablplanta.php';" width="86" height="18" alt="Cancelar" border=0>
					</div></td>
				</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
<?php if ($campnomb) echo '<font face="Verdana" >Corregir los campos marcados con *</font>'; ?>
			<input type="hidden" name="plantacodigo" value="<?php if (! $flageditarplanta) { echo $sbreg [plantacodigo]; } else { echo $plantacodigo; } ?>"> 
			<input type="hidden" name="accioneditarplanta"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux?>">
			<input type="hidden" id="file_plano" name="file_plano" value="<?php echo $file_plano; ?>">
		</form>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>
