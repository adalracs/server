<?php
ob_start();
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblvistasobrecarg.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include('../src/FunGen/fnccargapresentac.php');

if (!session_is_registered('htmlreport'))
	session_register('htmlreport');
?>
<html>
<head>
<title>Sobrecarga de servicios de mantenimientos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="c0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
</head>
<?php
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="FFFFFF" class="NoisePageBODY">
<form name="form1" method="post"  enctype="multipart/form-data">
<TABLE border="0" width="100%">
 <TR>
  <TD>&nbsp;</TD>
  <TD align="center"><B>Adsum Kallpa</B></TD>
 </TR>
 <TR>
  <TD>&nbsp;</TD>
  <TD align="center"><B><?php echo  fnccargapresentac(4); ?></B></TD>
 </TR>
</TABLE>
<BR />
<?php 
include("../src/FunGen/fnccalcsobrecarg.php");
ob_start();
fnccalcsobrecarg($fecini, $fecfin);
$_SESSION['htmlreport'] = ob_get_contents();
?>
<div align="center">
  <input type="image" name="aceptar"  src="../img/aceptar.gif"
onclick="form1.action='main.php';"  width="86" height="18" alt="Aceptar"
border=0>
  <input type="image" name="imprimir"  src="../img/imprimir.gif"
onclick="window.open('detallatimedrepprint.php','printReport','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=600,height=500'); return false;"  width="86" height="18" alt="Aceptar"
border=0>
</div>
</form>
</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>