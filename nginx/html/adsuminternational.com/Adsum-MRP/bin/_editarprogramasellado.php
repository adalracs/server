<?php	
	if(!$noAjax)
	{
		include ( '../src/FunPerSecNiv/fncconn.php');
		include ( '../src/FunPerSecNiv/fncclose.php');
		include ( '../src/FunPerSecNiv/fncfetch.php');
		include ( '../src/FunPerSecNiv/fncnumreg.php');
		include ( '../src/FunPerSecNiv/fncsqlrun.php');
		include ( '../src/FunPerPriNiv/pktblop.php');
		include ( '../src/FunPerPriNiv/pktblopsellado.php');
		include ( '../src/FunPerPriNiv/pktblprogramasellado.php');
		include ( '../src/FunPerPriNiv/pktblopp.php');
		include ( '../src/FunPerPriNiv/pktblequipo.php');
		include ( '../src/FunPerPriNiv/pktblpadreitem.php');
		include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
		include ( '../src/FunGen/cargainput.php');
	}
	//conexion
	$idcon = fncconn();
	$rs_equipo = dinamicscanopequipo(array('sistemcodigo' => 4, 'tipequcodigo' => 4),array('sistemcodigo' => '=', 'tipequcodigo' => '='),$idcon);
	//se consultan el numero de resgistros
	$nr_equipo = fncnumreg($rs_equipo);
	//se recorre el resultado de la consulta
	for($a = 0;$a < $nr_equipo;$a++)
	{
		//se extrae uno de la consulta dependiendo de su indice
		$rw_equipo = fncfetch($rs_equipo,$a);
		//se crear array de cotiene id de los sortable
		$sortable = ($sortable)? $sortable = $sortable.', #sortable_'.$rw_equipo['equipocodigo'] : $sortable = '#sortable_'.$rw_equipo['equipocodigo'];
		//se crea array de los equipos existentes		
		$arrequipo = ($arrequipo)? $arrequipo = $arrequipo.','.$rw_equipo['equipocodigo'] : $arrequipo = $rw_equipo['equipocodigo'];
	}
	
