<?php

if(!$noAjax):
include '../../FunPerPriNiv/pktblformulacion.php';
include '../../FunPerPriNiv/pktblusuario.php';
include '../../FunPerPriNiv/pktblitemformul.php';
include '../../FunPerPriNiv/pktblitemdesa.php';
include '../../FunPerSecNiv/fncconn.php';
include '../../FunPerSecNiv/fncclose.php';
include '../../FunPerSecNiv/fncnumreg.php';
include '../../FunPerSecNiv/fncfetch.php';
include '../../FunPerSecNiv/fncsqlrun.php';
include '../../FunGen/cargainput.php';
endif;


if($formulpadre):
?>
<div style="overflow:auto;height:350px;" class="ui-widget-content">
<?php

$idcon = fncconn();
$sql = "SELECT * FROM formulacion WHERE formulcodigo ='".$formulpadre."' OR formulpadre = ".$formulpadre." ORDER BY formulorden";
//$rsFormulacion = dinamicscanopformulacion(array('formulcodigo' => $formulpadre , 'formulpadre' =>$formulpadre),array('formulcodigo'=>'=', 'formulpadre' =>'='),$idcon,1);
$rsFormulacion = fncsqlrun($sql,$idcon);
$nrFormulacion = fncnumreg($rsFormulacion);
$nrFormulacion = ($nrFormulacion >= 1)? $nrFormulacion - 1 : $nrFormulacion ;

for($k = 0; $k < $nrFormulacion; $k++):
	$rwFormulacion = fncfetch($rsFormulacion,$k);
	$rsItemformul = dinamicscanitemformul(array('formulcodigo' => $rwFormulacion[formulcodigo]),$idcon);
	$nrItemformul = fncnumreg($rsItemformul);
		
	$obj_capaa = 'capaa_'.$k;
	$obj_capab = 'capab_'.$k;
	$obj_capac = 'capac_'.$k;
	
	$obj_slip_capaa = 'slip_capaa_'.$k;
	$obj_slip_capab = 'slip_capab_'.$k;
	$obj_slip_capac = 'slip_capac_'.$k;
	
	$obj_antibl_capaa = 'antibl_capaa_'.$k;
	$obj_antibl_capab = 'antibl_capab_'.$k;
	$obj_antibl_capac = 'antibl_capac_'.$k;
	
	unset($arrformulacion);
	
	for($i = 0; $i < $nrItemformul; $i++):
		
		$rwItemformul = fncfetch($rsItemformul, $i);
		$rwItemdesa = loadrecorditemdesa($rwItemformul[itedescodigo],$idcon);
		
		$obj_capa = 'capa'.strtolower($rwItemformul['iteforcapa']).'_'.$k;
		$obj_slip = 'slip_capa'.strtolower($rwItemformul['iteforcapa']).'_'.$k;
		$obj_antibl = 'antibl_capa'.strtolower($rwItemformul['iteforcapa']).'_'.$k;
		
		$$obj_capa = $$obj_capa + $rwItemformul['iteforporcen'];
		$$obj_slip = $$obj_slip + ( ( (int) $rwItemdesa['itedesslip']) * ( (int)$rwItemformul['iteforporcen'] / 100) );
		$$obj_antibl = $$obj_antibl + ( ( (int) $rwItemdesa['itedesantibl']) * ( (int)$rwItemformul['iteforporcen'] / 100) );
		
		$rwItemdesa = loadrecorditemdesa($rwItemformul['itedescodigo'],$idcon);
			
		($arrformulacion) ? $arrformulacion .= ':|:'.$rwItemformul['itedescodigo'].':-:'.$rwItemformul['iteforcapa'].':-:'.$rwItemformul['iteforporcen'].':-:'.$rwItemdesa['itedesslip'].':-:'.$rwItemdesa['itedesantibl'].':-:'.$rwItemdesa['itedescosto'] : $arrformulacion = $rwItemformul['itedescodigo'].':-:'.$rwItemformul['iteforcapa'].':-:'.$rwItemformul['iteforporcen'].':-:'.$rwItemdesa['itedesslip'].':-:'.$rwItemdesa['itedesantibl'].':-:'.$rwItemdesa['itedescosto'];  
		
	endfor;
	
