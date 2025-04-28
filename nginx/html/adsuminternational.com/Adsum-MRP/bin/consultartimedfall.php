<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunGen/sesion/fnccaf.php'); 
$reccomact= fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
?> 
<html> 
<head> 
<title>Tiempo medio entre fallas</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarEquipo.js" type="text/javascript" ></script>
<script language="JavaScript" src="motofech.js"></script>
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript">
function validarFechasVacias(ordtrafecini,cierotfecfin)
{
	if(ordtrafecini && cierotfecfin)
		return true;
	else
	{
		alert('Por favor escoja la fecha de inicio \ny de fin del periodo a observar')
		if(!ordtrafecini)
		 	window.document.getElementById("divordtrafecini").style.visibility="visible";
		if(!cierotfecfin)
		 	window.document.getElementById("divcierotfecfin").style.visibility="visible";
		return false;
	}
}
</script>
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body onload="window.focus();"  bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data" 
onsubmit="return validarFechasVacias(window.document.form1.ordtrafecini.value,
window.document.form1.cierotfecfin.value);">
<p><font class="NoiseFormHeaderFont">Tiempo medio entre fallas</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Tiempo medio entre fallas</font></span></td></tr>
<tr>
	<td>
		<table width="93%" border="0" cellspacing="0" cellpadding="3" align="center">
			<tr> 
				<td>
				<div id="divordtrafecini" style="visibility:hidden">*</div>
				</td>
				<td>
				Fecha de inicio</td>
				<td> 
				<input name="ordtrafecini" type="text" onfocus="if(!agree) this.blur();" value="<?php 
				if(!$flagconsultarequipo){ echo $sbreg[ordtrafecini];} else {echo $ordtrafecini;}?>" size="14">
				</td>
				<td>
				<img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=ordtrafecini','calendario1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
				</td>
				</tr>
				<tr>
				<td>
				<div id="divcierotfecfin" style="visibility:hidden">*</div>
				</td>
				<td>
				Fecha final</td>
				<td>
				<input name="cierotfecfin" type="text" onfocus="if(!agree) this.blur();"
				value="<?php if(!$flagconsultarequipo){ echo $sbreg[cierotfecfin];} else {echo $cierotfecfin;}?>" 
				size="14">
				</td>
				<td>
				<img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=cierotfecfin','calendario2','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
				</td>
			</tr>
		</table>
	</td>
</tr>

<tr> 
  <td> 
		<table width="85%" border="0" cellspacing="0" cellpadding="3" align="center">
            <tr>
            <td width="21%">Planta</td>
            <td width="30%">
            <select name="plantacodigo" onchange="cargarSistemas(this.value);
			window.document.form1.equipocodigo.value='';
			window.document.form1.equiponombre.value='';
			window.document.form1.equipomarca.value='';
			window.document.form1.equipomodelo.value='';
			"
				>
            <option value ="">Seleccione</option>
            <?php
				include ('../src/FunGen/floadplanta.php');
				$idcon = fncconn();
				floadplanta($idcon);
				fncclose($idcon);
			?></select>
            </td>
            <td width="21%">Proceso</td>
            <td width="30%">
            <select name="sistemcodigo" 
			onchange="window.document.form1.equipocodigo.value='';
			window.document.form1.equiponombre.value='';
			window.document.form1.equipomarca.value='';
			window.document.form1.equipomodelo.value='';
			">
            <option value ="">Seleccione</option>
            </select>
            </td>
          </tr>
<tr> 
 <td width="41%"><?php if($campnomb == "equipocodigo"){ $equipocodigo=null;
echo "*";}
?>Equipo
<input name="radio1" type="radio" target="_parent"
onclick="window.open('consultarequipotimedrep.php?codigo=<?php echo $codigo?>&sistemcodigo='+window.document.form1.sistemcodigo.value+'&plantacodigo='+window.document.form1.plantacodigo.value,'equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');">
</td>
 <td>Cod.&nbsp;<input name="equipocodigo" type="text" size="8"
onchange="cargarEquipo(this.value);" 
onfocus="
window.document.form1.sistemcodigo.options[0].selected=true;
window.document.form1.plantacodigo.options[0].selected=true;
">
 </td>
 <td>Nombre</td>
 <td><input name="equiponombre" type="text"	size="14" onFocus="if (!agree)this.blur();"> </td>
 </tr>
          <tr> 
            <td width="21%">Marca</td>
            <td width="30%"> 
              <input name="equipomarca" type="text"	value="<?php if(!$flagconsultarequipo){ 
echo $sbreg[equipomarca];} else {echo $equipomarca;}?>" size="14" onFocus="if (!agree)this.blur();">
            </td>
            <td width="21%">Modelo</td>
            <td width="28%"> 
              <input name="equipomodelo" type="text" size="17" onFocus="if (!agree)this.blur();">
            </td>
        <tr>
        	<td></td>
	        <td>
	            <input type="button" name="buscarmarca" value="Buscar marca"
onclick="window.open('consultarvistamarca.php?codigo=<?php echo $codigo?>&sistemcodigo='+window.document.form1.sistemcodigo.value+'&plantacodigo='+window.document.form1.plantacodigo.value,'equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');">
	        </td>
        </tr>
        <tr>
            <td width="21%">Horas de operaci&oacute;n</td>
	        <td>
              <input name="horas_operac" type="text" size="17">
	        </td>
        </tr>
<td colspan="2"></td>            
          </tr>
          <tr> 
            <td width="21%">&nbsp;</td>
          </tr>
        </table>  
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center">
<input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarequipo.value =  1; form1.action='maestabltimedfall.php';"  width="86" 
height="18" alt="Nuevo Registro" border=0>&nbsp;
<img src="../img/ayuda.gif" border="0" alt="Ayuda">
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="flagconsultarequipo" value="1">
<input type="hidden" name="accionconsultarequipo">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="columnas" value="
ordtrafecini,
ordtrahorini,
cierotfecfin,
cierothorini,
plantacodigo,
sistemcodigo, 
equipocodigo, 
equiponombre, 
estadocodigo, 
cencoscodigo, 
equipofabric, 
equipomarca,
equiposerie,
equipomodelo,
usuacodi
">
<input type="hidden" name="nombtabl" value="equipo">
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
