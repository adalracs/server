<?php  
ob_start(); 
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblparaprod.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblcausafalla.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/pktblservicio.php');
//--
	session_register("masterparaprod");
	$_SESSION['masterparaprod'] = 1;
//--

	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
	if($accionborrarparaprod)
	{
		include ( 'borraparaprod.php');
	}
	else
	{
		if($accionconsultarparaprod)
		{
			//include ( '../src/FunGen/sesion/fncalmdatc.php');
			$accionconsultarparaprod = 1;
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
			while ($nombcamp)
			{
				$nombcamp = trim($nombcamp);
				if($nombcamp == "usuacodi")
					$recarreglo[$nombcamp] = $empleacod;
				else
					$recarreglo[$nombcamp] = $$nombcamp;
				if($recarreglo[$nombcamp] != null){ $nusw =1;}
				$nombcamp = strtok(",");
			}
			if(!$nusw)
				$accionconsultarparaprod = 0;
		}
	}

	include ( '../src/FunGen/sesion/fncaumdec.php');
	include('../src/FunGen/fncpageposition.php');
	$intervalo = fncaumdec('paraprod',$inicio,$fin,$mov,$accionconsultarparaprod,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans];}
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr� A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Registros de parada produccion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>		
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de paradas de producci&oacute;n</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="NoiseFormTABLE" width="95%"> 
 				<tr><td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablparaprod.php',$flagcheck); ?></td></tr> 
  				<tr> 
  					<td> 
  						<?php  
  							if($reccomact[nuevo])
  								echo '       <input type="image" name="nuevo"  src="../img/nuevo.gif" onclick="form1.action='."'".'ingrnuevparaprod.php'."'".';"  width="86" height="18" alt="Nuevo Registro" border=0 ';
							if($flagcheck)
								echo "disabled >";
							else
								echo '>'; 
  							
							if($reccomact[consultar])
  								echo '            <input type="image" name="consultar" src="../img/consulta.gif" onclick="form1.action='."'".'consultarparaprod.php'."'".';" width="86" height="18" alt="Consultar" border=0 '; 
  								
							if($flagcheck)
								echo "disabled >";
							else
								echo '>';
						?> 
 					</td> 
 					<td width="42"><input type="image" name="adelanta"  src="../img/adelanta.gif" onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos';form1.action='maestablparaprod.php';" alt="Anterior"></td> 
 					<td width="46"><font size="2" color="#CC9900">Anterior</font></td>
 					<td width="50"><?php echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; ?></td> 
 					<td width="53"><div align="right"><font color="#CC9900">Siguiente</font></div></td> 
 					<td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestablparaprod.php';" alt="Siguiente"></td> 
 				</tr> 
 				<tr> 
  					<td colspan="6"><div align="right"> 
   						<?php  
   							if($reccomact[detallar])
   								echo '<b><input type="image" name="detallar" src="../img/verdetal.gif" onclick="form1.action='."'".'detallarparaprod.php'."'".';"  width="87" height="19" alt="Ver detalle" border=0 '; 
   								
   							if($flagcheck)
								echo "disabled >";
							else
								echo '></b>';
			
							if($reccomact[borrar])
								echo  '<b><input type="image" name="borrar"  src="../img/borrar.gif" onclick="'; 
							
							if($flagcheck)
								echo 'cargarcheck(this.form); form1.action='."'".'maestablborrgen.php'."'".';"  width="87" height="19" alt="Borrar Registro" border=0></b>';
							else 
								echo 'form1.action='."'".'borrarparaprod.php'."'".';"  width="87" height="19" alt="Borrar Registro" border=0></b>';
   
							if($reccomact[modificar])
   								echo '<b><input type="image" name="modificar"  src="../img/modifica.gif" onclick="form1.action='."'".'editarparaprod.php'."'".';"  width="87" height="19" alt="Modificar Registro" border=0 '; 
   							
   							if($flagcheck)
								echo "disabled>";
							else
								echo '></b>';
						?> 
 					</div></td> 
 				</tr> 
 				<tr> 
  					<td colspan="6"> 
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1"> 
							<tr> 
								<td width="3%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">&nbsp;Sel.</span></td> 
								<!-- <td width="6%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">&nbsp;N&uacute;mero</font></span></td> --> 
								<td width="16%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">&nbsp;Planta</font></span></td> 
								<td width="12%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">&nbsp;Sistema</font></span></td> 
								<td width="16%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">&nbsp;Equipo</font></span></td> 
								<td width="15%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">&nbsp;Causa de falla</font></span></td> 
								<td width="15%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">&nbsp;Fecha inicio</font></span></td> 
								<td width="15%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">&nbsp;Fecha fin</font></span></td> 
								<td width="8%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">&nbsp;Dur. [min]</font></span></td> 
							</tr> 
							<?php 
								include ( '../src/FunGen/sesion/fncvisregparaprod.php');
								$reg[0] = 'parprocodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisregparaprod('paraprod', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?>
						</table> 
   					</td> 
  				</tr> 
  				<tr> 
   					<td colspan="6"><div align="right"></div><div align="right"> 
					<?php  
   						if($reccomact[detallar])
   							echo '<b><input type="image" name="detallar" src="../img/verdetal.gif" onclick="form1.action='."'".'detallarparaprod.php'."'".';"  width="87" height="19" alt="Ver detalle" border=0 '; 
   							
   						if($flagcheck)
							echo "disabled >";
						else
							echo '></b>';
		
						if($reccomact[borrar])
							echo  '<b><input type="image" name="borrar"  src="../img/borrar.gif" onclick="'; 
						
						if($flagcheck)
							echo 'cargarcheck(this.form); form1.action='."'".'maestablborrgen.php'."'".';"  width="87" height="19" alt="Borrar Registro" border=0></b>';
						else 
							echo 'form1.action='."'".'borrarparaprod.php'."'".';"  width="87" height="19" alt="Borrar Registro" border=0></b>';
   
						if($reccomact[modificar])
   							echo '<b><input type="image" name="modificar"  src="../img/modifica.gif" onclick="form1.action='."'".'editarparaprod.php'."'".';"  width="87" height="19" alt="Modificar Registro" border=0 '; 
   						
   						if($flagcheck)
							echo "disabled>";
						else
							echo '></b>';
					?> 
  					</div></td> 
  				</tr> 
  				<tr> 
   					<td><img src="../img/ayuda.gif" border="0" alt="Ayuda"></td> 
   					<td width="42"><input type="image" name="primero"  src="../img/primero.gif" onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'primero';form1.action='maestablparaprod.php';" alt="Primero"></td> 
   					<td width="46"><input type="image" name="adelanta" src="../img/adelanta.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos';form1.action='maestablparaprod.php';" alt="Anterior"></td>
   					<td width="50"><?php echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; ?></td> 
   					<td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif"  onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestablparaprod.php';" alt="Siguiente"></td> 
   					<td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'ultimo';form1.action='maestablparaprod.php';" alt="Ultimo"></td> 
  				</tr> 
  				<tr><td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablparaprod.php',$flagcheck); ?></td></tr> 
			</table> 	
  			
  			<input type="hidden" name="codigo" value="<?php  echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php  echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php  echo $intervalo[fin]; ?>"> 
 			<input type="hidden" name="nombtabl" value="paraprod"> 
			<input type="hidden" name="columnas" value="parprocodigo,