$nombre = cargausuanombre($rwFormulacion[usuacodi],$idcon);
?>
<table width="95%" border="0" cellspacing="1" cellpadding="1"
	align="center">
	<tr>
		<td colspan="9" class="ui-state-default">&nbsp;<b>Omologacion # <?php echo ($k + 1); ?> </b></td>
		</tr>
	<tr>
		<td class="NoiseFooterTD">&nbsp;Codigo (Mezcla)&nbsp;</td>
		<td class="NoiseDataTD" colspan="8"><?php echo $rwFormulacion[formulnumero] ?></td>
	</tr>
	<tr>
		<td class="NoiseFooterTD">&nbsp;Fecha</td>
		<td class="NoiseDataTD"><?php echo $rwFormulacion[formulfecha]; ?></td>
		<td class="NoiseFooterTD">&nbsp;<b>Responsable</b></td>
		<td class="NoiseDataTD" colspan="6">&nbsp;<?php echo $nombre ?></td>
	</tr>
	<tr>
		<td width="15%" class="NoiseFooterTD">&nbsp;Capa A</td>
		<td width="10%" class="NoiseDataTD"><?php echo $rwFormulacion[formulcapaa]; ?>
		<b>%</b></td>
		<td width="10%" class="NoiseFooterTD">&nbsp;Formulado &nbsp;</td>
		<td width="10%" class="NoiseDataTD">&nbsp;<?php echo $$obj_capaa ?>&nbsp;<b>%</b></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;Slip &nbsp;</td>
		<td width="10%" class="NoiseDataTD">&nbsp;<?php echo $$obj_slip_capaa ?></td>
		<td width="10%" class="NoiseFooterTD">&nbsp;Antiblock &nbsp;</td>
		<td width="10%" class="NoiseDataTD">&nbsp;<?php echo $$obj_antibl_capaa ?></td>
		<td width="10%" class="NoiseDataTD">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="NoiseFooterTD">&nbsp;Capa B</td>
		<td width="10%" class="NoiseDataTD"><?php echo $rwFormulacion[formulcapab]; ?><b>%</b></td>
		<td width="10%" class="NoiseFooterTD">&nbsp;Formulado &nbsp;</td>
		<td width="10%" class="NoiseDataTD">&nbsp;<?php echo $$obj_capab?>&nbsp;<b>%</b></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;Slip &nbsp;</td>
		<td width="10%" class="NoiseDataTD">&nbsp;<?php echo $$obj_slip_capab ?></td>
		<td width="10%" class="NoiseFooterTD">&nbsp;Antiblock &nbsp;</td>
		<td width="10%" class="NoiseDataTD">&nbsp;<?php echo $$obj_antibl_capab ?></td>
		<td width="10%" class="NoiseDataTD">&nbsp;</td>
	</tr>
	<tr>
		<td width="15%" class="NoiseFooterTD">&nbsp;Capa C</td>
		<td width="10%" class="NoiseDataTD"><?php echo $rwFormulacion[formulcapac]; ?><b>%</b></td>
		<td width="10%" class="NoiseFooterTD">&nbsp;Formulado &nbsp;</td>
		<td width="10%" class="NoiseDataTD">&nbsp;<?php echo $$obj_capac ?>&nbsp;<b>%</b></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;Slip &nbsp;</td>
		<td width="10%" class="NoiseDataTD">&nbsp;<?php echo $$obj_slip_capac ?></td>
		<td width="10%" class="NoiseFooterTD">&nbsp;Antiblock &nbsp;</td>
		<td width="10%" class="NoiseDataTD">&nbsp;<?php echo $$obj_antibl_capac ?></td>
		<td width="10%" class="NoiseDataTD">&nbsp;</td>
	</tr>
<!--	
	<tr>
		<td colspan="1" class="NoiseDataTD">&nbsp;Costo</td>
		<td colspan="3" class="NoiseDataTD"><span id="costo">0.0</span>&nbsp;<b>COP</b></td>
		<td colspan="1" class="NoiseDataTD">&nbsp;<b>Total</b></td>
		<td colspan="1" class="NoiseDataTD">&nbsp;<span id="slip">0.0</span></td>
		<td colspan="1" class="NoiseDataTD">&nbsp;<b>Total</b></td>
		<td colspan="1" class="NoiseDataTD">&nbsp;<span id="antiblock">0.0</span></td>
		<td width="10%" class="NoiseDataTD">&nbsp;</td>
	</tr>
-->
	<tr>
		<td colspan="9">
		<table width="95%" border="0" cellspacing="1" cellpadding="0"
			align="center">
			<tr>
				<td>
				<?php
				$noAjax = true;
				$fladetallar = 1;
				include '../../FunjQuery/jquery.visors/jquery.formulacion.php';
				?>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<br>
<?php
endfor;
?>
</div>
<?php 
endif;
?>