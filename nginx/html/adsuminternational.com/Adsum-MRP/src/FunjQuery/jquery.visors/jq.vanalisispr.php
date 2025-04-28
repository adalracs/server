<?php 

	if(!$noAjax)
	{
		include "../../FunPerPriNiv/pktblvaranalisis.php";
		include "../../FunPerPriNiv/pktblitemdesa.php";
		include "../../FunPerSecNiv/fncnumreg.php";
		include "../../FunPerSecNiv/fncclose.php";
		include "../../FunPerSecNiv/fncfetch.php";
		include "../../FunPerSecNiv/fncconn.php";
		include "../../FunGen/cargainput.php";
	}
	
	$idcon = fncconn();

	if($tipsolcodigo > 0){

		$rsVarAnalisis = dinamicscanopvaranalisis(array("tipsolcodigo" => $tipsolcodigo),array("tipsolcodigo" => "="),$idcon);
			
		if($rsVarAnalisis){
			$nrVarAnalisis = fncnumreg($rsVarAnalisis);
		}

	}

	if($nrVarAnalisis > 0){
?>	
	
<div style="width:770px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="40%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Variable</td>
				<td width="25%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Tipo Especificacion</td>
				<td width="15%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Especificacion</td>
				<td width="8%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Unidad</td>
				<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Resultado</td>
				<td width="2%" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:770px; height: 140px;overflow:auto;" class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
		
		for($a = 0; $a < $nrVarAnalisis; $a++){
			$complement = ($a % 2) ? ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

			$rwVarAnalisis = fncfetch($rsVarAnalisis, $a);

			$varanaespecificacion = "";
			$vartipoespecificacion = "";

			if($rwVarAnalisis["varanatipespe"] == 1){

				$varanaespecificacion = "+ ".$rwVarAnalisis["varanatolems"]. " - ".$rwVarAnalisis["varanatolemn"];
				$vartipoespecificacion = "Rango +/- | Tolerancia +/-";

				if($itedesespeci){
					$varanaespecificacion += "&nbsp;{".$itedesespeci."}";
				}

			}else if($rwVarAnalisis["varanatipespe"] == 2){

				$varanaespecificacion = $rwVarAnalisis["varanadetesp"];
				$vartipoespecificacion = "Mayor Igual >= ";

			}else if($rwVarAnalisis["varanatipespe"] == 3){

				$varanaespecificacion = $rwVarAnalisis["varanadetesp"];
				$vartipoespecificacion = "Menor Igual <= ";

			}else if($rwVarAnalisis["varanatipespe"] == 4){

				$vartipoespecificacion = "Binaria 1/0 <= ";

			}

			$varValor = 'txtvalor'.$rwVarAnalisis['varanacodigo'];
			$varVaranatipespee = 'varanatipespe'.$rwVarAnalisis['varanacodigo'];
			$varVaranatolems = 'varanatolems'.$rwVarAnalisis['varanacodigo'];
			$varVaranatolemn = 'varanatolemn'.$rwVarAnalisis['varanacodigo'];
			$varVaranadetesp = 'varanadetesp'.$rwVarAnalisis['varanacodigo'];

			$$varVaranatipespee = $rwVarAnalisis["varanatipespe"];
			$$varVaranatolems = $rwVarAnalisis["varanatolems"];
			$$varVaranatolemn = $rwVarAnalisis["varanatolemn"];
			$$varVaranadetesp = $rwVarAnalisis["varanadetesp"];

?>
			<tr <?php echo $complement ?> >
				<td width="40%" style=" border-bottom: 1px solid #fff;"><?php echo ($rwVarAnalisis["varananombre"])? strtoupper($rwVarAnalisis["varananombre"]) : "---" ;?></td>
				<td width="25%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($vartipoespecificacion)? strtoupper($vartipoespecificacion) : "---"; ?></td>
				<td width="15%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($varanaespecificacion)? strtoupper($varanaespecificacion) : "---"; ?></td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwVarAnalisis["unidadcodigo"])? $rwVarAnalisis["unidadcodigo"] : "" ; ?></td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;
					<?php if(!$flagDetallar){ ?>
						<input type="text" name="<?php echo $varValor; ?>" id="<?php echo $varValor; ?>" value="<?php echo $$varValor; ?>" size="5" class="<?php if($campnomb[$varValor] == 1){ echo 'ui-state-error ui-corner-all'; }else if($campnombre[$varValor] == 1){ echo "ui-state-highlight ui-corner-all"; } ?>" onkeyup="valResultado(this.value, '<?php echo $rwVarAnalisis['varanacodigo']; ?>');" /></td>
					<?php }else{ 

							echo ($$varValor)? $$varValor : "---" ;

						}
					?>
					<input type="hidden" name="<?php echo $varVaranatipespee; ?>" id="<?php echo $varVaranatipespee; ?>" value="<?php echo $$varVaranatipespee; ?>"/>
					<input type="hidden" name="<?php echo $varVaranatolems; ?>" id="<?php echo $varVaranatolems; ?>" value="<?php echo $$varVaranatolems; ?>"/>
					<input type="hidden" name="<?php echo $varVaranatolemn; ?>" id="<?php echo $varVaranatolemn; ?>" value="<?php echo $$varVaranatolemn; ?>"/>
					<input type="hidden" name="<?php echo $varVaranadetesp; ?>" id="<?php echo $varVaranadetesp; ?>" value="<?php echo $$varVaranadetesp; ?>"/>
			</tr>
<?php			
		}
		
	
		if($a < 13){
			for($b = $a; $b < 13; $b++){
				($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="40%" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="25%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="15%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="8%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="10%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>
<?php

	}else{
?>
		<div class="ui-widget">
			<div style="margin-top: 1px; padding: 0 .7em;height: 100px;" class="ui-state-highlight ui-corner-all">
				<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span> <b>No se encontro plan de inspecci&oacute;n&nbsp;</b></p>
			</div>
		</div>
<?php 
	}
?>		