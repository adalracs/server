<?php	
	if(!$noAjax)
	{
		include ( '../src/FunPerSecNiv/fncconn.php');
		include ( '../src/FunPerSecNiv/fncclose.php');
		include ( '../src/FunPerSecNiv/fncfetch.php');
		include ( '../src/FunPerSecNiv/fncnumreg.php');
		include ( '../src/FunPerSecNiv/fncsqlrun.php');
		include ( '../src/FunPerPriNiv/pktblop.php');
		include ( '../src/FunPerPriNiv/pktblopdoblado.php');
		include ( '../src/FunPerPriNiv/pktblprogramadoblado.php');
		include ( '../src/FunPerPriNiv/pktblopp.php');
		include ( '../src/FunPerPriNiv/pktblequipo.php');
		include ( '../src/FunPerPriNiv/pktblpadreitem.php');
		include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
		include ( '../src/FunGen/cargainput.php');
	}
	//conexion
	$idcon = fncconn();
	$rs_equipo = dinamicscanopequipo(array('sistemcodigo' =>62, 'tipequcodigo' => 4),array('sistemcodigo' => '=', 'tipequcodigo' => '='),$idcon);
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
		<title>Programa de doblado</title>
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
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_bandejadbl.js"></script>
		<script type="text/javascript">
			$(function(){
				$( "<?php echo $sortable ?>" ).sortable().disableSelection();

		        var $tabs = $( "#programadoblado" ).tabs();
		 
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
		<div id="programadoblado">
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
					$rsDoblado = dinamicscanopprogramadoblado1(array('equipocodigo' => $obj_equipo),array('equipocodigo' => '='),$idcon);
					//se consulta el numero de resgirstro de la consulta
					$nrDoblado = fncnumreg($rsDoblado);
			?>
			<script type="text/javascript">
				Event_animatedcollapse('<?php echo $nrDoblado ?>', 'filtrProdbl_<?php echo $obj_equipo ;?>');
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
						for($b = 0;$b < $nrDoblado;$b++)
						{
							//se extrae uno de acuerdo a su indice
							$rwDoblado = fncfetch($rsDoblado,$b);
							//rutina para traer las op's que contienen la opp madre
							$rsOpproduccion = dinamicscanopop(array('ordoppcodigo' => $rwDoblado['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
							$nrOpproduccion = fncnumreg($rsOpproduccion);
							//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
							$REFPRODUCCION = '';
							$LARGOMATERIAL = '';
							$FUELLEMATERIAL = '';
							$ANCHOMATERIAL = '';
							$PESOMILLAR = '';	
							$CANTIDADPED = '';
							$FECHAENTREGA = '';
							$KILOSDOBLADO = '';
							//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
							$PEDIDOPRODUCCION = '';
							$TIPOPEDIDO = '';
							$ITEMPRODUCCION = '';
							$CLIENTEPRODUCCION = '';
							$DESTINOPEDIDO = '';		
							//VARIABLE A USAR EN OPP {ORDENES DE PRODUCCION PROGRAMADA}
							$KILOSDOBLADO = ($rwDoblado['ordoppcantkg'])? $rwDoblado['ordoppcantkg'] : '---' ;
							//FILTRO PARA EL EVENTO DE CHECKBOX
							$checked = '';
							if($rwDoblado['ordoppcomfir'] > 0)
							{
								$checked = 'checked';
								$arroppview = ($arroppview)? $arroppview.','.$rwDoblado['ordoppcodigo'] : $rwDoblado['ordoppcodigo'];
							}
							//se recorren las ordenes de produccion {op} asociadas en la opp
							for($c = 0;$c < $nrOpproduccion;$c++)
							{
								$rwOpproduccion = fncfetch($rsOpproduccion, $c);
								$rwOpdoblado = loadrecordopdoblado($rwOpproduccion['ordprocodigo'],$idcon);
								//VARIABLE A USAR EN OP {ORDENES DE PRODUCCION}
								if($rwOpdoblado['producnombre']) $REFPRODUCCION = ($REFPRODUCCION)? $REFPRODUCCION.'<br>&nbsp;'.$rwOpdoblado['producnombre'] : $rwOpdoblado['producnombre'] ;
								if($rwOpdoblado['ordprolargom']) $LARGOMATERIAL = ($LARGOMATERIAL)? $LARGOMATERIAL.'<br>&nbsp;'.$rwOpdoblado['ordprolargom'] : $rwOpdoblado['ordprolargom'] ;
								if($rwOpdoblado['ordprofuelle']) $FUELLEMATERIAL = ($FUELLEMATERIAL)? $FUELLEMATERIAL.'<br>&nbsp;'.$rwOpdoblado['ordprofuelle'] : $rwOpdoblado['ordprofuelle'] ;
								if($rwOpdoblado['ordproancmat']) $ANCHOMATERIAL = ($ANCHOMATERIAL)? $ANCHOMATERIAL.'<br>&nbsp;'.$rwOpdoblado['ordproancmat'] : $rwOpdoblado['ordproancmat'] ;
								if($rwOpdoblado['ordpropmilla']) $PESOMILLAR = ($PESOMILLAR)? $PESOMILLAR.'<br>&nbsp;'.$rwOpdoblado['ordpropmilla'] : $rwOpdoblado['ordpropmilla'] ;
								if($rwOpdoblado['propedcansol']) $CANTIDADPED = ($CANTIDADPED)? $CANTIDADPED.'<br>&nbsp;'.$rwOpdoblado['propedcansol'] : $rwOpdoblado['propedcansol'] ;
								if($rwOpdoblado['pedvenfecent']) $FECHAENTREGA = ($FECHAENTREGA)? $FECHAENTREGA.'<br>&nbsp;'.strtoupper($rwOpdoblado['pedvenfecent']) : strtoupper($rwOpdoblado['pedvenfecent']) ;
								//VARIABLES ACUMULABLES A USAR EN OP {ORDENES DE PRODUCCION}
								if($rwOpdoblado['pedvennumero']) $PEDIDOPRODUCCION = ($PEDIDOPRODUCCION)? $PEDIDOPRODUCCION.'<br>&nbsp;'.$rwOpdoblado['pedvennumero'] : $rwOpdoblado['pedvennumero'] ;
								if($rwOpdoblado['tipevenombre']) $TIPOPEDIDO = ($TIPOPEDIDO)? $TIPOPEDIDO.'<br>&nbsp;'.$rwOpdoblado['tipevenombre'] : $rwOpdoblado['tipevenombre'] ;
								if($rwOpdoblado['produccoduno']) $ITEMPRODUCCION = ($ITEMPRODUCCION)? $ITEMPRODUCCION.'<br>&nbsp;'.$rwOpdoblado['produccoduno'] : $rwOpdoblado['produccoduno'] ;
								if($rwOpdoblado['ordcomrazsoc']) $CLIENTEPRODUCCION = ($CLIENTEPRODUCCION)? $CLIENTEPRODUCCION.'<br>&nbsp;'.$rwOpdoblado['ordcomrazsoc'] : $rwOpdoblado['ordcomrazsoc'] ;
								if($rwOpdoblado['procednombre']) $DESTINOPEDIDO = ($DESTINOPEDIDO)? $DESTINOPEDIDO.'<br>&nbsp;'.strtoupper($rwOpdoblado['procednombre']) : strtoupper($rwOpdoblado['procednombre']) ;
							}
								($b % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
					?>
					<li class="ui-state-default"  id="<?php echo $rwDoblado['ordoppcodigo'] ?>" style="width:100%;">
						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
							<tr <?php echo $complement ?>">
								<td width="6%" class="cont-line">&nbsp;<?php echo str_pad($rwDoblado['ordoppcodigo'], 4, "0", STR_PAD_LEFT) ?></td>
								<td width="35%" class="cont-line">&nbsp;<?php echo $REFPRODUCCION; ?></td>
								<td width="8%" class="cont-line">&nbsp;<?php echo $LARGOMATERIAL; ?></td>
								<td width="10%" class="cont-line">&nbsp;<?php echo $ANCHOMATERIAL; ?></td>
								<td width="6%" class="cont-line">&nbsp;<?php echo $FUELLEMATERIAL; ?></td>
								<td width="8%" class="cont-line">&nbsp;<?php echo $PESOMILLAR; ?></td>
								<td width="8%" class="cont-line">&nbsp;<?php echo $CANTIDADPED;?></td>
								<td width="10%" class="cont-line">&nbsp;<?php echo $FECHAENTREGA; ?></td>
								<td width="6%" class="cont-line">&nbsp;<?php echo number_format($KILOSDOBLADO, 2, ',', '.'); ?></td>
								<td width="5%" class="cont-line">&nbsp;<input type="checkbox" id="chkoppview" name="chkoppview" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arroppview').value, ',', 'arroppview');" value="<?php echo $rwDoblado['ordoppcodigo'] ?>"></td>
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
					<button id="editaprograma_dbl">Editar [programa]</button>
					<button id="cancelarprograma_dbl">Atras</button></div>
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