<?php
ob_start();
	include ( '../src/FunPHPMailer/fncmailconfig.php');
	
	if($saveconfig)
		include('grabamailconfig.php');
	
	$sbreg = fncloadfileconf('../etc/mail.conf');	
	
	$url = $sbreg['url'];
	$host = $sbreg['host'];
	$port = $sbreg['port'];
	$timeout = $sbreg['timeout'];
	$smtp = $sbreg['smtp'];
	
	$smtprequery = $sbreg['smtprequery'];
	
	$username = $sbreg['username'];
	$password = $sbreg['password'];
	
	$namesoft = $sbreg['namesoft'];
	$mail = $sbreg['mail'];
	
	$sendmail = $sbreg['sendmail'];
	$ccmail = $sbreg['ccmail'];	
	
	$headgen_ss_page = str_replace("[s]", "\n", $sbreg['headgen_ss_page']);
	$headman_ss_page = str_replace("[s]", "\n", $sbreg['headman_ss_page']);
	$headges_ss_page = str_replace("[s]", "\n", $sbreg['headges_ss_page']);
	$headot_ss_page = str_replace("[s]", "\n", $sbreg['headot_ss_page']);
	$headrep_ss_page = str_replace("[s]", "\n", $sbreg['headrep_ss_page']);
	$headcier_ss_page = str_replace("[s]", "\n", $sbreg['headcier_ss_page']);
	
	$send_off = $sbreg['send_off'];
	$subject = $sbreg['subject'];
	$foot_page = str_replace("[s]", "\n", $sbreg['foot_page']);

	$sendssgen = $sbreg['sendssgen'];
	$sendssges = $sbreg['sendssges'];
	$sendssot = $sbreg['sendssot'];
	$sendotasg = $sbreg['sendotasg'];
	$sendotges = $sbreg['sendotges'];
	$sendotrepcer = $sbreg['sendotrepcer'];
	
