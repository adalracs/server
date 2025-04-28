<?php
  include ( '../src/FunGen/sesion/fncvalsesion.php');
  include ( '../src/FunPerPriNiv/pktblusuario.php');
  $idcon = fncconn();
  $rsUsuario = loadrecordusuario($GLOBALS[usuacodi], $idcon);
?>
<!-- C�digo creado por:
Andr�s Riascos
Fecha: 24092001 -->
<!doctype html>
<html>
<head>
 <!-- <meta HTTP-EQUIV="expires" CONTENT="0"> -->
<title>Adsum Kallpa ::::::: Sistema de gesti&oacute;n de mantenimiento</title>

<link rel="shortcut icon" href="../img/favicon.ico" />
<link rel="icon" type="image/png" href="../img/favicon.png" />
</head>
<?php
	if(!$nures)
	{
		echo "<!--";
	}
?>
<frameset framespacing="0" border="0" cols="*" rows="65px,*">
  <frame name="heading" src="title.php" frameborder="0" scrolling="no" bgcolor="5961a0">
  <frameset border="0" framespacing="0" cols="200,*" rows="*">
    <frameset frameborder="0" framespacing="0" border="0" rows="<?php echo ($rsUsuario['usuabandeja'] > 0)? '60,0,40' : '100,0' ; ?>">
		 <frame marginwidth="5" marginheight="5" src="menu_empty.php" name="menu" frameborder="0" scrolling="AUTO">
		 <frame marginwidth="0" marginheight="0" src="fncmenu.php" name="codigo" scrolling="no" frameborder="0">
		 <?php if($rsUsuario['usuabandeja'] > 0){?>
		 	<frame marginwidth="5" marginheight="5" src="menu_empty1.php" name="menu1" frameborder="0" scrolling="AUTO">
		 <?php }?>
    </frameset>
    <frame id ="frm_set_main" marginwidth="5" marginheight="20" src="main.php" name="text" scrolling="AUTO">
  </frameset>
</frameset><noframes></noframes>
<?php
	if(!$nures)
	{
		echo " -->";
	}
?>
</html>
