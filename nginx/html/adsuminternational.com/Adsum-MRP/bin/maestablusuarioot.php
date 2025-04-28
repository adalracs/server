<?php 
ob_start(); 
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscangeneral.php');
	include ( '../src/FunPerPriNiv/pktblvistacuadrillausuario.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');	
	
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 

	if($accionconsultarusuarioot)
	{
		$nusw = 0;
		$nombcamp = strtok ($columnas,",");
		while ($nombcamp)
		{
			$nombcamp = trim($nombcamp);
			if($nombcamp == "usuacodi")
				$recarreglo[$nombcamp] = $usuacodigo;
			else 
				$recarreglo[$nombcamp] = $$nombcamp;
				
			if($recarreglo[$nombcamp] != null)
			 $nusw =1;
			$nombcamp = strtok(",");
		}
//		if(!$nusw)
//			$accionconsultarusuarioot = 0;
	}
	
	if(!$accionconsultarusuarioot)
		 $none = 1;
		 	
	$accionconsultarusuarioot = 1;
	$recarreglo['negocicodigo'] = $negocicodigo;
	
	
	include ( '../src/FunGen/sesion/fncaumdec.php'); 
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('vistacuadrillausuario',$inicio,$fin,$mov,$accionconsultarusuarioot,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
 
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Registros de Empleados</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
<!--		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>-->
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de empleados</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="750"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablusuarioot.php',$flagcheck); ?></td></tr>
  				<tr><td>&nbsp;</td></tr> 
  				<tr><td align="left" class="NoiseErrorDataTD"><div class="ui-buttonset">
					<button id="consultar">Consulta</button>
				</div></td></tr>
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
								<td width="9%" class="ui-state-default">Cedula</td> 
								<td width="30%" class="ui-state-default">Nombre</td> 
								<td width="25%" class="ui-state-default">Departamento</td>
								<td width="24%" class="ui-state-default">Cargo</td> 
							</tr> 
							<?php 
								include ( '../src/FunGen/sesion/fncvisregusuariequipo.php'); 
								$reg[0] = 'usuacodi'; 
								$reg1[0] = 'n'; 
								$nureturn = fncvisregusuarigen('vistacuadrillausuario', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablusuarioot.php',$flagcheck); ?></td></tr> 				
 			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
  			<input type="hidden" name="sourcetable" value="usuarioot"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">  
 			<input type="hidden" name="nombtabl" value="vistacuadrillausuario"> 
			<input type="hidden" name="columnas" value="usuacodi,
cargocodigo,
departcodigo,
tipusucodigo,
usuaacti,
usuadocume,
usuanombre,
usuapriape,
usuasegape,
usuatelefo,
usuatelef2,
usuadirecc,
usuaemail,
usuaactiot,
ciudadcodigo"> 
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarusuarioot && !$none) echo $usuacodigo; ?>"> 
 			<input type="hidden" name="cargocodigo" value="<?php if($accionconsultarusuarioot && !$none) echo $cargocodigo; ?>"> 
 			<input type="hidden" name="departcodigo" value="<?php if($accionconsultarusuarioot && !$none) echo $departcodigo; ?>"> 
 			<input type="hidden" name="tipusucodigo" value="<?php if($accionconsultarusuarioot && !$none) echo $tipusucodigo; ?>"> 
 			<input type="hidden" name="usuaacti" value="<?php if($accionconsultarusuarioot && !$none) echo $usuaacti; ?>"> 
 			<input type="hidden" name="usuadocume" value="<?php if($accionconsultarusuarioot && !$none) echo $usuadocume; ?>"> 
 			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarusuarioot && !$none) echo $usuanombre; ?>"> 
 			<input type="hidden" name="usuapriape" value="<?php if($accionconsultarusuarioot && !$none) echo $usuapriape; ?>"> 
 			<input type="hidden" name="usuasegape" value="<?php if($accionconsultarusuarioot && !$none) echo $usuasegape; ?>"> 
 			<input type="hidden" name="usuatelefo" value="<?php if($accionconsultarusuarioot && !$none) echo $usuatelefo; ?>"> 
 			<input type="hidden" name="usuatelef2" value="<?php if($accionconsultarusuarioot && !$none) echo $usuatelef2; ?>"> 
 			<input type="hidden" name="usuadirecc" value="<?php if($accionconsultarusuarioot && !$none) echo $usuadirecc; ?>"> 
 			<input type="hidden" name="usuaemail" value="<?php if($accionconsultarusuarioot && !$none) echo $usuaemail; ?>"> 
 			<input type="hidden" name="usuaactiot" value="<?php if($accionconsultarusuarioot && !$none) echo $usuaactiot; ?>"> 
 			<input type="hidden" name="ciudadcodigo" value="<?php if($accionconsultarusuarioot && !$none) echo $ciudadcodigo; ?>"> 
 			<input type="hidden" name="negocicodigo" value="<?php echo $negocicodigo; ?>"> 
 			<input type="hidden" name="accionconsultarusuarioot" value="<?php echo $accionconsultarusuarioot; ?>"> 
 			<input type="hidden" name="mov"> 
 			
  			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="selcampos" value="usuacodi, usuanombre, usuapriape, usuasegape">
			<input type="hidden" name="arreglo_b">
			<!--											-->
 		</form> 
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>