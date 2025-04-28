<!-- NECESIDAD DE PRODUCCION -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Necesidad de producci&oacute;n</td>
	</tr>
</table>
<?php
for($a = 0;$a < 1;$a++)
{
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Calibre</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($total_calibre)? $total_calibre : '---' ;?>&nbsp;<b>&micro;m</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho planeado</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($arrMateriales[$a]['plapadanchoi'])? number_format($arrMateriales[$a]['plapadanchoi'], 2, ',', '.')  : '---' ;?>&nbsp;<b>mm</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($cantplanea_kgs)? number_format($cantplanea_kgs, 2, ',', '.') : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Metros</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($arrMateriales[$a]['plapadcantmt'])? number_format($arrMateriales[$a]['plapadcantmt'], 2, ',', '.') : '' ; ?>&nbsp;</td>
	</tr>
</table>
<?php
}
?>
<!-- FIN NECESIDAD DE PRODUCCION -->
<!-- OBSERVACIONES -->
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="3" class="ui-state-default">&nbsp;Observaciones</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td><?php echo $ordprodescri_cor; ?></td>
	</tr>
</table>
<!-- FIN OBSERVACIONES -->



<!-- ORDENES DE PRODUCCION -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;ORDENES DE PRODUCCION PROGRAMADAS</td>	
	</tr>
</table>
<?php 
$idcon = fncconn();
$rsOP = dinamicscanopop2(array('solprocodigo' => $solprocodigo,'tipsolcodigo' => 4),array('solprocodigo' => '=','tipsolcodigo' => '='),$idcon);
$nrOP = fncnumreg($rsOP);
if(!$nrOP)
{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td>
			<div class="ui-widget">
				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">
					<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span> <b>No se encontraron opp.</b></p>
				</div>
			</div>
		</td>
	</tr>
</table>
<?php
}
for($a = 0;$a < $nrOP;$a++)
{
	$rwOP = fncfetch($rsOP,$a);
	$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwOP['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
	$nrOpproduccion = fncnumreg($rsOpproduccion);
	//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
	$ANCHOBOBINA = '';
	$ANCHOCORTE = '';
	$KILOSCORTE = '';
	$METROSCORTE = '';
	//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
	$ANCHOCORTE = '';
	$PISTACORTE = '';
	$FECHAENTREGA = '';
	//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
	$ANCHOBOBINA = ($rwOP['ordoppanchot'])? $rwOP['ordoppanchot'] : '---' ;
	$KILOSCORTE = ($rwOP['ordoppcantkg'])? $rwOP['ordoppcantkg'] : '---' ;
	$METROSCORTE = ($rwOP['ordoppcantmt'])? $rwOP['ordoppcantmt'] : '---' ;
	for($b = 0;$b < $nrOpproduccion;$b++)
	{
		$rwOpproduccion = fncfetch($rsOpproduccion, $b);
		$rwOpcorte = loadrecordopcorte($rwOpproduccion['ordprocodigo'],$idcon);
		//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
		$TAMANOCORE = ($rwOpcorte['ordprotacore'])? $rwOpcorte['ordprotacore'] : '---' ;
		//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
		if($rwOpcorte['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpcorte['producnombre'] : $rwOpcorte['producnombre'] ;
		if($rwOpcorte['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpcorte['pedvenfecent']) : strtoupper($rwOpcorte['pedvenfecent']) ;
		if($rwOpcorte['ordproancmat'] && $rwOpcorte['ordpropistap']) 
		{
			$ANCHOCORTE = ($ANCHOCORTE)? $ANCHOCORTE.' | '.($rwOpcorte['ordpropistap'] * $rwOpcorte['ordproancmat']) : ($rwOpcorte['ordpropistap'] * $rwOpcorte['ordproancmat']);
			$PISTACORTE = ($PISTACORTE)? $PISTACORTE.' | '.$rwOpcorte['ordpropistap'].' * '.$rwOpcorte['ordproancmat'] : $rwOpcorte['ordpropistap'].' * '.$rwOpcorte['ordproancmat'] ;
		}
	}
	
	($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr> 
		<td class="ui-state-default" width="10%"  align="center"># OP</td>
		<td class="ui-state-default" width="10%"  align="center">T. Core&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="10%"  align="center">A.&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="20%"  align="center">A. Corte&nbsp;<b>mm</b></td>
		<td class="ui-state-default" width="20%"  align="center">Pistas&nbsp;</td>
		<td class="ui-state-default" width="10%"  align="center">F. Entrega</td>
		<td class="ui-state-default" width="10%"  align="center"><b>Kgs Pr.</b></td>
		<td class="ui-state-default" width="10%"  align="center"><b>Mts Pr.</b></td>  
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" rowspan="2">&nbsp;<?php echo str_pad($rwOP['ordoppcodigo'], 4, "0", STR_PAD_LEFT) ?></td>
		<td class="cont-line">&nbsp;<?php echo $TAMANOCORE; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOBOBINA; ?></td>
		<td class="cont-line">&nbsp;<?php echo $ANCHOCORTE; ?></td>
		<td class="cont-line">&nbsp;<?php echo $PISTACORTE; ?></td>
		<td class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($KILOSCORTE, 2, ',', '.'); ?></td>
		<td class="cont-line">&nbsp;<?php echo number_format($METROSCORTE, 2, ',', '.'); ?></td>
	</tr>
	<tr <?php echo $complement ?>">
		<td class="cont-line" colspan="7">
		<?php 
			$ordoppcodigo = $rwOP['ordoppcodigo'];
			$tiposoliprog = 4;
			include ('jquery.historeporteopp.php');
		?>
		</td>
	</tr>
</table>
<?php 
}
?>