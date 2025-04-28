<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/sesion/fnccantrow1.php');
include ( '../src/FunPerPriNiv/limitscan.php');
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblvistamaxtareot.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktblotestado.php');
include ( '../src/FunGen/sesion/fncalmdat.php');
include ( '../src/FunGen/sesion/fnccaf.php');
$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
// --
session_unregister("arrtransac");
session_unregister("arrtransaccod");
session_unregister("arrtransacherr");
session_unregister("flagsoliot");
session_unregister("arrtransacitem");
session_unregister("arrtransaccoditem");
session_unregister("arrtransacite");
session_unregister("flagsoliotitem");
session_unregister("arrtransactran");
// --
if($accionconsultarvistamaxtareot)
{
//	include ( '../src/FunGen/sesion/fncalmdatc.php');
	$nusw = 0;
	$nombcamp = strtok ($columnas,",");
	while ($nombcamp)
	{
		$nombcamp = trim($nombcamp);
		$recarreglo[$nombcamp] = $$nombcamp;
		if($recarreglo[$nombcamp]){ $nusw =1;}
		$nombcamp = strtok(",");
	}
	if(!$nusw){
		$accionconsultarvistamaxtareot = 0;
	}
}
include ( '../src/FunGen/sesion/fncaumdec.php');
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
<title>Registros de Gesti&oacute;n de &Oacute;rdenes de trabajo</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
</head> 
<?php 
if(!$codigo)
{ echo "<!--";}
?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de Gesti&oacute;n de &Oacute;rdenes de trabajo</font><br>
  <br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
 <tr> 
 <td width="700" colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
  <tr> 
  <td> 
  <?php 
  if($reccomact[nuevo]){
  	echo '       <input type="image" name="nuevo"  src="../img/nuevo.gif"
onclick="form1.action='."'".'ingrnuevtareot.php'."'".';"  width="86" 
height="18" alt="Nuevo Registro" border=0>'; 
  }
  if($reccomact[consultar]){
  	echo '            <input type="image" name="consultar"
src="../img/consulta.gif" 
onclick="form1.action='."'".'consultarvistamaxtareot.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0>'; 
  }
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="form1.mov.value = 'menos';form1.action='maestablvistamaxtareot.php';" alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50"> 
  <?php 
  $intervalo = fncaumdec('vistamaxtareot',$inicio,$fin,$mov,$accionconsultartareot,$recarreglo);
  $cantrow = $intervalo[total];
  if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas';form1.action='maestablvistamaxtareot.php';" alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right"> 
   <?php 
   if($reccomact[detallar]){
   	echo '<b><input type="image" name="detallar" src="../img/verdetal.gif"
onclick="form1.action='."'".'detallartareot.php'."'".';"  width="87" 
height="19"  alt="Ver detalle" border=0></b>'; 
   }
?> 
 </div></td> 
 </tr> 
 <tr> 
  <td colspan="6"> 
  <table width="100%" border="0" align="center" cellspacing="2" cellpadding="1"> 
<tr> 
<td width="8%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Selec.</font></span></td> 
<td width="15%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Cod. OT</font></span></td> 
<td width="30%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Encargado</font></span></td> 
<td width="25%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Tipo de mantenimiento</font></span></td> 
<td width="22%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Estado</font></span></td> 
</tr>
<?php 
include ( '../src/FunGen/sesion/fncvisregvistamaxtareot.php');
$reg[0] = 'ordtracodigo';
$reg1[0] = 'n';
$nureturn = fncvisregvistamaxtareot('vistamaxtareot',$reg,$reg1,$idtrans);
?> 
   </table> 
   </td> 
  </tr> 
  <tr> 
   <td colspan="6"> <div align="right"> 
  </div><div align="right"> 
<?php 
if($reccomact[detallar]){
	echo  '<b><input type="image" name="detallar"  src="../img/verdetal.gif"
onclick="form1.action='."'".'detallarvistamaxtareot.php'."'".';"  width="87" 
height="19" alt="Ver detalle" border=0></b>'; 
}
?> 
  </div> 
  </td> 
  </tr> 
  <tr> 
   <td><img src="../img/ayuda.gif" border="0" alt="Ayuda"></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="form1.mov.value = 'primero';form1.action='maestablvistamaxtareot.php';" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onclick="form1.mov.value = 'menos';form1.action='maestablvistamaxtareot.php';" 
alt="Anterior"></td> 
   <td width="50"> 
<?php 
echo '<font color="#006699" size="2" face="Arial, Helvetica,
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font>'; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas';form1.action='maestablvistamaxtareot.php';" alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="form1.mov.value = 'ultimo';form1.action='maestablvistamaxtareot.php';" alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="vistamaxtareot"> 
<input type="hidden" name="columnas" value="tareotcodigo, 
tareacodigo, 
ordtracodigo, 
tiptracodigo, 
operaccodigo, 
tareottiedur,
tareotnota,
progracodigo, 
tareothorini, 
tareotfecini, 
tareothorfin, 
tareotfecfin, 
tareotsecuen, 
tareotfin, 
usacodi, 
otestacodigo, 
prioricodigo, 
tipcumcodigo
"> 
 <input type="hidden" name="tareotcodigo" value="<?php echo $tareotcodigo; ?>"> 
  <input type="hidden" name="ordtracodigo" value="<?php echo $ordtracodigo; ?>"> 
 <input type="hidden" name="tareacodigo" value="<?php echo $tareacodigo; ?>"> 
 <input type="hidden" name="tiptracodigo" value="<?php echo $tiptracodigo; ?>"> 
 <input type="hidden" name="operaccodigo" value="<?php echo $operaccodigo; ?>">
 <input type="hidden" name="tareottiedur" value="<?php echo $tareottiedur; ?>"> 
 <input type="hidden" name="tareotnota" value="<?php echo $tareotnota; ?>">
 <input type="hidden" name="progracodigo" value="<?php echo $progracodigo; ?>"> 
 <input type="hidden" name="tareothorini" value="<?php echo $tareothorini; ?>"> 
 <input type="hidden" name="tareotfecini" value="<?php echo $tareotfecini; ?>"> 
 <input type="hidden" name="tareothorfin" value="<?php echo $tareothorfin; ?>"> 
 <input type="hidden" name="tareotfecfin" value="<?php echo $tareotfecfin; ?>"> 
 <input type="hidden" name="tareotsecuen" value="<?php echo $tareotsecuen; ?>"> 
 <input type="hidden" name="tareotfin" value="<?php echo $tareotfin; ?>"> 
 <input type="hidden" name="usuacodi" value="<?php echo $usuacodi; ?>"> 
 <input type="hidden" name="otestacodigo" value="<?php echo $otestacodigo; ?>"> 
 <input type="hidden" name="prioricodigo" value="<?php echo $prioricodigo; ?>"> 
 <input type="hidden" name="tipcumcodigo" value="<?php echo $tipcumcodigo; ?>"> 
 <input type="hidden" name="accionconsultartareot" value="<?php echo $accionconsultartareot; ?>"> 
 <input type="hidden" name="mov"> 
 </form> 
 </body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
