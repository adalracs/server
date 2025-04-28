<?php 
ob_start(); 

// -------------------------------------------
include ('../src/FunPerSecNiv/fncconn.php');
include ('../src/FunPerSecNiv/fncclose.php');
include ('../src/FunPerSecNiv/fncnumreg.php');
include ('../src/FunPerSecNiv/fncfetch.php');
// -------------------------------------------

include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
include ( '../src/FunPerPriNiv/pktbltipocomponen.php');
include ( '../src/FunPerPriNiv/pktblcamperequipo.php'); 
include ( '../src/FunPerPriNiv/pktbltipocomponencamperequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponencamperequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunGen/sesion/fncalmdat.php'); 
include ( '../src/FunGen/sesion/fnccaf.php'); 
include ( '../src/FunGen/fncborrareg.php'); 

//$reccomact = fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 
if($accionborrartipocomponen) 
{ 
	include ( 'borratipocomponen.php'); 
} 
else 
{ 
		if($accionconsultartipocomponen) 
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
					$accionconsultartipocomponen = 0; 
				} 
			} 
	} 
include ( '../src/FunGen/sesion/fncaumdec.php'); 
include('../src/FunGen/fncpageposition.php');
$intervalo = fncaumdec 
('tipocomponen',$inicio,$fin,$mov,$accionconsultartipocomponen,$recarreglo); 
$cantrow = $intervalo[total]; 
if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados-

Autor:  
Fecha: 
 --> 
<html> 
<head> 
<title>Registros de tipos de componente</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado tipos de componente</font><br>
  <br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE" width="60%"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestabltipocomponenaux.php',$flagcheck); ?></td> 
 </tr> 
  <tr> 
  <td> 
  <?php 
  
if($reccomact[nuevo]){ 
echo '       <input type="image" name="nuevo"  src="../img/nuevo.gif" 
onclick="form1.action='."'".'ingrnuevtipocomponen.php'."'".';"  width="86" 
height="18" alt="Nuevo Registro" border=0 ';
if($flagcheck)
	echo "disabled";
echo '>';
} 

echo '       <input type="image" name="consultar"  src="../img/consulta.gif" 
onclick="form1.action='."'".'consultartipocomponenaux.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0 ';
if($flagcheck)
	echo "disabled";
echo '>'; 

?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos';form1.action='maestabltipocomponenaux.php';" 
alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50"> 
  <?php 
        	echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; 
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestabltipocomponenaux.php';" 
alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right"> 
   <?php 
if($reccomact[detallar]){ 
echo '<b><input type="image" name="detallar" src="../img/verdetal.gif" 
onclick="form1.action='."'".'detallartipocomponen.php'."'".';"  width="87" 
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
	else echo 'form1.action='."'".'borrartipocomponen.php';
	
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){ 
echo '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editartipocomponen.php'."'".';"  width="87" 
height="19"  alt="Modificar Registro" border=0 ';
if($flagcheck)
	echo "disabled";
echo '></b>'; 
}
?>
 </div></td> 
 </tr> 
 <tr> 
  <td colspan="6"> 
  <table width="100%" border="0" align="center" cellspacing="1" 
cellpadding="1"> 
<tr>
<td width="14%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Sel.&nbsp;</font></span></td> 
<td width="14%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td> 
<td width="58%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Nombre</font></span></td>
<td width="14%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Acr&oacute;nimo</font></span></td>
</tr> 
<?php 
include ( '../src/FunGen/sesion/fncvisregtipocomponenaux.php');

	$reg[0] = 'tipcomcodigo'; 
	$reg1[0] = 'n'; 
	$nureturn = fncvisregtipos('tipocomponen', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
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
onclick="form1.action='."'".'detallartipocomponen.php'."'".';"  width="87" 
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
	else echo 'form1.action='."'".'borrartipocomponen.php';
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){ 
echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editartipocomponen.php'."'".';"  width="87" 
height="19" alt="Modificar Registro" border=0 ';
if($flagcheck)
	echo "disabled";
echo '></b>';
}
?>
  </div> 
  </td> 
  </tr> 
  <tr> 
   <td><img src="../img/ayuda.gif" border="0" alt="Ayuda"></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'primero';form1.action='maestabltipocomponenaux.php';" 
alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 
'menos';form1.action='maestabltipocomponenaux.php';" alt="Anterior"></td> 
   <td width="50"> 
<?php 
        	echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total];  
?>
   </td>
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestabltipocomponenaux.php';" 
alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'ultimo';form1.action='maestabltipocomponenaux.php';" 
alt="Ultimo"></td> 
  </tr> 
  <tr> 
 <td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestabltipocomponenaux.php',$flagcheck); ?></td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="tipocomponen">
<input type="hidden" name="columnas" value="tipcomcodigo,
tipcomnombre, 
tipcomdescri, 
tipcomcampo 
"> 
 <input type="hidden" name="tipcomcodigo" value="<?php echo $tipcomcodigo; ?>"> 
 <input type="hidden" name="tipcomnombre" value="<?php echo $tipcomnombre; ?>"> 
 <input type="hidden" name="tipcomdescri" value="<?php echo $tipcomdescri; ?>"> 
 <input type="hidden" name="tipcomcampo" value="<?php echo $tipcomcampo; ?>"> 
 <input type="hidden" name="tipcomacroni" value="<?php echo $tipcomacroni; ?>"> 
 <input type="hidden" name="accionconsultartipocomponen" value="<?php echo 
$accionconsultartipocomponen; ?>"> 
 <input type="hidden" name="mov"> 
 <!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
<!-- Campos a visualizar en maestablborrgen		-->
<input type="hidden" name="selcampos" value="tipcomcodigo, tipcomnombre, tipcomacroni">
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