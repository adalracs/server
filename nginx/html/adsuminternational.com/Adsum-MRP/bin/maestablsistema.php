<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/sesion/fnccantrow1.php');
include ( '../src/FunPerPriNiv/limitscan.php');
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunGen/sesion/fncalmdat.php');
include ( '../src/FunGen/sesion/fnccaf.php');

$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

if($accionborrarsistema){
	include ( 'borrasistema.php');
}else{

		
	if($accionconsultarsistema == 1){
		//include ( '../src/FunGen/sesion/fncalmdatc.php');
		$nusw = 0;
		$nombcamp = strtok ($columnas,",");
		while ($nombcamp){
			$nombcamp = trim($nombcamp);
			$recarreglo[$nombcamp] = $$nombcamp;
			if($recarreglo[$nombcamp] != null){ $nusw =1;}
			$nombcamp = strtok(",");
		}
		if(!$nusw){
			$accionconsultarsistema = 0;		
		}
	}

	if($recarreglo){
		if(!$recarreglo[plantacodigo]){
			$recarreglo[plantacodigo] = $GLOBALS[usuaplanta];
			$accionconsultarsistema = 1;
		}
	}else{
		unset($recarreglo);
		$recarreglo[plantacodigo] = $GLOBALS[usuaplanta];
		$accionconsultarsistema = 1;
	}
}

include ( '../src/FunGen/sesion/fncaumdec.php');
include('../src/FunGen/fncpageposition.php');
  $intervalo = fncaumdec('sistema',$inicio,$fin,$mov,$accionconsultarsistema,$recarreglo);
  $cantrow = $intervalo[total];
  if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
--=> cbedoya <=-07-09-2007-=> modificado para adaptación de los campos personalizados <=--
GenVers: 3.1 --> 
<html> 
<head> 
<title>Registros de sistema</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de procesos</font><br>
  <br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="65%"> 
 <tr> 
<td colspan="6" class="NoiseErrorDataTD">
<table border="0" cellspacing="0" cellpadding="0" align="center"  width="100%"> 
	<tr>
		<td class="NoiseErrorDataTD" align="right"><?php page_position($intervalo,'maestablsistema.php',$flagcheck); ?></td>
	</tr>
</table>
</td> 
 </tr>
  <tr> 
  <td> 
  <?php 
  if($reccomact[nuevo]){
  	echo '       <input type="image" name="nuevo"  src="../img/nuevo.gif"
onclick="form1.action='."'".'ingrnuevsistema.php'."'".';"  width="86" 
height="18" alt="Nuevo Registro" border=0 ';
if($flagcheck)
	echo "disabled";
echo '>';
}
  if($reccomact[consultar]){
  	echo '            <input type="image" name="consultar"
src="../img/consulta.gif" 
onclick="form1.action='."'".'consultarsistema.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0 ';
if($flagcheck)
	echo "disabled";
echo '>'; 
}
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos';form1.action='maestablsistema.php';" alt="Anterior"></td> 
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
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestablsistema.php';" alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right"> 
   <?php 
   if($reccomact[detallar]){
   	echo '<b><input type="image" name="detallar" src="../img/verdetal.gif"
onclick="form1.action='."'".'detallarsistema.php'."'".';"  width="87" 
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
	else echo 'form1.action='."'".'borrarsistema.php';
	
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
   if($reccomact[modificar]){
   	echo '<b><input type="image" name="modificar"  src="../img/modifica.gif"
onclick="form1.action='."'".'editarsistema.php'."'".';"  width="87" height="19" 
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
<td width="12%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF"><a href="#" onclick="setForm('<?php echo $inicio;?>', '<?php echo $fin;?>', '<?php echo $mov;?>');" style="text-decoration:none; color:#FFFFFF;">Sel.&nbsp;<input type="<?php if($flagcheck) echo "radio"; else echo "checkbox"; ?>"></a></font></span></td> 
<td width="12%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td> 
<td width="38%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Nombre</font></span></td> 
<td width="38%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Planta</font></span></td> 
</tr> 
<?php 
include ( '../src/FunGen/sesion/fncvisregsistema.php');
$reg[0] = 'sistemcodigo';
$reg1[0] = 'n';
$nureturn = fncvisregsistema('sistema', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
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
onclick="form1.action='."'".'detallarsistema.php'."'".';"  width="87" 
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
	else echo 'form1.action='."'".'borrarsistema.php';
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){
	echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif"
onclick="form1.action='."'".'editarsistema.php'."'".';"  width="87" height="19" 
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
   <td><a href="javascript:;" ><img type="image" src="../img/ayuda.gif" name="Ayuda" onclick="window.open('navegacion.htm','ambinave','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Ayuda" border=0 ></a></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'primero';form1.action='maestablsistema.php';" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos';form1.action='maestablsistema.php';" 
alt="Anterior"></td> 
   <td width="50"> 
<?php 
        	echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestablsistema.php';" alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'ultimo';form1.action='maestablsistema.php';" alt="Ultimo"></td> 
  </tr> 
  <tr> 
 <td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablsistema.php',$flagcheck); ?></td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="sistema"> 
<input type="hidden" name="columnas" value="sistemcodigo, 
plantacodigo, 
sistemnombre, 
sistemdescri
"> 
 <input type="hidden" name="sistemcodigo" value="<?php echo $sistemcodigo; ?>"> 
 <input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>"> 
 <input type="hidden" name="sistemnombre" value="<?php echo $sistemnombre; ?>"> 
 <input type="hidden" name="sistemdescri" value="<?php echo $sistemdescri; ?>"> 
 <input type="hidden" name="accionconsultarsistema" value="<?php echo $accionconsultarsistema; ?>"> 
 <input type="hidden" name="mov"> 
 <!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
<!-- Campos a visualizar en maestablborrgen		-->
<input type="hidden" name="selcampos" value="sistemcodigo, sistemnombre">
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
