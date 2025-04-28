<?php 	
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	include ( '../src/FunPerPriNiv/pktblareafuncio.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include_once '../src/FunPerPriNiv/pktblitem.php';
	include_once '../src/FunPerPriNiv/pktblunimedida.php';
	include_once '../src/FunPerPriNiv/pktblherramie.php';
	
	if(!$flagdetallarinventecnico)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 

		if(!$sbreg) 
			include( '../src/FunGen/fnccontfron.php'); 
		
		$idcon = fncconn();

		if($sbreg['arefuncodigo'])
			$rs_areafuncio = loadrecordareafuncio($sbreg['arefuncodigo'], $idcon);
			
		if($sbreg['departcodigo'])
			$rs_departam = loadrecorddepartam($sbreg['departcodigo'], $idcon);
			
		$usuacodigo = $sbreg['usuacodi'];
	} 
?>
<html> 
	<head> 
		<title>Detalle de registro de inventario tecnico</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				$("#tabsinventecnico").tabs({
					ajaxOptions: {
						error: function(xhr, status, index, anchor) {
							$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
						}
					}
				});
			});
		</script>
		<style type="text/css">
			#loading { position: absolute; top: 5px; right: 5px; }
			.sub-style { font-size: 95%; font-family : Arial }
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Inventario T&eacute;cnico</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="800">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;Registro</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg['usuacodi']; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;T&eacute;cnico</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg['usuanombre'].' '.$sbreg['usuapriape'].' '.$sbreg['usuasegape']; ?></td> 
 							</tr> 
							<tr>
								<td class="NoiseFooterTD">&nbsp;Departamento</td>
								<td class="NoiseDataTD"><?php echo $rs_departam['departnombre'] ?></td> 
 							</tr> 
						</table> 
					</td>
				</tr>
				<tr> 
  					<td> 
  						<div style="width: 778px; margin:0 auto;" >
							<div id="tabsinventecnico">
								<ul>
									<li><a href="#tabs-1"><span class="ui-icon ui-icon-suitcase" style="float: left; margin-right: .3em;"></span>Item's</a></li>
									<li><a href="#tabs-2"><span class="ui-icon ui-icon-wrench" style="float: left; margin-right: .3em;"></span>Herramientas</a></li>
<!--									<li><a href="#tabs-3"><span class="ui-icon ui-icon-transferthick-e-w" style="float: left; margin-right: .3em;"></span>Transacciones</a></li>-->
								</ul>
								<div id="tabs-1">
									<?php $noAjax = true;  include '../src/FunjQuery/jquery.tabs/phpscripts/jquery.inv_item.php'; ?>
				  				</div>
			  					<div id="tabs-2">
									<?php $noAjax = true;  include '../src/FunjQuery/jquery.tabs/phpscripts/jquery.inv_herramie.php'; ?>
								</div>
<!--			  					<div id="tabs-3">-->
<!--									-->
<!--								</div>-->
							</div>
						</div>
               		</td>
				</tr>
			  	<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  			</table>
 			<input type="hidden" name="flagdetallarinventecnico" value="1"> 
			<input type="hidden" name="acciondetallarinventecnico">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">	  		
			<input type="hidden" name="columnas" value="usuacodigo,
cargocodigo,
departcodigo,
usuadocume,
usuanombre,
usuapriape,
usuasegape"> 
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarinventecnico) echo $usuacodigo; ?>"> 
 			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarinventecnico) echo $usuanombre; ?>"> 
 			<input type="hidden" name="usuapriape" value="<?php if($accionconsultarinventecnico) echo $usuapriape; ?>"> 
 			<input type="hidden" name="usuasegape" value="<?php if($accionconsultarinventecnico) echo $usuasegape; ?>"> 
 			<input type="hidden" name="usuadocume" value="<?php if($accionconsultarinventecnico) echo $usuadocume; ?>"> 
 			<input type="hidden" name="cargocodigo" value="<?php if($accionconsultarinventecnico) echo $cargocodigo; ?>"> 
 			<input type="hidden" name="departcodigo" value="<?php if($accionconsultarinventecnico) echo $departcodigo; ?>">
 			<input type="hidden" name="negocicodigo" value="<?php echo $negocicodigo; ?>">
 			<input type="hidden" name="accionconsultarinventecnico" value="<?php echo $accionconsultarinventecnico; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>