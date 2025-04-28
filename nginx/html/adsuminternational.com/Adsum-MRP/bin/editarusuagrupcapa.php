<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblgrupcapa.php');
include('../src/FunGen/floadusuaselect.php');
if($accioneditarusuagrupcapa)
{
	include ('editausuagrupcapa.php');
	$flageditarusuagrupcapa = 1; 
}
ob_end_flush();
if(!$flageditarusuagrupcapa)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
	$vargrupcapa = $sbreg[grucapcodigo];
	$arrgrupcapa = loadrecordgrupcapa($vargrupcapa,$idcon);
	$codgrupcapa = $sbreg[grucapcodigo];
	$str = loadrecordusuagrupcapaproc($sbreg[grucapcodigo],$idcon);
	fncclose($idcon);
}
?>
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: 		Andr�s A. Riascos D. 
Fecha: 		26052004 
Modificado: jcortes
Fecha:		13-jul-2005
GenVers: 3.1 --> 
<html> 
<head> 
<title>Editar registro de usuagrupcapa</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" src="../src/FunGen/fncmoveselectoptions.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/cargarUsuagrupcapa.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/cargarFullUsuagrupcapa.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript">

var arreglo1 = new Array;
var arreglo2 = new Array;
var arreglo_aux = new Array;
function carga()
{
	for(var i=0; i < document.form1.elements['empleaselec'].length; i++)
	{
		arreglo2[i] = document.form1.empleaselec[i].value;
	}
	document.form1.arreglo2.value = arreglo2;

	for(var i=0; i < document.form1.elements['empleadelet'].length; i++)
	{
		arreglo1[i] = document.form1.empleadelet[i].value;
	}
	document.form1.arreglo1.value = arreglo1;
}

var all_users = new Array;
function save_users(lista1,lista2)
{
	if(window.document.form1.flageditarusuagrupcapa1.value!=1)
	{
		//si es la primera vez que abre la p�gina
		for(var i=0; i < lista1.length; i++)
		{
			arreglo_aux[i] = lista1.options[i].value;
		}
		window.document.form1.arreglo_aux.value = arreglo_aux;

		for(var i=0; i < lista1.length; i++)
		{
			all_users[i] = new Array;
			all_users[i][0] = lista1.options[i].text;
			all_users[i][1] = lista1.options[i].value;
		}
	}
	else
	{
		for(var i=0; i < lista2.length; i++)
		{
			all_users[i] = new Array;
			all_users[i][0] = lista2.options[i].text;
			all_users[i][1] = lista2.options[i].value;
		}
	}
}


function load_users(cadena)
{
    miArray  = jsrsArrayFromString( cadena  , ",");
	var i,j;
	j=0;
	var defaultSelected = false;
	var selected = false;
    for(i = 0; i < miArray.length -1; i++)
    {
		if(i == 0 )
		{
			defaultSelected = true;
			selected = true;
		}
		valor = miArray[i];
		nombre = miArray[i+1];
		window.document.form1.empleadelet.options[j] = new Option(nombre,valor,defaultSelected,selected);
		j++;
		i++;
    }
    
    for(k=0; k < window.document.form1.empleadelet.length; k++)
    {
	    for(m= 0; m < window.document.form1.empleaselec.length; m++)
	    {
	    	if(window.document.form1.empleadelet.options[k].value == window.document.form1.empleaselec.options[m].value)
	    	{
	    		delete_record(window.document.form1.empleaselec,m);
	    	}
	    }
	}
}
</script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
</head> 
<?php
    if(!$codigo)
    { echo "<!--";}
?>
<body onload="
save_users(window.document.form1.empleaselec, window.document.form1.usuarios);
load_users('<?php echo $str;?>');"
bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Grupo de empleados</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="681" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
	<td class="NoiseFieldCaptionTD"><span class="style5">
	<font color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="86%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="10%"><?php if($campnomb == "grucapcodigo"){$grucapcodigo = null; 
echo "*";}?>Grupo</td> 
 <td colspan="3">
 <div style="display:none">
 <select name="usuarios" size="4">
 <?php
   if($flageditarusuagrupcapa)
   {
		$idcon = fncconn();
		floadusuaselect($idcon,$arreglo_aux);
		fncclose($idcon);
   }
 ?>
 </select></div>
 <select onchange="
