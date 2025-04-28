<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblusuario.php';
		include '../../FunPerPriNiv/pktbldepartam.php';
		include '../../FunGen/cargainput.php';
		
		include '../../FunGen/floaddepartam.php';
	endif;

	$idcon = fncconn();
?>
<style>
	.row-consumo { font-size:11px;}
</style>
<div style="width:778px; height: 14px; margin:0 auto;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="113" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Id</td>
				<td width="320" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="300" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Departamento</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div  style="width:778px; margin:0 auto; height: 150px;overflow:auto;border-top:0;" class="ui-widget-content">
<div style=" height: auto;" id="listatecnicos">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
			<?php 
				if($lsttecnicoot) $arrObject = explode(',', $lsttecnicoot);
				
				for($a = 0; $a < count($arrObject); $a++):	
					$rsInstructor = loadrecordusuario($arrObject[$a], $idcon);
//					($rsInstructor['cargocodigo'])? $rsCargo= loadrecordcargo($rsInstructor['cargocodigo'], $idcon):$rsCargo['cargonombre'] = 'N/A' ;
					
					$objDepartam = 'depart_'.$arrObject[$a];
					
					if(!$$objDepartam)
						$$objDepartam = $rsInstructor['departcodigo'];  
					
					//condiciones Personalizadas
					($a % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">
				<td width="30" class="row-consumo" style=" border-bottom: 1px solid #fff;" align="center">
					<input type="checkbox" name="chkarritemreceta" id="chkarritemreceta" onclick="setSelectionRow(this.value, document.getElementById('lsttecnicoot').value, ',', 'lsttecnicoot');" value="<?php echo $arrObject[$a] ?>">
				</td>
				<td width="113" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $arrObject[$a]; ?></td>
				<td width="320" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsInstructor['usuanombre'].' '.$rsInstructor['usuapriape'].' '.$rsInstructor['usuasegape']; ?></td>
				<td width="300" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;
				<select name="<?php echo $objDepartam ?>" id="<?php echo $objDepartam ?>">
					<option value="">-- Seleccione --</option>
					<?php 
						floaddepartam($$objDepartam, $idcon);
					?>
				</select>	
			</td>
			</tr>
			<?php 
				endfor;

				unset($arrObject);
				
				if($a < 20):
					for($b = $a; $b < 20; $b++):
						($b % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="113" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="320" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="299" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
			<?php
					endfor;
				endif;
			?>		
		</table>
		<input name="lsttecnicoot" id="lsttecnicoot" type="hidden" value="<?php echo $lsttecnicoot ?>" />
	</div>
	</div>