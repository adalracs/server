<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscanusuario.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/pktblvistausuariogrup.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltipousuario.php'); 
	include ( '../src/FunPerPriNiv/pktblgrupo.php');
	include ( '../src/FunGen/fncusuagrup.php');
	include ( '../src/FunPerPriNiv/pktblupdateusuagrup.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	
	$reccomact =  fnccaf($_COOKIE[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionborrarusuario)
		include ( 'borrausuario.php');	
	else
	{
		if($accionconsultarusuario)
		{
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				
				if($nombcamp == 'usuacodi')
					$recarreglo[$nombcamp] = $usuacodigo;
				else
					$recarreglo[$nombcamp] = $$nombcamp;
					
				if($recarreglo[$nombcamp] != null)
					$nusw = 1;
				$nombcamp = strtok(",");
			}
			if(!$nusw)
				$accionconsultarusuario = 0;
		}
	}

	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('vistausuariogrup',$inicio,$fin,$mov, $accionconsultarusuario,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
?>
<html>
	<head> 
		<title>Registros de Usuarios</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
<!--		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>-->
<!--		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>-->
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de empleados</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="800"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablusuario.php',$flagcheck); ?></td></tr>
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
								<td width="8%" class="ui-state-default">Registro</td>
								<td width="9%" class="ui-state-default">Login</td> 
								<td width="30%" class="ui-state-default">Nombre</td> 
								<td width="25%" class="ui-state-default">Grupo</td>
								<td width="24%" class="ui-state-default">Tipo Usuario</td> 
							</tr> 
          					<?php
								include ( '../src/FunGen/sesion/fncvisregusuario.php');
								$reg[0] = 'usuacodi';
								$reg1[0] = 'n';
								$nureturn = fncvisregusuario('vistausuariogrup',$reg,$reg1,$idtrans);
							?>							
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablusuario.php',$flagcheck); ?></td></tr> 				
 			</table> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>">
			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
			<input type="hidden" name="nombtabl" value="vistausuariogrup">
			<input type="hidden" name="sourcetable" value="usuario"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">
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
			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarusuario) echo $usuacodigo; ?>">
			<input type="hidden" name="cargocodigo" value="<?php if($accionconsultarusuario) echo $cargocodigo; ?>">
			<input type="hidden" name="departcodigo" value="<?php if($accionconsultarusuario) echo $departcodigo; ?>">
			<input type="hidden" name="tipusucodigo" value="<?php if($accionconsultarusuario) echo $tipusucodigo; ?>">
			<input type="hidden" name="usuanomb" value="<?php if($accionconsultarusuario) echo $usuanomb; ?>">
			<input type="hidden" name="usuapass" value="<?php if($accionconsultarusuario) echo $usuapass; ?>">
			<input type="hidden" name="usuaacti" value="<?php if($accionconsultarusuario) echo $usuaacti; ?>">
			<input type="hidden" name="usuadocume" value="<?php if($accionconsultarusuario) echo $usuadocume; ?>">
			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarusuario) echo $usuanombre; ?>">
			<input type="hidden" name="usuapriape" value="<?php if($accionconsultarusuario) echo $usuapriape; ?>">
			<input type="hidden" name="usuasegape" value="<?php if($accionconsultarusuario) echo $usuasegape; ?>">
			<input type="hidden" name="usuatelefo" value="<?php if($accionconsultarusuario) echo $usuatelefo; ?>">
			<input type="hidden" name="usuatelef2" value="<?php if($accionconsultarusuario) echo $usuatelef2; ?>">
			<input type="hidden" name="usuacontac" value="<?php if($accionconsultarusuario) echo $usuacontac; ?>">
			<input type="hidden" name="usuatelcon" value="<?php if($accionconsultarusuario) echo $usuatelcon; ?>">
			<input type="hidden" name="usuadirecc" value="<?php if($accionconsultarusuario) echo $usuadirecc; ?>">
			<input type="hidden" name="usuaemail" value="<?php if($accionconsultarusuario) echo $usuaemail; ?>">
			<input type="hidden" name="usuavalhor" value="<?php if($accionconsultarusuario) echo $usuavalhor; ?>">
			<input type="hidden" name="usuaactiot" value="<?php if($accionconsultarusuario) echo $usuaactiot; ?>">
			<input type="hidden" name="grupcodi" value="<?php if($accionconsultarusuario) echo $grupcodi; ?>">
			<input type="hidden" name="accionconsultarusuario" value="<?php echo $accionconsultarusuario; ?>">
			<input type="hidden" name="mov">
			<input type="hidden" name="flagcheck" value="<?php  echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="arr_borrar" value="<?php  echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>