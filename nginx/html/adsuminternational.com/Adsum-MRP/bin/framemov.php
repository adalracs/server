<?php
  include ( '../src/FunGen/sesion/fncvalsesion.php');
?>
<!-- C.digo creado por:
Andr.s Riascos
Fecha: 24092001 -->
<html>
<head>
 <!-- <meta HTTP-EQUIV="expires" CONTENT="0"> -->
<title>Adsum Kallpa ::::::: Sistema de gesti&oacute;n de mantenimiento</title>
</head>
<?php
	if(!$nures)
	{
		echo "<!--";
	}
?>
<frameset framespacing="0" border="0" cols="*" rows="65px,*">
  <frame name="heading" src="titlemov.php" frameborder="0" scrolling="no" bgcolor="5961a0">
<frame name="text" src="main.php"></frameset><noframes></noframes>
<?php
 	if(!$nures)
	{
		echo " -->";
	}
?>
</html>