?>
<html>
	<head>
		<title>Programa de sellado</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/jquery-1.8.2.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.core.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.mouse.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.button.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.draggable.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.position.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.resizable.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.dialog.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.tabs.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.autocomplete.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.slider.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.datepicker.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.sortable.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/ui_9.1/ui/jquery.ui.droppable.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejasld.js"></script>
		<script type="text/javascript">
			$(function(){
				$( "<?php echo $sortable ?>" ).sortable().disableSelection();

		        var $tabs = $( "#programasellado" ).tabs();
		 
		        var $tab_items = $( "ul:first li", $tabs ).droppable({
		            accept: ".connectedSortable li",
		            hoverClass: "ui-state-hover",
		            drop: function( event, ui ) {
		                var $item = $( this );
		                var $list = $( $item.find( "a" ).attr( "href" ) )
		                    .find( ".connectedSortable" );
		 
		                ui.draggable.hide( "slow", function() {
		                    $tabs.tabs( "select", $tab_items.index( $item ) );
		                    $( this ).appendTo( $list ).show( "slow" );
		                });
		            }
		        });
			});
		</script>
	</head>
	<body>
	<form name="form1" method="post"  enctype="multipart/form-data">
		<div id="programasellado">
			<ul>
			<?php 
				//se cuenta el numero de registros del sql de equipos
				$nr_equipo = fncnumreg($rs_equipo);
				//se recorre la consulta
				for($a = 0;$a < $nr_equipo;$a++)
				{
					//se extrae uno de acuerdo a su indice
					$rw_equipo = fncfetch($rs_equipo,$a);
					//objetos a usar
					$obj_tab = '#tabs-'.$rw_equipo['equipocodigo'];//sirve para asignar los id a las <li>
			?>
				<li><a href="<?php echo $obj_tab ?>">&nbsp;<?php echo $rw_equipo['equiponombre']?>&nbsp;<br>&nbsp;</a></li>
			<?php 
				}
			?>
			</ul>
			<?php 
				//se cuenta el numero de registro del sql de equipos
				$nr_equipo = fncnumreg($rs_equipo);
				//se recorre la consulta
				for($a = 0;$a < $nr_equipo;$a++)
				{
					//se extrae uno de acuerdo a su indice
					$rw_equipo = fncfetch($rs_equipo,$a);
					//objetos a usar
					$obj_equipo = $rw_equipo['equipocodigo'];
					$obj_tab = 'tabs-'.$rw_equipo['equipocodigo'];//id de los tabs
					$obj_sortable = "sortable_".$rw_equipo['equipocodigo'];//id de los sortable
					$rsSellado = dinamicscanopprogramasellado1(array('equipocodigo' => $obj_equipo),array('equipocodigo' => '='),$idcon);
					//se consulta el numero de resgirstro de la consulta
					$nrSellado = fncnumreg($rsSellado);
			?>
			<script type="text/javascript">
				Event_animatedcollapse('<?php echo $nrSellado ?>', 'filtrProsld_<?php echo $obj_equipo ;?>');
			</script>
			<div id="<?php echo $obj_tab ?>">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
					<tr>
						<td class="ui-state-default" width="6%"  align="center"># OPP</td>
						<td class="ui-state-default" width="35%"  align="center">Referencia</td>
						<td class="ui-state-default" width="8%"  align="center">Largo&nbsp;<b>mm</b></td>
						<td class="ui-state-default" width="10%"  align="center">Ancho b.&nbsp;<b>mm</b></td>
						<td class="ui-state-default" width="6%"  align="center">Fuelle</td>
						<td class="ui-state-default" width="8%"  align="center">Kg Millar</td>
						<td class="ui-state-default" width="8%"  align="center">Cantidad</td>
						<td class="ui-state-default" width="10%"  align="center">F. entrega</td>
						<td class="ui-state-default" width="6%"  align="center">Kg&nbsp;<b>PR</b></td>
						<td class="ui-state-default" width="5%"  align="center">Sel.</td>  
					</tr>
				</table>
				<ul id="<?php echo $obj_sortable ?>" class="connectedSortable ui-helper-reset">
					<?php 
						//se recorre la consulta de opp
						for($b = 0;$b < $nrSellado;$b++)
						{
							//se extrae uno de acuerdo a su indice
							$rwSellado = fncfetch($rsSellado,$b);
							//rutina para traer las op's que contienen la opp madre
							$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwSellado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
							$nrOpproduccion = fncnumreg($rsOpproduccion);
							//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
							$REFPRODUCCION = '';
							$LARGOMATERIAL = '';
							$FUELLEMATERIAL = '';
							$ANCHOMATERIAL = '';
							$PESOMILLAR = '';	
							$CANTIDADPED = '';
							$FECHAENTREGA = '';
							$KILOSSELLADO = '';
							$METROSELLADO = '';
							//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
							$PEDIDOPRODUCCION = '';
							$TIPOPEDIDO = '';
							$ITEMPRODUCCION = '';
							$CLIENTEPRODUCCION = '';
							$DESTINOPEDIDO = '';		
							//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
							$KILOSSELLADO = ($rwSellado['ordoppcantkg'])? $rwSellado['ordoppcantkg'] : '---' ;
							$METROSELLAD0 = ($rwSellado['ordoppcantmt'])? $rwSellado['ordoppcantmt'] : '---' ;
							$APROBADOSELLADO = ($rwSellado['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;
							//FILTRO PARA EL EVENTO DE CHECKBOX
							$checked = '';
							if($rwSellado['ordoppcomfir'] > 0)
							{
								$checked = 'checked';
								$arroppview = ($arroppview)? $arroppview.','.$rwSellado['ordoppcodigo'] : $rwSellado['ordoppcodigo'];
							}
							//se recorren las ordenes de produccion {op} asociadas en la opp
							for($c = 0;$c < $nrOpproduccion;$c++)
							{
								$rwOpproduccion = fncfetch($rsOpproduccion, $c);
								$rwOpsellado = loadrecordopsellado($rwOpproduccion['ordprocodigo'],$idcon);
								//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
								if($rwOpsellado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpsellado['producnombre'] : $rwOpsellado['producnombre'] ;
								if($rwOpsellado['ordprolargom']) $LARGOMATERIAL = ($LARGOMATERIAL)? $LARGOMATERIAL.'<br>&nbsp;'.$rwOpsellado['ordprolargom'] : $rwOpsellado['ordprolargom'] ;
								if($rwOpsellado['ordprofuelle']) $FUELLEMATERIAL = ($FUELLEMATERIAL)? $FUELLEMATERIAL.'<br>&nbsp;'.$rwOpsellado['ordprofuelle'] : $rwOpsellado['ordprofuelle'] ;
								if($rwOpsellado['ordproancmat']) $ANCHOMATERIAL = ($ANCHOMATERIAL)? $ANCHOMATERIAL.'<br>&nbsp;'.$rwOpsellado['ordproancmat'] : $rwOpsellado['ordproancmat'] ;
								if($rwOpsellado['ordpropmilla']) $PESOMILLAR = ($PESOMILLAR)? $PESOMILLAR.'<br>&nbsp;'.$rwOpsellado['ordpropmilla'] : $rwOpsellado['ordpropmilla'] ;
								if($rwOpsellado['propedcansol']) $CANTIDADPED = ($CANTIDADPED)? $CANTIDADPED.'<br>&nbsp;'.$rwOpsellado['propedcansol'] : $rwOpsellado['propedcansol'] ;
								if($rwOpsellado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpsellado['pedvenfecent']) : strtoupper($rwOpsellado['pedvenfecent']) ;
								//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
								if($rwOpsellado['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpsellado['pedvennumero'] : $rwOpsellado['pedvennumero'] ;
								if($rwOpsellado['tipevenombre']) $TIPOPEDIDO = ($TIPOPEDIDO)? $TIPOPEDIDO.'<br>&nbsp;'.$rwOpsellado['tipevenombre'] : $rwOpsellado['tipevenombre'] ;
								if($rwOpsellado['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOpsellado['produccoduno'] : $rwOpsellado['produccoduno'] ;
								if($rwOpsellado['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpsellado['ordcomrazsoc'] : $rwOpsellado['ordcomrazsoc'] ;
								if($rwOpsellado['procednombre']) $DESTINOPEDIDO = ($DESTINOPEDIDO)? $DESTINOPEDIDO.'<br>&nbsp;'.strtoupper($rwOpsellado['procednombre']) : strtoupper($rwOpsellado['procednombre']) ;
							}
								($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
					?>
					<li class="ui-state-default"  id="<?php echo $rwSellado['ordoppcodigo'] ?>" style="width:100%;">
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
							<tr <?php echo $complement ?>">
								<td width="6%" class="cont-line">&nbsp;<?php echo str_pad($rwSellado['ordoppcodigo'], 4, "0", STR_PAD_LEFT) ?></td>
								<td width="35%" class="cont-line">&nbsp;<?php echo $REFPRODUCCION; ?></td>
								<td width="8%" class="cont-line">&nbsp;<?php echo $LARGOMATERIAL; ?></td>
								<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOMATERIAL; ?></td>
								<td width="6%" class="cont-line">&nbsp;<?php echo $FUELLEMATERIAL; ?></td>
								<td width="8%" class="cont-line">&nbsp;<?php echo $PESOMILLAR; ?></td>
								<td width="8%" class="cont-line">&nbsp;<?php echo $CANTIDADPED;?></td>
								<td width="10%" class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
								<td width="6%" class="cont-line">&nbsp;<?php echo number_format($KILOSSELLADO, 2, ',', '.'); ?></td>
								<td width="5%" class="cont-line">&nbsp;<input type="checkbox" id="chkoppview" name="chkoppview" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arroppview').value, ',', 'arroppview');" value="<?php echo $rwSellado['ordoppcodigo'] ?>"></td>
							</tr>
						</table>
					</li>
					<?php 
						}
					?>
				</ul>
			</div>
			<?php 
				}
			?>
		</div>
		<table width="100%" align="center" cellpadding="1" cellspacing="1">
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
					<button id="editaprograma_sld">Editar [programa]</button>
					<button id="cancelarprograma_sld">Atras</button></div>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr> 
		</table>
		<input type="hidden" name="arrequipo" id="arrequipo" value="<?php echo $arrequipo; ?>" />
		<input type="hidden" name="arroppview" id="arroppview" value="<?php echo $arroppview; ?>" />
		<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
	</form>
	<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
	<head>
		 <style>
    		<?php echo $sortable_css ?> { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 120px; }
    	</style>
	</head>
</html>