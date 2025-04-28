<?php
ob_start();
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblvistaequipotemp.php');
	include ( '../src/FunPerPriNiv/pktblequipotemp.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblestado.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	include ( '../src/FunPerPriNiv/pktblnegocio.php');

	if(!$equtemcodigo || ($equtemcodigo && !$accionconsultarequipotemp))
	{
		if($columnas)
		{
			$campos = explode(',', $columnas);
			for($a = 0; $a < count($campos); $a++)
			{
				$campo1 = trim($campos[$a]);
				unset($$campo1);
			}
		}
		
		$idcon = fncconn();
		$rsNegocio = loadrecordnegocio($negocicodigo, $idcon);
		$equtemcodigo = $rsNegocio['negocicacint'];
		$accionconsultarequipotemp = 1;
		$columnas = 'equtemcodigo';
	}
	
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionborrarequipotemp)
		include ( 'borraequipotemp.php');
	else
	{
		if($accionconsultarequipotemp)
		{
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				$recarreglo[$nombcamp] = $$nombcamp;
				if($recarreglo[$nombcamp]){ $nusw =1;}
				$nombcamp = strtok(",");
			}
			if(!$nusw)
				$accionconsultarequipotemp = 0;
		}
	}
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
  	$intervalo = fncaumdec('vistaequipotemp',$inicio,$fin,$mov,$accionconsultarequipotemp,$recarreglo);
  	$cantrow = $intervalo[total];
  	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush();
?>
<html>
	<head> 
		<title>Registros de equipo temporales [Integracion SRF]</title> 
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
			<p><font class="NoiseFormHeaderFont">Listado de equipos temporales</font></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="70%"> 
 				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablequipotemp.php',$flagcheck); ?></td></tr>
  				<tr><td>&nbsp;</td></tr> 
  				<tr><td align="left" class="NoiseErrorDataTD"><div class="ui-buttonset">
				<?php
				  	if($reccomact[consultar] && !$flagcheck)
				  		echo '<button id="consultar">Consulta</button>&nbsp;&nbsp;';
				   	
				   	if($reccomact[modificar] && !$flagcheck)
				   		echo '<button id="editar">Adicionar a listado equipos</button>&nbsp;&nbsp;';
				?>
				</div></td></tr>
 				<tr><td>&nbsp;</td></tr>
 				<tr><td><?php include ('../def/jquery.button_navup.php') ?></td></tr>
 				<tr><td></td></tr>
		    	<tr><td></td></tr>
 				<tr> 
  					<td> 
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1" class="ui-widget-content"> 
							<tr> 
								<td width="5%" class="ui-state-default">Sel.</td> 
								<td width="15%" class="ui-state-default">C&oacute;digo</td> 
								<td width="70%" class="ui-state-default">Nombre</td> 
								<td width="10%" class="ui-state-default">Estado</td> 
							</tr>
							<?php
								include ( '../src/FunGen/sesion/fncvisregequipotemp.php');
								$reg[0] = 'equtemcodigo';
								$reg1[0] = 's';
								$nureturn = fncvisregequipotemp('vistaequipotemp',$reg,$reg1,$idtrans,$arr_borrar,$flagcheck);
							?>
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablequipotemp.php',$flagcheck); ?></td></tr> 				
 			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 			<input type="hidden" name="nombtabl" value="vistaequipotemp"> 
  			<input type="hidden" name="sourcetable" value="equipotemp"> 
 			<input type="hidden" name="selstar" id="selstar" value="0">  
			<input type="hidden" name="columnas" value="equtemcodigo,estadocodigo,sistemcodigo,cencoscodigo,equtemnombre,equtemdescri,equtemfabric,equtemmarca,
