<?php
	include ('../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerPriNiv/pktblservicioplanta.php');
	include ('../src/FunPerPriNiv/pktblciudad.php');
	include ('../src/FunPerPriNiv/pktblunimedida.php');
	
	if (! $flagdetallarplanta) 
	{
		include ('../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga ( $nombtabl, $radiobutton );
		
		if (! $sbreg)
			include ('../src/FunGen/fnccontfron.php');
		$idcon = fncconn ();
		
		$sbregunimedida = loadrecordunimedida ( $sbreg [unidadcodigo], $idcon );
		
		include_once '../src/FunPerPriNiv/pktblplanoplanta.php';
		include_once '../src/FunPerPriNiv/pktblplano.php';
		
		$arr_planos = loadrecordplanoplanta($sbreg[plantacodigo], $idcon);
		
		foreach($arr_planos as $value)
		{
			$planos = loadrecordplano($value, $idcon);
			
			if(!$file_plano)
				$file_plano = str_replace('../img/planos/', '', $planos['planoruta']);
			else
				$file_plano = $file_plano.':-:'.str_replace('../img/planos/', '', $planos['planoruta']);
		}
		
		fncclose ( $idcon );
	}
?>
<html>
	<head>
		<title>Detalle de registro de Planta</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<script language="JavaScript" src="motofech.js"></script>
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
					action: 'uploadfileplanoplanta.php?plantacodigo=<?php echo  $sbreg[plantacodigo] ?>', // I disabled uploads in this example for security reaaons
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
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post" enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Ubicaciones</font></p>
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="90%">
				<tr><td  class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
								<td class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td bgcolor="#f0f6ff"><?php echo $sbreg [plantacodigo]; ?></td>
<td class="NoiseFooterTD">&nbsp;C&oacute;digo Inmueble</td>
<td bgcolor="#f0f6ff"><?php  echo $sbreg [plantabieninmu]; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Nombre</td>
								<td bgcolor="#f0f6ff"><?php echo $sbreg [plantanombre]; ?></td>
<td class="NoiseFooterTD">&nbsp;Profesional de Operaci&oacute;n</td>
<td bgcolor="#f0f6ff"><?php echo $sbreg [plantaencarg]; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Profesional de Mantenimiento</td>
								<td bgcolor="#f0f6ff"><?php echo $sbreg [plantaencman]; ?></td>
<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
<td bgcolor="#f0f6ff"><?php echo $sbreg [plantaubicac]; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Ciudad</td>
								<td bgcolor="#f0f6ff">
									<?php 
										$idcon = fncconn ();
	$sbregdpto = loadrecordciudad ( $sbreg [ciudadcodigo], $idcon );
	echo $sbregdpto[ciudadnombre];
					?></td>
								<td class="NoiseFooterTD">&nbsp;Capacidad</td>
								<td bgcolor="#f0f6ff"><?php echo $sbreg [plantacapaci]; ?>&nbsp;&nbsp;<?php echo $sbregunimedida [unidadacra]; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td>
								<td bgcolor="#f0f6ff"><?php  echo $sbreg [plantadescri]; ?></td>
								<td class="NoiseFooterTD">&nbsp;Servicios</td>
								<td bgcolor="#f0f6ff">
		<?php
		include ("../src/FunGen/floadservicioplanta.php");
		floadservicioplanta ( $sbreg ["plantacodigo"], $idcon, false );
		fncclose ( $idcon );
		?>
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
												if($plano[$b]) echo "<li><b>".$plano[$b]."</b>&nbsp;&nbsp;".'<a target="_blank" href="../img/planos/'.$plano[$b].'">Ver</a></li>';                  					
			                  			}
			                  		?>
			                  		</ul>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php if($sbreg [plantabieninmu]): ?>
				<tr>
  					<td>
        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
                   			<tr>
                   				<td height="600" class="ui-widget-content">
                   					<iframe src="http://gaia.li.com.co/mandala/gbi/bin/detallartabinmuebleadsum.php?codigo=<?php echo $codigo ?>&inmueble=<?php echo $sbreg['plantabieninmu']; ?>" frameborder="0" name="inmueble" id = "inmueble"  height="600" width="100%" align="absmiddle"></iframe>
                   				</td>
                   			</tr>
                   		</table>
					</td>
				</tr>
				<?php endif; ?>
				<tr>
					<td><div align="center">
						<input type="image" name="aceptar" src="../img/aceptar.gif" onclick="form1.action='maestablplanta.php';" width="86" height="18" alt="Aceptar" border=0>
					</div></td>
				</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
			<input type="hidden" name="flagdetallarplanta" value="1"> 
			<input type="hidden" name="acciondetallarplanta"> <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" id="file_plano" name="file_plano" value="<?php echo $file_plano; ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>
