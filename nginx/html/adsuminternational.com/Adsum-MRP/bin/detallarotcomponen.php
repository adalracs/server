<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktblvistacomponenplanta.php');	
	include('../src/FunPerSecNiv/fncfetch.php');
	include('../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
ob_end_flush();

	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunGen/cargainput.php');

	if($componcodigo){
		$idcon = fncconn();
		$sbreg = loadrecordvistacomponenplanta($componcodigo,$equipocodigo,$usuaplanta,$idcon);
		
		if($sbreg > 0){
			$sbregequip = loadrecordequipo($sbreg[equipocodigo],$idcon);
			$equiponombre = $sbregequip[equiponombre];
		}
		fncclose($idcon);	
	}
?> 


<html>
	<head>
		<title>Detalle Componente OT</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css">
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		<SCRIPT LANGUAGE="JavaScript">

		</script>
		<style type="text/css">
			.estilo1 {font-size: 100%; font-family : Arial } 
			.estilo21 {font-size: 85%; font-family : Arial } 
		</style>
	</head>
	<body bgcolor="#f7f7f7" text="#000000">
	<form name="form1" method="post"  enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="1" cellpadding="0"  align="center"  >	
		<?php
			if($sbreg < 0 || !$sbreg){
				echo '<tr><td><b>No se encontro el Componente o No coincide al equipo</b></td></tr>'."\n";
				echo '<!--'."\n";
			}
		?>
			<tr> 
				<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
				<td width="24%" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componcodigo];}else {echo $componcodigo;}?></td> 
				<td width="22%" class="NoiseFooterTD">&nbsp;</td> 
				<td  class="NoiseDataTD">&nbsp;</td>   
			</tr> 
			<tr>
				<td class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;</span>Nombre</td>
				<td colspan="3" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componnombre];}else {echo $componnombre;}?></td>
			</tr>
			<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
			<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
			<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>

			<tr><td height="17" colspan="4" class="NoiseErrorDataTD">&nbsp;Equipo</td></tr>
			<tr> 
				<td width="20%" class="NoiseFooterTD"> &nbsp;C&oacute;digo</td>
				<td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[equipocodigo]; }else{ echo $equipocodigo;} ?></td>
				<td class="NoiseFooterTD">&nbsp;</td>
				<td class="NoiseDataTD">&nbsp;</td>
			</tr>
			<tr>
				<td class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;</span>Nombre</td>
				<td colspan="3" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $equiponombre;} ?></td>
			</tr>
			<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
			<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
			<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
			<tr>
				<td width="20%" class="NoiseFooterTD">&nbsp;Fabricante</td>
				<td width="24%" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componfabric];} else {echo $componfabric;} ?></td> 
				<td width="22%" class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;Marca</span></td> 
				<td width="34%" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componmarca];}else {echo $componmarca;}?></td> 
			</tr> 
			<tr> 
				<td width="20%" class="NoiseFooterTD">&nbsp;Modelo</td> 
				<td width="24%" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componmodelo];} else {echo $componmodelo;} ?></td> 
				<td width="22%" class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;No. de serie </span></td> 
				<td width="34%" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componserie];} else {echo $componserie;}?></td> 
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;No. inventario  </td>
				<td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componcinv];} else {echo $componcinv;}?></td>
				<td class="NoiseFooterTD"> <span class="NoiseFooterTD">&nbsp;</span>Vida &uacute;til </td>
				<td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componviduti];}else {echo $componviduti;}?></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Alto</td>
				<td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componalto];}else {echo $componalto;}?></td>
				<td class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;</span>Largo</td>
				<td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componlargo];}else {echo $componlargo;}?></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Ancho</td>
				<td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componancho];}else {echo $componancho;}?></td>
				<td class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;</span>Peso</td>
				<td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componpeso];} else {echo $componpeso;}?></td>
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Fecha compra</td>
				<td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componfeccom];} else {echo $componfeccom;}?>a-m-d</td>
				<td class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;Fec. instalaci&oacute;n</span></td>
				<td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componfecins];} else {echo $componfecins;}?>a-m-d</td>
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Venc. garantia</td>
				<td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componvengar];} else {echo $componvengar;}?>     a-m-d</td>
				<td class="NoiseFooterTD">&nbsp;</td>
				<td class="NoiseDataTD">&nbsp;</td>
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
				<td colspan="3" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[componubicac];} else {echo $componubicac;}?></td>
			</tr>
			<?php
				if($sbreg < 0 || !$sbreg){
					echo '-->'."\n";
				}
			?>
	  	</table>
	</form>
	</body>
</html>