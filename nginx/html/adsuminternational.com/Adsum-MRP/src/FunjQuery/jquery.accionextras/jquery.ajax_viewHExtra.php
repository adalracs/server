<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblhorasextra.php';
		include '../../FunPerPriNiv/pktblhoraextraot.php';
	endif;
	
	if($horextcodigo):
		$idcon = fncconn();
		$rs_horasextra = loadrecordhorasextra($horextcodigo, $idcon);
		
		if($rs_horasextra['horextcodigo'])
			$rs_horaextraot = loadrecordhoraextraot($horextcodigo, $idcon);
	endif;
?>

<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
	<tr>
     	<td class="NoiseFooterTD" width="20%">&nbsp;Fecha</td>
     	<td class="NoiseDataTD" width="80%">&nbsp;<?php echo $rs_horasextra['horextfecha'] ?></td>
	</tr>
	<tr>
     	<td class="NoiseFooterTD">&nbsp;Periodo</td>
     	<td class="NoiseDataTD">&nbsp;De&nbsp;<?php echo date("h:i a",strtotime($rs_horasextra['horexthorini'])) ?>&nbsp;A&nbsp;<?php echo date("h:i a",strtotime($rs_horasextra['horexthorfin'])) ?></td>
	</tr>
	<tr><td class="ui-state-default" colspan="4"></td></tr>
 	<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  	<tr><td colspan="2" class="NoiseFooterTD">&nbsp;<?php echo  utf8_encode($rs_horasextra['horextdescri']); ?></td></tr>
</table>
<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
	<tr><td class="ui-state-default"></td></tr>
	<tr> 
		<td>
			<div>
				<div style="width:506px; height: 14px; padding: 3px; margin:0 auto;" class="ui-state-default">
					Listado de Ordenes asiganadas al empleado
				</div>
				<div style="width:512px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
					<div style="width:495px; height: auto;">
						<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">
							<tr>
								<td width="40%" class="ui-state-default estilo2">Orden de trabajo</td>
								<td width="60%" class="ui-state-default estilo2">Fecha de ejecuci&oacute;n</td>
							</tr>
							<?php 
								include '../../FunPerPriNiv/pktblot.php';
								if($rs_horaextraot > 0):
									for($a = 0; $a < count($rs_horaextraot); $a++):
										$rs_ot = loadrecordot($rs_horaextraot[$a]['ordtracodigo'], $idcon);
										
										if($a % 2)
											$class = "NoiseDataTD";
										else
											$class = "NoiseFooterTD";
							?>
							<tr class="<?php echo $class ?>">
								<td width="40%">&nbsp;Orden # <?php echo $rs_horaextraot[$a]['ordtracodigo'] ?></td>
								<td width="60%">&nbsp;<?php echo $rs_ot['ordtrafecini'] ?></td>
							</tr>
							<?php 
									endfor; 
								endif;
								 
								if($a < 8):
									for($b = $a; $b < 8; $b++):
									
										if($b % 2)
											$class = "NoiseDataTD";
										else
											$class = "NoiseFooterTD";
							?>
							<tr class="<?php echo $class ?>">
								<td width="40%">&nbsp;</td>
								<td width="60%">&nbsp;</td>
							</tr>
							<?php
									endfor;
								endif;
							?>
						</table>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>