parprofecgen,
parprohorgen,
equipocodigo,
sistemcodigo,
plantacodigo,
partecodigo,
componcodigo,
parprodescri,
parprofecini,
parprohorini,
parprofecfin,
parprohorfin,
usuacodi,
servicicodigo,
tipfalcodigo,
caufallcodigo,
tiptracodigo">
			<input type="hidden" name="parprocodigo" value="<?php  echo $parprocodigo; ?>">
			<input type="hidden" name="parprofecgen" value="<?php  echo $parprofecgen; ?>">
			<input type="hidden" name="parprohorgen" value="<?php  echo $parprohorgen; ?>">
			<input type="hidden" name="plantacodigo" value="<?php  echo $plantacodigo; ?>">
			<input type="hidden" name="sistemcodigo" value="<?php  echo $sistemcodigo; ?>">
			<input type="hidden" name="equipocodigo" value="<?php  echo $equipocodigo; ?>">
			<input type="hidden" name="componcodigo" value="<?php  echo $componcodigo; ?>">
			<input type="hidden" name="partecodigo" value="<?php  echo $partecodigo; ?>">
			<input type="hidden" name="parprodescri" value="<?php  echo $parprodescri; ?>">
			<input type="hidden" name="parprofecini" value="<?php  echo $parprofecini; ?>">
			<input type="hidden" name="parprohorini" value="<?php  echo $parprohorini; ?>">
			<input type="hidden" name="parprofecfin" value="<?php  echo $parprofecfin; ?>">
			<input type="hidden" name="parprohorfin" value="<?php  echo $parprohorfin; ?>">
			<input type="hidden" name="empleacod" value="<?php  echo $empleacod; ?>">
			<input type="hidden" name="servicicodigo" value="<?php  echo $servicicodigo; ?>">
			<input type="hidden" name="tipfalcodigo" value="<?php  echo $tipfalcodigo; ?>">
			<input type="hidden" name="caufallcodigo" value="<?php  echo $caufallcodigo; ?>">
			<input type="hidden" name="tiptracodigo" value="<?php  echo $tiptracodigo; ?>">

 			<input type="hidden" name="accionconsultarparaprod" value="<?php  echo $accionconsultarparaprod; ?>"> 
 			<input type="hidden" name="accionfiltrarservicio" value="<?php echo $accionfiltrarservicio; ?>"> 
 
 			<input type="hidden" name="mov"> 
 			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php  echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<input type="hidden" name="selcampos" value="parprocodigo, parprofecini, parprohorini">
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php  echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											-->
  		</form> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>