<?php 
ini_set('display_errors',1);

	if(!$noAjax):
		include '../../FunPerPriNiv/pktblgestionoppitemdesa.php';
		include '../../FunPerPriNiv/pktblvistaformulacion.php';
		include '../../FunPerPriNiv/pktblinvplantaresinas.php';
		include '../../FunPerPriNiv/pktblgestionoppsaldo.php';
		include '../../FunPerPriNiv/pktblvistagestionopp.php';
		include '../../FunPerPriNiv/pktblvistareporteopp.php';
		include '../../FunPerPriNiv/pktblvistacierreopp.php';
		include '../../FunPerPriNiv/pktbloppitemdesa.php';
		include '../../FunPerPriNiv/pktblopextrusion.php';
		include '../../FunPerPriNiv/pktblitemformul.php';
		include '../../FunPerPriNiv/pktblgestionopp.php';
		include '../../FunPerPriNiv/pktblpadreitem.php';
		include '../../FunPerPriNiv/pktblitemdesa.php';
		include '../../FunPerPriNiv/pktblvistaopp.php';
		include '../../FunPerPriNiv/pktblequipo.php';
		include '../../FunPerPriNiv/pktblsaldo.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblopp.php';
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunGen/cargainput.php';
	endif;

?>
<div style="width:1000px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;O.E</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Opp&nbsp;</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;PV&nbsp;</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Kgs&nbsp;</td>
				<td width="80" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Mts&nbsp;</td>
				<td width="175" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Equipo&nbsp;</td>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item&nbsp;</td>
				<td width="300" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre&nbsp;</td>
				<td width="150" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Asignado&nbsp;<b>(Kgs)</b></td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:1000px; height: 100px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($arrrequisicionopp):
	
		$idcon = fncconn();
		$arrObjsrequisicionopp = explode(',',$arrrequisicionopp);
		$arrItemdesa = array();
		$arrMateriales = array();
		$arrSaldo = array();
		$arrItem = array();


		for($a = 0; $a < count($arrObjsrequisicionopp); $a++):
			$rwOrdenProduccion = (loadrecordvistagestionopp($arrObjsrequisicionopp[$a],$idcon) > 0)? loadrecordvistagestionopp($arrObjsrequisicionopp[$a],$idcon) : loadrecordvistareporteopp($arrObjsrequisicionopp[$a],$idcon) ;
			$rwOrdenProduccion = ($rwOrdenProduccion > 0)? $rwOrdenProduccion : loadrecordvistacierreopp($arrObjsrequisicionopp[$a],$idcon) ;
			$rwOrdenProduccion = loadrecordvistaopp($arrObjsrequisicionopp[$a], $idcon);
			
			if($rwOrdenProduccion > 0 ):
				
				$rwOpp = loadrecordopp($rwOrdenProduccion['ordoppcodigo'],$idcon);
			
				($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
		
				$itedescodigo = '';
				$itedesnombre = '';
				$oppitecantid = '';

			
				if($rwOrdenProduccion['ordoppcodigo']){
					$rsOppItemdesa = dinamicscanopoppitemdesa(array('ordoppcodigo' => $rwOrdenProduccion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
				}

				$nrOppItemdesa = fncnumreg($rsOppItemdesa);
		
				for($b = 0; $b < $nrOppItemdesa; $b++){

					$rwOppItemdesa = fncfetch($rsOppItemdesa,$b);
					$rwItemdesa = loadrecorditemdesa($rwOppItemdesa['itedescodigo'],$idcon);
					$itedescodigo = ($itedescodigo)? $itedescodigo.'<br>&nbsp;'.$rwOppItemdesa['itedescodigo'] : $rwOppItemdesa['itedescodigo'] ;
					$itedesnombre = ($itedesnombre)? $itedesnombre.'<br>&nbsp;'.$rwItemdesa['itedesnombre'] : $rwItemdesa['itedesnombre']  ;
					$oppitecantid = ($oppitecantid)? $oppitecantid.'<br>&nbsp;'.$rwOppItemdesa['oppitecantid'] : $rwOppItemdesa['oppitecantid']  ;
					
					($rwOppItemdesa['itedescodigo'])? '' : $itedescodigo = '---' ;
					($rwOppItemdesa['oppitecantid'])? '' : $oppitecantid = '---' ;
				
					$arrItemdesa[$rwOppItemdesa['itedescodigo']] ['itedescodigo'] = $rwOppItemdesa['itedescodigo'];
					$arrItemdesa[$rwOppItemdesa['itedescodigo']] ['itedesnombre'] = $rwItemdesa['itedesnombre'];
					$arrItemdesa[$rwOppItemdesa['itedescodigo']] ['oppitecantid'] += $rwOppItemdesa['oppitecantid'];
					$arrItemdesa[$rwOppItemdesa['itedescodigo']] ['reqitecantkg'] += $rwOppItemdesa['oppitecantid'];
				}
		
				if($nrOppItemdesa < 1){

					$itedescodigo = '---';
					$itedesnombre = '---';
					$oppitecantid = '---';
				}
			
				$rsOppextrusion = dinamicscanoppextrusiongen1(array('ordoppcodigo' => $rwOrdenProduccion['ordoppcodigo'] ),array('ordoppcodigo' => '='),$idcon);
	   			$nrOppextrusion = fncnumreg($rsOppextrusion);
	   		
	   			for($b = 0; $b < $nrOppextrusion; $b++){

	     			$rwOppextrusion = fncfetch($rsOppextrusion,$b);
	     			$rwViewFormulacion = loadrecordvistaformulacion1($rwOppextrusion['formulnumero'],$idcon);

	     			$rsItemFormul = dinamicscanitemformulgen(array('formulcodigo' => $rwViewFormulacion['formulcodigo']),array('formulcodigo' => '='),$idcon);
	          		$nrItemFormul = fncnumreg($rsItemFormul);
	          	
	          		for($c = 0; $c < $nrItemFormul; $c++){

	          			$rwItemFormul = fncfetch($rsItemFormul,$c);
						$rwItemdesa = loadrecorditemdesa($rwItemFormul['itedescodigo'],$idcon);
						//objetos a utilizar
						$objs_iteforporcen = 'iteforporcen_'.$rwItemFormul['itedescodigo'];//porcentaje del item en la capa
						$objs_formulcapa = 'formulcapa'.strtolower($rwItemFormul['iteforcapa']);//capa del item
						$$objs_iteforporcen = (($rwItemFormul['iteforporcen'] / 100) * ($rwViewFormulacion[$objs_formulcapa] / 100));
	          		}
	          			
	          		$rsItemFormul = dinamicscanitemformulgen1(array('formulcodigo' => $rwViewFormulacion['formulcodigo']),array('formulcodigo' => '='),$idcon);
	          		$nrItemFormul = fncnumreg($rsItemFormul);
	          	
	          		for($c = 0; $c < $nrItemFormul; $c++){

						$rwItemFormul = fncfetch($rsItemFormul,$c);
						$rwItemdesa = loadrecorditemdesa($rwItemFormul['itedescodigo'],$idcon);
						//objetos a utilizar
						$objs_iteforporcen = 'iteforporcen_'.$rwItemFormul['itedescodigo'];//porcentaje del item en la capa
						$arrMateriales[$rwItemFormul['itedescodigo']]['itedescodigo'] = $rwItemdesa['itedescodigo'];
						$arrMateriales[$rwItemFormul['itedescodigo']]['sum'] += $$objs_iteforporcen * $rwOpp['ordoppcantkg'];
	    			}

	    		}

	    		//se consulta ultima gestion de materiales
				$rwGestionopp = loadrecordultimagestionopp($arrObjsrequisicionopp[$a],$idcon);
			
				if( $rwGestionopp > 0 ){

					$difancho = 0;
					$porcentaje = 0;
					$kextraancho = 0;
					$knetosaldo = 0;
					$kreq = 0;

					$rsGestionOppSaldo = dinamicscanopgestionoppsaldo( array( "gesoppcodigo" => $rwGestionopp["gesoppcodigo"]), array( "gesoppcodigo" => "=" ), $idcon);
					$nrGestionOppSaldo = fncnumreg($rsGestionOppSaldo);

					for( $b = 0; $b < $nrGestionOppSaldo; $b++){

						$rwGestionOppSaldo = fncfetch($rsGestionOppSaldo,$b);
						$rwSaldo = loadrecordsaldo($rwGestionOppSaldo["saldocodigo"],$idcon);
						$rwItemdesa = loadrecorditemdesa($rwSaldo["itedescodigo"] ,$idcon);
						$rwItemdesaId = loadrecorditemdesa($rwGestionOppSaldo["itedescodigoid"] ,$idcon);

						//genreacion array de saldos por orden
						$arrSaldo[$rwSaldo['itedescodigo']] ['itedescodigo'] = $rwSaldo["itedescodigo"];
						$arrSaldo[$rwSaldo['itedescodigo']] ['itedesnombre'] = $rwItemdesa["itedesnombre"];
						$arrSaldo[$rwSaldo['itedescodigo']] ['saldocantkgs'] = $rwSaldo['saldocantkgs'];
						$arrSaldo[$rwSaldo['itedescodigo']] ['itedescodigoid'] = $rwGestionOppSaldo["itedescodigoid"];

						//calculamos el aporte del saldo a el material asignado por planeacion
						$difancho = $rwItemdesa["itedesancho"] - $rwItemdesaId["itedesancho"];
						$porcentaje = $difancho / $rwItemdesa["itedesancho"];
						$kextraancho = $rwSaldo['saldocantkgs'] * $porcentaje;
						$knetosaldo = $rwSaldo['saldocantkgs'] - $kextraancho;

						$arrItemdesa[$rwGestionOppSaldo['itedescodigoid']] ['asgitecantkg'] += $knetosaldo;
						$arrSaldo[$rwSaldo['itedescodigo']] ['knetosaldo'] = $knetosaldo;
						$arrSaldo[$rwSaldo['itedescodigo']] ['saldocantkex'] = $kextraancho;

					}

					$rsGestionOppItemdesa = dinamicscanopgestionoppitemdesa( array( "gesoppcodigo" => $rwGestionopp["gesoppcodigo"]), array( "gesoppcodigo" => "=" ), $idcon);
					$nrGestionOppItemdesa = fncnumreg($rsGestionOppItemdesa);

					for( $b = 0; $b < $nrGestionOppItemdesa; $b++){

						$rwGestionOppItemdesa = fncfetch($rsGestionOppItemdesa,$b);
						$rwItemdesa = loadrecorditemdesa($rwGestionOppItemdesa['itedescodigo'],$idcon);
						$arritem = ($arritem)? $arritem.":|:".$rwGestionOppItemdesa["itedescodigo"].":-:f" : $rwGestionOppItemdesa["itedescodigo"].":-:f" ;

						$arrItem[$rwGestionOppItemdesa['itedescodigo']] ['itedescodigo'] = $rwGestionOppItemdesa["itedescodigo"];
						$arrItem[$rwGestionOppItemdesa['itedescodigo']] ['itedesnombre'] = $rwItemdesa['itedesnombre'];
						$arrItem[$rwGestionOppItemdesa['itedescodigo']] ['gesoppcantkg'] = $rwGestionOppItemdesa["gesoppcantkg"];
						$arrItem[$rwGestionOppItemdesa['itedescodigo']] ['gesoppcantmt'] = $rwGestionOppItemdesa["gesoppcantmt"];
					}

				}


		
?>			
			<tr <?php echo $complement ?> >
				<td width="30" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar):?><input type="checkbox" id="chkrequisicionopp" name="chkrequisicionopp" value="<?php echo $arrObjsrequisicionopp[$a] ?>" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrrequisicionopptmp').value, ',', 'requisicionopptmp');" ><?php else:?>&nbsp;&nbsp;&nbsp;<b>X</b><?php endif;?></td>
				<td width="30" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<font color="#FF0000"><b><?php echo str_pad($rwOrdenProduccion['prograindice'], 2, "0", STR_PAD_LEFT); ?></b></font></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo str_pad($rwOrdenProduccion['solprocodigo'], 4, "0", STR_PAD_LEFT); ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo str_pad($rwOrdenProduccion['pedvennumero'], 3, "0", STR_PAD_LEFT); ?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwOpp['ordoppcantkg'], 2, ',', '.'); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwOpp['ordoppcantmt'], 2, ',', '.'); ?></td>
				<td width="175" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo strtoupper($rwOrdenProduccion['equiponombre']); ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $itedescodigo; ?></td>
				<td width="300" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $itedesnombre; ?></td>
				<td width="147" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($oppitecantid,2,',','.'); ?></td>
			</tr>
