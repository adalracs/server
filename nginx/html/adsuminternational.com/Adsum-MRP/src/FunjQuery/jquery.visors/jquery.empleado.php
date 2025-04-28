<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblusuario.php';
		include '../../FunPerPriNiv/pktblcargo.php';
		include '../../FunGen/cargainput.php';
	endif;

	$idcon = fncconn();
?>
<style>
	.row-consumo { font-size:11px;}
</style>
<div style="width:760px; height: 14px; margin:0 auto;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="115" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Id</td>
				<td width="300" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="300" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cargo</td>
				<td width="15" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div  style="width:760px; margin:0 auto; height: 170px;overflow:auto;border-top:0;" class="ui-widget-content">
	<div style=" height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
			<?php 
				if($lstempleado) $arrObjectv = explode(',', $lstempleado);
				
				for($a = 0; $a < count($arrObjectv); $a++)
				{
					$rsEmpleado = loadrecordusuario($arrObjectv[$a], $idcon);
					($rsEmpleado['cargocodigo'])? $rsCargo= loadrecordcargo($rsEmpleado['cargocodigo'], $idcon) : $rsCargo['cargonombre'] = 'N/A' ;
					
					//condiciones Personalizadas
					($a % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">
				<td width="30" class="row-consumo" style=" border-bottom: 1px solid #fff;" align="center">
					<input type="checkbox" name="chkarrlstempleado" id="chkarrlstempleado" onclick="setSelectionRow(this.value, document.getElementById('lstempleado').value, ',', 'lstempleado');" value="<?php echo $arrObjectv[$a] ?>">
				</td>
				<td width="115" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $arrObjectv[$a]; ?></td>
				<td width="300" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsEmpleado['usuanombre'].' '.$rsEmpleado['usuapriape'].' '.$rsEmpleado['usuasegape']; ?></td>
				<td width="300" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsCargo['cargonombre'] ?></td>
			</tr>
			<?php 
				}
				unset($arrObjectv);
				
				if($a < 20)
				{
					for($b = $a; $b < 20; $b++)
					{
						($b % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="115" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="300" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="300" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
			<?php
					}
				}
			?>		
		</table>
	</div>
</div>