ob_end_flush();
?>
<html>
	<head>
    	<title>Transaccion de correos</title>
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    	<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		
		<?php include('../def/jquery.library_maestro.php');?>

		<script type="text/javascript">
			$(function(){
				$("#configmail").tabs({
					ajaxOptions: {
						error: function(xhr, status, index, anchor) {
							$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
						}
					}
				});
				$( "#configmail" ).tabs( "option", "disabled", [3, 4] );

				
				$('#grabar').click(function(){
					document.form1.submit();
				});
				
			});
			
			
		</script>
		<style type="text/css">
			.estilo1 {font-size: 85%; font-family : Arial } 
			.estilo2 {font-size: 95%; font-family : Arial }
		
			#filtrarlistas {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#filtrarlistas span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			#filtrarclearlistas {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#filtrarclearlistas span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
		</style>
  	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data">
      		<p><font class="NoiseFormHeaderFont">Transacci&oacute;n de correos</font><br><br></p>
      		<div id="configmail">
				<ul>
					<li><a href="#tabs-1">Conexi&oacute;n</a></li>
					<li><a href="#tabs-2">Correos</a></li>
					<li><a href="#tabs-3">Solicitud de Servicio</a></li>
					<li><a href="#tabs-4">Orden asignada al funcionario de mantenimiento</a></li>
					<li><a href="#tabs-5">Orden de trabajo Gestionada</a></li>
					<li><a href="#tabs-6">Orden de trabajo Reportada/Cerrada</a></li>
				</ul>
				<div id="tabs-1">
					<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
						<tr><td class="ui-state-default">&nbsp;Dominio</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		 							<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;URL</td>
										<td width="90%" class="NoiseDataTD">http://<input type="text" name="url" value="<?php echo str_replace('http://', '', $url); ?>" size="60"></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td class="ui-state-default">&nbsp;Configuraci&oacute;n de conexi&oacute;n</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		 							<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;Servidor</td>
										<td width="90%" class="NoiseDataTD"><input type="text" name="host" value="<?php echo $host; ?>" size="50"></td>
									</tr>
		 							<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;Puerto</td>
										<td width="90%" class="NoiseDataTD"><input type="text" name="port" value="<?php echo $port; ?>" size="10"></td>
									</tr>
		 							<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;Time out</td>
										<td width="90%" class="NoiseDataTD"><input type="text" name="timeout" value="<?php echo $timeout; ?>" size="10">&nbsp;segundos</td>
									</tr>
		 							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Servidor de salida SMTP&nbsp;&nbsp;&nbsp;<input type="checkbox" name="smtp" <?php if($smtp) echo 'checked'; ?>></td></tr>
								</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr><td class="ui-state-default">&nbsp;Requiere inicio de sesi&oacute;n utilizando Autenticaci&oacute;n</td></tr>
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		       						<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Requiere inicio de sesi&oacute;n utilizando Autenticaci&oacute;n&nbsp;&nbsp;&nbsp;<input type="checkbox" name="smtprequery" <?php if($smtprequery) echo 'checked'; ?>></td></tr>
		       						<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;Usuario</td>
										<td width="90%" class="NoiseDataTD"><input type="text" name="username" value="<?php echo $username; ?>" size="50"></td>
									</tr>
		 							<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;Contrase&ntilde;a</td>
										<td width="90%" class="NoiseDataTD"><input type="password" name="password" value="<?php echo $password; ?>" size="50"></td>
									</tr>
		      					</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr><td class="ui-state-default">&nbsp;Correo de la aplicaci&oacute;n</td></tr>
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		       						<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;Mostrar nombre</td>
										<td width="90%" class="NoiseDataTD"><input type="text" name="namesoft" value="<?php echo $namesoft; ?>" size="30"></td>
									</tr>
		 							<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;Correo</td>
										<td width="90%" class="NoiseDataTD"><input type="text" name="mail" value="<?php echo $mail; ?>" size="30"></td>
									</tr>
		      					</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr><td class="ui-state-default">&nbsp;Nueva solicitud de servicio</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;<small><b>Aqu&iacute; debe especificar que usuarios recibir&aacute;n la alerta de una nueva solicitud.</b></small></td></tr>
									<tr><td colspan="2" class="NoiseDataTD">&nbsp;Enviar informacion de la nueva solcitud de servicio a:</td></tr>
		 							<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;Email</td>
										<td width="90%" class="NoiseDataTD"><input type="text" name="sendmail" name="sendmail" value="<?php echo $sendmail; ?>" size="50"></td>
									</tr>
		 							<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;CC</td>
										<td width="90%" class="NoiseDataTD"><input type="text" name="ccmail" name="ccmail" value="<?php echo $ccmail; ?>" size="110"></td>
									</tr>
		 							<tr>
										<td width="10%" class="NoiseFooterTD">&nbsp;</td>
										<td width="90%" class="NoiseDataTD">&nbsp;Ej: mi_correo_1@dominio.com, mi_correo_2@dominio.com ...</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<div id="tabs-2">
					<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD"><input type="checkbox" name="sendssgen" <?php if($sendssgen) echo 'checked'; ?>>&nbsp;Enviar correo de confirmaci&oacute;n al funcionario cuando ingrese una nueva <b>Solicitud de Servicio</b></td></tr>
		 							<tr><td class="NoiseFooterTD"><input type="checkbox" name="sendssges" <?php if($sendssges) echo 'checked'; ?>>&nbsp;Enviar correo de informaci&oacute;n al funcionario solicitante cuando se gestione una <b>Solicitud de Servicio</b></td></tr>
		 							<tr><td class="NoiseFooterTD"><input type="checkbox" name="sendssot" <?php if($sendssot) echo 'checked'; ?>>&nbsp;Enviar correo de informaci&oacute;n al funcionario solicitante cuando se genere una <b>Orden de Trabajo</b> a partir de una <b>Solicitud de Servicio</b></td></tr>
		 							<tr><td class="NoiseFooterTD"><input type="checkbox" name="sendotasg" disabled <?php if($sendotasg) echo 'checked'; ?>>&nbsp;Enviar correo de confirmaci&oacute;n al funcionario de mantenimiento al ser asignado a una <b>Orden de Trabajo</b></td></tr>
		 							<tr><td class="NoiseFooterTD"><input type="checkbox" name="sendotges" disabled <?php if($sendotges) echo 'checked'; ?>>&nbsp;Enviar correo de informaci&oacute;n de gestion de la <b>Orden de Trabajo</b></td></tr>
		 							<tr><td class="NoiseFooterTD"><input type="checkbox" name="sendotrepcer" <?php if($sendotrepcer) echo 'checked'; ?>>&nbsp;Enviar correo de informaci&oacute;n de reporte y cierre de la <b>Orden de Trabajo</b></td></tr>
								</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr><td class="ui-state-default">&nbsp;Asunto de los correos</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD"><input type="text" name="subject" value="<?php echo $subject; ?>" size="90"></td></tr>
								</table>
							</td>
						</tr>
						<tr><td class="ui-state-default">&nbsp;Despedida de los correos</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD"><input type="text" name="send_off" value="<?php echo $send_off; ?>" size="90"></td></tr>
								</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr><td class="ui-state-default">&nbsp;Pie de p&aacute;gina de los correos</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD"><textarea rows="4" cols="150" name="foot_page" ><?php echo $foot_page; ?></textarea></td></tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<div id="tabs-3">
					<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
						<tr><td class="ui-state-default">&nbsp;Contenido confirmaci&oacute;n al solicitante</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD">&nbsp;Escriba el contenido al inicio del correo</td></tr>
		 							<tr><td class="NoiseFooterTD"><textarea rows="4" cols="150" disabled name="headgen_ss_page" >Inactivo <?php echo $headgen_ss_page; ?></textarea></td></tr>
								</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr><td class="ui-state-default">&nbsp;Contenido para el departamento de mantenimiento</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD">&nbsp;Escriba el contenido al inicio del correo</td></tr>
		 							<tr><td class="NoiseFooterTD"><textarea rows="4" cols="150" name="headman_ss_page" ><?php echo $headman_ss_page; ?></textarea></td></tr>
								</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr><td class="ui-state-default">&nbsp;Contenido Gesti&oacute;n de la solicitud</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD">&nbsp;Escriba el contenido al inicio del correo</td></tr>
		 							<tr><td class="NoiseFooterTD"><textarea rows="4" cols="150" name="headges_ss_page" ><?php echo $headges_ss_page; ?></textarea></td></tr>
								</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr><td class="ui-state-default">&nbsp;Contenido Generaci&oacute;n Orden de trabajo a partir de la Solicitud</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD">&nbsp;Escriba el contenido al inicio del correo</td></tr>
		 							<tr><td class="NoiseFooterTD"><textarea rows="4" cols="150" name="headot_ss_page" ><?php echo $headot_ss_page; ?></textarea></td></tr>
								</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Para el uso de datos escribe estos tags en el contenido</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NOMBRE_SOLICITANTE}}</td><td class="NoiseDataTD">&nbsp;=&gt; Indica el nombre del funcionario solicitante</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NUMERO_SOLICITUD}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica el n&uacute;mero de Solicitud</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NUMERO_ORDEN_TRABAJO}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica el n&uacute;mero de Orden de trabajo al cual fue asignada la solicitud</td></tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<div id="tabs-4">
					<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Para el uso de datos escribe estos tags en el contenido</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NOMBRE_CLIENTE_DIRECTO}}</td><td class="NoiseDataTD">&nbsp;=&gt; Indica el nombre del cliente inicial</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NOMBRE_CLIENTE_CONTACTO}}</td><td class="NoiseDataTD">&nbsp;=&gt; Indica el nombre del contacto de ubicaci&oacute;n del equipo</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NUMERO_SOLICITUD}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica el numero de Solicitud</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NUMERO_DE_ORDEN}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica el numero de Orden asignado</td></tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<div id="tabs-5">
					<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Para el uso de datos escribe estos tags en el contenido</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NOMBRE_SOLICITANTE}}</td><td class="NoiseDataTD">&nbsp;=&gt; Indica el nombre del funcionario solicitante</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NOMBRE_TECNICO}}</td><td class="NoiseDataTD">&nbsp;=&gt; Indica el nombre del tecnico que gestiona la orden</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NUMERO_SOLICITUD}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica el numero de Solicitud</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NUMERO_DE_ORDEN}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica el numero de Orden asignado</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{FECHA_GESTION}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica la fecha/hora de la gesti&oacute;n</td></tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<div id="tabs-6">
					<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
						<tr><td class="ui-state-default">&nbsp;Contenido Reporte t&eacute;cnico de la orden</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD">&nbsp;Escriba el contenido al inicio del correo</td></tr>
		 							<tr><td class="NoiseFooterTD"><textarea rows="4" cols="150" name="headrep_ss_page" ><?php echo $headrep_ss_page; ?></textarea></td></tr>
								</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr><td class="ui-state-default">&nbsp;Contenido Cierre de la orden</td></tr>	
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD">&nbsp;Escriba el contenido al inicio del correo</td></tr>
		 							<tr><td class="NoiseFooterTD"><textarea rows="4" cols="150" name="headcier_ss_page" ><?php echo $headcier_ss_page; ?></textarea></td></tr>
								</table>
							</td>
						</tr>
						<tr><td></td></tr>
						<tr>
							<td>
		       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		 							<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Para el uso de datos escribe estos tags en el contenido</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NOMBRE_TECNICO}}</td><td class="NoiseDataTD">&nbsp;=&gt; Indica el nombre del tecnico que reporta o cierra la orden</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NUMERO_SOLICITUD}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica el numero de Solicitud</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{NUMERO_DE_ORDEN}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica el numero de Orden asignado</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{FECHA_REPORTE}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica la fecha/hora del reporte</td></tr>
		 							<tr><td class="NoiseDataTD" width="17%">&nbsp;{{FECHA_CIERRE}}</td><td class="NoiseDataTD">&nbsp;=&gt; Identifica la fecha/hora del cierre</td></tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
					<tr><td>&nbsp;</td></tr>
					<tr>
						<td class="NoiseErrorDataTD" align="center">
							<a href="#" id="grabar" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-circle-check"></span>Grabar</a>
						</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
				</table>
			</div>
			<input type="hidden" name="saveconfig" id="saveconfig" value="1">
 		</form>
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body>
<?php if(!$codigo) { echo " -->"; } ?>
</html>