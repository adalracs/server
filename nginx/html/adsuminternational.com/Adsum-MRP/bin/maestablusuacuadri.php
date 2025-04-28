<?php 
ob_start();
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/sesion/fnccantrow1.php');
include ( '../src/FunPerPriNiv/limitscanusuario.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblvistausuacuadrilla.php');
include ( '../src/FunPerPriNiv/pktbldepartam.php');
include ( '../src/FunPerPriNiv/pktblcargo.php');
include ( '../src/FunGen/sesion/fncalmdat.php');
include ('../src/FunGen/floadusuariohidden.php');
$idcon = fncconn();
$negocio = loadrecorddepartam($GLOBALS["departcodigo"], $idcon);
$GLOBALS[negocicodigo]=$negocio[negocicodigo];
									
				
$reaccionconsultarusuario= 1;
if(!$columnas)   
	$columnas = 'usuaacti';

$usuaacti = 1;

if($accionconsultarusuario){
	$recarreglo[ciudadcodigo] = $ciudadcodigo;
	
	
	if (!$ciudadcodigo){
		$accionconsultarusuario = 0;
	}
}
if($reaccionconsultarusuario){
	$accionconsultarusuario = 1;
	
	$nusw = 0;
	$nombcamp = strtok ($columnas,",");
	while ($nombcamp)
	{
		$nombcamp = trim($nombcamp);
		if($nombcamp == "usuacodi")
		$recarreglo[$nombcamp] = $usuacodigo;
		else
		$recarreglo[$nombcamp] = $$nombcamp;
		if($recarreglo[$nombcamp]){ $nusw =1;}
		$nombcamp = strtok(",");
	}
	if(!$nusw){
		$accionconsultarusuario = 0;
	}
}
include ( '../src/FunGen/sesion/fncaumdec.php');
include('../src/FunGen/fncpageposition.php');
$recarreglo[departcodigo] = $_POST[departcodigo];
$recarreglo[cargocodigo] = $_POST[cargocodigo];
$intervalo = fncaumdec('vistausuacuadrilla',$inicio,$fin,$mov,$accionconsultarusuario,$recarreglo); 
$cantrow = $intervalo[total]; 
if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }

