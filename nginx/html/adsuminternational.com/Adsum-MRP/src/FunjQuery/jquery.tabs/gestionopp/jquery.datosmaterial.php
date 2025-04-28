<?php 

	if($tipsolcodigo == 1){
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
		<tr class="ui-state-default">
			<td colspan="5" class="cont-title">&nbsp;Datos de material</td>
		</tr>
	<?php

		if($formulcodigo > 0){

			$rwOpp = loadrecordopp($ordoppcodigo,$idcon);

			$sqlFormulacion = "SELECT DISTINCT iteforcapa, itedescodigo, SUM(iteforporcen) AS iteforporcen 
				FROM itemformul WHERE formulcodigo = '{$formulcodigo}' GROUP BY iteforcapa,itedescodigo ORDER BY iteforcapa";

			$rsFormulacion = fncsqlrun($sqlFormulacion,$idcon);
			$nrFormulacion = fncnumreg($rsFormulacion);

			for($a = 0; $a < $nrFormulacion; $a++){

				$rwFormulacion = fncfetch($rsFormulacion,$a);

				$rwFormul = loadrecordformulacion($formulcodigo, $idcon);
				$rwItemdesa = loadrecorditemdesa($rwFormulacion["itedescodigo"],$idcon);

				$objPorcen = "iteforporcen_".$rwFormulacion["itedescodigo"];
				$objCapa = "formulcapa".strtolower($rwFormulacion["iteforcapa"]);

				$$objPorcen = $$objPorcen + (($rwFormulacion["iteforporcen"] / 100) * ($rwFormul[$objCapa] / 100));
			}			
			
			$sqlFormulacion = "SELECT DISTINCT(itedescodigo) FROM itemformul WHERE formulcodigo ='{$formulcodigo}'";

			$rsFormulacion = fncsqlrun($sqlFormulacion,$idcon);
			$nrFormulacion = fncnumreg($rsFormulacion);

			for($a = 0; $a < $nrFormulacion; $a++){

				$rwFormulacion = fncfetch($rsFormulacion,$i);
				$rwItemdesa = loadrecorditemdesa($rwFormulacion["itedescodigo"],$idcon);
				$objPorcen = "iteforporcen_".$rwFormulacion["itedescodigo"];
?>
		<tr>
			<td width="10%" class="NoiseFooterTD">&nbsp;Item.</td>
			<td width="40%" class="NoiseDataTD">&nbsp;<?php echo $rwItemdesa['itedescodigo']; ?>&nbsp;-<?php echo carganombitemdesa($rwItemdesa["itedescodigo"],$idcon); ?></td>
			<td width="10%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($rwOpp["ordoppcantkg"] * $$objPorcen, 2, ",", "."); ?></td>
			<td width="10%" class="NoiseDataTD">&nbsp;<?php echo number_format($$objPorcen * 100, 2, ",", "."); ?>&nbsp;<b>(%)</b></td>
		</tr>
<?php				
			}
		}
			
		if(!$nrFormulacion || !$formulcodigo){
?>
		<tr>
			<td>
				<div class="ui-widget">
				 	<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
			  			<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
			  			<b>No se encontraron resinas en la formula.</b></p>
			 		</div>
				</div>
			</td>
		</tr>

<?php
		}

?>
	</table>
<?php
	}else{
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
		<tr class="ui-state-default">
			<td class="cont-title">&nbsp;Datos de material</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
<?php 

		$rsOppitemdesa = dinamicscanoppitemdesa(array( 'ordoppcodigo' => $ordoppcodigo ),$idcon);
		$nrOppitemdesa = fncnumreg($rsOppitemdesa);

		if(!$nrOppitemdesa){

?>
		<tr>
			<td>
				<div class="ui-widget">
				 	<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
			  			<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
			  			<b>No se encontraron materiales asignados en OPP.</b></p>
			 		</div>
				</div>
			</td>
		</tr>

<?php
		}
			
		for( $a = 0; $a < $nrOppitemdesa; $a++){

			unset($metros);	
			$rwOppitemdesa = fncfetch($rsOppitemdesa,$a);
			$rwItemdesa = loadrecorditemdesa($rwOppitemdesa['itedescodigo'],$idcon);
			$rwPadreitem = loadrecordpadreitemxkeylinea($rwItemdesa['keylinea'],$idcon);

			if($rwPadreitem["paditedensid"] > 0 && $rwItemdesa["itedesancho"] > 0 && $rwItemdesa["itedescalib"] > 0){
					
				$metros = ( $rwOppitemdesa['oppitecantid'] / ($rwItemdesa['itedesancho'] * $rwItemdesa['itedescalib'] * $rwPadreitem['paditedensid']) ) * 1000000 ;
			}

?>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Item.</td>
			<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $rwOppitemdesa['itedescodigo']; ?></td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Material.</td>
			<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo carganombitemdesa($rwOppitemdesa['itedescodigo'],$idcon); ?></td>
		</tr>
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;<b>(kgs)</b></td>
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($rwOppitemdesa['oppitecantid'], 2, ',', '.'); ?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Metros&nbsp;<b>(mts)</b></td>
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($metros, 2, ',', '.'); ?></td>
		</tr>
<?php
		
			$rsRequisicion = fullscanrequisicionoppxopp($ordoppcodigo,$idcon);
			$nrRequisicion = fncnumreg($rsRequisicion);

			for($b = 0;$b < $nrRequisicion;$b++){

				$rwRequisicion = fncfetch($rsRequisicion, $b);

				if($rwRequisicion["requisnumero"] > 0){

					$rwSumaItemdesa = loadrecordsumrequisicionitemdesa($rwRequisicion["requiscodigo"], $rwOppitemdesa["itedescodigo"], $idcon);
					$RINUMERO = ($RINUMERO)? $RINUMERO."&nbsp;".$rwRequisicion["requisnumero"]."<br>" : $rwRequisicion["requisnumero"]."<br>";
					$RIDESCRI = ($RIDESCRI)? $RIDESCRI."&nbsp;".$rwRequisicion["requisdescri"]."<br>" : $rwRequisicion["requisdescri"]."<br>";

					if( $rwSumaItemdesa > 0){

						$RIRECIBIDO = ($RIRECIBIDO)? $RIRECIBIDO."&nbsp;".number_format($rwSumaItemdesa["reqitecantre"], 2, ",", ".")."<br>" : number_format($rwSumaItemdesa["reqitecantre"], 2, ",", ".")."<br>";
					}

				}

			}
			
		} 
?>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
		<tr class="ui-state-default">
			<td class="cont-title">&nbsp;Datos de Requisicion</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;No. R.I&nbsp;</td>
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($RINUMERO)? $RINUMERO : "---" ; ?></td>
			<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;<b>(kgs)</b></td>
			<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($RIRECIBIDO)? $RIRECIBIDO : "---" ; ?></td>
		</tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n&nbsp;</td>
			<td colpan="3" class="NoiseDataTD">&nbsp;<?php echo ($RIDESCRI)? $RIDESCRI : "---" ; ?></td>
		<tr>
		</tr>
	</table>
<?php 

	}
?>