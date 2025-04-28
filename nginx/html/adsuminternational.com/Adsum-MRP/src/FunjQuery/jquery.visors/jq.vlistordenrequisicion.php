<?php 

	include_once ( "../../FunGen/cargainput.php");
	include_once ( "../../FunPerSecNiv/fncconn.php");
	include_once ( "../../FunPerSecNiv/fncclose.php");
	include_once ( "../../FunPerSecNiv/fncnumreg.php");
	include_once ( "../../FunPerSecNiv/fncfetch.php");
	include_once ( "../../FunPerSecNiv/fncsqlrun.php");
	include_once ( "../../FunPerPriNiv/pktblopp.php");
	include_once ( "../../FunPerPriNiv/pktblitemdesa.php");
	include_once ( "../../FunPerPriNiv/pktbloppitemdesa.php");
	include_once ( "../../FunPerPriNiv/pktblvistagestionopp.php");
	
	$idcon = fncconn();
	
	if($tipsolcodigo || $opestacodigo || $solprocodigo){

		$ircrecord["tipsolcodigo"] = $tipsolcodigo;
		$ircrecordop["tipsolcodigo"] = "=";
		$ircrecord["opestacodigo"] = $opestacodigo;
		$ircrecordop["opestacodigo"] = "=";
		$ircrecord["solprocodigo"] = $solprocodigo;
		$ircrecordop["solprocodigo"] = "=";

		$rsOrdenProduccion = dinamicscanopvistagestionopp($ircrecord, $ircrecordop, $idcon);

	}else{

		$rsOrdenProduccion = fullscanvistagestionopp($idcon);		
	}
	
		
	if($rsOrdenProduccion){
		$nrOrdenProduccion = fncnumreg($rsOrdenProduccion);
	}
		
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
<div style="width:1000px; height: 250px; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 

 if($nrOrdenProduccion)
 {
 	
	if($arrrequisicionopp)
	{
		$array_tmp = explode(',',$arrrequisicionopp);
		$array_key = array_flip($array_tmp);
	}
	
	for($a = 0;$a< $nrOrdenProduccion;$a++){
		$rwOrdenProduccion = fncfetch($rsOrdenProduccion,$a);
		$rwOpp = loadrecordopp($rwOrdenProduccion['ordoppcodigo'],$idcon);
		
		$itedescodigo = '';
		$itedesnombre = '';
		$oppitecantid = '';
		
		$rsOppItemdesa = dinamicscanopoppitemdesa(array('ordoppcodigo' => $rwOrdenProduccion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
		$nrOppItemdesa = fncnumreg($rsOppItemdesa);
		
		for($b = 0; $b < $nrOppItemdesa; $b++)
		{
			$rwOppItemdesa = fncfetch($rsOppItemdesa,$b);
			$rwItemdesa = loadrecorditemdesa($rwOppItemdesa['itedescodigo'],$idcon);
			$itedescodigo = ($itedescodigo)? $itedescodigo.'<br>&nbsp;'.$rwOppItemdesa['itedescodigo'] : $rwOppItemdesa['itedescodigo'] ;
			$itedesnombre = ($itedesnombre)? $itedesnombre.'<br>&nbsp;'.$rwItemdesa['itedesnombre'] : $rwItemdesa['itedesnombre']  ;
			$oppitecantid = ($oppitecantid)? $oppitecantid.'<br>&nbsp;'.$rwOppItemdesa['oppitecantid'] : $rwOppItemdesa['oppitecantid']  ;
			
			($rwOppItemdesa['itedescodigo'])? '' : $itedescodigo = '---' ;
			($rwOppItemdesa['oppitecantid'])? '' : $oppitecantid = '---' ;
		}
		
		if($nrOppItemdesa < 1)
		{
			$itedescodigo = '---';
			$itedesnombre = '---';
			$oppitecantid = '---';
		}
		
		($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
		
		if(is_array($array_key))
		{
			$checked = '';
			if(array_key_exists($rwOrdenProduccion['ordoppcodigo'], $array_key))
				$checked = 'checked';
		}
?>
			<tr <?php echo $complement ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;"><input type="checkbox" name="chkarrrequisicionopp" id="chkarrrequisicionopp" <?php echo $checked ?> value="<?php echo $rwOrdenProduccion['ordoppcodigo'] ?>" onclick="setSelectionRow(this.value, document.getElementById('arrrequisicionopp').value, ',', 'arrrequisicionopp');" /></td>
				<td width="30" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<font color="#FF0000"><b><?php echo str_pad($rwOrdenProduccion['prograindice'], 2, "0", STR_PAD_LEFT); ?></b></font></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo str_pad($rwOrdenProduccion['solprocodigo'], 4, "0", STR_PAD_LEFT); ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo str_pad($rwOrdenProduccion['pedvennumero'], 3, "0", STR_PAD_LEFT); ?></td>
				<td width="70" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwOpp['ordoppcantkg'], 2, ',', '.'); ?></td>
				<td width="80" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo number_format($rwOpp['ordoppcantmt'], 2, ',', '.'); ?></td>
				<td width="175" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo strtoupper($rwOrdenProduccion['equiponombre']); ?></td>
				<td width="50" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $itedescodigo; ?></td>
				<td width="300" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $itedesnombre; ?></td>
				<td width="147" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $oppitecantid; ?></td>
			</tr>
<?php 
	}
 }
	
	if($a < 20){
		for($b = $a; $b < 20; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
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
			}
		}
?>
		</table>
	</div>
</div>