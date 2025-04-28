<?php 
ob_start();
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/sesion/fnccantrow1.php');
include ( '../src/FunPerPriNiv/limitscan.php');
include ( '../src/FunPerPriNiv/limitscanusua.php');
include ( '../src/FunPerSecNiv/fncconn.php'); 
include ( '../src/FunPerSecNiv/fncclose.php'); 
include ( '../src/FunPerSecNiv/fncfetch.php'); 
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerPriNiv/pktblusuario1.php');
include ( '../src/FunPerPriNiv/pktbldepartam.php');
include ( '../src/FunPerPriNiv/pktblcargo.php');
include ( '../src/FunGen/sesion/fncalmdat.php');
include ( '../src/FunGen/sesion/fncalmdatusua.php');
include ( '../src/FunGen/sesion/fncalmdatcusua.php');
include ( '../src/FunGen/sesion/fnccaf.php');
$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 

if($accionconsultarusuario)
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
		if($recarreglo[$nombcamp]){ $nusw =1;}
		$nombcamp = strtok(",");
	}
	if(!$nusw){
		$accionconsultarusuario = 0;
	}
}
include ( '../src/FunGen/sesion/fncaumdecusua.php');
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
</head> 
<?php 
if(!$codigo)
{ echo "<!--";}
?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de empleados</font><br><br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
  <tr> 
  <td> 
  <?php 
  if(/*$reccomact[nuevo]*/true){
  	echo '<input type="image" name="adicionar"  src="../img/adicionar.gif"
onclick="cargarcheck(this.form);form1.accionnuevoemplgrupo.value= 1;window.opener.document.form1.arreglo_auxdef.value = window.document.form1.arr_borrar.value;window.opener.document.form1.radio2.focus();window.close();"  width="86" 
height="18" alt="Adicionar Registro" border=0>'; 
  }
  if(/*$reccomact[consultar]*/true){
  	echo '            <input type="image" name="consultar"
src="../img/consulta.gif" 
onclick="form1.action='."'".'consultarusuaauxot.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0>'; 
  }
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="cargarcheck(this.form);form1.mov.value='menos';form1.action='maestablusuaauxot.php';" alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50"> 
  <?php 
  $intervalo = fncaumdecusua('usuario',$inicio,$fin,$mov,$accionconsultarusuario,$recarreglo,$empleacod);
  $cantrow = $intervalo[total];
  if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="cargarcheck(this.form);form1.mov.value='mas';form1.action='maestablusuaauxot.php';" alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right"> 
 </div></td> 
 </tr> 
 <tr> 
  <td colspan="6"> 
  <table width="100%" border="0" align="center" cellspacing="2" 
cellpadding="1"> 
<tr> 
<td width="8%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Selec.</font></span></td> 
<td width="8%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td> 
<td width="15%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&eacute;dula</font></span></td> 
<td width="32%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Nombre</font></span></td> 
<td width="25%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Departamento</font></span></td> 
<td width="25%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Cargo</font></span></td> 

</tr> 
<?php 
include ( '../src/FunGen/sesion/fncvisregusuarigrupc.php');
$reg[0] = 'usuacodi';
$reg1[0] = 'n';
$nureturn = fncvisregusuarigrupc('usuario',$reg,$reg1,$idtrans,$arr_borrar);
?> 
   </table> 
   </td> 
  </tr> 
  <tr> 
   <td colspan="6"> <div align="right"> 
  </div><div align="right"> 
  </div> 
  </td> 
  </tr> 
  <tr> 
   <td><a href="javascript:;" ><img type="image" src="../img/ayuda.gif" name="Ayuda" onclick="window.open('navegacion.htm','ambinave','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Ayuda" border=0 ></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="cargarcheck(this.form);form1.mov.value='primero';form1.action='maestablusuaauxot.php';" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onclick="cargarcheck(this.form);form1.mov.value='menos';form1.action='maestablusuaauxot.php';" 
alt="Anterior"></td> 
   <td width="50"> 
<?php 
echo '<div align="center"><font color="#006699" size="2" face="Arial, Helvetica,
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font></div>'; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="cargarcheck(this.form);form1.mov.value='mas';form1.action='maestablusuaauxot.php';" alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="cargarcheck(this.form);form1.mov.value='ultimo';form1.action='maestablusuaauxot.php';" alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="accionnuevoemplgrupo" value="<?php echo $accionnuevoemplgrupo;?>">
 <input type="hidden" name="nombtabl" value="usuario">
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
<input type="hidden" name="usuacodi" value="<?php echo $usuacodi; ?>">
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
 <input type="hidden" name="accionconsultarusuario" value="<?php echo $accionconsultarusuario; ?>">
 <input type="hidden" name="mov"> 
<input type="hidden" name="arreglo_b"> 
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>"> 
<!-- Variables de llenado de ot  -->
<input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo; ?>">
<input type="hidden" name="sistemcodigo" value="<?php echo $sistemcodigo; ?>">
<input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>">
<input type="hidden" name="ordtradescri" value="<?php echo $ordtradescri; ?>">
<input type="hidden" name="prioricodigo" value="<?php echo $prioricodigo; ?>">
<input type="hidden" name="tipmancodigo" value="<?php echo $tipmancodigo; ?>">
<input type="hidden" name="anno" value="<?php echo $anno; ?>">
<input type="hidden" name="mes" value="<?php echo $mes; ?>">
<input type="hidden" name="dia" value="<?php echo $dia; ?>">
<input type="hidden" name="hora" value="<?php echo $hora; ?>">
<input type="hidden" name="minuto" value="<?php echo $minuto; ?>">
<input type="hidden" name="anno1" value="<?php echo $anno1; ?>">
<input type="hidden" name="mes1" value="<?php echo $mes1; ?>">
<input type="hidden" name="dia1" value="<?php echo $dia1; ?>">
<input type="hidden" name="hora1" value="<?php echo $hora1; ?>">
<input type="hidden" name="minuto1" value="<?php echo $minuto1; ?>">
<!-- Variables de llenado de tareot  -->
<input type="hidden" name="flagnuevoot" value="1"> 
<input type="hidden" name="empleacodigo1" value="<?php echo $empleacodigo1; ?>">
<input type="hidden" name="tiptracodigo" value="<?php echo $tiptracodigo; ?>">
<input type="hidden" name="tareacodigo" value="<?php echo $tareacodigo; ?>">
<input type="hidden" name="tareotorden" value="<?php echo $tareotorden; ?>">
<input type="hidden" name="tareottiedur" value="<?php echo $tareottiedur; ?>">
<input type="hidden" name="ordtranota" value="<?php echo $ordtranota; ?>">
<input type="hidden" name="empleacod" value="<?php echo $empleacod; ?>"> 
<input type="hidden" name="flagconsultarempleado" value="1"> 

</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html>