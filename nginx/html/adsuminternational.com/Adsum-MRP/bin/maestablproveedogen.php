<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/sesion/fnccantrow1.php');
include ( '../src/FunPerPriNiv/limitscan.php');
include ( '../src/FunPerPriNiv/pktblproveedo.php');
include ( '../src/FunGen/sesion/fncalmdat.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunGen/sesion/fnccaf.php');
include ( '../src/FunGen/sesion/fncfecultact.php');
include ( '../src/FunGen/sesion/fncvalopcmen.php');
$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
if($accionborrarproveedo)
{
	include ( 'borraproveedo.php');
}
else
{
	if($accionconsultarproveedo)
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
			$accionconsultarproveedo = 0;
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
<title>Registros de proveedo</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de proveedores</font><br>
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
onclick="form1.action='."'".'consultarproveedogen.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0>'; 
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="form1.mov.value = 'menos';form1.action='maestablproveedogen.php';" alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50"> 
  <?php 
  $intervalo = fncaumdec('proveedo',$inicio,$fin,$mov,$accionconsultarproveedo,$recarreglo);
  $cantrow = $intervalo[total];
  if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas';form1.action='maestablproveedogen.php';" alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right">&nbsp; 
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
<td width="44%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Nombre</font></span></td> 
<td width="40%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Ciudad - Pais</font></span></td> 
</tr> 
<?php 
include ( '../src/FunGen/sesion/fncvisregproveedogen.php');
$reg[0] = 'proveecodigo';
$reg1[0] = 'n';
$nureturn = fncvisregproveedogen('proveedo',$reg,$reg1,$idtrans);
?> 
   </table> 
   </td> 
  </tr> 
  <tr> 
   <td colspan="6"> <div align="right"> 
  </div><div align="right"> 
&nbsp;
  </div> 
  </td> 
  </tr> 
  <tr> 
   <td><a href= "javascript:;"><img type="image" src="../img/ayuda.gif" name="Ayuda" onclick="window.open('navegacion.htm','ambinave','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Ayuda" border=0 ></a></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="form1.mov.value = 'primero';form1.action='maestablproveedogen.php';" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onclick="form1.mov.value = 'menos';form1.action='maestablproveedogen.php';" 
alt="Anterior"></td> 
   <td width="50"> 
<?php 
echo '<div align="center"><font color="#006699" size="2" face="Arial, Helvetica,
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font></div>'; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas';form1.action='maestablproveedogen.php';" alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="form1.mov.value = 'ultimo';form1.action='maestablproveedogen.php';" alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="proveedo"> 
<input type="hidden" name="columnas" value="proveecodigo, 
proveenombre, 
proveerepleg, 
proveetelefo, 
proveefax, 
proveepais, 
proveeciudad, 
proveedirecc, 
proveeurl, 
proveeemail, 
proveenota,
proestcodigo,
proveepostal,
proveecontac,
proveetelcon 
"> 
 <input type="hidden" name="proveecodigo" value="<?php echo $proveecodigo; ?>"> 
 <input type="hidden" name="proveenombre" value="<?php echo $proveenombre; ?>"> 
 <input type="hidden" name="proveerepleg" value="<?php echo $proveerepleg; ?>"> 
 <input type="hidden" name="proveetelefo" value="<?php echo $proveetelefo; ?>"> 
 <input type="hidden" name="proveefax" value="<?php echo $proveefax; ?>"> 
 <input type="hidden" name="proveepais" value="<?php echo $proveepais; ?>"> 
 <input type="hidden" name="proveeciudad" value="<?php echo $proveeciudad; ?>"> 
 <input type="hidden" name="proveedirecc" value="<?php echo $proveedirecc; ?>"> 
 <input type="hidden" name="proveeurl" value="<?php echo $proveeurl; ?>"> 
 <input type="hidden" name="proveeemail" value="<?php echo $proveeemail; ?>"> 
 <input type="hidden" name="proveenota" value="<?php echo $proveenota; ?>"> 
 <input type="hidden" name="proestcodigo" value="<?php echo $proestcodigo; ?>"> 
 <input type="hidden" name="proveepostal" value="<?php echo $proveepostal; ?>"> 
 <input type="hidden" name="proveecontac" value="<?php echo $proveecontac; ?>"> 
 <input type="hidden" name="proveetelcon" value="<?php echo $proveetelcon; ?>"> 
 <input type="hidden" name="accionconsultarproveedo" value="<?php echo $accionconsultarproveedo; ?>"> 
 <input type="hidden" name="mov"> 
 </form> 
 </body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
