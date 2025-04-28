<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunPerPriNiv/pktbldepartamento.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$reccomact =  fnccaf($GLOBALS["usuacodi"],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionborrarproveedo1)
		include ( 'borraproveedo1.php');
	else
	{
		if($accionconsultarproveedo1)
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
				$accionconsultarproveedo1 = 0;
		}
	}
	
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
  	$intervalo = fncaumdec('proveedo',$inicio,$fin,$mov,$accionconsultarproveedo1,$recarreglo);
  	$cantrow = $intervalo[total];
  	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Registros de proveedores</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
		
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de proveedores</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="600">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablproveedo.php',$flagcheck); ?></td></tr>
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
								<td width="6%" class="ui-state-default">Sel.</td> 
								<td width="10%" class="ui-state-default">C&oacute;digo</td> 
								<td width="44%" class="ui-state-default">Nombre</td> 
								<td width="40%" class="ui-state-default">Ciudad</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregproveedo.php');
								$reg[0] = 'proveecodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregproveedo('proveedo', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablproveedo.php',$flagcheck); ?></td></tr>
			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="proveedo1"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
 			<input type="hidden" name="nombtabl" value="proveedo"> 
			<input type="hidden" name="columnas" value="proveecodigo,proveenombre,proveerepleg,proveetelefo,proveefax,proveepais,ciudadcodigo,proveedirecc,proveeurl,proveeemail,proveenota,proestcodigo,proveepostal,proveecontac,proveetelcon,tipprocodigo">
			<input type="hidden" name="proveecodigo" value="<?php if($accionconsultarproveedo1) echo $proveecodigo; ?>">
			<input type="hidden" name="proveenombre" value="<?php if($accionconsultarproveedo1) echo $proveenombre; ?>">
			<input type="hidden" name="proveerepleg" value="<?php if($accionconsultarproveedo1) echo $proveerepleg; ?>">
			<input type="hidden" name="proveetelefo" value="<?php if($accionconsultarproveedo1) echo $proveetelefo; ?>">
			<input type="hidden" name="proveefax" value="<?php if($accionconsultarproveedo1) echo $proveefax; ?>">
			<input type="hidden" name="proveepais" value="<?php if($accionconsultarproveedo1) echo $proveepais; ?>">
			<input type="hidden" name="proveedirecc" value="<?php if($accionconsultarproveedo1) echo $proveedirecc; ?>">
			<input type="hidden" name="proveeurl" value="<?php if($accionconsultarproveedo1) echo $proveeurl; ?>">
			<input type="hidden" name="proveeemail" value="<?php if($accionconsultarproveedo1) echo $proveeemail; ?>">
			<input type="hidden" name="proveenota" value="<?php if($accionconsultarproveedo1) echo $proveenota; ?>">
			<input type="hidden" name="proestcodigo" value="<?php if($accionconsultarproveedo1) echo $proestcodigo; ?>">
			<input type="hidden" name="proveepostal" value="<?php if($accionconsultarproveedo1) echo $proveepostal; ?>">
			<input type="hidden" name="proveecontac" value="<?php if($accionconsultarproveedo1) echo $proveecontac; ?>">
			<input type="hidden" name="proveetelcon" value="<?php if($accionconsultarproveedo1) echo $proveetelcon; ?>">
			<input type="hidden" name="ciudadcodigo" value="<?php if($accionconsultarproveedo1) echo $ciudadcodigo; ?>">
			<input type="hidden" name="deptocodigo" value="<?php if($accionconsultarproveedo1) echo $deptocodigo; ?>">
			<input type="hidden" name="tipprocodigo" value="<?php if($accionconsultarproveedo1) echo $tipprocodigo; ?>">
			<input type="hidden" name="accionconsultarproveedo1" value="<?php echo $accionconsultarproveedo1; ?>">
 			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="proveecodigo, proveenombre">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											--> 
 		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>