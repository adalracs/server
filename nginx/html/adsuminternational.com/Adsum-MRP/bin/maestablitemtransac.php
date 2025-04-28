<?php  
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/sesion/fnccantrow1.php');
include ( '../src/FunPerPriNiv/limitscan.php');
include ( '../src/FunPerSecNiv/fncconn.php'); 
include ( '../src/FunPerSecNiv/fncclose.php'); 
include ( '../src/FunPerSecNiv/fncfetch.php'); 
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
include('../src/FunPerPriNiv/pktblproveedo.php');
include('../src/FunPerPriNiv/pktblbodega.php');
include ( '../src/FunGen/sesion/fncalmdat.php');
include ( '../src/FunGen/sesion/fnccaf.php');

$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
if($accionconsultaritem)
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
	if(!$nusw){
		$accionconsultaritem = 0;
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
<title>Registros de item</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de item</font><br><br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
  <tr> 
  <td> 
  <?php 
    if($reccomact[consultar]){
  	echo '       <input type="image" name="consultar"  src="../img/consulta.gif"
onclick="form1.action='."'".'consultaritemtransac.php'."'".';"  width="86" height="18" 
alt="Consultar Registro" border=0>'; 
  }
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="form1.mov.value='menos';form1.action='maestablitemtransac.php';" alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50"> 
  <?php  
  $intervalo = fncaumdec('item',$inicio,$fin,$mov,$accionconsultaritem,$recarreglo);
  $cantrow = $intervalo[total];
  if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="form1.mov.value='mas';form1.action='maestablitemtransac.php';" alt="Siguiente"></td> 
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
<td width="30%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Nombre</font></span></td> 
<td width="12%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Cant. Disponible</font></span></td> 
<td width="24%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Bodega</font></span></td> 
<td width="26%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Proveedor</font></span></td> 
</tr> 
<?php  
include ('../src/FunGen/sesion/fncvisregitemtransac.php');
$reg[0] = 'itemcodigo';
$reg1[0] = 'n';
$nureturn = fncvisregitemtransac('item',$reg,$reg1,$idtrans);
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
   <td><a href="javascript:;" ><img src="../img/ayuda.gif" border="0" alt="Ayuda"></a></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="form1.mov.value='primero';form1.action='maestablitemtransac.php';" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onclick="form1.mov.value='menos';form1.action='maestablitemtransac.php';" 
alt="Anterior"></td> 
   <td width="50"> 
<?php  
echo '<font color="#006699" size="2" face="Arial, Helvetica,
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font>'; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="form1.mov.value='ultimo';form1.action='maestablitemtransac.php';" alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="form1.mov.value='ultimo';form1.action='maestablitemtransac.php';" alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php  echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php  echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php  echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="item"> 
<input type="hidden" name="columnas" value="itemcodigo, 
proveecodigo, 
bodegacodigo, 
unidadcodigo,
cencoscodigo,
itemnombre,
itemcanmin,
itemcanmax, 
itemvalor, 
itemnota,
itemdispon
"> 
 <input type="hidden" name="itemcodigo" value="<?php  echo $itemcodigo; ?>"> 
 <input type="hidden" name="proveecodigo" value="<?php  echo $proveecodigo; ?>"> 
 <input type="hidden" name="bodegacodigo" value="<?php  echo $bodegacodigo; ?>"> 
 <input type="hidden" name="cencoscodigo" value="<?php  echo $cencoscodigo; ?>"> 
 <input type="hidden" name="itemnombre" value="<?php  echo $itemnombre; ?>"> 
 <input type="hidden" name="itemcanmin" value="<?php  echo $itemcanmin; ?>"> 
 <input type="hidden" name="itemcanmax" value="<?php  echo $itemcanmax; ?>"> 
 <input type="hidden" name="itemvalor" value="<?php  echo $itemvalor; ?>"> 
 <input type="hidden" name="itemnota" value="<?php  echo $itemnota; ?>"> 
 <input type="hidden" name="itemdispon" value="<?php  echo $itemdispon; ?>"> 
 <input type="hidden" name="accionconsultaritem" value="<?php  echo $accionconsultaritem; ?>"> 
 <input type="hidden" name="accionconsultartransacitem" value="<?php  echo $accionconsultartransacitem; ?>"> 
 <input type="hidden" name="accioneditartransacitem" value="<?php  echo $accioneditartransacitem; ?>"> 
 <input type="hidden" name="mov"> 
 <input type="hidden" name="tipmovcodigo" value="<?php  echo $tipmovcodigo; ?>"> 
 <input type="hidden" name="transitecodigo" value="<?php  echo $transitecodigo; ?>"> 
 <input type="hidden" name="usuacodi" value="<?php  echo $usuacodi; ?>"> 
 <input type="hidden" name="transitecantid" value="<?php  echo $transitecantid; ?>"> 
 <input type="hidden" name="transitefecha" value="<?php  echo $transitefecha; ?>"> 
 <input type="hidden" name="flageditartransacitem"> 
 <input type="hidden" name="accionnuevoitem"> 
 
 <input type="hidden" name="flagsoliotitem" value="<?php  echo $flagsoliotitem; ?>"> 
 </form> 
 </body> 
<?php  
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
