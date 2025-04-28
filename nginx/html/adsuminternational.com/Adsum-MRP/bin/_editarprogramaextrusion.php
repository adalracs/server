<?php	

	if(!$noAjax)
	{
		include ( '../src/FunPerSecNiv/fncconn.php');
		include ( '../src/FunPerSecNiv/fncclose.php');
		include ( '../src/FunPerSecNiv/fncfetch.php');
		include ( '../src/FunPerSecNiv/fncnumreg.php');
		include ( '../src/FunPerSecNiv/fncsqlrun.php');
		include ( '../src/FunPerPriNiv/pktblop.php');
		include ( '../src/FunPerPriNiv/pktblopextrusion.php');
		include ( '../src/FunPerPriNiv/pktblprogramaextrusion.php');
		include ( '../src/FunPerPriNiv/pktblopp.php');
		include ( '../src/FunPerPriNiv/pktblequipo.php');
		include ( '../src/FunPerPriNiv/pktblpadreitem.php');
		include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
		include ( '../src/FunGen/cargainput.php');
	}
	//conexion
	$idcon = fncconn();
	//equipos del sistema de extriusion {1}
	$rs_equipo = dinamicscanopequipo(array('sistemcodigo' => 1, 'tipequcodigo' => 3),array('sistemcodigo' => '=', 'tipequcodigo' => '='),$idcon);
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
		<title>Programa de extrusion</title>
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
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejaext.js"></script>
		<script type="text/javascript">
			$(function(){
				$( "<?php echo $sortable ?>" ).sortable().disableSelection();
				 
		        var $tabs = $( "#programaextrusion" ).tabs();
		 
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
		<div id="programaextrusion" style="width:900px;align:center;margin-left:20px;">
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
				<li><a href="<?php echo $obj_tab ?>">&nbsp;<?php echo $rw_equipo['equiponombre']?><br>&nbsp;</a></li>
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
					$obj_sortable = "sortable_".$rw_equipo['equipocodigo'];////id de los sortable
					$rsExtrusion = dinamicscanopprogramaextrusion1(array('equipocodigo' => $obj_equipo),array('equipocodigo' => '='),$idcon, $rtr = 1);
					//se consulta el numero de resgirstro de la consulta
					$nrExtrusion = fncnumreg($rsExtrusion);
			?>
			<script type="text/javascript">
				Event_animatedcollapse('<?php echo $nrExtrusion ?>', 'filtrProext_<?php echo $obj_equipo ;?>');
			</script>
			<div id="<?php echo $obj_tab ?>">
				<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
					<tr>
						<td class="ui-state-default" width="5%"  align="center"># OPP</td>
						<td class="ui-state-default" width="10%"  align="center">Item&nbsp;<small><b>Pr.</b></small></td> 
						<td class="ui-state-default" width="7%"  align="center">Mezcla</td>
						<td class="ui-state-default" width="10%"  align="center">Anc.&nbsp;Ext.<b>(mm)</b></td>
						<td class="ui-state-default" width="10%"  align="center">Anc.&nbsp;Crt.<b>(mm)</b></td>
						<td class="ui-state-default" width="10%"  align="center">Calibre&nbsp;<b>(&micro;m)</b></td>
						<td class="ui-state-default" width="10%"  align="center">Pistas&nbsp;</td>
						<td class="ui-state-default" width="10%"  align="center">Kilogramos&nbsp;</td>
						<td class="ui-state-default" width="10%"  align="center">Kilogramos&nbsp;<small>(pdt)</small></td>
						<td class="ui-state-default" width="10%"  align="center">Tiempo Pr.</td> 
						<td class="ui-state-default" width="5%"  align="center"><span class="ui-icon ui-icon-clipboard"></span></td>
					</tr>
				</table>
				<ul id="<?php echo $obj_sortable ?>" class="connectedSortable ui-helper-reset">
					<?php 
						//se recorre la consulta de opp
						for($b = 0;$b < $nrExtrusion;$b++)
						{
							//se extrae uno de acuerdo a su indice
							$rwExtrusion = fncfetch($rsExtrusion,$b);
							//se consulta datos de la opp especificos
							$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwExtrusion['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
							$nrOpproduccion = fncnumreg($rsOpproduccion);
							//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
							$ANCHOEXTRUSION = '';
							$CALIBREEXTRUSION = '';
							$KILOSEXTRUSION = '';
							$METROSEXTRUSION = '';
							$APROBADOEXTRUSION = '';
							//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
							$FORMULAEXTRUSION = '';
							$CORTEEXTRUSION = '';
							$PISTASEXTRUSION = '';
							$ITEMPRODUCCION = '';
							$CLIENTEPRODUCCION = '';
							$REFPRODUCCION = '';
							$PEDIDOPRODUCCION = '';
							$DESTINOPRODUCCION = '';
							//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
							$ANCHOEXTRUSION = ($rwExtrusion['ordoppanchot'])? $rwExtrusion['ordoppanchot'] : '---' ;
							$KILOSEXTRUSION = ($rwExtrusion['ordoppcantkg'])? $rwExtrusion['ordoppcantkg'] : '---' ;
							$METROSEXTRUSION = ($rwExtrusion['ordoppcantmt'])? $rwExtrusion['ordoppcantmt'] : '---' ;
							$APROBADOEXTRUSION = ($rwExtrusion['ordoppcomfir'] > 0)? '<font color="#000080"><b>Si</b></font>' : '<font color="#FF0000"><b>No</b></font>' ;
							//FILTRO PARA EL EVENTO DE CHECKBOX
							$checked = '';
							if($rwExtrusion['ordoppcomfir'] > 0)
							{
								$checked = 'checked';
								$arroppview = ($arroppview)? $arroppview.','.$rwExtrusion['ordoppcodigo'] : $rwExtrusion['ordoppcodigo'];
							}
							//se recorren las ordenes de produccion {op} asociadas en la opp
							for($c = 0;$c < $nrOpproduccion;$c++)
							{
								$rwOpproduccion = fncfetch($rsOpproduccion, $c);
								$rwOpextrusion = loadrecordopextrusion($rwOpproduccion['ordprocodigo'],$idcon);
								//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
								$FORMULAEXTRUSION = ($rwOpextrusion['formulnumero'])? $rwOpextrusion['formulnumero'] : '---' ;
								$CALIBREEXTRUSION = ($rwOpextrusion['ordprocalibr'])? $rwOpextrusion['ordprocalibr'] : '---' ;
								//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
								if($rwOpextrusion['itedescodigo']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.' | '.$rwOpextrusion['itedescodigo'] : $rwOpextrusion['itedescodigo'] ;
								if($rwOpextrusion['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpextrusion['pedvennumero'] : $rwOpextrusion['pedvennumero'] ;
								if($rwOpextrusion['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpextrusion['ordcomrazsoc'] : $rwOpextrusion['ordcomrazsoc'] ;
								if($rwOpextrusion['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpextrusion['producnombre'] : $rwOpextrusion['producnombre'] ;
								if($rwOpextrusion['procednombre']) $DESTINOPRODUCCION = ($DESTINOPRODUCCION)? $DESTINOPRODUCCION.'<br>&nbsp;'.strtoupper($rwOpextrusion['procednombre']) : strtoupper($rwOpextrusion['procednombre']) ;
								if($rwOpextrusion['ordproancext'] && $rwOpextrusion['ordpropistae']) 
								{
									$CORTEEXTRUSION = ($CORTEEXTRUSION)? $CORTEEXTRUSION.' | '.($rwOpextrusion['ordpropistae'] * $rwOpextrusion['ordproancext']) : ($rwOpextrusion['ordpropistae'] * $rwOpextrusion['ordproancext']);
									$PISTASEXTRUSION = ($PISTASEXTRUSION)? $PISTASEXTRUSION.' | '.$rwOpextrusion['ordpropistae'].' * '.$rwOpextrusion['ordproancext'] : $rwOpextrusion['ordpropistae'].' * '.$rwOpextrusion['ordproancext'] ;
								}
							}
							($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
					?>
					<li class="ui-state-default"  id="<?php echo $rwExtrusion['ordoppcodigo'] ?>" style="width:100%;">
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
							<tr <?php echo $complement ?> >
								<td width="5%" class="cont-line">&nbsp;<font color="blue"><b><?php echo str_pad($rwOpextrusion['solprocodigo'], 4, "0", STR_PAD_LEFT); ?></b></font></td>
								<td width="10%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $ITEMPRODUCCION; ?></b></font></td>
								<td width="7%" class="cont-line">&nbsp;<font color="brown"><b><?php echo $FORMULAEXTRUSION; ?></b></font></td>
								<td width="10%" class="cont-line" align="center">&nbsp;<?php echo $ANCHOEXTRUSION; ?></td>
								<td width="10%" class="cont-line" align="center">&nbsp;<?php echo $CORTEEXTRUSION; ?></td>
								<td width="10%" class="cont-line">&nbsp;<?php echo $CALIBREEXTRUSION; ?></td>
								<td width="10%" class="cont-line">&nbsp;<?php echo $PISTASEXTRUSION;?></td>
								<td width="10%" class="cont-line">&nbsp;<font color="green"><b><?php echo number_format($KILOSEXTRUSION, 2, ',', '.'); ?></b></font></td>
								<td width="10%" class="cont-line">&nbsp;<font color="red"><b><?php echo number_format($KILOSEXTRUSION, 2, ',', '.'); ?></b></font></td>
								<td width="10%" class="cont-line">&nbsp;<font color="green"><b><small>&nbsp;<?php echo date("Y-m-d H:i", strtotime(" {$varDate} + {$$total_equipotmp} minutes")); ?></small></b></font></td>
								<td width="5%" class="cont-line">&nbsp;<input type="checkbox" id="chkoppview" name="chkoppview" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arroppview').value, ',', 'arroppview');" value="<?php echo $rwExtrusion['ordoppcodigo'] ?>"></td>
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
					<button id="editaprograma_ext">Editar [programa]</button>
					<button id="cancelarprograma_ext">Atras</button></div>
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