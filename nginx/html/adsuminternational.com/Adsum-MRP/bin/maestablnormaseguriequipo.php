<?php  
ob_start(); 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
include ( '../src/FunPerPriNiv/pktblnormaseguri.php'); 
include ( '../src/FunGen/sesion/fncalmdat.php'); 
include ( '../src/FunGen/sesion/fnccaf.php'); 
// --- Se incluyen los siguientes archivos en las ventanas emergentes ---
// ----------------------------------------------------------------------
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]); 
if($accionborrarnormaseguri) 
{ 
	include ( 'borranormaseguri.php'); 
} 
else 
{ 
		if($accionconsultarnormaseguriequpo) 
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
					$accionconsultarnormaseguriequipo = 0; 
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
<title>Registros de normaseguri</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="javascript">
var arreglo_aux = new Array;

function cargarcheck(cual)
{
	var arreglo = new Array;
	var nomVec = new Array;

	var x = 0;
	var flag = 0;
	for(var m = 0; m < cual.length; m++)
	{
		if(cual.elements[m].type == "checkbox" )
		{
			if(cual.elements[m].checked == true)
			{
				arreglo[x] = cual.elements[m].value;
				x = x + 1;
				document.form1.arreglo.value = arreglo;
			}
		}
	}
	if (document.form1.arreglo_aux.value == "")
	{
		document.form1.arreglo_aux.value = arreglo;
	}
	else
	{
		nomVec = document.form1.arreglo_aux.value.split(",");

		for (var m = 0; m < arreglo.length; m++)
		{
			flag = 0;
			var z = nomVec.length;
			for (var i = 0; i < z; i++)
			{
				if(nomVec[i] == arreglo[m])
				flag = 1;
			}
			if(flag == 0){
				nomVec[z] = arreglo[m];
			}
		}
		window.document.form1.arreglo_aux.value = nomVec;

	}
}
</SCRIPT>
</head> 
<?php  
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de normas de seguridad</font><br><br></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
 <tr> 
 <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
  <tr> 
  <td> 
  <?php  
  echo '<input type="image" name="adicionar"  src="../img/adicionar.gif"
onclick="cargarcheck(this.form); form1.accionconsultarnormaseguriequipo.value= 1;
window.opener.document.form1.arreglo_aux.value = window.document.form1.arreglo_aux.value;
window.opener.document.form1.opnNormSeguri.focus();
window.close();"  width="86" 
height="18" alt="Adicionar Registro" border=0>&nbsp;'; 
  echo '<input type="image" name="consultar"  src="../img/consulta.gif"
onclick="form1.action='."'".'consultarnormaseguriequipo.php'."'".';"  width="86" 
height="18" alt="Consultar" border=0>'; 
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="cargarcheck(this.form); form1.mov.value = 'menos';form1.action='maestablnormaseguriequipo.php';" 
alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50"> 
  <?php  
	$intervalo = fncaumdec 
('normaseguri',$inicio,$fin,$mov,$accionconsultarnormaseguri,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="cargarcheck(this.form); form1.mov.value = 'mas';form1.action='maestablnormaseguriequipo.php';" 
alt="Siguiente"></td> 
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
<td width="46%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">C&oacute;digo</font></span></td> 
<td width="46%" class="NoiseFieldCaptionTD"><span class="style5"><font 
color="#FFFFFF">Nombre</font></span></td> 
</tr> 
<?php  
include ( '../src/FunGen/sesion/fncvisregnormaseguriequipo.php'); 
	$reg[0] = 'norsegcodigo'; 
	$reg1[0] = 'n'; 
	$nureturn = fncvisregnormaseguriequipo('normaseguri',$reg,$reg1,$idtrans,$arreglo_aux); 
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
   <td><a href= "javascript:;"><img type="image" src="../img/ayuda.gif" name="Ayuda" onclick="window.open('navegacion.htm','ambinave','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Ayuda" border=0 ></a></td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="cargarcheck(this.form); form1.mov.value = 'primero';form1.action='maestablnormaseguriequipo.php';" 
alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" onclick="cargarcheck(this.form); form1.mov.value = 
'menos';form1.action='maestablnormaseguriequipo.php';" alt="Anterior"></td> 
   <td width="50"> 
<?php  
echo '<font color="#006699" size="2" face="Arial, Helvetica, 
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font>'; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="cargarcheck(this.form); form1.mov.value = 'mas';form1.action='maestablnormaseguriequipo.php';" 
alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="cargarcheck(this.form); form1.mov.value = 'ultimo';form1.action='maestablnormaseguriequipo.php';" 
alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="6" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
 </table> 
 <input type="hidden" name="codigo" value="<?php  echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php  echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php  echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="normaseguri"> 
<input type="hidden" name="columnas" value="norsegcodigo, 
norsegnombre, 
norsegdescri 
"> 
 <input type="hidden" name="norsegcodigo" value="<?php  echo $norsegcodigo; ?>"> 
 <input type="hidden" name="norsegnombre" value="<?php  echo $norsegnombre; ?>"> 
 <input type="hidden" name="norsegdescri" value="<?php  echo $norsegdescri; ?>"> 
 <input type="hidden" name="accionconsultarnormaseguriequipo" value="<?php  echo $accionconsultarnormaseguriequipo; ?>"> 
 <input type="hidden" name="mov"> 
 <!--					--> 
<input type="hidden" name="arreglo"> 
<input type="hidden" name="arreglo_aux" value="<?php  echo $arreglo_aux;?>">
<!--					-->  
 </form> 
 </body> 
<?php  
if(!$codigo) 
{ echo " -->"; } 
?> 
</html> 
