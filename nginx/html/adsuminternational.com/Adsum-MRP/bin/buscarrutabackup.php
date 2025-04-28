<?php
include ( '../src/FunGen/sesion/fncvalses.php');
?>
<!-- Propiedad intelectual de Adsum SA (c)
-Todos los derechos reservados-
Creado con WAG Adsum
Autor: Andr�s A. Riascos D.
Fecha: 26052004
GenVers: 3.1 -->
<html>
<head>
<title>Buscar archivo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function cargardatospadre()
{
 cursopadrenombre =  window.opener.document.form1.cursopadrenombre.value;
}
</script>
</head>
<?php
    if(!$codigo)
    { echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Directorio</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE">
  <tr>
    <td width="256" class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">
Buscar directorio</font></span></td></tr>
<tr>
  <td>
            <table width="85%" border="0" cellspacing="0" cellpadding="3"
align="center">
              <tr>
                <td width="41%" border="1"></td>
<td width="100%"></td>
</tr>
<tr>
 <td colspan="2">
<?php
if(strrpos($moverse,'..'))
{
	$moverse = str_replace('/..','',$moverse);
	$moverse = substr($moverse,0,strrpos($moverse,'/'));
}

if($moverse)
	$moverse = $moverse."/";

if($path == null)
	$path = "/";
elseif($flag == 1)
	$path = "/".$moverse;
else
	$path = "/".$moverse;

echo "Ubicaci&oacute;n: ".$path.'<br><br>';

$handle = opendir($path);

while($file = readdir($handle))
{
	if(is_dir($path) && $file != ".")
	{
		if($file == "..")
		{
			$flag = 1;
			echo "<a href='?path=".$path."&moverse=".$moverse.$file."&codigo=".$codigo."'><img src='../img/volver.gif'>".$file."</a><br>";
		}
		else
		{
			if(!strpos($file,"."))
			{
				echo "<a href='?path=".$path."&moverse=".$moverse.$file."&codigo=".$codigo."'><img src='../img/menu_folder_closed.gif'>".$file."</a><br>";
			}
		}
	}
}
?>
 </td>
 </tr>
 <tr>
 <td colspan="2" align="center">
 <?php echo '<input type="button" name="return" value="Aceptar" onclick="window.opener.document.form1.backupruta.value=\''.$path.'\';window.close();">';
  echo '<input type="button" name="return" value="Cancelar" onclick="window.close();">';?>
 
 </td></tr>
</table>
  </td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
<input type="hidden" name="flag" value="<?php echo $flag;?>">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>
