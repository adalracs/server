<?php
	include ( "../src/FunGen/sesion/fncvallogin.php");
	include ( "../src/FunGen/sesion/fncaccion.php");
	include ( '../src/FunGen/fncstrfecha.php');
	
	$navmov = 0;
	$navmov = 1;
	if($id && $pass)
	{
		fncaccion(fncvallogin($id,$pass),$id,$pass, $navmov);
	}
?>
<html>
	<head>
		<title>Adsum Kallpa :::::::Sistema de gesti&oacute;n de mantenimiento</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="X-UA-Compatible" content="IE=9" >
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.funtionsusers.js"></script>
		<style type="text/css">
			<!--
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
				font-family: Tahoma;
			}
			
			.ui-widget-header {font-size: 12px;}
			-->
		</style>
		<script language="javascript">
			$(function(){
				$('#entrarlog').button({ icons: { primary: "ui-icon-person" } }).click(function() {
					if(document.getElementById('id').value == '' || document.getElementById('pass').value == '')
					{
						document.getElementById('msg').innerHTML = '<p>Debe ingresar Usuario y Contrase&ntilde;a</p>';
						$('#msgwindow').dialog('open');
					}
					else
					{
						accionComprobarUsuario();
					}
					return false;
				});
				
				$('#salirlog').button({ icons: { primary: "ui-icon-squaresmall-close" } }).click(function() {
					window.close();					
					return false;
				});

			});
			
		
			function resolutions()
			{
				window.resizeTo(screen.availWidth, screen.availHeight); 
				window.moveTo(0,0);
			}
		</script>
	</head>
	<body onLoad="resolutions(); window.document.login.id.focus();">
							<table  align="center" cellpadding="0" cellspacing="0" border="0" width="200px">
		  						<tr><td>&nbsp;</td></tr>
                                <tr><td class="ui-widget-header">&nbsp;Bienvenido a Adsum Kallpa</td></tr>
		  					</table>
		  					<form name="login" method="post">
							  <table  align="center" cellpadding="4" cellspacing="0" border="0" width="200px" class="ui-widget-content">
			  						<tr>
			    						<td style="font-size: 12px;" align="center">Nombre de usuario</td>
			  						</tr>
			  						<tr>
			  						  <td align="center"><input name="id" id="id" type="text" value="<?php echo $id;?>"></td>
		  						  </tr>
			  						<tr>
			  						  <td align="center"><span style="font-size: 12px;">Contrase&ntilde;a</span></td>
		  						  </tr>
			  						<tr>
			    						<td align="center"><input name="pass" id="pass" type="password"></td>

			  						</tr>
			  						<tr><td colspan="3" align="right">
			  							<div class="ui-buttonset" align="center">
											<button id="entrarlog">Entrar</button>&nbsp;&nbsp;<button id="salirlog">Salir</button>
										</div>
		<!--	  							<input type="submit" value="Aceptar" name="submit">-->
			  						</td></tr>
								</table>
		  					</form>
	</body>
</html>