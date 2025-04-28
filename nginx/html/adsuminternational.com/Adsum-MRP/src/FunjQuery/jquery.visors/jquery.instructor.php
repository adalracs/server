<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblusuario.php';
		include '../../FunPerPriNiv/pktblcargo.php';
		include '../../FunPerPriNiv/pktbltema.php';
		include '../../FunGen/cargainput.php';
	endif;

	$idcon = fncconn();
?>
<style>
	.row-consumo { font-size:11px;}
</style>
<div  style="width:780px; height: 150px; margin:0 auto; overflow:auto;" class="ui-state-default">
	<div style="width:1000px; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
			<tr>
				<td width="20" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Id</td>
				<td width="200" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="200" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cargo</td>
				<td width="300" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Contenido</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;No. Horas</td>
				<td width="100" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Valor</td>
			</tr>
			<?php 
				if($lstinstructor)
				{
				 	$arrObject = explode(',', $lstinstructor);
				 	$rsTema = fullscantema($idcon);
				 	$nrTema = fncnumreg($rsTema);
				 	
				 	if($nrTema > 0)
				 	{
				 		for($a = 0; $a < $nrTema; $a++)
				 		{
				 			$rwTema = fncfetch($rsTema, $a);
				 			$arrTema[] = $rwTema;
				 		} 	
				 	}
				 	
				 	
				}
				
				for($a = 0; $a < count($arrObject); $a++):
					$subArray = explode('_', $arrObject[$a]);
				
					$rsInstructor = loadrecordusuario($subArray[1], $idcon);
					$rsCargo= ($rsInstructor['cargocodigo'])? loadrecordcargo($rsInstructor['cargocodigo'], $idcon): array('cargonombre' => 'N/A');
					
					/*Efectos de nombre de objetos */
					
					$objTema = 'curcontema_'.$arrObject[$a].'_'.$a;
					$objHora = 'curconhora_'.$arrObject[$a].'_'.$a;
					$objvalor = 'curconvalor_'.$arrObject[$a].'_'.$a;
					$objThora = 'tipohora_'.$arrObject[$a].'_'.$a;
//					$$objvalor = ($rsInstructor == -3)? $$objvalor :0;
					
					if(!$$objvalor)
						$$objvalor = 0;
					
					/*Condiciones Personalizadas */
					$nombre = 	$rsInstructor['usuanombre'].' '.$rsInstructor['usuapriape'].' '.$rsInstructor['usuasegape'];
					if($rsInstructor == -3):
						if($arrcontratista) $arrObj = explode(':|:', $arrcontratista);
						for($i = 0; $i < count($arrObj); $i++):	
							$arrCont = explode(':-:',$arrObj[$i]);
							if($arrCont[0] == $subArray[1]):
								$nombre = $arrCont[2].' '.$arrCont[3].' '.$arrCont[4];
								break;
							endif;
						endfor;
						$rsCargo= array('cargonombre' => 'Contratista Capacitador');
					endif;
					($a % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">
				<td width="20" class="row-consumo" style=" border-bottom: 1px solid #fff;" align="center">
					<input type="checkbox" name="chklstinstructor" id="chklstinstructor" onclick="setSelectionRow(this.value, document.getElementById('lstinstructor').value, ',', 'lstinstructor');" value="<?php echo $arrObject[$a] ?>">
				</td>
				<td width="80" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $subArray[1]; ?></td>
				<td width="200" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $nombre ?></td>
				<td width="200" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsCargo['cargonombre'] ?></td>
				<td width="200" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">
					<select name="<?php echo $objTema;?>" id="<?php echo $objTema;?>" style="font-size:11px">
						<option value="">-- Seleccione --</option>
						<?php 
							for($e = 0; $e < count($arrTema); $e++)
					 			echo '<option value ="'.$arrTema[$e]['temacodigo'].'"'.(($arrTema[$e]['temacodigo'] == $$objTema) ? ' selected ' : '').'>'.$arrTema[$e]['temanombre'].'</option>';
						?>
					</select>
				</td>
				<td width="100" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">
					<input type="text" size="3"  style="font-size:11px" name="<?php echo $objHora;?>" id="<?php echo $objHora;?>" value="<?php echo $$objHora;?>" onchange="calculahoras();" />
					<select name="<?php echo $objThora ?>" id="<?php echo $objThora ?>" onchange="calculahoras();" style="font-size:11px">
						<option value="1" <?php if($$objThora == 1) echo 'selected' ?>>HR</option>
						<option value="2" <?php if($$objThora == 2) echo 'selected' ?>>MIN</option>
					</select>
				</td>
				<td width="97" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">
					<input type="text" size="7" name="<?php echo $objvalor;?>" id="<?php echo $objvalor;?>" value="<?php echo $$objvalor;?>" style="font-size:11px" />
				</td>
			</tr>
			<?php 
				endfor;

				if($a < 20):
					for($b = $a; $b < 20; $b++):
						($b % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">
				<td width="20" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="200" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="200" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="200" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="100" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="97" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
			<?php
					endfor;
				endif;
			?>		
		</table>
	</div>
</div>
		