<?php
			endif;
		endfor;
	endif;
	
	
	if($a < 10):
		for($b = $a; $b < 10; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>" >
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="30" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="175" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="300" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="147" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;
?>
		</table>
	</div>
</div>


<?php if($arrSaldo || $arrItem): ?>
<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td colspan="5" class="ui-state-default">&nbsp;Pre-Asignacion&nbsp;</td>
		</tr>
		<tr>
			<td width="15%" class="ui-state-default">&nbsp;Item&nbsp;</td>
			<td width="40%" class="ui-state-default">&nbsp;Referencia&nbsp;</td>
			<td width="15%" class="ui-state-default">&nbsp;Asignados&nbsp;(<b>kgs</b>)</td>
			<td width="15%" class="ui-state-default">&nbsp;E-Ancho&nbsp;(<b>kgs</b>)</td>
			<td width="15%" class="ui-state-default">&nbsp;Neto&nbsp;(<b>kgs</b>)</td>
		</tr>
		<?php 
			if($arrSaldo){

				foreach($arrSaldo as $arr){

					$rwItemdesa = loadrecorditemdesa($arr['itedescodigo'],$idcon);
					$rwPadreitem = loadrecordpadreitemxkeylinea($rwItemdesa['keylinea'],$idcon);
					$arrSaldo[$rwSaldo['itedescodigo']] ['saldocantkex'] = $kextraancho;
		?>
		<tr <?php echo $complement ?> >
			<td width="15%">&nbsp;<?php echo ($arr['itedescodigo'])? $arr['itedescodigo'] : '---' ; ?>&nbsp;{saldo}</td>
			<td width="40%">&nbsp;<?php echo ($rwItemdesa['itedesnombre'])? $rwItemdesa['itedesnombre'] : '---' ; ?>&nbsp;<?php echo ($arr['itedescodigoid'])? '<small>identificador</small>&nbsp;'.$arr['itedescodigoid'] : '' ; ?></td>
			<td width="15%">&nbsp;<?php echo ($arr['saldocantkgs'])? number_format($arr['saldocantkgs'],2,',','.') : '---' ;?></td>
			<td width="15%">&nbsp;<?php echo ($arr['saldocantkgs'])? number_format($arr['saldocantkex'],2,',','.') : '---' ;?></td>
			<td width="15%">&nbsp;<?php echo ($arr["knetosaldo"])? number_format($arr["knetosaldo"],2,',','.') : "---" ;  ?>--</td>
		</tr>
		<?php 
				}
			}

			if($arrItem){

				foreach($arrItem as $arr){
					$rwItemdesa = loadrecorditemdesa($arr['itedescodigo'],$idcon);
					$rwPadreitem = loadrecordpadreitemxkeylinea($rwItemdesa['keylinea'],$idcon);
		?>
		<tr <?php echo $complement ?> >
			<td width="15%">&nbsp;<?php echo ($arr['itedescodigo'])? $arr['itedescodigo'] : '---' ; ?>&nbsp;{inventario}</td>
			<td width="40%">&nbsp;<?php echo ($arr['itedesnombre'])? $arr['itedesnombre'] : '---' ; ?></td>
			<td width="15%">&nbsp;<?php echo ($arr['gesoppcantkg'])? number_format($arr['gesoppcantkg'],2,',','.') : '---' ;?></td>
			<td width="15%">&nbsp;<?php echo number_format( 0 ,2,',','.' ); ?></td>
			<td width="15%">&nbsp;<?php echo ($arr['gesoppcantkg'])? number_format($arr['gesoppcantkg'],2,',','.') : '---' ;?></td>
		</tr>
		<?php 
				}
			} 
		?>
	</table>
</div>
<?php else: ?>
	<div class="ui-widget">
 		<div style="padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
  			<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
  			<b>No se encontraron pre-asignaciones</b></p>
 		</div>
	</div>
<?php endif; ?>


<?php if($arrItemdesa): ?>
<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td colspan="5" class="ui-state-default">&nbsp;<?php if($campnomb["reqitecantrq_"] == 1){echo "*";}?>Resumen Necesidad Materiales&nbsp;</td>
		</tr>
		<tr>
			<td width="15%" class="ui-state-default">&nbsp;Item&nbsp;</td>
			<td width="40%" class="ui-state-default">&nbsp;Referencia&nbsp;</td>
			<td width="15%" class="ui-state-default">&nbsp;Total&nbsp;(<b>kgs</b>)</td>
			<td width="15%" class="ui-state-default">&nbsp;Asignado&nbsp;(<b>kgs</b>)</td>
			<td width="15%" class="ui-state-default">&nbsp;Neto Req.&nbsp;(<b>kgs</b>)</td>
		</tr>
		<?php 
				foreach($arrItemdesa as $arr)
				{
					$rwItemdesa = loadrecorditemdesa($arr['itedescodigo'],$idcon);
					$reqitecantrq  = $arr['oppitecantid'] - $arrItemdesa[$arr['itedescodigo']] ['asgitecantkg'];

					$arrItemdesaRQ = ($arrItemdesaRQ)? $arrItemdesaRQ.":|:".$arr['itedescodigo'].":-:".$reqitecantrq : $arr['itedescodigo'].":-:".$reqitecantrq  ;
		?>
		<tr <?php echo $complement ?> >
			<td width="15%">&nbsp;<?php echo ($arr['itedescodigo'])? $arr['itedescodigo'] : '---' ; ?></td>
			<td width="40%">&nbsp;<?php echo ($arr['itedesnombre'])? $arr['itedesnombre'] : '---' ; ?></td>
			<td width="15%">&nbsp;<?php echo ($arr['oppitecantid'])? number_format($arr['oppitecantid'],2,',','.') : '---' ;?></td>
			<td width="15%">&nbsp;<?php echo ($arrItemdesa[$arr['itedescodigo']] ['asgitecantkg'])? number_format( $arrItemdesa[$arr['itedescodigo']] ['asgitecantkg'], 2, ",", ".") : "---" ; ?></td>
			<td width="15%">&nbsp;<?php echo ($reqitecantrq)? number_format( $reqitecantrq, 2, ",", ".") : "" ; ?></td>
		</tr>
		<?php 
				}
		?>	
	</table>
</div>
<?php endif;?>

<?php if($arrMateriales):?>
<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td colspan="6" class="ui-state-default">&nbsp;Resumen {Resinas}&nbsp;</td>
		</tr>
		<?php 	        
	 		foreach($arrMateriales as $arrValue)
	       	{

	       		$arrItemdesaResinasRQ = ($arrItemdesaResinasRQ)? $arrItemdesaResinasRQ.":|:".$arrValue['itedescodigo'].":-:".$arrValue["sum"] : $arrValue['itedescodigo'].":-:".$arrValue["sum"]  ;

	       		$rwItemdesa = loadrecorditemdesa($arrValue['itedescodigo'] ,$idcon);
	       		$rwInvplantaresina = loadrecordinvplantaresinaxitemdesa($arrValue["itedescodigo"], $idcon);

	       		$invresdisponible = ($rwItemdesa["itedesinvent"] + $rwInvplantaresina["invrescantid"]) - $arrValue['sum'];
	 	?>
		<tr>
	 		<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;Item</td>
	      	<td class="NoiseFooterTD cont-field-b" width="30%">&nbsp;Material</td>
	      	<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;Planta&nbsp;<b>(kg)</b></td>
	      	<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;Inventario&nbsp;<b>(kg)</b></td>
	      	<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;Disponible&nbsp;<b>(kg)</b>&nbsp;</td>
			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;<b>(kg)</b>&nbsp;</td>
		</tr>	
		<tr>
			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#FF0000"><b><?php echo str_pad( $arrValue['itedescodigo']  , 3, "0", STR_PAD_LEFT) ?></b></font></td>
			<td class="NoiseDataTD cont-field-b" width="40%">&nbsp;<font color="#000080"><b><?php echo ($arrValue['itedescodigo'])? carganombitemdesa($arrValue['itedescodigo'], $idcon) : '---' ;?></b></font></td>
			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo number_format($rwInvplantaresina["invrescantid"], 2, ",", "."); ?></b></font></td>
			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo number_format($rwItemdesa["itedesinvent"], 2, ",", "."); ?></b></font></td>
			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="<?php echo ($invresdisponible > 0)? "#000080": "#FF0000"; ?>"><b><?php echo number_format($invresdisponible, 2, ",", "."); ?></b></font></td>
			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($arrValue['sum'])? number_format($arrValue['sum'], 2, ',', '.') : '---' ;?></b></font></td>
		</tr>
		<?php 
			}
	  	?>
	</table>
</div>
<?php endif;?>

<input type="hidden" name="arrItemdesaRQ" id="arrItemdesaRQ" value="<?php echo $arrItemdesaRQ; ?>" />
<input type="hidden" name="arrItemdesaResinasRQ" id="arrItemdesaResinasRQ" value="<?php echo $arrItemdesaResinasRQ; ?>" />