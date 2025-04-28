<?php
ob_start();
// -- Los siguientes archivos se incluyen en las ventanas emergentes -- //
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
//----------------------------------------------
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/sesion/fnccantrow1.php');
include ( '../src/FunPerPriNiv/limitscan.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktblvistaot.php');
include ( '../src/FunGen/sesion/fncalmdat.php');
include ( '../src/FunGen/sesion/fnccaf.php');

$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

if($accionconsultarvistaot)
{
//	include ( '../src/FunGen/sesion/fncalmdatc.php');
	$accionconsultarvistaot = 1;
	$nusw = 0;
	$nombcamp = strtok ($columnas,",");

	while ($nombcamp)
	{
		$nombcamp = trim($nombcamp);

		if(trim($nombcamp) != "usuacodi")
		{
			$recarreglo[$nombcamp] = $$nombcamp;
			
			if($recarreglo[$nombcamp] != null)
				$nusw = 1;
		}
		else {
			if(!$nusw)
				if($empleacod != "")
				{
					$recarreglo[$nombcamp] = $empleacod;
					$nusw = true;	
				}
			else
				if($empleacod != "")
					$recarreglo[$nombcamp] = $empleacod;
		}	
		$nombcamp = strtok(",");
	}

	if(!$nusw)
	{
		$accionconsultarvistaot = 0;
	}
}
include ( '../src/FunGen/sesion/fncaumdec.php');
ob_end_flush();
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr� A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head>
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript" ></SCRIPT>
<script language="JavaScript" src="../src/FunGen/cargarEmpleaselec.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarOt.js" type="text/javascript" ></script>
<SCRIPT language="JavaScript" src="../src/FunGen/cargarVistaotaux.js" type="text/javascript"></script>
<title>Registros de ot</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de ordenes de trabajo</font><br>
  <br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
  <tr> 
  <td> 
  	<input type="image" name="volver"  src="../img/consulta.gif"
onclick="form1.action='consultarvistaotregla.php';"  width="86" height="18" 
alt="Volver" border=0>
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="form1.mov.value = 'menos';form1.action='maestablvistaotregla.php';" alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50">
  <?php
  include('../src/FunGen/fncreturnregla.php');
//  #DEFINE REP 1 
//  Indica listar solo las OT's que su estado apunta a ser de tipo 'REPORTADA' 

  $arr_codi_ot = fncreturnregla(REP);

  $intervalo = fncaumdec('vistaot',$inicio,$fin,$mov,$accionconsultarvistaot,$recarreglo);
  $cantrow = $intervalo[total];
  if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans];}
  ?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="form1.mov.value='mas'; form1.action='maestablvistaotregla.php';" alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6">
  <div align="right">&nbsp;</div>
</td> 
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
<td width="13%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Tarea</font></span></td> 
<td width="13%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Planta</font></span></td> 
<td width="13%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Sistema</font></span></td> 
<td width="13%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Equipo</font></span></td> 
<td width="16%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Encargado</font></span></td> 
<td width="10%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Prioridad</font></span></td> 
</tr> 
<?php 
include ('../src/FunGen/sesion/fncvisregvistaotaux.php');
$reg[0] = 'ordtracodigo';
$reg1[0] = 'n';
$nureturn = fncvisregvistaotaux('vistaot',$reg,$reg1,$idtrans);
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
onclick="form1.action='."'".'detallarot.php'."'".';"  width="87" height="19" 
alt="Ver detalle" border=0></b>'; 
}
if($reccomact[borrar]){
	echo  '<b><input type="image" name="borrar"  src="../img/borrar.gif"
onclick="form1.action='."'".'borrarot.php'."'".';"  width="87" height="19" 
alt="Borrar Registro" border=0></b>'; 
}
if($reccomact[modificar]){
	echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif"
onclick="form1.action='."'".'editarot.php'."'".';"  width="87" height="19" 
alt="Modificar Registro" border=0></b>'; 
}
?> 
  </div> 
  </td> 
  </tr> 
  <tr> 
   <td><img src="../img/ayuda.gif" border="0" alt="Ayuda"></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="form1.mov.value='primero'; form1.action='maestablvistaotregla.php';" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onclick="form1.mov.value='menos'; form1.action='maestablvistaotregla.php';" 
alt="Anterior"></td> 
   <td width="50"> 
<?php 
echo '<font color="#006699" size="2" face="Arial, Helvetica,
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font>'; 
?>
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="form1.mov.value='mas'; form1.action='maestablvistaotregla.php';" alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="form1.mov.value='ultimo'; form1.action='maestablvistaotregla.php';" alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table>
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="vistaot"> 
<input type="hidden" name="columnas" value="ordtracodigo,
ordtrafecgen,
plantacodigo,
sistemcodigo,
equipocodigo,
componcodigo,
tipmancodigo,
prioricodigo,
ordtradescri,
ordtrafecini,
ordtrahorini,
ordtrafecfin,
ordtrahorfin,
usuacodi,
tiptracodigo,
tareacodigo,
usutarcodigo
">
<input type="hidden" name="accionconsultarvistaot" value="0"> 
<input type="hidden" name="mov"> 
 
  </form> 
 </body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?>
</html>