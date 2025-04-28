<?php 
ini_set("display_errors", 1);
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblop.php';
	endif;

if($solcodigo)
{
		$idcon = fncconn();
			$pro[solprocodigo]=$solcodigo;
			$pro[procedcodigo]=$procdcodigo;
			$rwtipoproced = dinamicscanopop(array( 'solprocodigo' => $pro[solprocodigo], 'procedcodigo' => $pro[procedcodigo]),array( 'solprocodigo' => '=','procedcodigo' => '='),$idcon);

			$numReg = fncnumreg($rwtipoproced); 
			for ($i=0; $i < $numReg ; $i++) { 
				$rs_item = fncfetch($rwtipoproced, $i);
				if($rs_item[ordoppcodigo]){
					$ordoppcodigo1=$rs_item[ordoppcodigo];
					$arreglover[$i]=$rs_item[ordoppcodigo];
				}
			}
			if($arreglover==NULL){
				$veces=0;
				$numReg=0;
			}			
			for ($i=0; $i < count($arreglover); $i++) { 
				for ($j=0; $j < $i; $j++) { 

					if($arreglover[$i]==$arreglover[$j]){
						$veces++;
						$ordoppcodigo1=$arreglover[$i];
					}
				}
			}
			if($numReg==1){
				$veces=1;
			}

			if($numReg<=0)
			{
				$ordoppcodigo1="";
?>
				<div style="width:630px;   overflow:auto; border-left:0; border-right:0; border-bottom:0; float: left;" class="ui-widget-content">
					<div style="width:620px;   z-index:auto ;background-color:#F3F781; auto;border:1px solid #FFFF00 ;border-radius:5px;">
						&nbsp;La orden no de encuentra disponible
					</div>
				</div>
<?php
			}else{ if($veces>0){
				?>
				<input type="hidden" size="3" name="ordoppcodigo1" value="<?php echo $ordoppcodigo1; ?>">
<?php
				}
			}	
			if($numReg>1 && $veces<=0){
				?>
				<div style="width:630px;   overflow:auto; border-left:0; border-right:0; border-bottom:0; float: left;" class="ui-widget-content">
					<div style="width:620px;   z-index: auto; background-color:#F5A9A9; auto;border:1px solid #FF0000 ;border-radius:5px;">
						&nbsp;Hubo un error
					</div>
				</div>
<?php
			}
}		
?>		
