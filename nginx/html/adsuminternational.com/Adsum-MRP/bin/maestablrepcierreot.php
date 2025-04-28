<?php
session_start();
	include('../src/FunPerSecNiv/fncconn.php');
	include('../src/FunPerSecNiv/fncclose.php');
	include('../src/FunPerSecNiv/fncfetch.php');
	include('../src/FunPerSecNiv/fncnumreg.php'); 
	include ( '../src/FunGen/sesion/fnccantrow.php'); 
	include ( '../src/FunGen/sesion/fnccantrow1.php'); 
	include ( '../src/FunPerPriNiv/limitscan.php'); 
	//include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblvistarepcierre.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/limitscanvistas.php');
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

	if($accionborrarreportot){ 
		include ( 'borrareportot.php'); 
	} 
	else{ 
		if($accionconsultarreportot){ 
			//include ( '../src/FunGen/sesion/fncalmdatc.php'); 
			$nusw = 0; 
			$nombcamp = strtok ($columnas,","); 
			while ($nombcamp){ 
				$nombcamp = trim($nombcamp); 
				$recarreglo[$nombcamp] = $$nombcamp; 
				if($recarreglo[$nombcamp]){ $nusw =1;} 
				$nombcamp = strtok(","); 
			} 
			if(!$nusw){ 
				$accionconsultarreportot = 0; 
			} 
		} 
	} 

	include ( '../src/FunGen/sesion/fncaumdec.php');  
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Registros de reportes de ordenes de trabajo</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"><link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/jsrsClient.js"></script>
<script language="JavaScript" type="text/javascript" src="../src/FunGen/cargarReporteot.js"></script>

</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"><form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de reportes de ordenes de trabajo</font><br><br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
 <tr> 
 	<td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
 <tr> 
 	<td> 
  		<?php
			
				echo '       <input type="image" name="consultar"  src="../img/consulta.gif" 
					 onclick="form1.action='."'".'consultarrepcierreot.php'."'".';"  width="86" 
					 height="18" alt="Consultar" border=0>'; 
			
		?> 
 	</td> 
	<td width="42"> 
  	<input type="image" name="adelanta"  src="../img/adelanta.gif" 
	onclick="form1.mov.value = 'menos';form1.action='maestablrepcierreot.php';" 
	alt="Anterior"></td> 
 	<td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 	<td width="50"> 
  		<?php 
			$intervalo = fncaumdec('vistarepcierre',$inicio,$fin,$mov,$accionconsultarreportot,$recarreglo); 
			$cantrow = $intervalo[total]; 
			if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
		?> 
 	</td> 
 	<td width="53"><div align="right"><font color="#CC9900">Siguiente</font></div></td> 
 	<td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
	onclick="form1.mov.value = 'mas';form1.action='maestablrepcierreot.php';" 
	alt="Siguiente"></td> 
  </tr> 
  <tr> 
  	<td colspan="6"><div align="right"></div></td> 
  </tr> 
  <tr> 
  	<td colspan="6"><table width="100%" border="0" align="center" cellspacing="2" 
	cellpadding="1"> 
	 <tr> 
		<td width="8%" class="NoiseFieldCaptionTD"><span class="style5"><font 
		color="#FFFFFF">Selec.</font></span></td> 
		<td width="31%" class="NoiseFieldCaptionTD"><span class="style5"><font 
		color="#FFFFFF">Orden de trabajo</font></span></td> 
		<td width="51%" class="NoiseFieldCaptionTD"><span class="style5"><font 
		color="#FFFFFF">Encargado</font></span></td> 
	 </tr> 
	 <?php 
		include ( '../src/FunGen/sesion/fncvisregrepcierreot.php'); 
		$reg[0] = 'reportcodigo'; 
		$reg1[0] = 'n'; 
		$nureturn = fncvisregrepcierreot('vistarepcierre',$reg,$reg1,$idtrans); 
	 ?> 
	</table> 
   	</td> 
  </tr> 
  <tr> 
  	<td colspan="6"> <div align="right"></div><div align="right"></div></td> 
  </tr> 
  <tr> 
   	<td><img src="../img/ayuda.gif" border="0" alt="Ayuda"></td> 
   	<td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
	onclick="form1.mov.value = 'primero';form1.action='maestablrepcierreot.php';" 
	alt="Primero"></td> 
   	<td width="46"><input type="image" name="adelanta"  
	src="../img/adelanta.gif" onclick="form1.mov.value = 
	'menos';form1.action='maestablrepcierreot.php';" alt="Anterior"></td> 
   	<td width="50"> 
		<?php 
			echo '<font color="#006699" size="2" face="Arial, Helvetica, 
			sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
			'.$intervalo[total].'</font>'; 
		?> 
   	</td> 
   	<td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
	onclick="form1.mov.value = 'mas';form1.action='maestablrepcierreot.php';" 
	alt="Siguiente"></td> 
   	<td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
	onclick="form1.mov.value = 'ultimo';form1.action='maestablrepcierreot.php';" 
	alt="Ultimo"></td> 
  </tr> 
  <tr> 
   	<td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
<input type="hidden" name="nombtabl" value="vistarepcierre"> 
<input type="hidden" name="columnas" value="reportcodigo, 
ordtracodigo, 
tipmancodigo, 
prioricodigo, 
tiptracodigo, 
tareacodigo, 
reportfecha, 
reporttiedur,
reportdescri
"> 
<input type="hidden" name="reportcodigo" value="<?php echo $reportcodigo; ?>"> 
<input type="hidden" name="ordtracodigo" value="<?php echo $ordtracodigo; ?>"> 
<input type="hidden" name="tipmancodigo" value="<?php echo $tipmancodigo; ?>"> 
<input type="hidden" name="prioricodigo" value="<?php echo $prioricodigo; ?>"> 
<input type="hidden" name="tiptracodigo" value="<?php echo $tiptracodigo; ?>"> 
<input type="hidden" name="tareacodigo" value="<?php echo $tareacodigo; ?>"> 
<input type="hidden" name="reportfecha" value="<?php echo $reportfecha; ?>"> 
<input type="hidden" name="reporttiedur" value="<?php echo $reporttiedur; ?>"> 
<input type="hidden" name="reportdescri" value="<?php echo $reportdescri; ?>"> 
<input type="hidden" name="accionconsultarreportot" value="0"> 
<input type="hidden" name="mov"> 
</form> 
</body> 
<?php 
	if(!$codigo) 
	{ echo " -->"; } 
?> 
</html>