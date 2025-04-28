<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblbodega.php'); 
include ( '../src/FunGen/sesion/fncalmdat.php'); 
include ( '../src/FunGen/sesion/fnccaf.php'); 

$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 

if($accionborrarbodega) 
{ 
	include ( 'borrabodega.php'); 
} 
else 
{
	if($accionconsultarbodega)
	{
		//include ( '../src/FunGen/sesion/fncalmdatc.php');
		$nusw = 0;
		$nombcamp = strtok ($columnas,",");
		while ($nombcamp)
		{
			$nombcamp = trim($nombcamp);
			if($nombcamp == "usuacodi")
				$recarreglo[$nombcamp] = $usuacodigo;
			else 
				$recarreglo[$nombcamp] = $$nombcamp;
			if($recarreglo[$nombcamp] != null){ $nusw =1;}
				$nombcamp = strtok(",");
		}
		if(!$nusw){
			$accionconsultarbodega = 0;
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
<title>Registros de bodega</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de areas de vigilancia </font><br>
  <br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
  <tr> 
  <td><a href="ingrnuevareavigi.php">Area de vigilancia</a></td> 
  <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos';form1.action='maestablbodega.php';" alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50">
  <?php
	$intervalo = fncaumdec('bodega',$inicio,$fin,$mov,$accionconsultarbodega,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestablbodega.php';" alt="Siguiente"></td> 
 </tr>
 <tr>
  <td colspan="6"><div align="right"> 
   <?php 
if($reccomact[detallar]){ 
echo '<b><input type="image" name="detallar" src="../img/verdetal.gif" 
onclick="form1.action='."'".'detallarbodega.php'."'".';"  width="87" 
height="19"  alt="Ver detalle" border=0 ';
if($flagcheck)
	echo "disabled";
echo '></b>';
} 
if($reccomact[borrar])
{
	echo  '<b><input type="image" name="borrar"  src="../img/borrar.gif"
onclick="';
	if($flagcheck)
	{
		echo 'cargarcheck(this.form); ';
		echo 'form1.action='."'".'maestablborrgen.php';
	}
	else echo 'form1.action='."'".'borrarbodega.php';
	
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){ 
echo '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editarbodega.php'."'".';"  width="87" height="19"  
alt="Modificar Registro" border=0 ';
if($flagcheck)
	echo "disabled";
echo '></b>';
} 
?> 
 </div></td> 
 </tr> 
 <tr> 
  <td colspan="6"> 
  <table width="100%" border="0" align="center" cellspacing="2" 
cellpadding="1"> 
<tr> 
<td width="14%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF"><a href="#" onClick="setForm('<?php echo $inicio;?>', '<?php echo $fin;?>', '<?php echo $mov;?>');" style="text-decoration:none; color:#FFFFFF;">Selec.&nbsp;<input type="<?php if($flagcheck) echo "radio"; else echo "checkbox"; ?>"></a></font></span></td> 
<td width="8%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td> 
<td width="40%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Nombre</font></span></td> 
<td width="38%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Ubicaci&oacute;n</font></span></td> 
</tr> 
<?php 
include ( '../src/FunGen/sesion/fncvisregbodega.php'); 
	$reg[0] = 'bodegacodigo'; 
	$reg1[0] = 'n'; 
	$nureturn = fncvisregbodega('bodega', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
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
onclick="form1.action='."'".'detallarbodega.php'."'".';"  width="87" 
height="19" alt="Ver detalle" border=0 ';
if($flagcheck)
	echo "disabled";
echo '></b>';
} 
if($reccomact[borrar])
{
	echo  '<b><input type="image" name="borrar"  src="../img/borrar.gif"
onclick="';
	if($flagcheck)
	{
		echo 'cargarcheck(this.form); ';
		echo 'form1.action='."'".'maestablborrgen.php';
	}
	else echo 'form1.action='."'".'borrarbodega.php';
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){ 
echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editarbodega.php'."'".';"  width="87" height="19" 
alt="Modificar Registro" border=0 ';
if($flagcheck)
	echo "disabled";
echo '></b>';
} 
?> 
  </div> 
  </td> 
  </tr> 
  <tr> 
   <td><a href= "javascript:;"><img type="image" src="../img/ayuda.gif" name="Ayuda" onClick="window.open('navegacion.htm','ambinave','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Ayuda" border=0 ></a></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'primero';form1.action='maestablbodega.php';" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos';form1.action='maestablbodega.php';" 
alt="Anterior"></td>
   <td width="50">
<?php
echo '<div align="center"><font color="#006699" size="2" face="Arial, Helvetica, 
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font></div>'; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestablbodega.php';" alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'ultimo';form1.action='maestablbodega.php';" alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="bodega"> 
<input type="hidden" name="columnas" value="bodegacodigo, 
bodeganombre, 
usuacodi, 
bodegaubicac, 
bodegacapaci, 
bodeganota,
cencosocodigo
"> 
 <input type="hidden" name="bodegacodigo" value="<?php echo $bodegacodigo; ?>"> 
 <input type="hidden" name="bodeganombre" value="<?php echo $bodeganombre; ?>"> 
 <input type="hidden" name="usuacodi" value="<?php echo $usuacodi; ?>"> 
 <input type="hidden" name="bodegaubicac" value="<?php echo $bodegaubicac; ?>"> 
 <input type="hidden" name="bodegacapaci" value="<?php echo $bodegacapaci; ?>"> 
 <input type="hidden" name="bodeganota" value="<?php echo $bodeganota; ?>"> 
 <input type="hidden" name="cencoscodigo" value="<?php echo $cencoscodigo; ?>"> 
 <input type="hidden" name="accionconsultarbodega" value="<?php echo 
$accionconsultarbodega; ?>"> 
 <input type="hidden" name="mov">
 <!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
<!-- Campos a visualizar en maestablborrgen		-->
<input type="hidden" name="selcampos" value="bodegacodigo, bodeganombre, bodegaubicac">
<!--											-->
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
<input type="hidden" name="arreglo_b">
<!--											-->
</form> 
 </body> 
<?php 
if(!$codigo) 
{ echo " -->"; } 
?> 
</html> 
