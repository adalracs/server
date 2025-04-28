<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktbltiposistema.php');
include ( '../src/FunPerPriNiv/pktblcamperequipo.php'); 
include ( '../src/FunPerPriNiv/pktbltiposistemacamperequipo.php');
include ( '../src/FunPerPriNiv/pktblsistemacamperequipo.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunGen/sesion/fncalmdat.php'); 
include ( '../src/FunGen/sesion/fnccaf.php'); 
include ( '../src/FunGen/fncborrareg.php'); 

$reccomact = fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 
if($accionborrartiposistema) 
{ 
	include ( 'borratiposistema.php'); 
} 
else 
{ 
		if($accionconsultartiposistema) 
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
					$accionconsultartiposistema = 0; 
				} 
			} 
	} 
include ( '../src/FunGen/sesion/fncaumdec.php'); 
include('../src/FunGen/fncpageposition.php');
$intervalo = fncaumdec 
('tiposistema',$inicio,$fin,$mov,$accionconsultartiposistema,$recarreglo); 
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
<title>Registros de tipos de sistema</title> 
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
<p><font class="NoiseFormHeaderFont">Listado tipos de sistema</font><br>
  <br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestabltiposistema.php',$flagcheck); ?></td> 
 </tr> 
  <tr> 
  <td> 
  <?php 
  
if($reccomact[nuevo]){ 
echo '       <input type="image" name="nuevo"  src="../img/nuevo.gif" 
onclick="form1.action='."'".'ingrnuevtiposistema.php'."'".';"  width="86" 
height="18" alt="Nuevo Registro" border=0 ';
if($flagcheck)
	echo "disabled";
echo '>';
} 
if($reccomact[consultar]){ 
echo '       <input type="image" name="consultar"  src="../img/consulta.gif" 
onclick="form1.action='."'".'consultartiposistema.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0 ';
if($flagcheck)
	echo "disabled";
echo '>'; 
} 
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos';form1.action='maestabltiposistema.php';" 
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
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestabltiposistema.php';" 
alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right"> 
   <?php 
if($reccomact[detallar]){ 
echo '<b><input type="image" name="detallar" src="../img/verdetal.gif" 
onclick="form1.action='."'".'detallartiposistema.php'."'".';"  width="87" 
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
	else echo 'form1.action='."'".'borrartiposistema.php';
	
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){ 
echo '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editartiposistema.php'."'".';"  width="87" 
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
color="#FFFFFF"><a href="#" onClick="setForm('<?php echo $inicio;?>', '<?php echo $fin;?>', '<?php echo $mov;?>');" style="text-decoration:none; color:#FFFFFF;">Sel.&nbsp;<input type="<?php if($flagcheck) echo "radio"; else echo "checkbox"; ?>"></a></font></span></td> 
<td width="14%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td> 
<td width="60%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Nombre</font></span></td>
<td width="12%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Acr&oacute;nimo</font></span></td>
</tr> 
<?php 
include ( '../src/FunGen/sesion/fncvisregtipos.php'); 
	$reg[0] = 'tipsiscodigo'; 
	$reg1[0] = 'n'; 
	$nureturn = fncvisregtipos('tiposistema', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
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
onclick="form1.action='."'".'detallartiposistema.php'."'".';"  width="87" 
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
	else echo 'form1.action='."'".'borrartiposistema.php';
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){ 
echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editartiposistema.php'."'".';"  width="87" 
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
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'primero';form1.action='maestabltiposistema.php';" 
alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 
'menos';form1.action='maestabltiposistema.php';" alt="Anterior"></td> 
   <td width="50"> 
<?php 
        	echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; 
?>
   </td>
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestabltiposistema.php';" 
alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'ultimo';form1.action='maestabltiposistema.php';" 
alt="Ultimo"></td> 
  </tr> 
  <tr> 
 <td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestabltiposistema.php',$flagcheck); ?></td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="tiposistema">
<input type="hidden" name="columnas" value="tipsiscodigo,
tipsisnombre, 
tipsisdescri, 
tipsiscampo 
"> 
 <input type="hidden" name="tipsiscodigo" value="<?php echo $tipsiscodigo; ?>"> 
 <input type="hidden" name="tipsisnombre" value="<?php echo $tipsisnombre; ?>"> 
 <input type="hidden" name="tipsisdescri" value="<?php echo $tipsisdescri; ?>"> 
 <input type="hidden" name="tipsiscampo" value="<?php echo $tipsiscampo; ?>"> 
 <input type="hidden" name="tipsisacroni" value="<?php echo $tipsisacroni; ?>"> 
 <input type="hidden" name="accionconsultartiposistema" value="<?php echo 
$accionconsultartiposistema; ?>"> 
 <input type="hidden" name="mov"> 
 <!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
<!-- Campos a visualizar en maestablborrgen		-->
<input type="hidden" name="selcampos" value="tipsiscodigo, tipsisnombre, tipsisacroni">
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