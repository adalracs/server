<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblplano.php');
include ( '../src/FunPerPriNiv/pktblmanual.php');
if($accionnuevodocuequi)
{
	include ( 'grabadocuequi.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de docuequi</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Documentos por equipo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="454" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="95%" border="0" cellspacing="1" cellpadding="2" 
align="center"> 
<tr>
<td colspan="4" bgcolor="#f0f6ff"><hr></td>              
</tr>            
<tr> 
 <td width="25%" class="NoiseFooterTD"><?php if($campnomb["equipocodigo"] == 1){ $equipocodigo = null;
echo "*";}
?>Equipo
<input name="radio1"  type="radio" onclick="window.open('consultarequipogen.php?codigo=<?php echo $codigo?>','equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
 <td class="NoiseErrorDataTD">Cod.&nbsp;<input name="equipocodigo" type="text"	value="<?php if(!$flagnuevodocuequi){ 
echo $equipocodigo;} else {echo $equipocodigo;} ?>" size="8"></td>
 <td class="NoiseErrorDataTD">Nombre</td>
 <td class="NoiseErrorDataTD"><input name="equiponombre" type="text"	value="<?php if(!$flagnuevodocuequi){ 
echo $equiponombre;} else {echo $equiponombre;} ?>" size="14" onFocus="if (!agree)this.blur();"> </td>
 </tr>
<tr>
<td colspan="4" bgcolor="#f0f6ff"><hr></td>              
</tr> 
              <tr>
                <td width="25%" class="NoiseFooterTD"><?php if($campnomb["planocodigo"] == 1){ $planocodigo = null;
echo "*";}
?>Plano</td>
                <td colspan="3" class="NoiseErrorDataTD"><select name="planocodigo">
                      <?php
                       if(!$flagnuevodocuequi)
                       {
                       		echo '<option value = "">Seleccione'; 
                       }
                       else if($accionnuevodocuequi)
                       {
							if($planocodigo)
							{
								echo '<option value = "'.$planocodigo.'">'; 
								$idcon	= fncconn();
								$arrplano = loadrecordplano($planocodigo,$idcon);
								echo $arrplano[planonombre];
								fncclose($idcon);
							}
							else
							{
	                       		echo '<option value = "">Seleccione'; 
							}
                       }?></option>
                       <?php
				            include ('../src/FunGen/floadplano.php');
							$idcon = fncconn();
							floadplano($idcon); 
							fncclose($idcon);
						?></select></td>
              </tr>
              <tr> 
 <td width="25%" class="NoiseFooterTD"><?php if($campnomb["manualcodigo"] == 1){ $manualcodigo = null;
echo "*";}
?>Manual</td> 
  <td colspan="3" class="NoiseErrorDataTD"> 
    <select name="manualcodigo">
                      <?php
                       if(!$flagnuevodocuequi)
                       {
                       		echo '<option value = "">Seleccione'; 
                       }
                       else if($accionnuevodocuequi)
                       {
							if($manualcodigo)
							{
								echo '<option value = "'.$manualcodigo.'">'; 
								$idcon	= fncconn();
								$arrmanual = loadrecordmanual($manualcodigo,$idcon);
								echo $arrmanual[manualnombre];
								fncclose($idcon);
							}
							else
							{
	                       		echo '<option value = "">Seleccione'; 
							}
                       }?></option>
                       <?php
				            include ('../src/FunGen/floadmanual.php');
							$idcon = fncconn();
							floadmanual($idcon); 
							fncclose($idcon);
						?></select> 
  </td> 
 </tr> 
 <tr> 
  <td width="30%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevodocuequi.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabldocuequi.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
  </div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table>
<?php 
if($campnomb){ echo '<font face= "Verdana" >Corregir los campos marcados con *</font>';}
?> 
 <input type="hidden" name="docequcodigo"	value="<?php if(!$flagnuevodocuequi){ echo $sbreg[docequcodigo];}else{ echo $docequcodigo;} ?>">
<input type="hidden" name="accionnuevodocuequi"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html>