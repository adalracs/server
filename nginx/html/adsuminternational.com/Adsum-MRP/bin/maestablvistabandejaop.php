<?php
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	
ob_end_flush();
?>
<html>
	<head>
		<title>Bandeja de op programadas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.op.js"></script>
	</head>
	<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Bandeja de op programadas</font></p>			
			<div id="bandejaotgeneral">
				<ul>
					<li><a href="#tabs-1">Bandeja de op</a></li>
				</ul>
				<div id="tabs-1">
				</div>
			</div>
			<input type="hidden" name="accionnuevoopp" />
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
  	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>