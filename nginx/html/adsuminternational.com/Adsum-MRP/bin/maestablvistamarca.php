<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
//include ( '../src/FunGen/sesion/fncvalses.php'); 
/**/
include ( '../src/FunPerSecNiv/fncconn.php'); 
include ( '../src/FunPerSecNiv/fncclose.php'); 
include ( '../src/FunPerSecNiv/fncnumreg.php'); 
include ( '../src/FunPerSecNiv/fncfetch.php'); 
/**/
include ( '../src/FunPerPriNiv/pktblequipo.php'); 
include ( '../src/FunPerPriNiv/pktblvistamarca.php'); 
include ( '../src/FunGen/sesion/fncalmdat.php'); 
include ( '../src/FunGen/sesion/fnccaf.php'); 
//$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 
if($accionconsultarequipo)
{
	//sinclude ( '../src/FunGen/sesion/fncalmdatc.php');
	$nusw = 0;
	$nombcamp = strtok ($columnas,",");
	while ($nombcamp)
	{
		$nombcamp = trim($nombcamp);
		$recarreglo[$nombcamp] = $$nombcamp;
		if($recarreglo[$nombcamp] != null){ $nusw =1;}
		$nombcamp = strtok(",");
	}
	if(!$nusw){
		$accionconsultarequipo = 0;
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
<title>Registros de marcas</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de marcas</font><br>
  <br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
  <tr> 
  <td> 
  <?php 
echo '            <input type="image" name="consultar"  
src="../img/consulta.gif" 
onclick="form1.action='."'".'consultarvistamarca.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0>';
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="form1.mov.value = 'menos'; form1.action='maestablvistamarca.php';" alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50"> 
  <?php 
	$intervalo = fncaumdec('vistamarca',$inicio,$fin,$mov,$accionconsultarequipo,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas'; form1.action='maestablvistamarca.php';" alt="Siguiente"></td> 
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
<td width="92%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Marca</font></span></td>
</tr> 
<?php
	include ( '../src/FunGen/sesion/fncvisregvistamarca.php');
	$reg[0] = 'equipomarca';
	$reg1[0] = 's';
	$nureturn = fncvisregvistamarca('vistamarca',$reg,$reg1,$idtrans);
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
   <td><img src="../img/ayuda.gif" border="0" alt="Ayuda"></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="form1.mov.value = 'primero'; form1.action='maestablvistamarca.php';" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onclick="form1.mov.value = 'menos'; form1.action='maestablvistamarca.php';" 
alt="Anterior"></td> 
   <td width="50"> 
<?php 
echo '<font color="#006699" size="2" face="Arial, Helvetica, 
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font>'; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas'; form1.action='maestablvistamarca.php';" alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="form1.mov.value = 'ultimo'; form1.action='maestablvistamarca.php';" alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="equipo"> 
<input type="hidden" name="columnas" value="equipomarca">
 <input type="hidden" name="equipomarca" value="<?php echo $equipomarca;?>">
 <input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo;?>">
 <input type="hidden" name="sistemcodigo" value="<?php echo $sistemcodigo;?>">
 <input type="hidden" name="accionconsultarequipo" value="<?php echo $accionconsultarequipo; ?>"> 
 <input type="hidden" name="mov"> 
  </form> 
 </body> 
<?php 
if(!$codigo) 
{ echo " -->"; } 
?> 
</html> 
