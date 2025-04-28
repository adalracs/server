<?php	

	if(!$noAjax)
	{
		include ( '../src/FunPerSecNiv/fncconn.php');
		include ( '../src/FunPerSecNiv/fncclose.php');
		include ( '../src/FunPerSecNiv/fncfetch.php');
		include ( '../src/FunPerSecNiv/fncnumreg.php');
		include ( '../src/FunPerSecNiv/fncsqlrun.php');
		include ( '../src/FunPerPriNiv/pktblop.php');
		include ( '../src/FunPerPriNiv/pktblopflexo.php');
		include ( '../src/FunPerPriNiv/pktblprogramaflexo.php');
		include ( '../src/FunPerPriNiv/pktblopp.php');
		include ( '../src/FunPerPriNiv/pktblequipo.php');
		include ( '../src/FunPerPriNiv/pktblpadreitem.php');
		include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
		include ( '../src/FunGen/cargainput.php');
	}
	//conexion
	$idcon = fncconn();
	//se crea sql para traer los equipos del sistema de flexografia {3}
	$rs_equipo = dinamicscanopequipo(array('sistemcodigo' => 3, 'tipequcodigo' => 3),array('sistemcodigo' => '=', 'tipequcodigo' => '='),$idcon);
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
		<title>Programa de flexografia</title>
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
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejaflx.js"></script>
		<script type="text/javascript">
			$(function(){
				$( "<?php echo $sortable ?>" ).sortable().disableSelection();

		        var $tabs = $( "#programaflexo" ).tabs();
		 
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
		<div id="programaflexo">
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
					$rsFlexografia = dinamicscanopprogramaflexo1(array('equipocodigo' => $obj_equipo),array('equipocodigo' => '='),$idcon, $rtr = 1);
					//se consulta el numero de resgirstro de la consulta
					$nrFlexografia = fncnumreg($rsFlexografia);
			?>
			<div id="<?php echo $obj_tab ?>">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
					<tr>
						<td class="ui-state-default" width="4%"  align="center"># OPP</td>
						<td class="ui-state-default" width="8%"  align="center">Item</td>
						<td class="ui-state-default" width="31%"  align="center">Referencia</td>
						<td class="ui-state-default" width="10%"  align="center">Material</td>
						<td class="ui-state-default" width="6%"  align="center">Anc.&nbsp;mm</td>
						<td class="ui-state-default" width="6%"  align="center">Kilos</td>
						<td class="ui-state-default" width="6%"  align="center">Metros</td>
						<td class="ui-state-default" width="6%"  align="center">Impresion</td>
						<td class="ui-state-default" width="8%"  align="center">F. Entega</td>
						<td class="ui-state-default" width="6%"  align="center">Rodillo</td>
						<td class="ui-state-default" width="5%"  align="center">Sel.</td> 
					</tr>
				</table>
				<ul id="<?php echo $obj_sortable ?>" class="connectedSortable ui-helper-reset">
					<?php 
						//se recorre la consulta de opp
						for($b = 0;$b < $nrFlexografia;$b++)
						{
							//se extrae uno de acuerdo a su indice
							$rwFlexografia = fncfetch($rsFlexografia,$b);
							//se consulta datos de la opp especificos
							$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwFlexografia['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
							$nrOpproduccion = fncnumreg($rsOpproduccion);	
							//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
							$ANCHOIMPRESION = '';
							$KILOSIMPRESION = '';
							$METROSIMPRESION = '';
							$APROBADOIMPRESION = '';
							//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
							$ITEMPRODUCCION = '';
							$REFPRODUCCION = '';
							$MATERIALIMPRESION = '';
							$TIPOIMPRESION = '';
							$FECHAENTREGA = '';
							$RODILLOIMPRESION = '';
							$PEDIDOPRODUCCION = '';
							$CLIENTEPRODUCCION = '';
							$DESTINOPRODUCCION = '';
							$TIPOPEDIDOVENTA = '';
							//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
							$ANCHOIMPRESION = ($rwFlexografia['ordoppanchot'])? $rwFlexografia['ordoppanchot'] : '---' ;
							$KILOSIMPRESION = ($rwFlexografia['ordoppcantkg'])? $rwFlexografia['ordoppcantkg'] : '---' ;
							$METROSIMPRESION = ($rwFlexografia['ordoppcantmt'])? $rwFlexografia['ordoppcantmt'] : '---' ;
							$APROBADOIMPRESION = ($rwFlexografia['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;						
							//FILTRO PARA EL EVENTO DE CHECKBOX
							$checked = '';
							if($rwFlexografia['ordoppcomfir'] > 0)
							{
								$checked = 'checked';
								$arroppview = ($arroppview)? $arroppview.','.$rwFlexografia['ordoppcodigo'] : $rwFlexografia['ordoppcodigo'];
							}
							//se recorren las ordenes de produccion {op} asociadas en la opp
							for($c = 0;$c < $nrOpproduccion;$c++)
							{
								//se extrae una de acuerdo a su indice
								$rwOpproduccion = fncfetch($rsOpproduccion, $c);
								$rwOpflexografia = loadrecordopflexo($rwOpproduccion['ordprocodigo'],$idcon);
								//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
								$MATERIALIMPRESION = ($rwOpflexografia['paditenombre'])? $rwOpflexografia['paditenombre'] : '---' ;
								$TIPOIMPRESION = ($rwOpflexografia['ordprotipimp'])? strtoupper($rwOpflexografia['ordprotipimp']) : '---' ;
								$RODILLOIMPRESION = ($rwOpflexografia['ordprorodill'])? $rwOpflexografia['ordprorodill'] : '---' ;
								//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}				
								if($rwOpflexografia['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['produccoduno'] : $rwOpflexografia['produccoduno'] ;
								if($rwOpflexografia['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['producnombre'] : $rwOpflexografia['producnombre'] ;
								if($rwOpflexografia['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpflexografia['pedvenfecent']) : strtoupper($rwOpflexografia['pedvenfecent']) ;
								if($rwOpflexografia['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['pedvennumero'] : $rwOpflexografia['pedvennumero'] ;
								if($rwOpflexografia['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpflexografia['ordcomrazsoc'] : $rwOpflexografia['ordcomrazsoc'] ;
								if($rwOpflexografia['procednombre']) $DESTINOPRODUCCION = ($DESTINOPRODUCCION)? $DESTINOPRODUCCION.'<br>&nbsp;'.strtoupper($rwOpflexografia['procednombre']) : strtoupper($rwOpflexografia['procednombre']);
								if($rwOpflexografia['tipevenombre']) $TIPOPEDIDOVENTA = ($TIPOPEDIDOVENTA)? $TIPOPEDIDOVENTA.'<br>&nbsp;'.$rwOpflexografia['tipevenombre'] : $rwOpflexografia['tipevenombre'];
							}
							($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
					?>
					<li class="ui-state-default"  id="<?php echo $rwFlexografia['ordoppcodigo'] ?>" style="width:100%;">
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
							<tr <?php echo $complement ?>>
								<td width="4%" class="cont-line">&nbsp;<?php echo str_pad($rwOpflexografia['solprocodigo'], 4, "0", STR_PAD_LEFT); ?></td>
								<td width="8%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $ITEMPRODUCCION; ?></b></font></td>
								<td width="31%" class="cont-line">&nbsp;<font color="blue"><small><?php echo $REFPRODUCCION; ?></small></font></td>
								<td width="10%" class="cont-line">&nbsp;<font color="brown"><small><?php echo $MATERIALIMPRESION; ?></small></font></td>
								<td width="6%" class="cont-line">&nbsp;<?php echo $ANCHOIMPRESION; ?></td>
								<td width="6%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSIMPRESION, 2, ',', '.'); ?></b></td>
								<td width="6%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($METROSIMPRESION, 2, ',', '.'); ?></b></td>
								<td width="6%" class="cont-line">&nbsp;<?php echo $TIPOIMPRESION; ?></td>
								<td width="8%" class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
								<td width="6%" class="cont-line">&nbsp;<?php echo $RODILLOIMPRESION; ?></td>
								<td class="cont-line" width="5%" >&nbsp;<input type="checkbox" id="chkoppview" name="chkoppview" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arroppview').value, ',', 'arroppview');" value="<?php echo $rwFlexografia['ordoppcodigo'] ?>"></td>
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
					<button id="editaprograma_flx">Editar [programa]</button>
					<button id="cancelarprograma_flx">Atras</button></div>
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