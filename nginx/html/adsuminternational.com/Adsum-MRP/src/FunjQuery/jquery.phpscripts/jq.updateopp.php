<?php
	ini_set('display_errors',1);
	include  '../../FunGen/fncstrfecha.php'; 
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerPriNiv/pktblajustepn.php';
	include '../../FunPerPriNiv/pktblvelocidadpn.php';
	include '../../FunPerPriNiv/pktbloppajustepn.php';
	include '../../FunPerPriNiv/pktbloppvelocidadpn.php';
	
	$idcon = fncconn();
	
	$rsOppVelocidadpn = dinamicscanopoppvelocidadpn(array('ordoppcodigo' => $ordoppcodigo ),array('ordoppcodigo' => '='),$idcon);
	$nrOppVelocidadpn = fncnumreg($rsOppVelocidadpn);
	for($a = 0; $a < $nrOppVelocidadpn; $a++)
	{
		$rwOppVelocidadpn = fncfetch($rsOppVelocidadpn, $a);
		$arrvelocidadpn = ($arrvelocidadpn)? $arrvelocidadpn.','.$rwOppVelocidadpn['velocicodigo'] : $rwOppVelocidadpn['velocicodigo']; 
	}
	
	$rsOppAjustepn = dinamicscanopoppajustepn(array('ordoppcodigo' => $ordoppcodigo ),array('ordoppcodigo' => '='),$idcon);
	$nrOppAjustepn = fncnumreg($rsOppAjustepn);
	for($a = 0; $a < $nrOppAjustepn; $a++)
	{
		$rwOppAjustepn = fncfetch($rsOppAjustepn, $a);
		$arrajustepn = ($arrajustepn)? $arrajustepn.','.$rwOppAjustepn['ajustecodigo'] : $rwOppAjustepn['ajustecodigo'];
	}
	
?>
<html> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
				<tr><td><div class="ui-widget" style="display : none" id="wmnsj">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						
						<p id="mnsj"></p>
					</div>
				</div></td></tr>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;<small><?php echo strfecha(date("Y-m-d"))  ?></small></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">		
							<tr><td class="ui-state-default" colspan="2"><?php if($campnomb["arrvelocidadpn"] == 1)echo "*"; ?>&nbsp;Datos de orden - velocidad de orden</td></tr>
		  					<tr>
 								<td colspan="2">
 									<div id="listavelocidadpn">
 										<?php 
 											$noAjax = true;
 											include "../../FunjQuery/jquery.visors/jquery.velocidadpn.php";
 										?>
 									</div>
 									<input type="hidden" name="arrvelocidadpn" id="arrvelocidadpn" size="60"value="<?php echo $arrvelocidadpn ?>" />
									<input type="hidden" name="arrvelocidadpntmp" id="arrvelocidadpntmp" size="60"value="<?php echo $arrvelocidadpntmp ?>" />
 								</td>
 							</tr>
		  				</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">		
							<tr><td class="ui-state-default" colspan="2"><?php if($campnomb["arrajustepn"] == 1)echo "*"; ?>&nbsp;Datos de orden - Ajustes y/o cambios en orden</td></tr>
		  					<tr>
		  				</tr>
		  				<tr>
 							<td colspan="2">
 								<div id="listaajustepn">
 									<?php 
 										$noAjax = true;
 										include "../../FunjQuery/jquery.visors/jquery.ajustepn.php";
 									?>
 								</div>
 								<input type="hidden" name="arrajustepn" id="arrajustepn" size="60"value="<?php echo $arrajustepn ?>" />
								<input type="hidden" name="arrajustepntmp" id="arrajustepntmp" size="60"value="<?php echo $arrajustepntmp ?>" />
 							</td>
 						</tr>
 					</table>
 				</td>
 			</tr>
			<tr><td>&nbsp;</td></tr> 
			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
		</table>
		<input type="hidden" name="ordoppcodigo" id="ordoppcodigo" size="60" value="<?php echo $ordoppcodigo ?>" />
		</form>
	</body>
</html>