<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblvistaprogram.php'); 
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktbltipomedi.php');
include ( '../src/FunGen/sesion/fncalmdat.php'); 
include ( '../src/FunGen/sesion/fnccaf.php'); 
session_unregister("arrtransac");
session_unregister("arrtransaccod");
session_unregister("arrtransacherr");
session_unregister("flagsoliot");
session_unregister("arrtransacitem");
session_unregister("arrtransaccoditem");
session_unregister("arrtransacite");
session_unregister("flagsoliotitem");
$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 
if($accionborrarprogramacion) 
{ 
	include ( 'borraprogramacion.php'); 
} 
else 
{ 
		if($accionconsultarprogramacion) 
			{ 
				//include ( '../src/FunGen/sesion/fncalmdatc.php'); 
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
					$accionconsultarprogramacion = 0; 
				} 
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
<title>Registros de programacion</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de programaci&oacute;n</font><br><br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
  <tr> 
  <td> 
  <?php 
if($reccomact[nuevo]){ 
echo '       <input type="image" name="nuevo"  src="../img/nuevo.gif" 
onclick="form1.action='."'".'ingrnuevprogramacion.php'."'".';"  width="86" 
height="18" alt="Nuevo Registro" border=0>'; 
} 
if($reccomact[consultar]){ 
echo '       <input type="image" name="consultar"  src="../img/consulta.gif" 
onclick="form1.action='."'".'consultarprogramacion.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0>'; 
} 
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="form1.mov.value = 'menos';form1.action='maestablprogramacion.php';" 
alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50"> 
  <?php 
	$intervalo = fncaumdec('programacion',$inicio,$fin,$mov,$accionconsultarprogramacion,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas';form1.action='maestablprogramacion.php';" 
alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right"> 
   <?php 
if($reccomact[detallar]){ 
echo '<b><input type="image" name="detallar" src="../img/verdetal.gif" 
onclick="form1.action='."'".'detallarprogramacion.php'."'".';"  width="87" 
height="19"  alt="Ver detalle" border=0></b>'; 
} 
if($reccomact[borrar]){ 
echo '<b><input type="image" name="borrar"  src="../img/borrar.gif" 
onclick="form1.action='."'".'borrarprogramacion.php'."'".';"  width="87" 
height="19"  alt="Borrar Registro" border=0></b>'; 
} 
if($reccomact[modificar]){ 
echo '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editarprogramacion.php'."'".';"  width="87" 
height="19"  alt="Modificar Registro" border=0></b>'; 
} 
?> 
 </div></td> 
 </tr> 
 <tr> 
  <td colspan="6"> 
  <table width="100%" border="0" align="center" cellspacing="2" 
cellpadding="1"> 
<tr> 
<td width="8%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Selec.</font></span></td> 
<td width="10%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td> 
<td width="22%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Taller</font></span></td> 
<td width="20%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Equipo</font></span></td> 
<td width="15%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Tipo de medidor</font></span></td> 
<td width="15%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Frecuencia</font></span></td> 
<td width="10%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Cantidad</font></span></td> 
</tr> 
<?php 
if($empleacod)
{
	include ( '../src/FunGen/sesion/fncvisregusuariotareot.php');
	$reg[0] = 'usutarcodigo';
	$reg1[0] = 'n';
	$nureturn = fncvisregusuariotareot('usuariotareot',$reg,$reg1,$idtrans);
}elseif($tareacodigo || $tiptracodigo)
{
	include ( '../src/FunGen/sesion/fncvisregtareaot.php');
	$reg[0] = 'tareotcodigo';
	$reg1[0] = 'n';
	$nureturn = fncvisregtareaot('tareot',$reg,$reg1,$idtrans);
}else
{
	include ( '../src/FunGen/sesion/fncvisregprogramacion.php');
	$reg[0] = 'progracodigo';
	$reg1[0] = 'n';
	$nureturn = fncvisregprogramacion('programacion',$reg,$reg1,$idtrans);
}
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
onclick="form1.action='."'".'detallarprogramacion.php'."'".';"  width="87" 
height="19" alt="Ver detalle" border=0></b>'; 
} 
if($reccomact[borrar]){ 
echo  '<b><input type="image" name="borrar"  src="../img/borrar.gif" 
onclick="form1.action='."'".'borrarprogramacion.php'."'".';"  width="87" 
height="19" alt="Borrar Registro" border=0></b>'; 
} 
if($reccomact[modificar]){ 
echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editarprogramacion.php'."'".';"  width="87" 
height="19" alt="Modificar Registro" border=0></b>'; 
} 
?> 
  </div> 
  </td> 
  </tr> 
  <tr> 
   <td><img src="../img/ayuda.gif" border="0" alt="Ayuda"></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="form1.mov.value = 'primero';form1.action='maestablprogramacion.php';" 
alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onclick="form1.mov.value = 
'menos';form1.action='maestablprogramacion.php';" alt="Anterior"></td> 
   <td width="50"> 
<?php 
echo '<font color="#006699" size="2" face="Arial, Helvetica, 
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font>'; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas';form1.action='maestablprogramacion.php';" 
alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="form1.mov.value = 'ultimo';form1.action='maestablprogramacion.php';" 
alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="vistaprogram"> 
<input type="hidden" name="columnas" value="progracodigo, 
prioricodigo,
equipocodigo,
sistemcodigo,
plantacodigo,
componcodigo,
tipmedcodigo, 
prografecgen, 
prograhorgen, 
prografrecue, 
prografecini,
prograhorini, 
progratiedur,
progranota,
progracantid,
tipmancodigo,
usuacodi, 
tareacodigo,
tiptracodigo
"> 
 <input type="hidden" name="progracodigo" value="<?php echo $progracodigo; ?>"> 
 <input type="hidden" name="prioricodigo" value="<?php echo $prioricodigo; ?>"> 
 <input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo; ?>"> 
 <input type="hidden" name="sistemcodigo" value="<?php echo $sistemcodigo; ?>"> 
 <input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>"> 
 <input type="hidden" name="componcodigo" value="<?php echo $componcodigo; ?>"> 
 <input type="hidden" name="tipmedcodigo" value="<?php echo $tipmedcodigo; ?>"> 
 <input type="hidden" name="usuacodi" value="<?php echo $empleacod; ?>"> 
 <input type="hidden" name="prografecgen" value="<?php echo $prografecgen; ?>"> 
 <input type="hidden" name="prograhorgen" value="<?php echo $prograhorgen; ?>"> 
 <input type="hidden" name="prografrecue" value="<?php echo $prografrecue; ?>">
 <input type="hidden" name="prografecini" value="<?php echo $prografecini; ?>">
 <input type="hidden" name="prograhorini" value="<?php echo $prograhorini; ?>">
 <input type="hidden" name="progratiedur" value="<?php echo $progratiedur; ?>"> 
 <input type="hidden" name="progranota" value="<?php echo $progranota; ?>"> 
 <input type="hidden" name="progracantid" value="<?php echo $progracantid; ?>"> 
 <input type="hidden" name="accionconsultarprogramacion" value="<?php echo $accionconsultarprogramacion; ?>"> 
 <input type="hidden" name="mov"> 
 </form> 
 </body> 
<?php 
if(!$codigo) 
{ echo " -->"; } 
?> 
</html> 
