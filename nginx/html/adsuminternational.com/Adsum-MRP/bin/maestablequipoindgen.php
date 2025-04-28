<?php
ob_start();
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/sesion/fnccantrow1.php');
include ( '../src/FunPerPriNiv/limitscan.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblestado.php');
include ( '../src/FunGen/sesion/fncalmdat.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunGen/sesion/fnccaf.php');

$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

if($accionconsultarequipo)
{
	//include ( '../src/FunGen/sesion/fncalmdatc.php');
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
<title>Registros de equipo</title>
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
<p><font class="NoiseFormHeaderFont">Listado de equipos</font><br>
  <br></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE" width="90%">
 <tr>
 <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
  <tr>
  <td>
  <?php
echo '            <input type="image" name="consultar"
src="../img/consulta.gif"
onclick="form1.action='."'".'consultarequipoindgen.php'."'".';"  width="86"
height="18" alt="Consultar" border=0>';
?>
 </td>
 <td width="42">
  <input type="image" name="adelanta"  src="../img/adelanta.gif"
onclick="form1.mov.value = 'menos'; form1.action='maestablequipoindgen.php';" alt="Anterior"></td>
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td>
 <td width="50">
  <?php
	$intervalo = fncaumdec('equipo',$inicio,$fin,$mov,$accionconsultarequipo,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
?>
 </td>
 <td width="53">
 <div align="right"><font color="#CC9900">Siguiente</font></div>
 </td>
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif"
onclick="form1.mov.value = 'mas'; form1.action='maestablequipoindgen.php';" alt="Siguiente"></td>
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
<td width="10%" class="NoiseFieldCaptionTD"><span class="style5"><font
color="#FFFFFF">C&oacute;digo</font></span></td>
<td width="27%" class="NoiseFieldCaptionTD"><span class="style5"><font
color="#FFFFFF">Descripci&oacute;n</font></span></td>
<td width="27%" class="NoiseFieldCaptionTD"><span class="style5"><font
color="#FFFFFF">Sistema</font></span></td>
<td width="27%" class="NoiseFieldCaptionTD"><span class="style5"><font
color="#FFFFFF">Estado</font></span></td>
</tr>
<?php
include ( '../src/FunGen/sesion/fncvisregequipoindgen.php');
	$reg[0] = 'equipocodigo';
	$reg1[0] = 'n';
	$nureturn = fncvisregequipoindgen('equipo',$reg,$reg1,$idtrans);
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
   <td><a href="javascript:;" ><img type="image" src="../img/ayuda.gif" name="Ayuda" onclick="window.open('navegacion.htm','ambinave','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Ayuda" border=0 ></a>
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif"
onclick="form1.mov.value = 'primero'; form1.action='maestablequipoindgen.php';" alt="Primero"></td>
   <td width="46"><input type="image" name="adelanta"
src="../img/adelanta.gif" onclick="form1.mov.value = 'menos'; form1.action='maestablequipoindgen.php';"
alt="Anterior"></td>
   <td width="50">
<?php
echo '<font color="#006699" size="2" face="Arial, Helvetica,
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de
'.$intervalo[total].'</font>';
?>
   </td>
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif"
onclick="form1.mov.value = 'mas'; form1.action='maestablequipoindgen.php';" alt="Siguiente"></td>
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif"
onclick="form1.mov.value = 'ultimo'; form1.action='maestablequipoindgen.php';" alt="Ultimo"></td>
  </tr>
  <tr>
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td>
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
 <input type="hidden" name="accionconsultarequipo" value="<?php echo $accionconsultarequipo; ?>">
 <input type="hidden" name="mov">
  </form>
 </body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>