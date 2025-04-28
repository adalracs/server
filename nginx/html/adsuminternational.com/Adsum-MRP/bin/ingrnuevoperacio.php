<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktbltipooper.php');
include ( '../src/FunPerPriNiv/pktblcentcost.php');
if($accionnuevooperacio)
{
	include ( 'grabaoperacio.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de operacio</title> 
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
<p><font class="NoiseFormHeaderFont">Operaciones</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE">
  <tr>
    <td width="462" class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
    <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> Ingresar nuevo registro</font></span></td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="1" cellpadding="3" align="center">
        <tr>
          <td width="31%">&nbsp;</td>
          <td></td>
          <td><?php if($campnomb["operacfecha"] == 1){$operacfecha = null; 
echo "*";}?>
            Fecha</td>
          <td width="24%"><?php echo $operacfecha = date("Y-m-d");?></td>
        </tr>
        
        <tr>
          <td width="31%"><?php if($campnomb["tipopecodigo"] == 1){ $tipopecodigo=null;
 echo "*";}
 ?>
            Tipo de operaci&oacute;n</td>
          <td width="33%"><select name="tipopecodigo">
              <?php
    	if(!$flagnuevooperacio)
            {
            	echo '<option value = "">Seleccione'; 
            }
            elseif ($accionnuevooperacio)
            {
            	if($tipopecodigo)
            	{
	            	echo '<option value = "'.$tipopecodigo.'">'; 
	                $idcon	= fncconn();
					$arrtipooper = loadrecordtipooper($tipopecodigo,$idcon);
					echo $arrtipooper[tipopenombre];
					fncclose($idcon);
            	}else 
            	{
            		echo '<option value = "">Seleccione'; 
            	}
            }?>
              <?php
			include ('../src/FunGen/floadtipooperac.php');
			$idcon = fncconn();
			floadtipooperac($idcon);
			fncclose($idcon);
		?>
            </select>
          </td>
          <td width="12%"><?php if($campnomb["operacvalor"] == 1){ $operacvalor=null;
 echo "*";}
 ?>
            Valor</td>
          <td width="24%"><input type="text" name="operacvalor"	value="<?php if(!$flagnuevooperacio){ 
echo $sbreg[operacvalor];}else {echo $operacvalor;}?>" size="10"></td>
        </tr>
        <tr>
          <td width="31%">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>
      <div align="center">
        <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onClick="form1.accionnuevooperacio.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0>
        <input type="image" name="cancelar" src="../img/cancelar.gif" 
onClick="form1.action='maestabloperacio.php';"  width="86" height="18" 
alt="Cancelar" border=0>
    </div></td>
  </tr>
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
</table>
<?php 
if($campnomb){ echo '<font face= "Verdana" >Corregir los campos marcados con *</font>';}
?>
<input type="hidden" name="operaccodigo"	value="<?php if(!$flagnuevooperacio){ echo $sbreg[operaccodigo];}else{ echo $operaccodigo;} ?>">
<input type="hidden" name="operacfecha" value="<?php echo $operacfecha = date("Y-m-d");?>">
<input type="hidden" name="accionnuevooperacio"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
