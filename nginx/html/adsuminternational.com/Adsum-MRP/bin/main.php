<?php
include('../src/FunGen/fnccargapresentac.php');
$arrPresentac['presenloggra'] = fnccargapresentac(2);
$arrPresentac['presenemppre'] = fnccargapresentac(_PRESE);
$arrPresentac['presenempcop'] = fnccargapresentac(_COPYR);
$GLOBALS[usuacodi]= $_COOKIE[usuacodi];
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include ('../def/jquery.library_maestro.php'); ?> 
<link rel="shortcut icon" href="../img/favicon.ico" />
<link rel="icon" type="image/png" href="../img/favicon.png" />
</head>

<body bgcolor="#FFFFFF" text="#000000">
<form>
<div align="center">
  <p><img src="<?php echo  $arrPresentac['presenloggra']; ?>"></p>
  <p><font face="Tahoma" size="2"><b><?php echo  $arrPresentac['presenemppre']; ?></b></font></p>
  <p><font face="Tahoma" size="1"><b><?php echo  $arrPresentac['presenempcop']; ?></b></font></p>
</div>
</form>
</body>
</html>