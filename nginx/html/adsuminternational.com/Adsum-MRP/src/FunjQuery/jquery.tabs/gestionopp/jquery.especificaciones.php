<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Especificaciones de la OPP</td>
	</tr>
</table>


<!-- 	EXTRUSION -->
<?php
$rwOpp = loadrecordopp($ordoppcodigo,$idcon);
 
if($tipsolcodigo == 1):

$ANCHOEXTRUSION = ($rwOpp['ordoppanchot'])? $rwOpp['ordoppanchot'] : '---' ;
$KILOSEXTRUSION = ($rwOpp['ordoppcantkg'])? $rwOpp['ordoppcantkg'] : '---' ;
$METROSEXTRUSION = ($rwOpp['ordoppcantmt'])? $rwOpp['ordoppcantmt'] : '---' ;
$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwOpp['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
$nrOpproduccion = fncnumreg($rsOpproduccion);
for($a = 0;$a < $nrOpproduccion;$a++)
{
	$rwOpproduccion = fncfetch($rsOpproduccion, $a);
	$rwOpextrusion = loadrecordopextrusion($rwOpproduccion['ordprocodigo'],$idcon);
	$formulcodigo = ($rwOpextrusion['formulcodigo'])? $rwOpextrusion['formulcodigo'] : '' ;
	$FORMULAEXTRUSION = ($rwOpextrusion['formulnumero'])? $rwOpextrusion['formulnumero'] : '---' ;
	$CALIBREEXTRUSION = ($rwOpextrusion['ordprocalibr'])? $rwOpextrusion['ordprocalibr'] : '---' ;
	if($rwOpextrusion['ordproancmat'] && $rwOpextrusion['ordpropistae']) 
	{
		$CORTEEXTRUSION = ($CORTEEXTRUSION)? $CORTEEXTRUSION.' | '.($rwOpextrusion['ordpropistae'] * $rwOpextrusion['ordproancmat']) : ($rwOpextrusion['ordpropistae'] * $rwOpextrusion['ordproancmat']);
		$PISTASEXTRUSION = ($PISTASEXTRUSION)? $PISTASEXTRUSION.' | '.$rwOpextrusion['ordpropistae'].' * '.$rwOpextrusion['ordproancmat'] : $rwOpextrusion['ordpropistae'].' * '.$rwOpextrusion['ordproancmat'] ;
	}
}
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho Extrusion&nbsp;<b>(mm)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $ANCHOEXTRUSION; ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($CALIBREEXTRUSION, 2, ',', '.'); ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($KILOSEXTRUSION, 2, ',', '.'); ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Metros&nbsp;<b>(&micro;m)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($METROSEXTRUSION, 2, ',', '.'); ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Formula&nbsp;<input type="hidden" name="formulcodigo" id="formulcodigo" value="<?php echo $formulcodigo; ?>" /></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $FORMULAEXTRUSION;  ?>&nbsp;<small><button id="formulbutton">Detallar Formulacion</button></small></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Corte extrusion&nbsp;<b>(mm)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $CORTEEXTRUSION;  ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Pistas&nbsp;</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $PISTASEXTRUSION;  ?></td>
	</tr>
</table>
<?php endif;?>
<!-- 	FIN EXTRUSION -->




<!-- 	LAMINADO -->
<?php 
if($tipsolcodigo == 2):

$ANCHOLAMINADO = ($rwOpp['ordoppanchot'])? $rwOpp['ordoppanchot'] : '---' ;
$KILOSLAMINADO = ($rwOpp['ordoppcantkg'])? $rwOpp['ordoppcantkg'] : '---' ;
$METROSLAMINADO = ($rwOpp['ordoppcantmt'])? $rwOpp['ordoppcantmt'] : '---' ;
$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwOpp['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
$nrOpproduccion = fncnumreg($rsOpproduccion);
for($a = 0;$a < $nrOpproduccion;$a++)
{				
	$rwOpproduccion = fncfetch($rsOpproduccion, $a);
	$rwOplaminado = loadrecordoplaminado($rwOpproduccion['ordprocodigo'],$idcon);
	$MATERIALLAMINADO = ($rwOplaminado['paditenombre'])? $rwOplaminado['paditenombre'] : '---' ;
	$TIPOADHESIVO = ($rwOplaminado['ordprotiposo'])? strtoupper($rwOplaminado['ordprotiposo']) : '---' ;
	$DESEMPENOADHESIVO = ($rwOplaminado['ordprodesemp'])? strtoupper($rwOplaminado['ordprodesemp']) : '---' ;
	$LAMINADOADHESIVO = ($rwOplaminado['ordprolamina'])? strtoupper($rwOplaminado['ordprolamina']) : '---' ;
}				
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho Laminado&nbsp;<b>(mm)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $ANCHOLAMINADO; ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Laminado&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $LAMINADOADHESIVO;  ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($KILOSLAMINADO, 2, ',', '.'); ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Metros&nbsp;<b>(&micro;m)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($METROSLAMINADO, 2, ',', '.'); ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Tipo Adhesivo&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $TIPOADHESIVO;  ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Desempe&ntilde;o&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $DESEMPENOADHESIVO;  ?></td>
	</tr>
</table>
<?php 
endif;
?>
<!-- 	FIN LAMINADO -->


<!-- 	FLEXO -->
<?php 
if($tipsolcodigo == 3):
$ANCHOIMPRESION = ($rwOpp['ordoppanchot'])? $rwOpp['ordoppanchot'] : '---' ;
$KILOSIMPRESION = ($rwOpp['ordoppcantkg'])? $rwOpp['ordoppcantkg'] : '---' ;
$METROSIMPRESION = ($rwOpp['ordoppcantmt'])? $rwOpp['ordoppcantmt'] : '---' ;
$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwOpp['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
$nrOpproduccion = fncnumreg($rsOpproduccion);
for($a = 0;$a < $nrOpproduccion;$a++)
{
	$rwOpproduccion = fncfetch($rsOpproduccion, $a);
	$rwOpflexografia = loadrecordopflexo($rwOpproduccion['ordprocodigo'],$idcon);
	$MATERIALIMPRESION = ($rwOpflexografia['paditenombre'])? $rwOpflexografia['paditenombre'] : '---' ;
	$TIPOIMPRESION = ($rwOpflexografia['ordprotipimp'])? strtoupper($rwOpflexografia['ordprotipimp']) : '---' ;
	$RODILLOIMPRESION = ($rwOpflexografia['ordprorodill'])? $rwOpflexografia['ordprorodill'] : '---' ;
	$CALIBREFLEXO = ($rwOpflexografia['ordprocalibr'])? $rwOpflexografia['ordprocalibr'] : '---' ;
	$PISTASFLEXO = ($rwOpflexografia['ordpropistap'])? $rwOpflexografia['ordpropistap'] : '---' ;
}
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho impresion&nbsp;<b>(mm)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $ANCHOIMPRESION; ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Material de impresion&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $MATERIALIMPRESION;  ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($KILOSIMPRESION, 2, ',', '.'); ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Metros&nbsp;<b>(mm)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($METROSIMPRESION, 2, ',', '.'); ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Tipo impresion&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $TIPOIMPRESION;  ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Rodillo impresion&nbsp;<b>(mm)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $RODILLOIMPRESION;  ?></td>
	</tr>
</table>
<?php endif;?>
<!-- 	FIN FLEXO -->





<!-- 	CORTE -->
<?php 
if($tipsolcodigo == 4):
$ANCHOBOBINA = ($rwOpp['ordoppanchot'])? $rwOpp['ordoppanchot'] : '---' ;
$KILOSCORTE = ($rwOpp['ordoppcantkg'])? $rwOpp['ordoppcantkg'] : '---' ;
$METROSCORTE = ($rwOpp['ordoppcantmt'])? $rwOpp['ordoppcantmt'] : '---' ;
$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwOpp['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
$nrOpproduccion = fncnumreg($rsOpproduccion);
for($a = 0;$a < $nrOpproduccion;$a++)
{
	$rwOpproduccion = fncfetch($rsOpproduccion, $c);
	$rwOpcorte = loadrecordopcorte($rwOpproduccion['ordprocodigo'],$idcon);
	$TAMANOCORE = ($rwOpcorte['ordprotacore'])? $rwOpcorte['ordprotacore'] : '---' ;
	if($rwOpcorte['ordproancmat'] && $rwOpcorte['ordpropistap']) 
	{
		$ANCHOCORTE = ($ANCHOCORTE)? $ANCHOCORTE.' | '.($rwOpcorte['ordpropistap'] * $rwOpcorte['ordproancmat']) : ($rwOpcorte['ordpropistap'] * $rwOpcorte['ordproancmat']);
		$PISTACORTE = ($PISTACORTE)? $PISTACORTE.' | '.$rwOpcorte['ordpropistap'].' * '.$rwOpcorte['ordproancmat'] : $rwOpcorte['ordpropistap'].' * '.$rwOpcorte['ordproancmat'] ;
	}
}
?> 
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho bobina&nbsp;<b>(mm)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $ANCHOBOBINA; ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Tama&ntilde;o core&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $TAMANOCORE;  ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($KILOSCORTE, 2, ',', '.'); ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Metros&nbsp;<b>(&micro;m)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($METROSCORTE, 2, ',', '.'); ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Pistas&nbsp;</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $PISTACORTE;  ?></td>
	</tr>
</table>
 <?php 
 endif;
 ?>
<!-- 	FIN CORTE -->




<!-- 	SELLADO -->
<?php 
if($tipsolcodigo == 5):
$KILOSSELLADO = ($rwOpp['ordoppcantkg'])? $rwOpp['ordoppcantkg'] : '---' ;
$METROSELLADO = ($rwOpp['ordoppcantmt'])? $rwOpp['ordoppcantmt'] : '---' ;
$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwOpp['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
$nrOpproduccion = fncnumreg($rsOpproduccion);
for($a = 0;$a < $nrOpproduccion;$a++)
{
	$rwOpproduccion = fncfetch($rsOpproduccion, $a);
	$rwOpsellado = loadrecordopsellado($rwOpproduccion['ordprocodigo'],$idcon);
	if($rwOpsellado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpsellado['producnombre'] : $rwOpsellado['producnombre'] ;
	if($rwOpsellado['ordprolargom']) $LARGOMATERIAL = ($LARGOMATERIAL)? $LARGOMATERIAL.'<br>&nbsp;'.$rwOpsellado['ordprolargom'] : $rwOpsellado['ordprolargom'] ;
	if($rwOpsellado['ordprofuellem']) $FUELLEMATERIAL = ($FUELLEMATERIAL)? $FUELLEMATERIAL.'<br>&nbsp;'.$rwOpsellado['ordprofuellem'] : $rwOpsellado['ordprofuellem'] ;
	if($rwOpsellado['ordproanchom']) $ANCHOMATERIAL = ($ANCHOMATERIAL)? $ANCHOMATERIAL.'<br>&nbsp;'.$rwOpsellado['ordproanchom'] : $rwOpsellado['ordproanchom'] ;
	if($rwOpsellado['ordpropmillar']) $PESOMILLAR = ($PESOMILLAR)? $PESOMILLAR.'<br>&nbsp;'.$rwOpsellado['ordpropmillar'] : $rwOpsellado['ordpropmillar'] ;
	if($rwOpsellado['propedcansol']) $CANTIDADPED = ($CANTIDADPED)? $CANTIDADPED.'<br>&nbsp;'.$rwOpsellado['propedcansol'] : $rwOpsellado['propedcansol'] ;
}
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho material&nbsp;<b>(mm)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $ANCHOMATERIAL; ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Largo material&nbsp;<b>(mm)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $LARGOMATERIAL;  ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($KILOSSELLADO, 2, ',', '.'); ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Metros&nbsp;<b>(&micro;m)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo number_format($METROSELLADO, 2, ',', '.'); ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Fuelle&nbsp;</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $FUELLEMATERIAL;  ?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Peso millar&nbsp;<b>(gr)</b></td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $PESOMILLAR;  ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad pedida&nbsp;</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $CANTIDADPED;  ?></td>
	</tr>
</table>

<?php endif;?>
<!-- 	FIN SELLADO -->