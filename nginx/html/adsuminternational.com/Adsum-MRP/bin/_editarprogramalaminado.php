<?php	
	if(!$noAjax)
	{
		include ( '../src/FunPerSecNiv/fncconn.php');
		include ( '../src/FunPerSecNiv/fncclose.php');
		include ( '../src/FunPerSecNiv/fncfetch.php');
		include ( '../src/FunPerSecNiv/fncnumreg.php');
		include ( '../src/FunPerSecNiv/fncsqlrun.php');
		include ( '../src/FunPerPriNiv/pktblop.php');
		include ( '../src/FunPerPriNiv/pktblequipo.php');
		include ( '../src/FunPerPriNiv/pktbloplaminado.php');
		include ( '../src/FunPerPriNiv/pktblopp.php');
		include ( '../src/FunPerPriNiv/pktblpadreitem.php');
		include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
		include ( '../src/FunPerPriNiv/pktblprogramalaminado.php');
		include ( '../src/FunGen/cargainput.php');
	}
	//conexion
	$idcon = fncconn();
	//equipos del sistema de laminado {5}
	$rs_equipo = dinamicscanopequipo(array('sistemcodigo' => 5, 'tipequcodigo' => 3),array('sistemcodigo' => '=', 'tipequcodigo' => '='),$idcon);
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
		<title>Programa de laminado</title>
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
		<script type="text/javascript" src="../src/FunjQuery/external/jquery.qtip-1.0.0-rc3.min.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejalmn.js"></script>
		<script type="text/javascript">
			$(function(){
				$( "<?php echo $sortable ?>" ).sortable().disableSelection();

		        var $tabs = $( "#programalaminado" ).tabs();
		 
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
		<div id="programalaminado" style="width:900px;align:center;margin-left:20px;">
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
					$rsLaminado = dinamicscanopprogramalaminado1(array('equipocodigo' => $obj_equipo),array('equipocodigo' => '='),$idcon, $rtr = 1);
					//se consulta el numero de resgirstro de la consulta
					$nrLaminado = fncnumreg($rsLaminado);
			?>
			<div id="<?php echo $obj_tab ?>" style="width:860px;">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
					<tr>
						<td class="ui-state-default" width="5%"  align="center"># OPP</td>
						<td class="ui-state-default" width="7%"  align="center"># PV</td>
						<td class="ui-state-default" width="30%"  align="center">Referencia</td>
						<td class="ui-state-default" width="10%"  align="center">Anc1&nbsp;<b>mm</b></td>
						<td class="ui-state-default" width="10%"  align="center">Anc2&nbsp;<b>mm</b></td>
						<td class="ui-state-default" width="10%"  align="center">F. Entrega</td>
						<td class="ui-state-default" width="10%"  align="center">Kilogramos&nbsp;</td>
						<td class="ui-state-default" width="10%"  align="center">Metros&nbsp;</td>
						<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-clipboard"></span></td>
					</tr>
				</table>
				<ul id="<?php echo $obj_sortable ?>" class="connectedSortable ui-helper-reset">
					<?php 
						//se recorre la consulta de opp
						for($b = 0;$b < $nrLaminado;$b++)
						{
							//se extrae uno de acuerdo a su indice
							$rwLaminado = fncfetch($rsLaminado,$b);
							$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwLaminado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
							$nrOpproduccion = fncnumreg($rsOpproduccion);
							//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
							$ANCHOLAMINADO = '';
							$ANCHOLAMINADO2 = '';
							$KILOSLAMINADO = '';
							$METROSLAMINADO = '';
							$APROBADOLAMINADO = '';
							//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
							$TIPOADHESIVO = '';
							$DESEMPENOADHESIVO = '';
							$LAMINADOADHESIVO = '';
							$FECHAENTREGA = '';
							$PEDIDOPRODUCCION = '';
							$CLIENTEPRODUCCION = '';
							$REFPRODUCCION = '';
							$ITEMPRODUCCION = '';
							$TIPOPEDIDOVENTA = '';
							//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
							$ANCHOLAMINADO = ($rwLaminado['ordoppanchot'])? $rwLaminado['ordoppanchot'] : '---' ;
							$KILOSLAMINADO = ($rwLaminado['ordoppcantkg'])? $rwLaminado['ordoppcantkg'] : '---' ;
							$METROSLAMINADO = ($rwLaminado['ordoppcantmt'])? $rwLaminado['ordoppcantmt'] : '---' ;
							$APROBADOLAMINADO = ($rwLaminado['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;	
							//FILTRO PARA EL EVENTO DE CHECKBOX
							$checked = '';
							if($rwLaminado['ordoppcomfir'] > 0)
							{
								$checked = 'checked';
								$arroppview = ($arroppview)? $arroppview.','.$rwLaminado['ordoppcodigo'] : $rwLaminado['ordoppcodigo'];
							}
							//se recorren las ordenes de produccion {op} asociadas en la opp
							for($c = 0;$c < $nrOpproduccion;$c++)
							{
								//se extrae una de acuerdo a su indice
								$rwOpproduccion = fncfetch($rsOpproduccion, $c);
								$rwOplaminado = loadrecordoplaminado($rwOpproduccion['ordprocodigo'],$idcon);
								//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
								$TIPOADHESIVO = ($rwOplaminado['ordprotiposo'])? strtoupper($rwOplaminado['ordprotiposo']) : '---' ;
								$DESEMPENOADHESIVO = ($rwOplaminado['ordprodesemp'])? strtoupper($rwOplaminado['ordprodesemp']) : '---' ;
								$LAMINADOADHESIVO = ($rwOplaminado['ordprolamina'])? strtoupper($rwOplaminado['ordprolamina']) : '---' ;
								$ANCHOLAMINADO2 = ($rwOplaminado['ordproancalt'])? strtoupper($rwOplaminado['ordproancalt']) : '---' ;				
								//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
								if($rwOplaminado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOplaminado['pedvenfecent']) : strtoupper($rwOplaminado['pedvenfecent']) ;
								if($rwOplaminado['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOplaminado['pedvennumero'] : $rwOplaminado['pedvennumero'] ;
								if($rwOplaminado['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOplaminado['ordcomrazsoc'] : $rwOplaminado['ordcomrazsoc'] ;
								if($rwOplaminado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOplaminado['producnombre'] : $rwOplaminado['producnombre'] ;
								if($rwOplaminado['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOplaminado['produccoduno'] : $rwOplaminado['produccoduno'] ;
								if($rwOplaminado['tipevenombre']) $TIPOPEDIDOVENTA = ($TIPOPEDIDOVENTA)? $TIPOPEDIDOVENTA.'<br>&nbsp;'.$rwOplaminado['tipevenombre'] : $rwOplaminado['tipevenombre'];
							}
								($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
					?>
					<li class="ui-state-default"  id="<?php echo $rwLaminado['ordoppcodigo'] ?>" style="width:100%;">
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
							<tr <?php echo $complement ?> >								
								<td width="5%" class="cont-line">&nbsp;<font color="blue"><b><?php echo str_pad($rwOplaminado['solprocodigo'], 4, "0", STR_PAD_LEFT) ?></b></font></td>
								<td width="7%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $PEDIDOPRODUCCION; ?></b></font></td>
								<td width="30%" class="cont-line">&nbsp;<font color="blue"><small><?php echo $REFPRODUCCION; ?></small></font></td>
								<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOLAMINADO; ?></td>
								<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOLAMINADO2; ?></td>
								<td width="10%" class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
								<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSLAMINADO, 2, ',', '.'); ?></b></font></td>
								<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($METROSLAMINADO, 2, ',', '.'); ?></b></font></td>
								<td class="cont-line" width="5%" >&nbsp;<input type="checkbox" id="chkoppview" name="chkoppview" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arroppview').value, ',', 'arroppview');" value="<?php echo $rwLaminado['ordoppcodigo'] ?>"></td>
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
					<button id="editaprograma_lmn">Editar [programa]</button>
					<button id="cancelarprograma_lmn">Atras</button></div>
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