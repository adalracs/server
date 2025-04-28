<?php
session_start();
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/sesion/fnccantrow1.php');
include ( '../src/FunPerPriNiv/limitscanequipo.php');
include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncclose.php');
include('../src/FunPerSecNiv/fncfetch.php');
include('../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblvistaequipoplanta.php');
include ( '../src/FunPerPriNiv/pktblvistausuequplanta.php');
include ( '../src/FunPerPriNiv/pktblusuaequipo.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblestado.php');
include ( '../src/FunGen/sesion/fncalmdat.php');
include ( '../src/FunGen/sesion/fnccaf.php');
// -- campos personalizados
session_unregister('equicampos');
// --
$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
$GLOBALS[usuaplanta]=$codigo2;
if($accioneditar)
	$usuacodigo = null;

if($accionborrarequipo){
	include ( 'borraequipo.php');
}else{
	if($accionconsultarequipo){
		//include ( '../src/FunGen/sesion/fncalmdatc.php');
		if($usuacodigo){
			$accionconsultarusuaequipo = 1;
			$nusw = 0;
			$nombcamp = "usuequcodigo,usuacodi,equipocodigo,plantacodigo";
			$nombcamp = strtok ($nombcamp,",");
			while ($nombcamp){
				$nombcamp = trim($nombcamp);
				if($nombcamp == "usuacodi")
					$recarreglo[$nombcamp] = $usuacodigo;
				else
					$recarreglo[$nombcamp] = $$nombcamp;
					
				if($recarreglo[$nombcamp] != null){ $nusw =1;}
				$nombcamp = strtok(",");
			}
			if(!$nusw){
				$accionconsultarequipo = 0;
			}
		}else{
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
	}
		
	/*if(!$plantacodigo)
		$recarreglo[plantacodigo] =  $GLOBALS[usuaplanta];*/

	if(!$recarreglo){
		$accionconsultarequipo = 0;
	}else {
		$accionconsultarequipo = 1;
	}
}

include ( '../src/FunGen/sesion/fncaumdec.php');
include('../src/FunGen/fncpageposition.php');
	if($usuacodigo && $accionconsultarequipo){
		$intervalo = fncaumdec('vistausuequplanta',$inicio,$fin,$mov,$accionconsultarusuaequipo,$recarreglo);
		$cantrow = $intervalo[total];
		if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
	}else{
		
		$intervalo = fncaumdec('vistaequipoplanta',$inicio,$fin,$mov,$accionconsultarequipo,$recarreglo);
		$cantrow = $intervalo[total];
		if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
	}
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Registros de equipo</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head> 
<?php 
if(!$codigo)
{ echo "<!--";}
?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de equipos</font><br>
  <br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="95%"> 
 <tr> 
<td colspan="6" class="NoiseErrorDataTD">
<table border="0" cellspacing="0" cellpadding="0" align="center"  width="100%"> 
	<tr>
		<td class="NoiseErrorDataTD" align="right"><?php page_position($intervalo,'maestablequipogen.php',$flagcheck); ?></td>
	</tr>
</table>
</td> 
 </tr>
  <tr> 
  <td> 
  <?php 
  if($reccomact[nuevo]){
  	echo '       <input type="image" name="nuevo"  src="../img/nuevo.gif"
onclick="form1.action='."'".'ingrnuevequipo.php'."'".';"  width="86" 
height="18" alt="Nuevo Registro" border=0 ';
  	if($flagcheck)
  	echo "disabled";
  	echo '>';
  }

  	echo '            <input type="image" name="consultar"
src="../img/consulta.gif" 
onclick="form1.action='."'".'consultarequipogen.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0 ';
  	if($flagcheck)
  	echo "disabled";
  	echo '>';
  
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos'; form1.action='maestablequipogen.php';" alt="Anterior"></td> 
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
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas'; form1.action='maestablequipogen.php';" alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right"> 
   <?php 
   if($reccomact[detallar]){
   	echo '<b><input type="image" name="detallar" src="../img/verdetal.gif"
onclick="form1.action='."'".'detallarequipo.php'."'".';"  width="87" 
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
   	else echo 'form1.action='."'".'borrarequipo.php';

   	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
   }
   if($reccomact[modificar]){
   	echo '<b><input type="image" name="modificar"  src="../img/modifica.gif"
onclick="form1.action='."'".'editarequipo.php'."'".';"  width="87" height="19"  
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
<td width="7%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Sel.</font></span></td> 
<td width="7%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td>
<td width="16%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Nombre</font></span></td> 
<td width="12%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Estado</font></span></td> 
<td width="12%" class="NoiseFieldCaptionTD Estilo1">Marca</td>
<td width="10%" class="NoiseFieldCaptionTD Estilo1">No. serie </td>
<td width="10%" class="NoiseFieldCaptionTD Estilo1">No. activo fijo</td>
<td width="16%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Sistema</font></span></td> 
</tr> 
<?php 
if($usuacodigo && $accionconsultarequipo)
{
	include ( '../src/FunGen/sesion/fncvisregusuaequipogen.php');
	$reg[0] = 'usuequcodigo';
	$reg1[0] = 's';
	$nureturn = fncvisregusuaequipo('vistausuequplanta',array(0 => 'equipocodigo'), $reg1, $idtrans, $arr_borrar, $flagcheck);
}else
{
	include ( '../src/FunGen/sesion/fncvisregequipogen.php');
	$reg[0] = 'equipocodigo';
	$reg1[0] = 's';
	$nureturn = fncvisregequipo('vistaequipoplanta', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
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
onclick="form1.action='."'".'detallarequipo.php'."'".';"  width="87" 
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
	else echo 'form1.action='."'".'borrarequipo.php';
	echo "'".';"  width="87"
height="19" alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){
	echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif"
onclick="form1.action='."'".'editarequipo.php'."'".';"  width="87" height="19" 
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
   <td><a href="javascript:;" ><img type="image" src="../img/ayuda.gif" name="Ayuda" onClick="window.open('navegacion.htm','ambinave','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Ayuda" border=0 ></a></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'primero'; form1.action='maestablequipogen.php';" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos'; form1.action='maestablequipogen.php';" 
alt="Anterior"></td> 
   <td width="50"> 
<?php 
        	echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas'; form1.action='maestablequipogen.php';" alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'ultimo'; form1.action='maestablequipogen.php';" alt="Ultimo"></td> 
  </tr> 
  <tr> 
 <td colspan="6" class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablequipogen.php',$flagcheck); ?></td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="equipo"> 
<input type="hidden" name="columnas" value="equipocodigo, 
estadocodigo, 
sistemcodigo, 
cencoscodigo, 
equiponombre, 
equipodescri, 
equipofabric, 
equipomarca, 
equipomodelo, 
equiposerie, 
equipolargo, 
equipoancho, 
equipoalto, 
equipopeso, 
equipovolta, 
equipocorrie, 
equipopoten, 
equipofeccom, 
equipocinv, 
equipovengar, 
equipoviduti, 
equipofecins, 
equipoubicac, 
equipovalhor, 
equiponohs, 
equipoacti,
equipotipo,
equiponpas
"> 
 <input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo; ?>"> 
 <input type="hidden" name="estadocodigo" value="<?php echo $estadocodigo; ?>"> 
 <input type="hidden" name="sistemcodigo" value="<?php echo $sistemcodigo; ?>"> 
 <input type="hidden" name="cencoscodigo" value="<?php echo $cencoscodigo; ?>"> 
 <input type="hidden" name="equiponombre" value="<?php echo $equiponombre; ?>"> 
 <input type="hidden" name="equipodescri" value="<?php echo $equipodescri; ?>"> 
 <input type="hidden" name="equipofabric" value="<?php echo $equipofabric; ?>"> 
 <input type="hidden" name="equipomarca" value="<?php echo $equipomarca; ?>"> 
 <input type="hidden" name="equipomodelo" value="<?php echo $equipomodelo; ?>"> 
 <input type="hidden" name="equiposerie" value="<?php echo $equiposerie; ?>"> 
 <input type="hidden" name="equipolargo" value="<?php echo $equipolargo; ?>"> 
 <input type="hidden" name="equipoancho" value="<?php echo $equipoancho; ?>"> 
 <input type="hidden" name="equipoalto" value="<?php echo $equipoalto; ?>"> 
 <input type="hidden" name="equipopeso" value="<?php echo $equipopeso; ?>"> 
 <input type="hidden" name="equipovolta" value="<?php echo $equipovolta; ?>"> 
 <input type="hidden" name="equipocorrie" value="<?php echo $equipocorrie; ?>"> 
 <input type="hidden" name="equipopoten" value="<?php echo $equipopoten; ?>"> 
 <input type="hidden" name="equipofeccom" value="<?php echo $equipofeccom; ?>"> 
 <input type="hidden" name="equipocinv" value="<?php echo $equipocinv; ?>"> 
 <input type="hidden" name="equipovengar" value="<?php echo $equipovengar; ?>"> 
 <input type="hidden" name="equipoviduti" value="<?php echo $equipoviduti; ?>"> 
 <input type="hidden" name="equipofecins" value="<?php echo $equipofecins; ?>"> 
 <input type="hidden" name="equipoubicac" value="<?php echo $equipoubicac; ?>"> 
 <input type="hidden" name="equipovalhor" value="<?php echo $equipovalhor; ?>"> 
 <input type="hidden" name="equiponohs" value="<?php echo $equiponohs; ?>"> 
 <input type="hidden" name="equipoacti" value="<?php echo $equipoacti; ?>"> 
 <input type="hidden" name="equipotipo" value="<?php echo $equipotipo; ?>"> 
 <input type="hidden" name="equiponpas" value="<?php echo $equiponpas; ?>"> 
  <input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>"> 
 <input type="hidden" name="accionconsultarequipo" value="<?php echo $accionconsultarequipo; ?>">

 <input type="hidden" name="mov"> 
 <!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
<!-- Campos a visualizar en maestablborrgen		-->
<input type="hidden" name="selcampos" value="equipocodigo, equiponombre">
<!--											-->
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
<input type="hidden" name="arreglo_b">
<!--											-->
 <input type="hidden" name="usuequcodigo" value="<?php echo $usuequcodigo; ?>">  
 <input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo; ?>">  
 </form> 
 </body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html>