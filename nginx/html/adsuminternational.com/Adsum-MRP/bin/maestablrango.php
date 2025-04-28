<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblrango.php'); 
include ( '../src/FunGen/sesion/fncalmdat.php'); 
include ( '../src/FunGen/sesion/fnccaf.php'); 
$reccomact.= fnccaf($GLOBALS[usuacodi],$PATH_TRANSLATED); 
if($accionborrarrango) 
{ 
	include ( 'borrarango.php'); 
} 
else 
{ 
		if($accionconsultarrango) 
			{ 
//				include ( '../src/FunGen/sesion/fncalmdatc.php'); 
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
					$accionconsultarrango = 0; 
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
<title>Registros de rango</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de rango</font><br><br></p> 
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
onclick="form1.action='."'".'ingrnuevrango.php'."'".';"  width="86" height="18" 
alt="Nuevo Registro" border=0>'; 
} 
if($reccomact[consultar]){ 
echo '       <input type="image" name="consultar"  src="../img/consulta.gif" 
onclick="form1.action='."'".'consultarrango.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0>'; 
} 
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="form1.mov.value = 'menos';form1.action='maestablrango.php';" 
alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50"> 
  <?php 
	$intervalo = fncaumdec 
('rango',$inicio,$fin,$mov,$accionconsultarrango,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas';form1.action='maestablrango.php';" 
alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right"> 
   <?php 
if($reccomact[detallar]){ 
echo '<b><input type="image" name="detallar" src="../img/verdetal.gif" 
onclick="form1.action='."'".'detallarrango.php'."'".';"  width="87" height="19" 
 alt="Ver detalle" border=0></b>'; 
} 
if($reccomact[borrar]){ 
echo '<b><input type="image" name="borrar"  src="../img/borrar.gif" 
onclick="form1.action='."'".'borrarrango.php'."'".';"  width="87" height="19"  
alt="Borrar Registro" border=0></b>'; 
} 
if($reccomact[modificar]){ 
echo '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editarrango.php'."'".';"  width="87" height="19"  
alt="Modificar Registro" border=0></b>'; 
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
<td width="46%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td> 
<td width="46%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Descripci&oacute;n</font></span></td> 
</tr> 
<?php 
include ( '../src/FunGen/sesion/fncvisreg.php'); 
	$reg[0] = 'rangocodigo'; 
	$reg1[0] = 'n'; 
	$nureturn = fncvisreg('rango',$reg,$reg1,$idtrans); 
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
onclick="form1.action='."'".'detallarrango.php'."'".';"  width="87" height="19" 
alt="Ver detalle" border=0></b>'; 
} 
if($reccomact[borrar]){ 
echo  '<b><input type="image" name="borrar"  src="../img/borrar.gif" 
onclick="form1.action='."'".'borrarrango.php'."'".';"  width="87" height="19" 
alt="Borrar Registro" border=0></b>'; 
} 
if($reccomact[modificar]){ 
echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editarrango.php'."'".';"  width="87" height="19" 
alt="Modificar Registro" border=0></b>'; 
} 
?> 
  </div> 
  </td> 
  </tr> 
  <tr> 
   <td><img src="../img/ayuda.gif" border="0" alt="Ayuda"></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="form1.mov.value = 'primero';form1.action='maestablrango.php';" 
alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onclick="form1.mov.value = 
'menos';form1.action='maestablrango.php';" alt="Anterior"></td> 
   <td width="50"> 
<?php 
echo '<font color="#006699" size="2" face="Arial, Helvetica, 
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font>'; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas';form1.action='maestablrango.php';" 
alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="form1.mov.value = 'ultimo';form1.action='maestablrango.php';" 
alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="rango"> 
<input type="hidden" name="columnas" value="rangocodigo, 
rangomedini, 
rangomedfin, 
rangodescri 
"> 
 <input type="hidden" name="rangocodigo" value="<?php echo $rangocodigo; ?>"> 
 <input type="hidden" name="rangomedini" value="<?php echo $rangomedini; ?>"> 
 <input type="hidden" name="rangomedfin" value="<?php echo $rangomedfin; ?>"> 
 <input type="hidden" name="rangodescri" value="<?php echo $rangodescri; ?>"> 
 <input type="hidden" name="accionconsultarrango" value="<?php echo 
$accionconsultarrango; ?>"> 
 <input type="hidden" name="mov"> 
 </form> 
 </body> 
<?php 
if(!$codigo) 
{ echo " -->"; } 
?> 
</html> 
