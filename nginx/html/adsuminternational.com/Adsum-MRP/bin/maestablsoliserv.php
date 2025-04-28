<?php
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblvistasoliserv.php');
	include ( '../src/FunPerPriNiv/pktblvistahistsoliserv.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktblsoliserv.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');//New 12-sep-2007 cbedoya
	include ( '../src/FunPerPriNiv/pktblsistema.php');//New 12-sep-2007 cbedoya
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
  
	if($accionborrarsoliserv)
		include ( 'borrasoliserv.php');
	else
	{
		if($accionconsultarsoliserv)
		{
			$recon = 1;
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				$recarreglo[$nombcamp] = $$nombcamp;
				if($recarreglo[$nombcamp] != null){ $nusw =1;}
				$nombcamp = strtok(",");
			}
			if(!$nusw)
				$accionconsultarsoliserv = 0;
		}
	} 
	
	if($equipocodigocmbx && $filterindex && $recon)
	{
		$equipocodigo = $equipocodigocmbx;
		unset($plantacodigo, $sistemcodigo);
		$recarreglo['plantacodigo'] = $plantacodigo;
		$recarreglo['sistemcodigo'] = $sistemcodigo;
		$recarreglo['equipocodigo'] = $equipocodigocmbx;
		$accionconsultarot = 1;
	}
	
	//===Validacion de usuario========
	$idcon = fncconn();
	$rs_usuario = loadrecordusuario($usuacodi, $idcon);
	
	if($rs_usuario['usuasolser'] == 1)
	{
		$recarreglo["usuacodi"] = $usuacodi;
		$accionconsultarsoliserv = 1;
	}
	//===Validacion de usuario========
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('vistasoliserv',$inicio,$fin,$mov,$accionconsultarsoliserv,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
	
?>
<html>
	<head>
	    <title>Registros de solicitud de servicio</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	    <meta http-equiv="expires" content="0">
	    <script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
	    <script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
	    <script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				/**
				 * Boton Editar
				 */
				$('#editar1').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
					if(document.form1.selstar.value == 1)
					{
						document.form1.action = 'editar' + document.form1.sourcetable.value + '.php';
						document.form1.submit();
					}
					else
					{
						document.getElementById('msg').innerHTML = 'Debe seleccionar un registro.'
						$('#msgwindow').dialog('open');
					}
					
					return false;
				});

				$('#msgwindowsolser').dialog({
						autoOpen: false,
						width: 350,
						modal: true,
						buttons: {
						"Ok": function() { 
							window.location.reload();
							$(this).dialog("close"); 
						}
					}
				});
				
				//Msgbox Caja de Formulario Soliserv
				$('#windowmsgform').dialog({
					autoOpen: false,
					width: 650,
					modal: true,
					buttons: {
						"Cancelar": function() { 
							$(this).dialog("close"); 
						},
						"Aceptar": function() { 
							if(document.getElementById('tipcumcodigo').value == '')
								alert('Error: Debe seleccionar el tipo de cumplimiento');
							else
							{
								accionLoadGrabaSolser(document.getElementById('usuariocodi').value ,document.getElementById('ordtracodigo').value, document.getElementById('tipcumcodigo').value, document.getElementById('cierotdescri').value);
								$(this).dialog("close"); 
							}
						}
					}
				});
			});

			function accionLoadFormSolser(ordtracodigo)
			{
				$.ajax({	   
			    	dataType: "html",
			    	type: "POST",        
			    	url: "../src/FunjQuery/jquery.phpscripts/jquery.ajax_formsolser.php", 	
		        		data: "ordtracodigo=" + ordtracodigo,
		         		beforeSend: function(data){ },        
		         		success: function(requestData){
		         			document.getElementById('formulario').innerHTML = requestData;
		         			$('#windowmsgform').dialog('open');
		         		},         
		         		error: function(requestData, strError, strTipoError){ },
		         		complete: function(requestData, exito){ }                                      
		     	});
			}

			function accionLoadGrabaSolser(usuacodi, ordtracodigo, cumpli, descri)
			{
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.phpscripts/jquery.grabareportecierre.php", 	
					data: "ordtracodigo=" + ordtracodigo + "&cumpli=" + cumpli + "&usuacodi=" + usuacodi + "&descri=" + descri,
					beforeSend: function(data){ },        
					success: function(requestData){
						if(requestData == 'err')
						{
							document.getElementById('msgsolser').innerHTML = '<font color="red">Error:</font><br>*Se presento un error al registrar la calificaci&oacute;n.';
							$('#msgwindowsolser').dialog('open');
						}
						else
						{
							document.getElementById('msgsolser').innerHTML = 'Calificaci&oacute;n registrada satisfactoriamente.';
							$('#msgwindowsolser').dialog('open');
						}
					},         
					error: function(requestData, strError, strTipoError){},
					complete: function(requestData, exito){ }                                      
				});
			}
		</script>
  	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Listado de solicitudes de servicio</font><br><br></p>
      		<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="99%"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablsoliserv.php',$flagcheck); ?></td></tr>
  				<tr><td>&nbsp;</td></tr> 
  				<tr><td align="left"><div class="ui-buttonset">
				<?php
					if($reccomact[nuevo] && !$flagcheck)
				  		echo '<button id="nuevo">Nuevo</button>&nbsp;&nbsp;';
				  	
				  	if($reccomact[consultar] && !$flagcheck)
				  		echo '<button id="consultar">Consulta</button>&nbsp;&nbsp;';
				  	
					if($reccomact[detallar] && !$flagcheck)
				   		echo '<button id="detallar">Ver detalle</button>&nbsp;&nbsp;';
					
				   	if($reccomact[borrar] && !$flagcheck)
				   		echo '<button id="borrar">Borrar</button>&nbsp;&nbsp;';
				   	
				   	if($reccomact[borrar] && $flagcheck)
				   		echo '<button id="borrarselect">Borrar selecci&oacute;n</button>&nbsp;&nbsp;';
				   	
				   	if($reccomact[modificar] && !$flagcheck)
				   		echo '<button id="editar1">Gestionar</button>&nbsp;&nbsp;';
				   		
				   	if($reccomact[imprimir] && !$flagcheck)
				   		echo '<button id="imprimir">Imprimir</button>&nbsp;&nbsp;';
				?>
				</div></td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td><?php include ('../def/jquery.button_navup.php') ?></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
 				<tr> 
  					<td colspan="2"> 
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1" class="ui-widget-content"> 
							<tr> 
								<td class="ui-state-default tbl-head-font">Sel.</td>
								<td width="5%" class="ui-state-default tbl-head-font">C&oacute;digo</td>
								<td width="10%" class="ui-state-default tbl-head-font">Solicitante</td>
								<td width="10%" class="ui-state-default tbl-head-font">Ubicaci&oacute;n</td>
								<td width="10%" class="ui-state-default tbl-head-font">Sistema</td> 
								<td width="15%" class="ui-state-default tbl-head-font">Equipo</td>
								<td width="10%" class="ui-state-default tbl-head-font">Tipo de falla</td> 
								<td width="5%" class="ui-state-default tbl-head-font">Fecha</td> 
								<td width="5%" class="ui-state-default tbl-head-font">Calificar</td>
								<td width="5%" class="ui-state-default tbl-head-font">No. OT</td>
								<td width="5%" class="ui-state-default tbl-head-font">Prioridad</td>
								<td width="5%" class="ui-state-default tbl-head-font">Estado</td>
								<td width="10%" class="ui-state-default tbl-head-font">Encargado</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregsoliserv.php');
								$reg[0] = 'solsercodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregsoliserv('vistasoliserv', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablsoliserv.php',$flagcheck); ?></td></tr> 				
 			</table>
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>">
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="nombtabl" value="soliserv">
   			<input type="hidden" name="sourcetable" value="soliserv"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
			<input type="hidden" name="columnas" value="solsercodigo,usuacodigo,plantacodigo,sistemcodigo,equipocodigo,tipfalcodigo,estsolcodigo,solsermotivo,solserfecha,tiptracodigo,">
 			<input type="hidden" name="solsercodigo" value="<?php if($accionconsultarsoliserv) echo $solsercodigo; ?>">
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarsoliserv) echo $usuacodigo; ?>">
  			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarsoliserv) echo $equipocodigo; ?>">
  			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarsoliserv) echo $plantacodigo; ?>">
  			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarsoliserv) echo $sistemcodigo; ?>">
  			<input type="hidden" name="tipfalcodigo" value="<?php if($accionconsultarsoliserv) echo $tipfalcodigo; ?>">
 			<input type="hidden" name="estsolcodigo" value="<?php if($accionconsultarsoliserv) echo $estsolcodigo; ?>">
 			<input type="hidden" name="solsermotivo" value="<?php if($accionconsultarsoliserv) echo $solsermotivo; ?>">
 			<input type="hidden" name="solserfecha" value="<?php if($accionconsultarsoliserv) echo $solserfecha; ?>">
 			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultarsoliserv) echo $tiptracodigo; ?>">
 			<input type="hidden" name="accionconsultarsoliserv" value="<?php echo $accionconsultarsoliserv; ?>">
 			<input type="hidden" name="mov">
 			<!-- Permite el cambio de checkbox/radiobuttion -->
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="solsercodigo, solsermotivo">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="usuariocodi" id="usuariocodi" value="<?php echo $usuacodi;?>">
			<input type="hidden" name="arreglo_b">
			<!--											-->
 		</form>
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 		<div id="msgwindowsolser" title="Adsum Kallpa"><span id="msgsolser"></span></div>
 		<div id="windowmsgform" title="Adsum Kallpa [Calificar]"><span id="formulario"></span></div>
 	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>