<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	
	if(!$flagdetallartipoembobinado) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
			
		$tipembcodigo = $sbreg['tipembcodigo'];
		$tipembnombre = $sbreg['tipembnombre'];
		$tipembdescri = $sbreg['tipembdescri'];
			
        $arr_ext = array('.gif','.jpg','.jpeg','.png','.bmp','.GIF','.JPG','.JPEG','.PNG','.BMP');
	   	for($i = 0; $i < count($arr_ext); $i++)
	   	{
		   	if(file_exists('../img/pics_embobinados/embobinado_'.$sbreg['tipembcodigo'].$arr_ext[$i]))
		   	{
		   		$rutafoto = 'embobinado_'.$sbreg['tipembcodigo'].$arr_ext[$i];
		   		break;
		   	}
	   	}
	} 
?>
<html> 
	<head> 
		<title>Detalle de registro de tipos de embobinados</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$(".gallery a[rel^='prettyPhoto']").prettyPhoto({ social_tools: false, theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */ });
			});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Padre item</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">  
 							<tr> 
								<td class="NoiseErrorDataTD"  rowspan="5" colspan="2" width="30%" align="center">&nbsp;
            						<ul class="gallery clearfix">
										<li><a href="../img/pics_embobinados/<?php echo $rutafoto ?>" rel="prettyPhoto" title="<?php echo trim($sbreg['tipembnombre']) ?>"><img width="212" height="150" src="../img/pics_embobinados/<?php echo $rutafoto ?>"></a></li>
									</ul>
            					</td>
							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td>
								<td width="40%" class="NoiseDataTD">&nbsp;<?php echo ($tipembnombre)? strtoupper($tipembnombre) : '---' ; ?></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo ($tipembdescri)? strtoupper($tipembdescri) : '---' ; ?></td></tr>
						</table> 
  					</td> 
 				</tr> 
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallartipoembobinado" value="1"> 
			<input type="hidden" name="acciondetallartipoembobinado">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="tipembcodigo,tipembnombre,tipembdescri">
			<input type="hidden" name="tipembcodigo" value="<?php if($accionconsultartipoembobinado) echo $tipembcodigo; ?>"> 
 			<input type="hidden" name="tipembnombre" value="<?php if($accionconsultartipoembobinado) echo $tipembnombre; ?>"> 
 			<input type="hidden" name="tipembdescri" value="<?php if($accionconsultartipoembobinado) echo $tipembdescri; ?>"> 
 			<input type="hidden" name="accionconsultartipoembobinado" value="<?php echo $accionconsultartipoembobinado; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>