equtemmodelo,equtemserie,equtemlargo,equtemancho,equtemalto,equtempeso,equtemvolta,equtemcorrie,equtempoten,equtemfeccom,equtemcinv,equtemvengar,equtemviduti,
equtemfecins,equtemubicac,equtemvalhor,equtemnohs,equtemacti,equtemtipo,equtemnpas,contracodigo,tipequcodigo">
 			<input type="hidden" name="equtemcodigo" value="<?php if($accionconsultarequipotemp) echo $equtemcodigo; ?>">
 			<input type="hidden" name="estadocodigo" value="<?php if($accionconsultarequipotemp) echo $estadocodigo; ?>">
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarequipotemp) echo $sistemcodigo; ?>">
 			<input type="hidden" name="cencoscodigo" value="<?php if($accionconsultarequipotemp) echo $cencoscodigo; ?>">
 			<input type="hidden" name="equtemnombre" value="<?php if($accionconsultarequipotemp) echo $equtemnombre; ?>">
 			<input type="hidden" name="equtemdescri" value="<?php if($accionconsultarequipotemp) echo $equtemdescri; ?>">
 			<input type="hidden" name="equtemfabric" value="<?php if($accionconsultarequipotemp) echo $equtemfabric; ?>">
 			<input type="hidden" name="equtemmarca" value="<?php if($accionconsultarequipotemp) echo $equtemmarca; ?>">
 			<input type="hidden" name="equtemmodelo" value="<?php if($accionconsultarequipotemp) echo $equtemmodelo; ?>">
 			<input type="hidden" name="equtemserie" value="<?php if($accionconsultarequipotemp) echo $equtemserie; ?>">
 			<input type="hidden" name="equtemlargo" value="<?php if($accionconsultarequipotemp) echo $equtemlargo; ?>">
 			<input type="hidden" name="equtemancho" value="<?php if($accionconsultarequipotemp) echo $equtemancho; ?>">
 			<input type="hidden" name="equtemalto" value="<?php if($accionconsultarequipotemp) echo $equtemalto; ?>">
 			<input type="hidden" name="equtempeso" value="<?php if($accionconsultarequipotemp) echo $equtempeso; ?>">
 			<input type="hidden" name="equtemvolta" value="<?php if($accionconsultarequipotemp) echo $equtemvolta; ?>">
 			<input type="hidden" name="equtemcorrie" value="<?php if($accionconsultarequipotemp) echo $equtemcorrie; ?>">
 			<input type="hidden" name="equtempoten" value="<?php if($accionconsultarequipotemp) echo $equtempoten; ?>">
 			<input type="hidden" name="equtemfeccom" value="<?php if($accionconsultarequipotemp) echo $equtemfeccom; ?>">
 			<input type="hidden" name="equtemcinv" value="<?php if($accionconsultarequipotemp) echo $equtemcinv; ?>">
 			<input type="hidden" name="equtemvengar" value="<?php if($accionconsultarequipotemp) echo $equtemvengar; ?>">
 			<input type="hidden" name="equtemviduti" value="<?php if($accionconsultarequipotemp) echo $equtemviduti; ?>">
 			<input type="hidden" name="equtemfecins" value="<?php if($accionconsultarequipotemp) echo $equtemfecins; ?>">
 			<input type="hidden" name="equtemubicac" value="<?php if($accionconsultarequipotemp) echo $equtemubicac; ?>">
 			<input type="hidden" name="equtemvalhor" value="<?php if($accionconsultarequipotemp) echo $equtemvalhor; ?>">
 			<input type="hidden" name="equtemnohs" value="<?php if($accionconsultarequipotemp) echo $equtemnohs; ?>">
 			<input type="hidden" name="equtemacti" value="<?php if($accionconsultarequipotemp) echo $equtemacti; ?>">
 			<input type="hidden" name="equtemtipo" value="<?php if($accionconsultarequipotemp) echo $equtemtipo; ?>">
 			<input type="hidden" name="equtemnpas" value="<?php if($accionconsultarequipotemp) echo $equtemnpas; ?>">
 			<input type="hidden" name="contracodigo" value="<?php if($accionconsultarequipotemp) echo $contracodigo; ?>">
 			<input type="hidden" name="tipequcodigo" value="<?php if($accionconsultarequipotemp) echo $tipequcodigo; ?>">
 			<input type="hidden" name="accionconsultarequipotemp" value="<?php echo $accionconsultarequipotemp; ?>">
 			<input type="hidden" name="mov">
 			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
 		</form>
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>