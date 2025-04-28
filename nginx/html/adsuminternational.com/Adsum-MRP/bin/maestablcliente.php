<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscanusuario.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/pktblvistaclientegrup.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltipousuario.php');
	include ( '../src/FunPerPriNiv/pktblgrupo.php');
	include ( '../src/FunGen/fncusuagrup.php');
	include ( '../src/FunPerPriNiv/pktblupdateusuagrup.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

	if($accionborrarcliente)
		include ( 'borracliente.php');	
	else
	{
		if($accionconsultarcliente)
		{
			$nusw = 0;//SWITCH
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
			if(!$nusw)
				$accionconsultarcliente = 0;
		}
	}
	
//	var_dump($recarreglo);
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('vistaclientegrup',$inicio,$fin,$mov, $accionconsultarcliente,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
?>
<!-- Diseï¿½o creado por:
Andrï¿½s Riascos
Fecha: 05032002 -->
<html>
	<head>
		<title>Registros de Clientes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.funtionsusers.js"></script>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="#FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data">
  			<p><font class="NoiseFormHeaderFont">Listado de Clientes</font><br><br></p>
  			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="750"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablcliente.php',$flagcheck); ?></td></tr>
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
<!--					            <td width="6%" class="ui-state-default">C&oacute;digo</td>-->
					            <td width="12%" class="ui-state-default">NIT</td>
					            <td width="36%" class="ui-state-default">Nombre</td>
					            <td width="34%" class="ui-state-default">Contacto</td>
					            <td width="14%" class="ui-state-default">Telefono</td>
							</tr> 
							<?php 
								include ( '../src/FunGen/sesion/fncvisregcliente.php');
								$reg[0] = 'usuacodi';
								$reg1[0] = 'n';
								$nureturn = fncvisregusuario('vistaclientegrup',$reg,$reg1,$idtrans);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablcliente.php',$flagcheck); ?></td></tr> 				
 			</table> 
			<input type="hidden" name="codigo" value="<?php echo $codigo ?>">
			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>">
			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="cliente"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">  
			<input type="hidden" name="nombtabl" value="vistaclientegrup">
			<input type="hidden" name="columnas" value="usuacodi,
cargocodigo,
departcodigo,
tipusucodigo,
usuanomb,
usuapass,
usuaacti,
usuadocume,
usuanombre,
usuapriape,
usuasegape,
usuatelefo,
usuatelef2,
usuacontac,
usuatelcon,
usuadirecc,
usuaemail,
usuavalhor,
usuaactiot,
grupcodi">
			<input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo; ?>">
			<input type="hidden" name="cargocodigo" value="<?php echo $cargocodigo; ?>">
			<input type="hidden" name="departcodigo" value="<?php echo $departcodigo; ?>">
			<input type="hidden" name="tipusucodigo" value="<?php echo $tipusucodigo; ?>">
			<input type="hidden" name="usuanomb" value="<?php echo $usuanomb; ?>">
			<input type="hidden" name="usuapass" value="<?php echo $usuapass; ?>">
			<input type="hidden" name="usuaacti" value="<?php echo $usuaacti; ?>">
			<input type="hidden" name="usuadocume" value="<?php echo $usuadocume; ?>">
			<input type="hidden" name="usuanombre" value="<?php echo $usuanombre; ?>">
			<input type="hidden" name="usuapriape" value="<?php echo $usuapriape; ?>">
			<input type="hidden" name="usuasegape" value="<?php echo $usuasegape; ?>">
			<input type="hidden" name="usuatelefo" value="<?php echo $usuatelefo; ?>">
			<input type="hidden" name="usuatelef2" value="<?php echo $usuatelef2; ?>">
			<input type="hidden" name="usuacontac" value="<?php echo $usuacontac; ?>">
			<input type="hidden" name="usuatelcon" value="<?php echo $usuatelcon; ?>">
			<input type="hidden" name="usuadirecc" value="<?php echo $usuadirecc; ?>">
			<input type="hidden" name="usuaemail" value="<?php echo $usuaemail; ?>">
			<input type="hidden" name="usuavalhor" value="<?php echo $usuavalhor; ?>">
			<input type="hidden" name="usuaactiot" value="<?php echo $usuaactiot; ?>">
			<input type="hidden" name="grupcodi" value="<?php echo $grupcodi; ?>">
			<input type="hidden" name="accionconsultarcliente" value="<?php echo $accionconsultarcliente; ?>">
			<input type="hidden" name="mov">
  			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<input type="hidden" name="soliserv" value="<?php echo $soliserv;?>">
			<input type="hidden" name="seltack">			
			<input type="hidden" name="usuarionombre" id="usuarionombre">			
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>	
		<div id="windowpassword" title="Adsum Kallpa [Cambiar contraseña]">	
			<span id="formulario"></span>
		</div>	
	</body>
<?php if(!$codigo) { echo " -->"; } ?>
</html>
