<?php 
ini_set("display_errors", 1);
	if(!$noAjax){
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include ( '../../FunPerPriNiv/pktblitemdesa.php');
	}

	$idcon = fncconn();
	if($tipitemcodigo){
		$rwtipoitem = loadrecordlineaitemdesatipoitem($tipitemcodigo,$idcon);
	}
	if($rwtipoitem){
		$rntipoitem = fncnumreg($rwtipoitem); 
	}
?>
<div style="width:770px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: 90;">	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td width="65" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;C&oacute;digo</td>
				<td width="420" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="15" class="jui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:770px; height: 90px;  overflow:auto; border-left:0; border-right:0; border-bottom:0; float: left;" class="ui-widget-content">
	<div style="width:600px; height: auto;  z-index: auto;">
		<table width="125%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 	
if($rntipoitem)
{

			for($i=0;$i<$rntipoitem;$i++){

				$arr = fncfetch($rwtipoitem, $i);

				($i % 2) ? $complement = ' class="NoiseDataTD"' : $complement = ' class="NoiseFooterTD" ';
			
?>			
<tr <?php echo $complement ?>">
	<td width="65" style=" border-bottom: 1px solid #fff;"><input type="radio" id="itedescodigo" name="itedescodigo" value='<?php echo $arr['itedescodigo']?>'  <?php if($arr['itedescodigo']==$itedescodigo){echo 'checked';} ?>></td>
	<td width="420" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $arr['itedesnombre']; ?></td>
</tr>
<?php
		}

	}	
	if($i < 6)
	{
		for($b = $i; $b < 6; $b++)
		{
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="65" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="420" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}
	
?>
		</table>
	</div>
</div>