window.document.form1.empleadelet.length=0;
cargarUsuagrupcapa(this.value);" name="grucapcodigo">
<?php
	/*if(!$flagnuevousuagrupcapa)
	{
		echo '<option value = "">Seleccione';
	}*/
	if(!$flageditarusuagrupcapa)
	{
		echo '<option value = "'.$codgrupcapa.'">'.$arrgrupcapa[grucapnombre];
	}
	else if ($accioneditarsuagrupcapa)
	{
		if($grucapcodigo)
		{
			echo '<option value = "'.$grucapcodigo.'">';
			$idcon	= fncconn();
			$arrgrupcapa = loadrecordgrupcapa($grucapcodigo,$idcon);
			echo $arrgrupcapa[grucapnombre];
			fncclose($idcon);
		}
		else
		{
			echo '<option value = "">Seleccione';
		}
	}
	include ('../src/FunGen/floadgrupcapa.php');
	$idcon = fncconn();
	floadgrupcapa($idcon);
	fncclose($idcon);
?>
 </select></td>
 <td width="51%" colspan="3">&nbsp; </td> 
 </tr> 
 <tr> 
 <td colspan="7">&nbsp; </td> 
 </tr>
 <tr> 
 <td colspan="7">Empleado de mantenimiento
<!-- <input name="button1" type="image" src="../img/consultar.gif" heigth="25" width="25"
onClick="secundaria1=window.open('consultarusuarigrupc.php?codigo=<?php /*echo $codigo*/?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=150,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">-->
  <input name="button1" type="radio" 
onClick="secundaria1=window.open('consultarusuarigrupc.php?codigo=<?php echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=150,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">
</td>
  </tr>
 <tr> 
 <td colspan="7">&nbsp; </td> 
 </tr>
<tr> 
 <td colspan="2">Empleados</td> 
 <td colspan="2"><div align="left"></div></td>
 <td colspan="3">Empleados asignados</td> 
 </tr>
 <tr>
 <td colspan="2" rowspan="2"><select name="empleaselec" size="4">
   <?php
                       if($flageditarusuagrupcapa)
                       {
							$idcon = fncconn();
							floadusuaselect($idcon,$arreglo2); 
							fncclose($idcon);
                       }
					   else
					   {
							include('../src/FunGen/floadusuario.php');
							$idcon = fncconn();
							floadusuario($idcon);
							fncclose($idcon);
					   }
                       ?></select></td> 
 <td height="38" colspan="2"><div align="center">
   <input type="button" name="deletsele" value=" > " onclick="transferTo(this.form.empleaselec,this.form.empleadelet);">
 </div></td>
 <td colspan="3" rowspan="2">
 <select name="empleadelet" size="4">
   <?php
	if($flageditarusuagrupcapa)
	{
		$idcon = fncconn();
		floadusuaselect($idcon,$arreglo1);
		fncclose($idcon);
	}
	else
	{
		$idcon = fncconn();
		floadusuaselect($idcon,$arreglo1);
		fncclose($idcon);
	}?></select>
 </td>
 </tr>
 <tr>
   <td height="33" colspan="2"><div align="center">
     <input type="button" name="deletsele2" value=" < " onclick="transferTo(this.form.empleadelet,this.form.empleaselec);">
   </div></td>
 </tr> 

 <tr> 
  <td colspan="7">&nbsp;</td> 
  </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="carga();form1.accioneditarusuagrupcapa.value =  1;" 
width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablusuagrupcapa.php';"  width="86" height="18" alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>}';}
?> 
<input type="hidden" name="usugrucodigo" value="<?php if(!$flageditarusuagrupcapa){echo $sbreg[usugrucodigo];}else{ echo $usugrucodigo; } ?>">
<input type="hidden" name="accioneditarusuagrupcapa">
<input type="hidden" name="accioneditaremplgrupo" value="<?php echo $accioneditaremplgrupo;?>">
<input type="hidden" name="arreglo1" value="<?php echo $arreglo1;?>">
<input type="hidden" name="arreglo2" value="<?php echo $arreglo2;?>">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="nombtabl" value="<?php echo $nombtabl; ?>">
<input type="hidden" name="radiobutton" value="<?php echo $radiobutton; ?>">
<input type="hidden" name="flageditarusuagrupcapa1" value="<?php echo $flageditarusuagrupcapa; ?>">
<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux; ?>">
</form>
</body>
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html>