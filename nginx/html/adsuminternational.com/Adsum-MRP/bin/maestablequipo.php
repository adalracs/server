<?php
ob_start();
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscanequipo.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblvistaequipoplanta.php');
	include ( '../src/FunPerPriNiv/pktblvistanegoservplanta.php');
	include ( '../src/FunPerPriNiv/pktblusuaequipo.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblestado.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	// -- campos personalizados
	session_unregister('equicampos');
	// --
	$reccomact = fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionborrarequipo)
		include ( 'borraequipo.php');
	else
	{
		if($accionconsultarequipo)
		{
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				if($nombcamp == 'usuacodigo')
				{
					$nusw = 1;
					$recarreglo['equipoencarg'] = $$nombcamp;
				}
				else
					$recarreglo[$nombcamp] = $$nombcamp;
					
				if($recarreglo[$nombcamp] != null)
					$nusw = 1;
				$nombcamp = strtok(",");
			}
			
			if(!$nusw)
				$accionconsultarequipo = 0;
		}
	}
		
		/*if(!$plantacodigo)
			$recarreglo[plantacodigo] =  $GLOBALS[usuaplanta];*/
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('vistaequipoplanta',$inicio,$fin,$mov,$accionconsultarequipo,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush();
?>
<html> 
	<head> 
		<title>Registros de equipo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
	
		<style type="text/css">
			.Estilo1 {color: #FFFFFF}
		</style>
	</head>
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de equipos</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="95%"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablequipo.php',$flagcheck); ?></td></tr>
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
								<td width="5%" class="ui-state-default"><a href="#" onClick="setForm('<?php echo $inicio;?>','<?php echo $fin;?>','<?php echo $mov;?>');" style="text-decoration:none; ">Sel.<input type="<?php if($flagcheck) echo "radio"; else echo "checkbox"; ?>"></a></font></span></td> 
								<td width="13%" class="ui-state-default">C&oacute;digo</td> 
								<td width="30%" class="ui-state-default">Nombre</td> 
								<td width="10%" class="ui-state-default">Estado</td> 
								<td width="12%" class="ui-state-default">Marca</td> 
								<td width="12%" class="ui-state-default">Modelo</td> 
								<td width="6%" class="ui-state-default">Vida &uacute;til</td> 
								<td width="12%" class="ui-state-default">Proceso</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregequipo.php');
								$reg[0] = 'equipocodigo';
								$reg1[0] = 's';
								$nureturn = fncvisregequipo('vistaequipoplanta', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablequipo.php',$flagcheck); ?></td></tr> 				
 			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 			<input type="hidden" name="nombtabl" value="equipo"> 
  			<input type="hidden" name="sourcetable" value="equipo"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">  
			<input type="hidden" name="columnas" value="equipocodigo,
estadocodigo,
sistemcodigo,
cencoscodigo,
equiponombre,
equipodescri,
equipofabric,
equipomarca,
equipomodelo,
equiposerie,
equipolargo,
equipoancho,
equipoalto,
equipopeso,
equipovolta,
equipocorrie,
equipopoten,
equipofeccom,
equipocinv,
equipovengar,
equipoviduti,
equipofecins,
equipoubicac,
equipovalhor,
equiponohs,
equipoacti,
equipotipo,
codigosrf,
equiponpas,
tipequcodigo,
usuacodigo"> 
			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarequipo) echo $equipocodigo; ?>"> 
			<input type="hidden" name="estadocodigo" value="<?php if($accionconsultarequipo) echo $estadocodigo; ?>"> 
			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarequipo) echo $sistemcodigo; ?>"> 
			<input type="hidden" name="cencoscodigo" value="<?php if($accionconsultarequipo) echo $cencoscodigo; ?>"> 
			<input type="hidden" name="equiponombre" value="<?php if($accionconsultarequipo) echo $equiponombre; ?>"> 
			<input type="hidden" name="equipodescri" value="<?php if($accionconsultarequipo) echo $equipodescri; ?>"> 
			<input type="hidden" name="equipofabric" value="<?php if($accionconsultarequipo) echo $equipofabric; ?>"> 
			<input type="hidden" name="equipomarca" value="<?php if($accionconsultarequipo) echo $equipomarca; ?>"> 
			<input type="hidden" name="equipomodelo" value="<?php if($accionconsultarequipo) echo $equipomodelo; ?>"> 
			<input type="hidden" name="equiposerie" value="<?php if($accionconsultarequipo) echo $equiposerie; ?>"> 
			<input type="hidden" name="equipolargo" value="<?php if($accionconsultarequipo) echo $equipolargo; ?>"> 
			<input type="hidden" name="equipoancho" value="<?php if($accionconsultarequipo) echo $equipoancho; ?>"> 
			<input type="hidden" name="equipoalto" value="<?php if($accionconsultarequipo) echo $equipoalto; ?>"> 
			<input type="hidden" name="equipopeso" value="<?php if($accionconsultarequipo) echo $equipopeso; ?>"> 
			<input type="hidden" name="equipovolta" value="<?php if($accionconsultarequipo) echo $equipovolta; ?>"> 
			<input type="hidden" name="equipocorrie" value="<?php if($accionconsultarequipo) echo $equipocorrie; ?>"> 
			<input type="hidden" name="equipopoten" value="<?php if($accionconsultarequipo) echo $equipopoten; ?>"> 
			<input type="hidden" name="equipofeccom" value="<?php if($accionconsultarequipo) echo $equipofeccom; ?>"> 
			<input type="hidden" name="equipocinv" value="<?php if($accionconsultarequipo) echo $equipocinv; ?>"> 
			<input type="hidden" name="equipovengar" value="<?php if($accionconsultarequipo) echo $equipovengar; ?>"> 
			<input type="hidden" name="equipoviduti" value="<?php if($accionconsultarequipo) echo $equipoviduti; ?>"> 
			<input type="hidden" name="equipofecins" value="<?php if($accionconsultarequipo) echo $equipofecins; ?>"> 
			<input type="hidden" name="equipoubicac" value="<?php if($accionconsultarequipo) echo $equipoubicac; ?>"> 
			<input type="hidden" name="equipovalhor" value="<?php if($accionconsultarequipo) echo $equipovalhor; ?>"> 
			<input type="hidden" name="equiponohs" value="<?php if($accionconsultarequipo) echo $equiponohs; ?>"> 
			<input type="hidden" name="equipoacti" value="<?php if($accionconsultarequipo) echo $equipoacti; ?>"> 
			<input type="hidden" name="equipotipo" value="<?php if($accionconsultarequipo) echo $equipotipo; ?>"> 
			<input type="hidden" name="equiponpas" value="<?php if($accionconsultarequipo) echo $equiponpas; ?>"> 
			<input type="hidden" name="codigosrf" value="<?php if($accionconsultarequipo) echo $codigosrf; ?>"> 
			<input type="hidden" name="tipequcodigo" value="<?php if($accionconsultarequipo) echo $tipequcodigo; ?>"> 
			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarequipo) echo $usuacodigo; ?>"> 
			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarequipo) echo $usuanombre; ?>"> 
			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarequipo) echo $plantacodigo; ?>"> 
			<input type="hidden" name="accionconsultarequipo" value="<?php echo $accionconsultarequipo; ?>">

			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="equipocodigo, equiponombre">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											-->
		 	<input type="hidden" name="usuequcodigo" value="<?php echo $usuequcodigo; ?>">  
		 	<input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo; ?>">  
	 	</form> 
	 	<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>
