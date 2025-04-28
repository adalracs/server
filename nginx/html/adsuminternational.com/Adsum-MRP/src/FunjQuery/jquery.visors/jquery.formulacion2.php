<?php 

	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblformulacion.php';
		include '../../FunPerPriNiv/pktblitemdesa.php';
		include '../../FunPerPriNiv/pktblitemformul.php';
	endif;

	$idcon = fncconn();

?>


<div style="width:800px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Formulacion</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="320" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="120" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Ref.</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;%.</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:800x; height: 150px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:783px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrformulacion2) $arrObject = explode(',', $arrformulacion2);
		for($a = 0; $a < count($arrObject); $a++):	
			$rwItem = loadrecordformulacion($arrObject[$a], $idcon);
			$sql = "SELECT DISTINCT(iteforcapa),itedescodigo,SUM(iteforporcen) AS iteforporcen 
								FROM itemformul WHERE formulcodigo = '$arrObject[$a]' GROUP BY iteforcapa,itedescodigo ORDER BY iteforcapa";
			$rsItemformul = fncsqlrun($sql,$idcon);
			$nrItemformul = fncnumreg($rsItemformul);
			for($i = 0;$i<$nrItemformul;$i++):
				$rwItemformul = fncfetch($rsItemformul,$i);
				$rwItemdesa = loadrecorditemdesa($rwItemformul['itedescodigo'],$idcon);
				$objPorcen = 'iteforporcen_'.$rwItemformul['itedescodigo'];
				$objCapa = 'formulcapa'.strtolower($rwItemformul['iteforcapa']);
				$$objPorcen = $$objPorcen + (($rwItemformul['iteforporcen'] / 100) * ($rwItem[$objCapa] / 100));
			endfor;
			
			$sql = "SELECT DISTINCT(itedescodigo) FROM itemformul WHERE formulcodigo ='$arrObject[$a]'";
			$rsItemformul = fncsqlrun($sql,$idcon);
			$nrItemformul = fncnumreg($rsItemformul);
			for($i = 0;$i<$nrItemformul;$i++):
				($i % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				$rwItemformul = fncfetch($rsItemformul,$i);
				$rwItemdesa = loadrecorditemdesa($rwItemformul['itedescodigo'],$idcon);
				$objPorcen = 'iteforporcen_'.$rwItemformul['itedescodigo'];
?>			
			<tr <?php echo $complement ?>">
				<td width="80" style=" border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItem['formulnumero'] ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedescodigo'] ?></td>
				<td width="320" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedesnombre'] ?> </td>
				<td width="120" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwItemdesa['itedesrefere'] ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" align="right">&nbsp;<?php echo $$objPorcen * 100 ?>&nbsp;<b>%</b></td>
			</tr>
<?php
			endfor;
		endfor;
	
	if($a < 13):
		for($b = $a; $b < 13; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="80" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="320" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="120" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
		fncclose($idcon);
?>
		</table>
	</div>
</div>
<input type="hidden" name="arrformulacion2" id="arrformulacion2" size="60"value="<?php echo $arrformulacion2 ?>" />
<input type="hidden" name="formulacion" id="formulacion" size="60"value="<?php echo $arrformulacion2 ?>" />