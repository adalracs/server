<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblproveedo.php';
		include '../../FunPerPriNiv/pktblitemproveedo.php';
		include '../../FunPerPriNiv/pktblproveestado.php';
	endif;
?>

<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td class="ui-state-default"></td></tr>
	<tr> 
		<td>
			<div>
				<div style="width:574px; height: 14px; padding: 3px; margin:0 auto;" class="ui-state-default">
					<a onClick="return verocultar('filtraproveedo',0);" href="javascript:animatedcollapse.toggle('filtraproveedo');"><img id="row0" align="middle" align="top"  src="temas/Noise/<?php if($proveedor) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Proveedores</a>
				</div>
				<div id="filtraproveedo" ><!-- style="display: <?php if($proveedor): ?>block;<?php else: ?>none;<?php endif; ?>"> -->
					<?php if(!$detalle): ?>
					<div style="width:580px; height: 18px; margin:0 auto;" class="ui-state-default">
						<div style="width:100%; height: auto;">
							<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">	
								<tr>
									<td width="30" class="ui-state-default estilo2">Sel</td>
									<td width="300" class="ui-state-default estilo2">Proveedor</td>
									<td width="230" class="ui-state-default estilo2">Estado</td>
									<td width="12" class="ui-state-default estilo2">&nbsp;</td>
								</tr>
							</table>
						</div>
					</div>
					<div style="width:580px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
						<div style="width:563px; height: auto;">
							<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">	
								<?php 
									if($proveedor)
									{
										$array_tmp = explode(',',$proveedor);
										$array_key = array_flip($array_tmp);
									}
								
									$idcon = fncconn();
									$rs_proveedo = fullscanproveedo($idcon);
									$nr_proveedo = fncnumreg($rs_proveedo);
									
									for($a = 0; $a < $nr_proveedo; $a++): 
										$rw_proveedo = fncfetch($rs_proveedo, $a);
										$checked = '';
										
										if(is_array($array_key))
										{
											if(array_key_exists($rw_proveedo['proveecodigo'], $array_key))
												$checked = 'checked ';
										}
											
										if($a % 2)
											$class = "NoiseDataTD";
										else
											$class = "NoiseFooterTD";
											
										if($rw_proveedo['proestcodigo'])
											$rs_proveestado = loadrecordproveestado($rw_proveedo['proestcodigo'], $idcon);
								?>
								<tr class="<?php echo $class ?>">
									<td width="30"><input type="checkbox" id="chkproveedor" name="chkproveedor" <?php echo $checked ?>onclick="setSelectionRow(this.value, document.getElementById('proveedor').value, ',', 'proveedor');" value="<?php echo $rw_proveedo['proveecodigo'] ?>"></td>
									<td width="301">&nbsp;<?php echo $rw_proveedo['proveenombre'] ?></td>
									<td width="230">&nbsp;<?php echo $rs_proveestado['proestnombre'] ?></td>
								</tr>
								<?php 
									endfor; 
								
									if($a < 9):
										for($b = $a; $b < 9; $b++):
										
											if($b % 2)
												$class = "NoiseDataTD";
											else
												$class = "NoiseFooterTD";
								?>
								<tr class="<?php echo $class ?>">
									<td width="31">&nbsp;</td>
									<td width="301">&nbsp;</td>
									<td width="230">&nbsp;</td>
								</tr>
								<?php
										endfor;
									endif;
								?>
							</table>
							<input type="hidden" name="proveedor" id="proveedor" value="<?php echo $proveedor ?>">
						</div>
					</div>
					<?php else: ?>
					<div style="width:580px; height: 18px; margin:0 auto;" class="ui-state-default">
						<div style="width:100%; height: auto;">
							<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">	
								<tr>
									<td width="330" class="ui-state-default estilo2">Proveedor</td>
									<td width="230" class="ui-state-default estilo2">Estado</td>
									<td width="12" class="ui-state-default estilo2">&nbsp;</td>
								</tr>
							</table>
						</div>
					</div>
					<div style="width:580px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
						<div style="width:563px; height: auto;">
							<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">	
								<?php
									$nr_extproveedo = fncnumreg($rs_extproveedo);
									
									for($a = 0; $a < $nr_extproveedo; $a++): 
										$rw_extproveedo = fncfetch($rs_extproveedo, $a);
										
										if($a % 2)
											$class = "NoiseDataTD";
										else
											$class = "NoiseFooterTD";

										$rs_proveedo = loadrecordproveedo($rw_extproveedo['proveecodigo'], $idcon);	
											
										if($rs_proveedo['proestcodigo'])
											$rs_proveestado = loadrecordproveestado($rs_proveedo['proestcodigo'], $idcon);
											
								?>
								<tr class="<?php echo $class ?>">
									<td width="332">&nbsp;<?php echo $rs_proveedo['proveenombre'] ?></td>
									<td width="230">&nbsp;<?php echo $rs_proveestado['proestnombre'] ?></td>
								</tr>
								<?php 
									endfor; 
								
									if($a < 9):
										for($b = $a; $b < 9; $b++):
										
											if($b % 2)
												$class = "NoiseDataTD";
											else
												$class = "NoiseFooterTD";
								?>
								<tr class="<?php echo $class ?>">
									<td width="332">&nbsp;</td>
									<td width="230">&nbsp;</td>
								</tr>
								<?php
										endfor;
									endif;
								?>
							</table>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</td>
	</tr>
</table>