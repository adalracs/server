<?php 

ob_start(); 
	include ( '../src/FunPerPriNiv/pktblrecepcionmercancia.php');
	include ( '../src/FunPerPriNiv/pktblunimedida.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	
	if($accionborrarrecepcionmercancia)
		include ( 'borrarecepcionmercancia.php');
	else
	{
		if($accionconsultarrecepcionmercancia)
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
				$accionconsultarrecepcionmercancia = 0;
		}
	}
	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');

  	$intervalo = fncaumdec('recepcionmercancia',$inicio,$fin,$mov,$accionconsultarrecepcionmercancia,$recarreglo);
  	$cantrow = $intervalo[total];
  	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Registros de recepcion de mercancia</title> 
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
			<p><font class="NoiseFormHeaderFont">Listado de recepcion de mercancias</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="950">
				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablrecepcionmercancia.php',$flagcheck); ?></td></tr>
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
								<td width="5%" class="ui-state-default">Sel.</td> 
								<td width="5%" class="ui-state-default">C&oacute;digo</td> 
								<td width="5%" class="ui-state-default">Item</td> 
								<td width="30%" class="ui-state-default">Nombre</td> 
								<td width="25%" class="ui-state-default">Proveedor</td> 
								<td width="10%" class="ui-state-default">Lote</td> 
								<td width="10%" class="ui-state-default">U. Medida</td> 
								<td width="10%" class="ui-state-default">Cantidad</td> 
							</tr>
							<?php 
								include ( '../src/FunGen/sesion/fncvisregrecepcionmercancia.php');
								$reg[0] = 'recmercodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregrecepcionmercancia('recepcionmercancia', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td></td></tr>
		    	<tr><td></td></tr>
  				<tr><td><?php include ('../def/jquery.button_navdown.php') ?></td></tr> 
  				<tr><td>&nbsp;</td></tr>
  				<tr><td class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablrecepcionmercancia.php',$flagcheck); ?></td></tr>
			</table> 
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
 			<input type="hidden" name="sourcetable" value="recepcionmercancia"> 
 			<input type="hidden" name="selstar" id="selstar" value="0"> 
 			<input type="hidden" name="nombtabl" value="recepcionmercancia"> 
			<input type="hidden" name="columnas" value="recmercodigo,itedescodigo,lotecodigo,unidadcodigo,recmercantidad,recmerordcomp,recmernoir,recmernofact,bodegacodigo,recmercertificado">
			<input type="hidden" name="recmercodigo" value="<?php if($accionconsultarrecepcionmercancia) echo $recmercodigo; ?>">
			<input type="hidden" name="itedescodigo" value="<?php if($accionconsultarrecepcionmercancia) echo $itedescodigo; ?>">
			<input type="hidden" name="lotecodigo" value="<?php if($accionconsultarrecepcionmercancia) echo $lotecodigo; ?>">
			<input type="hidden" name="unidadcodigo" value="<?php if($accionconsultarrecepcionmercancia) echo $unidadcodigo; ?>">
			<input type="hidden" name="recmercantidad" value="<?php if($accionconsultarrecepcionmercancia) echo $recmercantidad; ?>">
			<input type="hidden" name="recmerordcomp" value="<?php if($accionconsultarrecepcionmercancia) echo $recmerordcomp; ?>">
			<input type="hidden" name="recmernoir" value="<?php if($accionconsultarrecepcionmercancia) echo $recmernoir; ?>">
			<input type="hidden" name="recmernofact" value="<?php if($accionconsultarrecepcionmercancia) echo $recmernofact; ?>">
			<input type="hidden" name="bodegacodigo" value="<?php if($accionconsultarrecepcionmercancia) echo $bodegacodigo; ?>">
			<input type="hidden" name="recmercertificado" value="<?php if($accionconsultarrecepcionmercancia) echo $recmercertificado; ?>">
			<input type="hidden" name="accionconsultarrecepcionmercancia" value="<?php echo $accionconsultarrecepcionmercancia; ?>">
 			<input type="hidden" name="mov"> 
			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="recmercodigo">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											--> 
 		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>