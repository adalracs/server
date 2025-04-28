<?php

	$idcon = fncconn();
	$rsCorte = dinamicscanopprogramacorte1(array("equipocodigo" => $equipo, "ordoppcomfir" => 1),array("equipocodigo" => "=", "ordoppcomfir" => "="),$idcon, $rtr = 1);
	//se consulta el numero de registros
	$nrCorte = fncnumreg($rsCorte);
	//objetos para el total por maquina
	$total_equipound = $equipo.'_und';
	$total_equipomts = $equipo.'_mts';
	$total_equipokgs = $equipo.'_kgs';
	$total_equipotmp = $equipo.'_tmp';

	echo "<script type='text/javascript'>Event_animatedcollapse('".$nrCorte."', 'filtrOpp_".$equipo."');</script>";
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
	<tr>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span></td>
		<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-person"></span></td>
		<td class="ui-state-default" width="5%"  align="center">O.E</td> 
		<td class="ui-state-default" width="15%"  align="center">Tiempo Pr.</td> 
		<td class="ui-state-default" width="5%"  align="center"># OPP</td>
		<td class="ui-state-default" width="15%"  align="center">Material</td>
		<td class="ui-state-default" width="10%"  align="center">Kilogramos&nbsp;</td>
		<td class="ui-state-default" width="10%"  align="center">Metros&nbsp;</td>
		<td class="ui-state-default" width="10%"  align="center">Estado</b></td>
		<td class="ui-state-default" width="10%"  align="center">No. RI</td>
		<td class="ui-state-default" width="10%"  align="center">Recibido&nbsp;<small>(kgs)</small></td>
	</tr>
