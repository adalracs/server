<?php
	$idcon = fncconn();
	$rsCorteExtrusion = dinamicscanopprogramacorteextrusion1(array("equipocodigo" => $equipo, "ordoppcomfir" => 1),array("equipocodigo" => "=", "ordoppcomfir" => "="),$idcon, $rtr = 1);//opcion para diferenciar las ordenes cerradas
	$nrCorteExtrusion = fncnumreg($rsCorteExtrusion);
	//varibles para cantidad por equipos
	$total_equipound = $equipo."_und";
	$total_equipomts = $equipo."_mts";
	$total_equipokgs = $equipo."_kgs";
	$total_equipotmp = $equipo."_tmp";
	
	$rwhora = getdate(time());
	$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
	echo "<script type='text/javascript'>Event_animatedcollapse('".$nrCorteExtrusion."', 'filtrOpp_".$equipo."');</script>";
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
		for($b = 0; $b < $nrCorteExtrusion; $b++)
		{
			$rwCorteExtrusion = fncfetch($rsCorteExtrusion, $b);
			unset($__itedescodigo);
			//sumatoria de unidades , metros, kilogramos
			$$total_equipound = $$total_equipound + 1; 
			$$total_equipokgs = $$total_equipokgs + $rwCorteExtrusion['ordoppcantkg'];
			$$total_equipomts = $$total_equipomts + $rwCorteExtrusion['ordoppcantmt'];

			//escaneo de velocidades para sumatoria de minutos de duracion de la orden
			$rsOppVelocidadpn = dinamicscanopoppvelocidadpn(array('ordoppcodigo' => $rwCorteExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppVelocidadpn = fncnumreg($rsOppVelocidadpn);
			for($i = 0; $i < $nrOppVelocidadpn; $i++)
			{
				$rwOppVelocidadpn = fncfetch($rsOppVelocidadpn, $i);
				$rwVelocidadpn = loadrecordvelocidadpn($rwOppVelocidadpn['velocicodigo'],$idcon);
				$$total_equipotmp = $$total_equipotmp + $rwVelocidadpn['velocivalora'];
			}
			//escaneo de ajuste para sumatoria de minutos de duracion de la orden
			$rsOppAjustepn = dinamicscanopoppajustepn(array('ordoppcodigo' => $rwCorteExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
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
			$rsOppItemDesa = dinamicscanopoppitemdesa(array('ordoppcodigo' => $rwCorteExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppItemDesa = fncnumreg($rsOppItemDesa);
			$MATCORTEEXTRUSION = '';
			for($c = 0; $c < $nrOppItemDesa; $c++)
			{
				$rWOppItemDesa = fncfetch($rsOppItemDesa, $c);
				if($rWOppItemDesa['itedescodigo']){
					
					$__itedescodigo = ($__itedescodigo)? $__itedescodigo : $rWOppItemDesa['itedescodigo'];
					$MATCORTEEXTRUSION = ($MATCORTEEXTRUSION)? $MATCORTEEXTRUSION.'-&nbsp;'.strtoupper($rWOppItemDesa['itedescodigo']).' - '.carganombitemdesa($rWOppItemDesa['itedescodigo'],$idcon) : strtoupper($rWOppItemDesa['itedescodigo']).' - '.carganombitemdesa($rWOppItemDesa['itedescodigo'],$idcon) ;
				}
			}

			//escaneo de velocidades para sumatoria de minutos de duracion de la orden
			$rsOppVelocidadpn = dinamicscanopoppvelocidadpn(array('ordoppcodigo' => $rwCorteExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppVelocidadpn = fncnumreg($rsOppVelocidadpn);
			for($i = 0; $i < $nrOppVelocidadpn; $i++)
			{
				$rwOppVelocidadpn = fncfetch($rsOppVelocidadpn, $i);
				$rwVelocidadpn = loadrecordvelocidadpn($rwOppVelocidadpn['velocicodigo'],$idcon);
				$$total_equipotmp = $$total_equipotmp + $rwVelocidadpn['velocivalora'];
			}
			//escaneo de ajuste para sumatoria de minutos de duracion de la orden
			$rsOppAjustepn = dinamicscanopoppajustepn(array('ordoppcodigo' => $rwCorteExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppAjustepn = fncnumreg($rsOppAjustepn);
			for($i = 0; $i < $nrOppAjustepn; $i++)
			{
				$rwOppAjustepn = fncfetch($rsOppAjustepn, $i);
				$rwAjustepn = loadrecordajustepn($rwOppAjustepn['ajustecodigo'],$idcon);
				$$total_equipotmp = $$total_equipotmp + $rwAjustepn['ajustevalora'];
			}
			//converision de mintuos a horas
			$varDate = date("Y-m-d H:i");
			//rutina para traer las op's que contienen la opp madre
			$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwCorteExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOpproduccion = fncnumreg($rsOpproduccion);
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOCORTEEXTRUSION = '';
			$CALIBRECORTEEXTRUSION = '';
			$KILOSCORTEEXTRUSION = '';
			$METROSCORTEEXTRUSION = '';
			$APROBADOCORTEEXTRUSION = '';
			//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
			$FORMULACORTEEXTRUSION = '';
			$CORTEEXTRUSION = '';
			$PISTASEXTRUSION = '';
			$ITEMPRODUCCION = '';
			$CLIENTEPRODUCCION = '';
			$REFPRODUCCION = '';
			$PEDIDOPRODUCCION = '';
			$DESTINOPRODUCCION = '';
			$OPESTADO = "";
			$RINUMERO = "";
			$RIRECIBIDO = "";
			$SALDO = "";
			//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
			$ANCHOCORTEEXTRUSION = ($rwCorteExtrusion['ordoppanchot'])? $rwCorteExtrusion['ordoppanchot'] : '---' ;
			$KILOSCORTEEXTRUSION = ($rwCorteExtrusion['ordoppcantkg'])? $rwCorteExtrusion['ordoppcantkg'] : '---' ;
			$METROSCORTEEXTRUSION = ($rwCorteExtrusion['ordoppcantmt'])? $rwCorteExtrusion['ordoppcantmt'] : '---' ;
			$APROBADOCORTEEXTRUSION = ($rwCorteExtrusion['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;
			$SPANEXTRUSION = ($rwCorteExtrusion['ordoppcomfir'] > 0)? 'ui-icon ui-icon-circle-check' : 'ui-icon ui-icon-circle-close' ;
			//se recorren las ordenes de produccion {op} asociadas en la opp
			for($c = 0;$c < $nrOpproduccion;$c++)
			{
				$rwOpproduccion = fncfetch($rsOpproduccion, $c);
				$rwOpcorteextrusion = loadrecordopcorteextrusion($rwOpproduccion['ordprocodigo'],$idcon);
				//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
				$FORMULACORTEEXTRUSION = ($rwOpcorteextrusion['formulnumero'])? $rwOpcorteextrusion['formulnumero'] : '---' ;
				$CALIBRECORTEEXTRUSION = ($rwOpcorteextrusion['ordprocalibr'])? $rwOpcorteextrusion['ordprocalibr'] : '---' ;
				//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
				if($rwOpcorteextrusion['itedescodigo']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.' | '.$rwOpcorteextrusion['itedescodigo'] : $rwOpcorteextrusion['itedescodigo'] ;
				if($rwOpcorteextrusion['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpcorteextrusion['pedvennumero'] : $rwOpcorteextrusion['pedvennumero'] ;
				if($rwOpcorteextrusion['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpcorteextrusion['ordcomrazsoc'] : $rwOpcorteextrusion['ordcomrazsoc'] ;
				if($rwOpcorteextrusion['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpcorteextrusion['producnombre'] : $rwOpcorteextrusion['producnombre'] ;
				if($rwOpcorteextrusion['procednombre']) $DESTINOPRODUCCION = ($DESTINOPRODUCCION)? $DESTINOPRODUCCION.'<br>&nbsp;'.strtoupper($rwOpcorteextrusion['procednombre']) : strtoupper($rwOpcorteextrusion['procednombre']) ;
				if($rwOpcorteextrusion['ordproanccxt'] && $rwOpcorteextrusion['ordpropistae']) 
				{
					$CORTEEXTRUSION = ($CORTEEXTRUSION)? $CORTEEXTRUSION.' | '.($rwOpcorteextrusion['ordpropistae'] * $rwOpcorteextrusion['ordproanccxt']) : ($rwOpcorteextrusion['ordpropistae'] * $rwOpcorteextrusion['ordproanccxt']);
					$PISTASEXTRUSION = ($PISTASEXTRUSION)? $PISTASEXTRUSION.' | '.$rwOpcorteextrusion['ordpropistae'].' * '.$rwOpcorteextrusion['ordproanccxt'] : $rwOpcorteextrusion['ordpropistae'].' * '.$rwOpcorteextrusion['ordproanccxt'] ;
				}
			}

			//requisiciones x orden
			$rsRequisicion = fullscanrequisicionoppxopp( $rwCorteExtrusion["ordoppcodigo"],$idcon);
			$nrRequisicion = fncnumreg($rsRequisicion);

			for($c = 0;$c < $nrRequisicion;$c++){

				$rwRequisicion = fncfetch($rsRequisicion, $c);
				if($rwRequisicion["requisnumero"]){
					$rwSumaItemdesa = loadrecordsumrequisicionitemdesa($rwRequisicion["requiscodigo"], $__itedescodigo, $idcon);
					$RINUMERO = ($RINUMERO)? $RINUMERO."&nbsp;".$rwRequisicion["requisnumero"]."<br>" : $rwRequisicion["requisnumero"]."<br>";
					/*
					if( $rwSumaItemdesa > 0){

						$RIRECIBIDO = ($RIRECIBIDO)? $RIRECIBIDO."&nbsp;".$rwSumaItemdesa["itedescodigo"]." : ".number_format($rwSumaItemdesa["reqitecantre"], 2, ",", ".")."<br>" : $rwSumaItemdesa["itedescodigo"]." : ".number_format($rwSumaItemdesa["reqitecantre"], 2, ",", ".")."<br>";
					}
					*/
				}


			}

			$rwGestionopp = loadrecordultimagestionopp($rwCorteExtrusion["ordoppcodigo"],$idcon);
			
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

			($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" ' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" ';

			$rsreporteopp = dinamicscanopreporteopp(array( "ordoppcodigo" => $rwCorteExtrusion['ordoppcodigo'], "repopptipo" => 1 ), array("ordoppcodigo" => "=", "repopptipo" => "=") ,$idcon);
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
		<td width="5%" class="cont-line">&nbsp;<input type="radio" name="radiobutton1" id="radiobutton1" value="<?php echo $rwCorteExtrusion['ordoppcodigo']; ?>" onclick="setOrdoppcodigo(this.value);" /></td>
		<td width="5%" class="cont-line">&nbsp;<?php echo ($b + 1); ?></td>
		<td width="15%" class="cont-line">&nbsp;<font color="green"><b><small><?php echo date("Y-m-d H:i", strtotime(" {$varDate} + {$$total_equipotmp} minutes")) ?></small></b></font></td>
		<td width="5%" class="cont-line">&nbsp;
			<a href="#" title="Kgs Pn [<?php echo number_format($SZreoppncantkg, 2, ",", "."); ?>] - Kgs Pdt [<?php echo number_format($KILOSCORTEEXTRUSION - $SZreoppncantkg, 2, ",", "."); ?>]" style="text-decoration:none;">
				<font color="blue"><b><?php echo str_pad($rwOpcorteextrusion['solprocodigo'], 4, "0", STR_PAD_LEFT) ?></b></font>
			</a>
		</td>
		<td width="15%" class="cont-line">&nbsp;<?php echo ($MATCORTEEXTRUSION)? $MATCORTEEXTRUSION : "---"; ?></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSCORTEEXTRUSION, 2, ',', '.'); ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($METROSCORTEEXTRUSION, 2, ',', '.'); ?></b></font></td>
		<td width="10%" class="cont-line">&nbsp;<?php echo ($rwOpcorteextrusion['opestacodigo'])? cargaopestanombre($rwOpcorteextrusion['opestacodigo'], $idcon) : "---"; ?></td>
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
		}
	
	if($b < 13)
	{
		for($c = $b; $c < 35; $c++)
		{
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
		}
	}
?>
</table>
<input type="hidden" name="<?php echo $total_equipound ?>" id="<?php echo $total_equipound ?>" value="<?php echo $$total_equipound ?>" />
<input type="hidden" name="<?php echo $total_equipokgs ?>" id="<?php echo $total_equipokgs ?>" value="<?php echo $$total_equipokgs ?>" />
<input type="hidden" name="<?php echo $total_equipomts ?>" id="<?php echo $total_equipomts ?>" value="<?php echo $$total_equipomts ?>" />