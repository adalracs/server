<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblgrupcapa.php');	
include('../src/FunPerPriNiv/pktblcargo.php');
include('../src/FunPerPriNiv/pktbltipousuario.php');
include ( '../src/FunGen/sesion/fnccarga.php');
if($accionusuario2 > 1)
{
	$sbregusua = fnccarga("usuario",$radiobutton);
	$usuari = $sbregusua[usuacodi];
	$usuacodigo = $sbregusua[usuacodi];
	$usuaced = $sbregusua[usuadocume];
	$usuanombre =$sbregusua[usuanombre]." ".$sbregusua[usuapriape]." ".$sbregusua[usuasegape];
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
<title>Consultar en usuagrupcapa</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
function carga1(cual)
{
	var flag = 0;
	for(var m = 0; m < cual.length; m++)
	{
		if(cual.elements[m].type == "radio" )
		{	
			if(cual.elements[m].checked == true){
				flag = 1;
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
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Consultar grupo de empleados</font></p> 
<table width="536" border="0" align="center" cellpadding="2" cellspacing="1" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="528" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="98%" border="0" cellspacing="0" cellpadding="1" 
align="center"> 
<tr> 
 <td width="21%">C&oacute;digo</td> 
 <td width="23%"><input name="usugrucodigo" type="text"	value="<?php if(!$flagconsultarusuagrupcapa){ echo $sbreg[empgrucodigo];}else{ echo 
$usugrucodigo; }?>" size="17"></td>
 <td width="12%">&nbsp; 
 </td> 
 <td width="44%">&nbsp;</td>
</tr> 
<tr> 
 <td width="21%">Grupo</td> 
 <td colspan="2"><select name="grucapcodigo">
   <?php
                       if(!$accionconsultaremplgrupo)
                       {
                       		echo '<option value = "">Seleccione'; 
                       }
                       elseif ($accionconsultaremplgrupo)
                       {
                       		echo '<option value = "'.$grucapcodigo.'">'; 
                       		$idcon	= fncconn();
							$arrgrupcapa = loadrecordgrupcapa($grucapcodigo,$idcon);
							echo $arrgrupcapa[grucapnombre];
							fncclose($idcon);
                       }?>
   <?php
				            include ('../src/FunGen/floadgrupcapa.php');
							$idcon = fncconn();
							floadgrupcapa($idcon); 
							fncclose($idcon);
						?>
 </select> </td>
 <td width="44%">&nbsp;</td>
</tr> 
<tr> 
 <td colspan="4">Empleado
 <input name="button1" type="radio" onClick="secundaria1=window.open('consultarusuarigrupcc.php?codigo=<?php echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=150,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">
<!--<input name="button1" type="radio" onClick="form1.action='consultarusuarigrupcc.php';submit();"></td> -->
 </tr>
 <tr> 
 <td width="21%">C&oacute;digo&nbsp;</td> 
 <td width="23%"><input name="usuacodigo" type="text"	value="<?php if(!$flagconsultarusuagrupcapa){ echo $usuacodigo; }?>" size="17" onFocus="if (!agree)this.blur();"></td>
 <td width="12%">Nombre</td> 
<td colspan="44%"><input name="usuanombre" type="text"	value="<?php if(!$flagconsultarusuagrupcapa){ echo $usuanombre;}?>" size="35" onFocus="if (!agree)this.blur();"></td>
</tr>
 <tr> 
  <td colspan="2">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionconsultarusuagrupcapa.value = 1;form1.action='maestablusuagrupcapa.php';"  width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablusuagrupcapa.php';"  width="86" height="18" alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="accionconsultarusuagrupcapa"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="usugrucodigo, 
grucapcodigo, 
usuacodi 
"> 
<input type="hidden" name="nombtabl" value="usuagrupcapa"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
