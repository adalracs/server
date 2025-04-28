<script type="text/javascript">

function ajaxItemsReceta(datapost)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.formmateapoy.php",
		beforeSend: function(data){
		document.getElementById('msgform').innerHTML = '';
		},        
		success: function(requestData){
			document.getElementById('msgform').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){ }                                      
	});
	
}

function ajaxListaReceta(objparams)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.visors/jquery.mateapoy.php",
		data: objparams,
		beforeSend: function(data){},        
		success: function(requestData){
			document.getElementById('listadoitemreceta').innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){ },
		complete: function(requestData, exito){}                                      
	});
	
}

function reLoadListReceta(){
	
	var arrObjItems = document.getElementById('arritem').value.split(','); //el comodin ',' es separador de filas
	var objparams = 'arritem=' + document.getElementById('arritem').value;
	
	ajaxListaReceta(objparams);
}
	
	$(function(){
		$("#msgwindowform").dialog({
			autoOpen: false,
			width: 580,
			height: 340,
			modal: true,
			buttons: {
				"Adicionar": function() { 
					reLoadListReceta();
					$(this).dialog("close"); 
				}
			}
		});
		
		/**
		 * Boton Quitar Tecnico
		 */
		$('#quitaritem').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
			reLoadListReceta();
			return false;
		});

		/**
		 * Boton Ingresar Insumo/item
		 */
		$('#ingresaritem').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {
			ajaxItemsReceta();
			$("#msgwindowform").dialog("open");
			return false;
		});
		
	});
</script>
<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblmateapoy.php';
		include '../../FunGen/cargainput.php';
	endif;

	$idcon = fncconn();
?>
<style>
	.row-consumo { font-size:11px;}
</style>
<div width="98%" style="height: 14px; margin:0 auto;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="25%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Codigo</td>
				<td width="65%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
			</tr>
		</table>
	</div>
</div>
<!--<div width="98%" style=" margin:0 auto; border-top:0;" class="ui-widget-content">-->
<!--	<div width="98%" style=" height: auto;" id="listatecnicos">-->
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
			<?php 
				if($arritem) $arrObject = explode(',', $arritem);
				$objTotalREP = 0;$objtotalUSD = 0;$objTotalCOP = 0;
				$objTotalLamina = 0;$objTotalFleje = 0;$objTotalOtros = 0;$objTotalSUM = 0;
				for($a = 0; $a < count($arrObject); $a++):	
					$rsItem = loadrecordmateapoy($arrObject[$a], $idcon);
					
					($a % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">
				<td width="10%" class="row-consumo" style=" border-bottom: 1px solid #fff;" align="center">
					<input type="checkbox" name="chkarritemreceta" id="chkarritemreceta" onclick="setSelectionRow(this.value, document.getElementById('arritem').value, ',', 'arritem');" value="<?php echo $arrObject[$a] ?>">
				</td>
				<td width="25%" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $arrObject[$a] ?></td>
				<td width="65%" class="row-consumo" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsItem['mataponombre'] ?></td>
			</tr>
			<?php 
				endfor;

				unset($arrObject);
				
				if($a < 5):
					for($b = $a; $b < 5; $b++):
						($b % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">
				<td width="10%" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="25%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="65%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
			<?php
					endfor;
				endif;
			?>		
		</table>
		<input name="arritem" id="arritem" type="hidden" value="<?php echo $arritem ?>" />
<!--	</div>-->
<!--</div>-->