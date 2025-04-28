<?php
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
if(!$flagborrarreporte)
{
include ( '../src/FunGen/sesion/fnccarga.php');
$sbreg = fnccarga($nombtabl,$radiobutton);
if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
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
<title>Borrar registro de reporte</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
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
<p><font class="NoiseFormHeaderFont">Reporte</font></p>

<?php
include('../src/FunGen/fncprintreport.php');

$idcon = fncconn();
fncprintreport($sbreg, $codigo, $idcon, 1);
fncclose($idcon);
?>

<input type="hidden" name="flagdetallarreporte" value="1">
<input type="hidden" name="accionborrarreporte">
<input type="hidden" name="nombtabl" value="reporte">
<input type="hidden" name="reportcodigo" value="<?= $sbreg['reportcodigo']; ?>">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>

</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>
