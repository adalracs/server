<?php 
ob_start();
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblvistainventecnico.php');
//	include ( '../src/FunPerPriNiv/pktblinventecnico.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

	if($accionborrarinventecnico)
		include ( 'borrainventecnico.php');
	else
	{
		if($accionconsultarinventecnico)
		{
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			
			while ($nombcamp)
			{
				
				$nombcamp = trim($nombcamp);
				if($nombcamp == "usuacodigo")
					$recarreglo['usuacodi'] = $usuacodigo;
				else 
					$recarreglo[$nombcamp] = $$nombcamp;
				
				if($recarreglo[$nombcamp]) 
					$nusw =1;
				$nombcamp = strtok(",");
			}
			
			if(!$nusw)
				$accionconsultarinventecnico = 0;
		}
	}
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('vistainventecnico',$inicio,$fin,$mov,$accionconsultarinventecnico,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
ob_end_flush();
?>
<html> 
	<head> 
		<title>Registros de Inventario Tecnico</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
		<style type="text/css">
			.fontlis {font-size:98%; }
		</style>
		
	</head>
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de usuario / Inventario T&eacute;cnico</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="950"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablinventecnico.php',$flagcheck); ?></td></tr>
  				<tr><td>&nbsp;</td></tr> 
  				<tr><td align="left" class="NoiseErrorDataTD"><?php include ('../def/jquery.maestablbuttonstranc.php') ?></td></tr>
 				<tr><td>&nbsp;</td></tr>
 				<tr><td><?php include ('../def/jquery.button_navup.php') ?></td></tr>
 				<tr><td></td></tr>
		    	<tr><td></td></tr>
 				<tr> 
  					<td> 
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1" class="ui-widget-content"> 
							<tr> 
								<td width="4%" class="ui-state-default">Sel.</td> 
								<td width="8%" class="ui-state-default">Registro</td> 
								<td width="8%" class="ui-state-default">C&eacute;dula</td> 
								<td width="30%" class="ui-state-default">Nombre</td> 
								<td width="25%" class="ui-state-default">Cargo</td> 
								<td width="25%" class="ui-state-default">Departamento</td> 
							</tr> 
							<?php 
								include ( '../src/FunGen/sesion/fncvisreginventecnico.php');
								$reg[0] = 'usuacodi';
								$reg1[0] = 'n';
								$nureturn = fncvisreg('vistainventecnico', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablinventecnico.php',$flagcheck); ?></td></tr> 				
 			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
  			<input type="hidden" name="sourcetable" value="inventecnico"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">  
 			<input type="hidden" name="nombtabl" value="vistainventecnico"> 
			<input type="hidden" name="columnas" value="usuacodigo,
cargocodigo,
departcodigo,
usuadocume,
usuanombre,
usuapriape,
usuasegape"> 
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarinventecnico) echo $usuacodigo; ?>"> 
 			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarinventecnico) echo $usuanombre; ?>"> 
 			<input type="hidden" name="usuapriape" value="<?php if($accionconsultarinventecnico) echo $usuapriape; ?>"> 
 			<input type="hidden" name="usuasegape" value="<?php if($accionconsultarinventecnico) echo $usuasegape; ?>"> 
 			<input type="hidden" name="usuadocume" value="<?php if($accionconsultarinventecnico) echo $usuadocume; ?>"> 
 			<input type="hidden" name="cargocodigo" value="<?php if($accionconsultarinventecnico) echo $cargocodigo; ?>"> 
 			<input type="hidden" name="departcodigo" value="<?php if($accionconsultarinventecnico) echo $departcodigo; ?>">
 			<input type="hidden" name="negocicodigo" value="<?php echo $negocicodigo; ?>">
 			<input type="hidden" name="accionconsultarinventecnico" value="<?php echo $accionconsultarinventecnico; ?>"> 
 			<input type="hidden" name="mov"> 
  			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="usuacodi">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											-->
 		</form> 
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>