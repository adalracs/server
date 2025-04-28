<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblcargo.php'); 
include ( '../src/FunGen/sesion/fncalmdat.php'); 
include ( '../src/FunGen/sesion/fnccaf.php'); 
include ( '../src/FunGen/fncborrareg.php');

$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 

if($accionborrarcargo) 
{ 
	include ( 'borracargo.php'); 
} 
else 
{
	if($accionconsultarcargo)
	{
//		include ( '../src/FunGen/sesion/fncalmdatc.php');
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
			$accionconsultarcargo = 0;
		}
	}
}
include ( '../src/FunGen/sesion/fncaumdec.php');
include('../src/FunGen/fncpageposition.php');

$intervalo = fncaumdec('cargo',$inicio,$fin,$mov,$accionconsultarcargo,$recarreglo); 
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
<title>Registros de cargo</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de cargos</font><br>
  <br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablcargo.php',$flagcheck); ?></td> 
 </tr> 
  <tr> 
  <td> 
  <?php 
if($reccomact[nuevo]){ 
echo '       <input type="image" name="nuevo"  src="../img/nuevo.gif" 
onclick="form1.action='."'".'ingrnuevcargo.php'."'".';"  width="86" height="18" 
alt="Nuevo Registro" border=0 ';
if($flagcheck)
	echo "disabled";
echo '>';
} 
if($reccomact[consultar]){ 
echo '            <input type="image" name="consultar"  
src="../img/consulta.gif" 
onclick="form1.action='."'".'consultarcargo.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0 ';
if($flagcheck)
	echo "disabled";
echo '>'; 
} 
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?> form1.mov.value = 'menos'; form1.action='maestablcargo.php';" alt="Anterior"></td> 
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
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?> form1.mov.value = 'mas'; form1.action='maestablcargo.php';" alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right"> 
   <?php 
if($reccomact[detallar]){ 
echo '<b><input type="image" name="detallar" src="../img/verdetal.gif" 
onclick="form1.action='."'".'detallarcargo.php'."'".';"  width="87" height="19" 
 alt="Ver detalle" border=0 ';
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
	else echo 'form1.action='."'".'borrarcargo.php';
	
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){ 
echo '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editarcargo.php'."'".';"  width="87" height="19"  
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
  <table width="100%" border="0" align="center" cellspacing="1" 
cellpadding="1"> 
<tr> 
<td width="14%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF"><a href="#" onclick="setForm('<?php echo $inicio;?>', '<?php echo $fin;?>', '<?php echo $mov;?>');" style="text-decoration:none; color:#FFFFFF;">Sel.&nbsp;<input type="<?php if($flagcheck) echo "radio"; else echo "checkbox"; ?>"></a></font></span></td> 
<td width="14%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td> 
<td width="72%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Nombre</font></span></td> 
</tr> 
<?php 
include ( '../src/FunGen/sesion/fncvisreg.php'); 
$reg[0] = 'cargocodigo'; 
$reg1[0] = 'n'; 
$nureturn = fncvisreg('cargo', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
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
onclick="form1.action='."'".'detallarcargo.php'."'".';"  width="87" height="19" 
alt="Ver detalle" border=0 ';
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
	else echo 'form1.action='."'".'borrarcargo.php';
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){ 
echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editarcargo.php'."'".';"  width="87" height="19" 
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
   <td><a href= "javascript:;"><img type="image" src="../img/ayuda.gif" name="Ayuda" onclick="window.open('ayudas/personal.html','personal','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=900,height=700');" width="86" height="18" alt="Ayuda" border=0 ></a></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?> form1.mov.value = 'primero'; form1.action='maestablcargo.php';" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta" src="../img/adelanta.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?> form1.mov.value = 'menos';form1.action='maestablcargo.php';" alt="Anterior"></td> 
   <td width="50"> 
<?php 
        	echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?> form1.mov.value = 'mas'; form1.action='maestablcargo.php';" alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?> form1.mov.value = 'ultimo'; form1.action='maestablcargo.php';" alt="Ultimo"></td> 
  </tr> 
  <tr> 
 <td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablcargo.php',$flagcheck); ?></td> 

  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="cargo"> 
<input type="hidden" name="columnas" value="cargocodigo, 
cargonombre, 
cargodescri, 
plantaubicac, 
plantaarea, 
plantadescri 
"> 
 <input type="hidden" name="cargocodigo" value="<?php echo $cargocodigo; ?>"> 
 <input type="hidden" name="cargonombre" value="<?php echo $cargonombre; ?>"> 
 <input type="hidden" name="cargodescri" value="<?php echo $cargodescri; ?>"> 
 <input type="hidden" name="plantaubicac" value="<?php echo $plantaubicac; ?>"> 
 <input type="hidden" name="plantaarea" value="<?php echo $plantaarea; ?>"> 
 <input type="hidden" name="plantadescri" value="<?php echo $plantadescri; ?>"> 
 <input type="hidden" name="accionconsultarcargo" value="<?php echo 
$accionconsultarcargo; ?>"> 
 <input type="hidden" name="mov"> 
<!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
<!-- Campos a visualizar en maestablborrgen		-->
<input type="hidden" name="selcampos" value="cargocodigo, cargonombre">
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