ob_end_flush();
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Registros de empleados</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de empleados</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="85%"> 
 				<tr><td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablusuacuadri.php',$flagcheck); ?></td><tr> 
  					<td> 
  					<?php 
  						if(/*$reccomact[nuevo]*/true){
  							echo '<input type="image" name="adicionar"  src="../img/adicionar.gif" onclick="
  													cargarcheck(this.form);form1.accionnuevoemplgrupo.value= 1;if(window.opener.document.form1.arreglo_tecnic.value){
  													window.opener.document.form1.arreglo_temptecnic.value =window.opener.document.form1.arreglo_temptecnic.value +'."','".'+ window.document.form1.arr_borrar.value;}
  													else{window.opener.document.form1.arreglo_temptecnic.value = window.document.form1.arr_borrar.value;}
  													window.opener.document.form1.consulta.focus();window.close();"  
  													width="86" height="18" alt="Adicionar Registro" border=0>'; 
  						}
  						if(/*$reccomact[consultar]*/true){
  							echo '<input type="image" name="consultar" src="../img/consulta.gif" onclick="form1.action='."'".'consultarusuacuadri.php?codigo='.$codigo."'".';"  width="86" height="18" alt="Consultar" border=0>'; 
  						}
					?> 
 					</td> 
 					<td width="42"><input type="image" name="adelanta"  src="../img/adelanta.gif" onclick="cargarcheck(this.form);form1.mov.value='menos';form1.action='maestablusuacuadri.php';" alt="Anterior"></td>
 					<td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 					<td width="50"> 
  					<?php 
        					echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; 
					?> 
 					</td> 
 					<td width="53"><div align="right"><font color="#CC9900">Siguiente</font></div></td> 
 					<td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" onclick="cargarcheck(this.form);form1.mov.value='mas';form1.action='maestablusuacuadri.php';" alt="Siguiente"></td> 
 				</tr> 
 				<tr><td colspan="6"><div align="right"></div></td></tr> 
 				<tr> 
  					<td colspan="6"> 
  						<table width="100%" border="0" align="center" cellspacing="1" cellpadding="1"> 
							<tr> 
								<td width="5%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Selec.</font></span></td> 
								<td width="10%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Registro</font></span></td> 
								<td width="10%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">C&eacute;dula</font></span></td> 
								<td width="35%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Nombre</font></span></td> 
								<td width="40%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Cargo</font></span></td> 
							</tr> 
							<?php 
								include ( '../src/FunGen/sesion/fncvisregusuacuadri.php');
								$reg[0] = 'usuacodi';
								$reg1[0] = 'n';
								$nureturn = fncvisregusuarigrupc('vistausuacuadrilla',$reg,$reg1,$idtrans,$arr_borrar);
							?> 
   						</table> 
   					</td> 
  				</tr> 
  				<tr><td colspan="6"> <div align="right"></div><div align="right"></div></td></tr> 
  				<tr> 
   					<td><a href="javascript:;" ><img type="image" src="../img/ayuda.gif" name="Ayuda" onclick="window.open('navegacion.htm','ambinave','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Ayuda" border=0 ></td> 
   					<td width="42"><input type="image" name="primero"  src="../img/primero.gif" onclick="cargarcheck(this.form);form1.mov.value='primero';form1.action='maestablusuacuadri.php';" alt="Primero"></td> 
   					<td width="46"><input type="image" name="adelanta"  src="../img/adelanta.gif" onclick="cargarcheck(this.form);form1.mov.value='menos';form1.action='maestablusuacuadri.php';" alt="Anterior"></td> 
   					<td width="50"> 
					<?php 
						echo '<div align="center"><font color="#006699" size="2" face="Arial, Helvetica, sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  '.$intervalo[total].'</font></div>'; 
					?> 
   					</td> 
   					<td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" onclick="cargarcheck(this.form);form1.mov.value='mas';form1.action='maestablusuacuadri.php';" alt="Siguiente"></td> 
   					<td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" onclick="cargarcheck(this.form);form1.mov.value='ultimo';form1.action='maestablusuacuadri.php';" alt="Ultimo"></td> 
  				</tr> 
  				<tr><td colspan="6" class="NoiseErrorDataTD" align="right"><?php page_position($intervalo,'maestablusuacuadri.php',$flagcheck); ?></td></tr> 
 			</table> 
			 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
			 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="vistausuacuadrilla">
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
usuaactiot">

<input type="hidden" name="usuacodi" value="<?php echo $_POST[usuacodi]; ?>">
<input type="hidden" name="cargocodigo" value="<?php echo $_POST[cargocodigo]; ?>">
<input type="hidden" name="departcodigo" value="<?php echo $_POST[departcodigo]; ?>">
<input type="hidden" name="tipusucodigo" value="<?php echo $$_POST[tipusucodigo]; ?>">
<input type="hidden" name="usuanomb" value="<?php echo $$_POST[usuanomb]; ?>">
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

			 <input type="hidden" name="accionnuevoemplgrupo" value="<?php echo $accionnuevoemplgrupo;?>">
			 <input type="hidden" name="accionconsultarusuario" value="<?php echo $accionconsultarusuario; ?>">
			 <input type="hidden" name="reaccionconsultarusuario" value="<?php echo $reaccionconsultarusuario; ?>">
			 <input type="hidden" name="mov"> 
			<input type="hidden" name="arreglo_b"> 
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>"> 
			<input type="hidden" name="flagconsultarempleado" value="1"> 
			<input type="hidden" name="ciudadcodigo" value="<?php echo $ciudadcodigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>