<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblusuanovedad.php';
		include '../../FunPerPriNiv/pktblestadonoveda.php';
	endif;
	
	if($usunovcodigo):
		$idcon = fncconn();
		$rs_usuanovedad = loadrecordusuanovedad($usunovcodigo, $idcon);
		$rs_estadonoveda = loadrecordestadonoveda($rs_usuanovedad['estnovcodigo'], $idcon);

		
		$strSQL = "	SELECT horasextra.*, horaextraot.hoexotcodigo, horaextraot.ordtracodigo 
					FROM horasextra 
						LEFT JOIN horaextraot ON horaextraot.horextcodigo = horasextra.horextcodigo 
						LEFT JOIN usunovhorext ON usunovhorext.hoexotcodigo = horaextraot.hoexotcodigo 
					WHERE usunovhorext.usunovcodigo = '{$rs_usuanovedad['usunovcodigo']}'";

		
		
		$rs_usunovhorext = pg_exec($idcon, $strSQL); 
		$nr_usunovhorext = fncnumreg($rs_usunovhorext);
	endif;
?>

<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
	<tr>
     	<td class="NoiseFooterTD" width="20%">&nbsp;Novedad</td>
     	<td class="NoiseDataTD" width="80%">&nbsp;<?php echo  utf8_encode($rs_estadonoveda['estnovnombre']) ?></td>
	</tr>
	<tr>
     	<td class="NoiseFooterTD">&nbsp;Periodo</td>
     	<td class="NoiseDataTD">&nbsp;Desde&nbsp;<?php echo date("Y-m-d h:i a", strtotime($rs_usuanovedad['usunovfecini'].' '.$rs_usuanovedad['usunovhorini'])) ?>&nbsp;hasta&nbsp;<?php echo date("Y-m-d h:i a", strtotime($rs_usuanovedad['usunovfecfin'].' '.$rs_usuanovedad['usunovhorfin'])) ?></td>
	</tr>
	<tr><td class="ui-state-default" colspan="2"></td></tr>
 	<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  	<tr><td colspan="2" class="NoiseDataTD">&nbsp;<?php echo  utf8_encode($rs_usuanovedad['usunovdescri']); ?></td></tr>
</table>
<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">						
	<tr><td class="ui-state-default"></td></tr>
	<tr> 
		<td>
			<div>
				<div style="width:509px; height: 14px; padding: 3px; margin:0 auto;" class="ui-state-default">
					Listado de horas extras relacionadas
				</div>
				<div id="filtrahoraextraot">
					<div style="width:515px; height: 18px; margin:0 auto;" class="ui-state-default">
						<div style="width:100%; height: auto;">
							<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">	
								<tr>
									<td width="73" class="ui-state-default estilo2">Fecha</td>
									<td width="73" class="ui-state-default estilo2">Desde</td>
									<td width="73" class="ui-state-default estilo2">Hasta</td>
									<td width="62" class="ui-state-default estilo2">Orden #</td>
									<td width="200" class="ui-state-default estilo2">Descripci&oacute;n</td>
									<td width="10" class="ui-state-default estilo2">&nbsp;</td>
								</tr>
							</table>
						</div>
					</div>
					<div style="width:515px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
						<div style="width:498px; height: auto;" id="listahoraextraot">
							<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">
								<?php 
									for($a = 0; $a < $nr_usunovhorext; $a++):
										$rw_usunovhorext = fncfetch($rs_usunovhorext, $a);
										
										if($a % 2)
											$class = "NoiseDataTD";
										else
											$class = "NoiseFooterTD";
								?>
								<tr class="<?php echo $class ?>">
									<td width="74">&nbsp;<?php echo $rw_usunovhorext['horextfecha'] ?></td>
									<td width="74">&nbsp;<?php echo date("h:i a", strtotime($rw_usunovhorext['horextfecha'].' '.$rw_usunovhorext['horexthorini'])) ?></td>
									<td width="74">&nbsp;<?php echo date("h:i a", strtotime($rw_usunovhorext['horextfecha'].' '.$rw_usunovhorext['horexthorfin'])) ?></td>
									<td width="63">&nbsp;<?php if($rw_usunovhorext['ordtracodigo']) echo $rw_usunovhorext['ordtracodigo']; else echo '------' ?></td>
									<td width="198">&nbsp;<?php echo  utf8_encode(substr($rw_usunovhorext['horextdescri'],0,40)); if(strlen($rw_usunovhorext['horextdescri']) > 40) echo '...'; ?></td>
								</tr>
								<?php 
									endfor; 
									 
									if($a < 10):
										for($b = $a; $b < 10; $b++):
										
											if($b % 2)
												$class = "NoiseDataTD";
											else
												$class = "NoiseFooterTD";
								?>
								<tr class="<?php echo $class ?>">
									<td width="74">&nbsp;</td>
									<td width="74">&nbsp;</td>
									<td width="74">&nbsp;</td>
									<td width="63">&nbsp;</td>
									<td width="198">&nbsp;</td>
								</tr>
								<?php
										endfor;
									endif;
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>