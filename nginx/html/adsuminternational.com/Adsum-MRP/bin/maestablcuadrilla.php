<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fnccantrow.php'); 
	include ( '../src/FunGen/sesion/fnccantrow1.php'); 
	include ( '../src/FunPerPriNiv/limitscan.php'); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunGen/sesion/fncalmdat.php'); 
	include ( '../src/FunGen/sesion/fnccaf.php'); 

	include ( '../src/FunPerPriNiv/pktblcuadrilla.php');
	include ( '../src/FunPerPriNiv/pktblvistacuadrilla.php');
	include ( '../src/FunPerPriNiv/pktbldepartamento.php'); 
	include ( '../src/FunPerPriNiv/pktblareafuncio.php'); 
	include ( '../src/FunPerPriNiv/pktbldepartam.php'); 
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunPerPriNiv/pktblzona.php'); 
	include ( '../src/FunPerPriNiv/pktblsubzona.php'); 
	include ( '../src/FunPerPriNiv/pktblservicio.php'); 
	
	$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 
	
	if($accionborrarcuadrilla)
		include ( 'borracuadrilla.php'); 
	else
	{
		if($accionconsultarcuadrilla)
		{
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				$recarreglo[$nombcamp] = $$nombcamp;
				if($recarreglo[$nombcamp])
					$nusw =1;
				$nombcamp = strtok(",");
			}
			
			if(!$nusw)
				$accionconsultarcuadrilla = 0;
		}
	}
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec ('vistacuadrilla',$inicio,$fin,$mov,$accionconsultarcuadrilla,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }

	$arrMes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$reccomact[imprimir] = 1;
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Registros de cuadrillas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		<style type="text/css">
			.reg-style {font-size: 95%; }
		</style>
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				//Boton Impresion
				/**
				 * Boton Anexar Tecnico
				 */
				$('#imprimir').button({ icons: { primary: "ui-icon-print" } }).click(function() {
					$("#msgcuadripreprint").dialog("open");
					return false;
				});

				$("#msgcuadripreprint").dialog({
					autoOpen: false,
					width: 550,
					height: 200,
					modal: true,
					buttons: {
						"Cancelar": function() {
							$(this).dialog("close"); 
						},
						"Aceptar": function() {
							window.open('detallarcuadriturnos.php?ID=<?php echo $codigo.'e'.$negocicodigo.'e' ?>' + document.getElementById('departcodigo').value + 'e' + document.getElementById('arefuncodigo').value + '&d=' + document.getElementById('mes').value + '-' + document.getElementById('anio').value,'','fullscreen=0,toolbar=1,location=0,status=1,menubar=1,scrollbars=1,resizable=0,width=800,height=650');
							$(this).dialog("close"); 
						}
					}
				});
			}); 
		</script>
		
	</head>
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de cuadrillas</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="750"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablcuadrilla.php',$flagcheck); ?></td></tr>
  				<tr><td>&nbsp;</td></tr> 
  				<tr><td align="left" class="NoiseErrorDataTD"><?php include ('../def/jquery.maestablbuttons.php') ?></td></tr>
 				<tr><td>&nbsp;</td></tr>
 				<tr><td><?php include ('../def/jquery.button_navup.php') ?></td></tr>
 				<tr><td></td></tr>
		    	<tr><td></td></tr>
 				<tr> 
  					<td> 
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1" class="ui-widget-content"> 
							<tr> 
								<td width="4%" class="ui-state-default">Sel.</td> 
								<td width="7%" class="ui-state-default">C&oacute;digo</td> 
								<td width="20%" class="ui-state-default">Cuadrilla</td> 
								<td width="20%" class="ui-state-default">Servicio</td> 
								<td width="29%" class="ui-state-default">Departamento</td> 
								<td width="20%" class="ui-state-default">&Aacute;rea funcional</td> 
							</tr> 
							<?php 
								include ( '../src/FunGen/sesion/fncvisregcuadrilla.php');
								$reg[0] = 'cuadricodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisreg('vistacuadrilla', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablcuadrilla.php',$flagcheck); ?></td></tr> 				
 			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
  			<input type="hidden" name="sourcetable" value="cuadrilla"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">  
 			<input type="hidden" name="nombtabl" value="cuadrilla"> 
			<input type="hidden" name="columnas" value="cuadricodigo,cuadrinombre,servicicodigo,cuadriacti,departcodigo,arefuncodigo"> 
 			<input type="hidden" name="cuadricodigo" value="<?php if($accionconsultarcuadrilla) echo $cuadricodigo; ?>"> 
 			<input type="hidden" name="cuadrinombre" value="<?php if($accionconsultarcuadrilla) echo $cuadrinombre; ?>"> 
 			<input type="hidden" name="servicicodigo" value="<?php if($accionconsultarcuadrilla) echo $servicicodigo; ?>"> 
 			<input type="hidden" name="departcodigo" value="<?php if($accionconsultarcuadrilla) echo $departcodigo; ?>"> 
 			<input type="hidden" name="arefuncodigo" value="<?php if($accionconsultarcuadrilla) echo $arefuncodigo; ?>"> 
 			<input type="hidden" name="cuadriacti" value="<?php if($accionconsultarcuadrilla) echo $cuadriacti; ?>"> 
 			<input type="hidden" name="accionconsultarcuadrilla" value="<?php echo $accionconsultarcuadrilla; ?>"> 
 			<input type="hidden" name="mov"> 
  			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="cuadricodigo, cuadrinombre">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											-->
 		</form>
 		<div id="msgcuadripreprint" title="Adsum Kallpa">
   			<div>
   				<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
					<tr> 
 						<td class="NoiseFooterTD">&nbsp;Departamento</td> 
  						<td class="NoiseDataTD"><select name="departcodigo" id="departcodigo" onChange="accionCmbxAreaFuncio(this.value,'','1');">
     						<option value = "">-- Seleccione --</option>
     						<?php
     							$idcon = fncconn();
								include ('../src/FunGen/floaddepartam.php');
								floaddepartamnegocio($departcodigo,$negocicodigo, $idcon);
							?>
    					</select></td> 
 					</tr>
 					<tr>
     					<td class="NoiseFooterTD">&nbsp;&Aacute;rea funcional</td>
     					<td class="NoiseDataTD"><span id="cmbxareafuncio"><select name="arefuncodigo" id="arefuncodigo">
     						<option value = "">-- Todos --</option>
     						<?php
								include ('../src/FunGen/floadareafuncio.php');
								floadareafunciodep($idcon, $departcodigo, $arefuncodigo);
							?>
    					</select></span></td>
					</tr>   
 					<tr>
     					<td class="NoiseFooterTD">&nbsp;Fecha</td>
     					<td class="NoiseDataTD">
     						<select name="mes" id="mes">
	     						<?php for($a = 0; $a < count($arrMes); $a++): ?>
								<option value = "<?php echo ($a + 1) ?>"><?php echo $arrMes[$a] ?></option>			
	     						<?php endfor;?>	
	    					</select>
     						<select name="anio" id="anio">
	     						<?php for($a = 2011; $a <= date('Y'); $a++): ?>
								<option value = "<?php echo $a ?>"><?php echo $a ?></option>			
	     						<?php endfor;?>	
	    					</select>
    					</td>
					</tr>   
				</table> 
   			</div>
   		</div>
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>