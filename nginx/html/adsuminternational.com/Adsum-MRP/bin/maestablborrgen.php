<?php
include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncclose.php');
include('../src/FunPerPriNiv/pktbl'.$nombtabl.'.php');

if(empty($arr_borrar))
{
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'alert("No seleccion\u00f3 ning\u00fan registro");'."\n";
	echo 'location ="maestabl'.$nombtabl.'.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
	exit;
}

if($accionborrar)
{ 
	include('../src/FunGen/fncborrareg.php');

	fncborrareg($arr_borrar, $nombtabl, $selcampos, $codigo);
}
//---------------------------------------
//----- Codigos de los registros a borrar
$values = explode(',', $arr_borrar);
$numreg = count($values);
//----- Campos a mostrar en el formulario
$campos = explode(',', $selcampos);
$numcam = count($campos);
//---------------------------------------
?>
<html>
<head>
<title>Borrar registros</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Borrar registros</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="70%">
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
 <tr>
  <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Borrar registros</font></span></td>
 </tr>
 <tr>
  <td>
  	<table width="85%" border="0" cellspacing="0" cellpadding="3" align="center">
	 <tr>
	  <td class="NoiseErrorDataTD" colspan="<?php echo  $numcam; ?>">Usted va a eliminar los siguientes registros. �Desea continuar?</td>
	 </tr>
	 <tr>
	 <td colspan="<?php echo  $numcam; ?>">&nbsp;</td>
	 </tr>
		<?php
		$idcon = fncconn();

		for($i=0; $i<$numreg; $i++)
		{
			$bar = explode('|', $values[$i]);
			$funct = loadrecord.$nombtabl;
			$arr_data = $funct($bar[0], $idcon);

			echo '<tr>';
			foreach ($campos as $k => $v)
			{
				if(is_string($v))
				{
					echo "<td>".$arr_data[trim($v)]."</td>";
				}
			}
			echo '</tr>';
		}
		fncclose($idcon);
		?>
	 <tr>
	  <td colspan="<?php echo  $numcam; ?>">&nbsp;</td>
	 </tr>
   </table>
  </td>
 </tr>
 <tr>
  <td>
  	<div align="center">
  	<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionborrar.value=1; form1.submit();"  width="86" height="18" alt="Aceptar" border=0>
    <input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.arr_borrar.value=''; form1.action='maestabl<?php echo  $nombtabl; ?>.php';"  width="86" height="18" alt="Cancelar" border=0>
	</div>
  </td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
<input type="hidden" name="codigo" value="<?php echo  $codigo; ?>">
<input type="hidden" name="arr_borrar" value="<?php echo  $arr_borrar; ?>">
<input type="hidden" name="nombtabl" value="<?php echo  $nombtabl; ?>">
<input type="hidden" name="selcampos" value="<?php echo  $selcampos; ?>">
<input type="hidden" name="accionborrar" value="0">
</form>
</body>
</html>