<?php 
		for($b = 0; $b < $nrCorte; $b++):
			$rwCorte = fncfetch($rsCorte, $b);
			unset($__itedescodigo);
			//sumatoria de unidades , metros, kilogramos
			$$total_equipound = $$total_equipound + 1; 
			$$total_equipokgs = $$total_equipokgs + $rwCorte['ordoppcantkg'];
			$$total_equipomts = $$total_equipomts + $rwCorte['ordoppcantmt'];
			
			//escaneo de velocidades para sumatoria de minutos de duracion de la orden
			$rsOppVelocidadpn = dinamicscanopoppvelocidadpn(array('ordoppcodigo' => $rwCorte['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppVelocidadpn = fncnumreg($rsOppVelocidadpn);
			for($i = 0; $i < $nrOppVelocidadpn; $i++)
			{
				$rwOppVelocidadpn = fncfetch($rsOppVelocidadpn, $i);
				$rwVelocidadpn = loadrecordvelocidadpn($rwOppVelocidadpn['velocicodigo'],$idcon);
				$$total_equipotmp = $$total_equipotmp + $rwVelocidadpn['velocivalora'];
			}
			//escaneo de ajuste para sumatoria de minutos de duracion de la orden
			$rsOppAjustepn = dinamicscanopoppajustepn(array('ordoppcodigo' => $rwCorte['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppAjustepn = fncnumreg($rsOppAjustepn);
			for($i = 0; $i < $nrOppAjustepn; $i++)
			{
				$rwOppAjustepn = fncfetch($rsOppAjustepn, $i);
				$rwAjustepn = loadrecordajustepn($rwOppAjustepn['ajustecodigo'],$idcon);
				$$total_equipotmp = $$total_equipotmp + $rwAjustepn['ajustevalora'];
			}
			//converision de mintuos a horas
			$varDate = date("Y-m-d H:i");
			//rutina para material asignado a la orden
			$rsOppItemDesa = dinamicscanopoppitemdesa(array('ordoppcodigo' => $rwCorte['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppItemDesa = fncnumreg($rsOppItemDesa);
			$MATCORTE = '';
			for($c = 0; $c < $nrOppItemDesa; $c++)
			{
				$rWOppItemDesa = fncfetch($rsOppItemDesa, $c);
				if($rWOppItemDesa['itedescodigo']){
					
					$__itedescodigo = ($__itedescodigo)? $__itedescodigo : $rWOppItemDesa['itedescodigo'];
					$MATCORTE = ($MATCORTE)? $MATCORTE.'-&nbsp;'.strtoupper($rWOppItemDesa['itedescodigo']).' - '.carganombitemdesa($rWOppItemDesa['itedescodigo'],$idcon) : strtoupper($rWOppItemDesa['itedescodigo']).' - '.carganombitemdesa($rWOppItemDesa['itedescodigo'],$idcon) ;
				}
			}
			//rutina para proceso de impresion
			$MATLAMINADO = '';
			$CANTLAMINADO = 0;
			$METROSLAMINADO = 0;
			$rwOp = loadrecordop1($rwCorte['ordoppcodigo'],$idcon);
			$rsProgramaLaminado = dinamicscanopop1(array( 'solprocodigo' => $rwOp['solprocodigo'], 'tipsolcodigo' => 2 ), array( 'solprocodigo' => '=', 'tipsolcodigo' => '=' ), $idcon);
			$nrProgramaLaminado = fncnumreg($rsProgramaLaminado);

			if($nrProgramaLaminado < 0 || !$nrProgramaLaminado)
				$MATLAMINADO = strtoupper('sin laminado');


			for($c = 0; $c < $nrProgramaLaminado; $c++)
			{
				$rwProgramaLaminado = fncfetch($rsProgramaLaminado, $c);
				
				$rsReporteoppReportepn = dinamicscanopreporteoppreportepn1( array( 'ordoppcodigo' => $rwProgramaLaminado['ordoppcodigo'] ), array( 'ordoppcodigo' => '='), $idcon);
				$nrReporteoppReportepn = fncnumreg($rsReporteoppReportepn);
				for($d = 0; $d < $nrReporteoppReportepn; $d++)
				{
					$rwReporteoppReportepn = fncfetch($rsReporteoppReportepn, $d);
					$CANTLAMINADO += $rwReporteoppReportepn['reoppncantkg'];
					$METROSLAMINADO += $rwReporteoppReportepn['reoppncantmt'];
				}
			}

			if($CANTLAMINADO > 0 && $METROSLAMINADO > 0)
				$MATLAMINADO = strtoupper('Kgs: '.number_format($CANTLAMINADO,2 , ',', '.').' Mts: '.number_format($METROSLAMINADO, 2, ',', '.'));
			else
				$MATLAMINADO = strtoupper('no laminado');
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwCorte['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOBOBINA = '';
			$ANCHOCORTE = '';
			$KILOSCORTE = '';
			$METROSCORTE = '';
			$APROBADOCORTE = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$TAMANOCORE = '';
			$ANCHOCORTE = '';
			$PISTACORTE = '';
			$FECHAENTREGA = '';
			$PEDIDOPRODUCCION = '';
			$TIPOPVCORTE = '';			
			$ITEMPRODUCCION = '';
			$REFPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			$OPESTADO = "";
			$RINUMERO = "";
			$RIRECIBIDO = "";
			$SALDO = "";
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOBOBINA = ($rwCorte['ordoppanchot'])? $rwCorte['ordoppanchot'] : '---' ;
			$KILOSCORTE = ($rwCorte['ordoppcantkg'])? $rwCorte['ordoppcantkg'] : '---' ;
			$METROSCORTE = ($rwCorte['ordoppcantmt'])? $rwCorte['ordoppcantmt'] : '---' ;
			$APROBADOCORTE = ($rwCorte['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;
			$SPANCORTE = ($rwCorte['ordoppcomfir'] > 0)? 'ui-icon ui-icon-circle-check' : 'ui-icon ui-icon-circle-close' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOpcorte = loadrecordopcorte($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				$TAMANOCORE = ($rwOpcorte['ordprotacore'])? $rwOpcorte['ordprotacore'] : '---' ;
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpcorte['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpcorte['pedvennumero'] : $rwOpcorte['pedvennumero'] ;
				if($rwOpcorte['tipevenombre']) $TIPOPVCORTE = ($TIPOPVCORTE)? $TIPOPVCORTE.'<br>&nbsp;'.$rwOpcorte['tipevenombre'] : $rwOpcorte['tipevenombre'] ;
				if($rwOpcorte['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpcorte['ordcomrazsoc'] : $rwOpcorte['ordcomrazsoc'] ;
				if($rwOpcorte['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOpcorte['produccoduno'] : $rwOpcorte['produccoduno'] ;
				if($rwOpcorte['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpcorte['producnombre'] : $rwOpcorte['producnombre'] ;
				if($rwOpcorte['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpcorte['pedvenfecent']) : strtoupper($rwOpcorte['pedvenfecent']) ;
				if($rwOpcorte['ordproancmat'] && $rwOpcorte['ordpropistap']) 
				{
					$ANCHOCORTE = ($ANCHOCORTE)? $ANCHOCORTE.' | '.($rwOpcorte['ordpropistap'] * $rwOpcorte['ordproancmat']) : ($rwOpcorte['ordpropistap'] * $rwOpcorte['ordproancmat']);
					$PISTACORTE = ($PISTACORTE)? $PISTACORTE.' | '.$rwOpcorte['ordpropistap'].' * '.$rwOpcorte['ordproancmat'] : $rwOpcorte['ordpropistap'].' * '.$rwOpcorte['ordproancmat'] ;
				}
			}

			//requisiciones x orden
			$rsRequisicion = fullscanrequisicionoppxopp( $rwCorte["ordoppcodigo"],$idcon);
			$nrRequisicion = fncnumreg($rsRequisicion);

			for($c = 0;$c < $nrRequisicion;$c++){

				$rwRequisicion = fncfetch($rsRequisicion, $c);
				if($rwRequisicion["requisnumero"]){
					$rwSumaItemdesa = loadrecordsumrequisicionitemdesa($rwRequisicion["requiscodigo"], $__itedescodigo, $idcon);
					$RINUMERO = ($RINUMERO)? $RINUMERO."&nbsp;".$rwRequisicion["requisnumero"]."<br>" : $rwRequisicion["requisnumero"]."<br>";

					if( $rwSumaItemdesa > 0){
						$RIRECIBIDO = ($RIRECIBIDO)? $RIRECIBIDO."&nbsp;".$rwSumaItemdesa["itedescodigo"]." : ".number_format($rwSumaItemdesa["reqitecantre"], 2, ",", ".")."<br>" : $rwSumaItemdesa["itedescodigo"]." : ".number_format($rwSumaItemdesa["reqitecantre"], 2, ",", ".")."<br>";
					}
				}


			}

			$rwGestionopp = loadrecordultimagestionopp($rwCorte["ordoppcodigo"],$idcon);
			
			if( $rwGestionopp > 0 ){

				$rsGestionOppSaldo = dinamicscanopgestionoppsaldo( array( "gesoppcodigo" => $rwGestionopp["gesoppcodigo"]), array( "gesoppcodigo" => "=" ), $idcon);
				$nrGestionOppSaldo = fncnumreg($rsGestionOppSaldo);
				for( $c = 0; $c < $nrGestionOppSaldo; $c++){
					$rwGestionOppSaldo = fncfetch($rsGestionOppSaldo,$c);
					$rwSaldo = loadrecordsaldo($rwGestionOppSaldo["saldocodigo"],$idcon);
					$rWItemDesa = loadrecorditemdesa($rwSaldo["itedescodigo"],$idcon);

					if($rwSaldo > 0 && $rWItemDesa["itedescodigo"] > 0){

						$SALDO = ($SALDO)? $SALDO."&nbsp;".$rWItemDesa["itedescodigo"]." - ".$rWItemDesa["itedesnombre"]." X ".number_format($rwSaldo["saldocantkgs"], 2, ",", ".")." kgs<br>" : $rwSaldo["itedescodigo"]." - ".$rWItemDesa["itedesnombre"]." X ".number_format($rwSaldo["saldocantkgs"], 2, ",", ".")." kgs<br>" ;
					}

				}

			}

			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

			$rsreporteopp = dinamicscanopreporteopp(array( "ordoppcodigo" => $rwCorte['ordoppcodigo'], "repopptipo" => 1 ), array("ordoppcodigo" => "=", "repopptipo" => "=") ,$idcon);
			$nrreporteopp = fncnumreg($rsreporteopp);

			$SZreoppncantkg = 0;
			$SZreoppncantmt = 0;

			for( $c = 0; $c < $nrreporteopp; $c++){

				$rwreporteopp = fncfetch($rsreporteopp,$c);
				$rsReporteoppreportepn = dinamicscanopreporteoppreportepn(array("repoppcodigo" => $rwreporteopp['repoppcodigo']), array("repoppcodigo" => "="), $idcon);
				$nrReporteoppreportepn = fncnumreg($rsReporteoppreportepn);

				for( $d = 0; $d < $nrReporteoppreportepn; $d++){

					$rwReporteoppreportepn = fncfetch($rsReporteoppreportepn,$d);
					$SZreoppncantkg = $SZreoppncantkg + $rwReporteoppreportepn["reoppncantkg"];
					$SZreoppncantmt = $SZreoppncantmt + $rwReporteoppreportepn["reoppncantmt"];
				}

			}
?>			
	<tr <?php echo $complement; ?> >
		<td width="5%" align="center"><a href="javascript:animatedcollapse.toggle('filtrOpp_<?php echo $equipo; ?>_<?php echo $b; ?>');"><img id="row" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a></td>
		<td width="5%" class="cont-line">&nbsp;<input type="radio" name="radiobutton1" id="radiobutton1" value="<?php echo $rwCorte['ordoppcodigo']; ?>" onclick="setOrdoppcodigo(this.value);" /></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo ($b + 1); ?></td>
		<td width="15%" class="cont-line">&nbsp;<font color="green"><b><small><?php echo date("Y-m-d H:i", strtotime(" {$varDate} + {$$total_equipotmp} minutes")) ?></small></b></font></td>
		<td width="5%" class="cont-line">&nbsp;
			<a href="#" title="Kgs Pn [<?php echo number_format($SZreoppncantkg, 2, ",", "."); ?>] - Kgs Pdt [<?php echo number_format($KILOSCORTE - $SZreoppncantkg, 2, ",", "."); ?>]" style="text-decoration:none;">
				<font color="blue"><b><?php echo str_pad($rwOpcorte['solprocodigo'], 4, "0", STR_PAD_LEFT) ?></b></font>
			</a>
		</td>
		<td width="15%" class="cont-line">&nbsp;<?php echo ($MATCORTE)? $MATCORTE : "---"; ?></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSCORTE, 2, ',', '.'); ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($METROSCORTE, 2, ',', '.'); ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo ($rwOpcorte['opestacodigo'])? cargaopestanombre($rwOpcorte['opestacodigo'], $idcon) : "---"; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo ($RINUMERO)? $RINUMERO : "---" ; ?></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo ($RIRECIBIDO)? $RIRECIBIDO : "---"; ?></td>
	</tr>
	<tr <?php echo $complement; ?> >
		<td colspan="11">
			<div id="filtrOpp_<?php echo $equipo ?>_<?php echo $b ?>" style="display: none;" >
				<table border="0" cellspacing="1" cellpadding="1" style="border-top:none; border-right:none;" align="left" class="ui-widget-content" width="100%">
					<tr>
						<td width="80" class="ui-state-default"><small>PV</small></td>
						<td width="350" class="ui-state-default"><small>Referencia&nbsp;</small></td>	
						<td width="350" class="ui-state-default"><small>Cliente&nbsp;</small></td>
						<td width="260" class="ui-state-default"><small>Saldo Asigando</small></td>
					</tr>
					<tr class="<?php echo  $class ?>">
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $PEDIDOPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $REFPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo $CLIENTEPRODUCCION; ?></small></td>
						<td class="NoiseFooterTD" valign="top">&nbsp;<small><?php echo ($SALDO)? $SALDO : "---"; ?></small></td>
					</tr>
				</table>
			</div>
		</td>		
	</tr>
<?php
		endfor;	
	
	if($b < 13):
		for($c = $b; $c < 35; $c++):
			($c % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
				<td class="cont-line">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
</table>
<input type="hidden" name="<?php echo $total_equipound ?>" id="<?php echo $total_equipound ?>" value="<?php echo $$total_equipound ?>" />
<input type="hidden" name="<?php echo $total_equipokgs ?>" id="<?php echo $total_equipokgs ?>" value="<?php echo $$total_equipokgs ?>" />
<input type="hidden" name="<?php echo $total_equipomts ?>" id="<?php echo $total_equipomts ?>" value="<?php echo $$total_equipomts ?>" />