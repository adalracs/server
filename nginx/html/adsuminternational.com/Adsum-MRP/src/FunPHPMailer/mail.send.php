<?php 
	include '../src/FunPHPMailer/fncmailconfig.php';
	include '../src/FunPHPMailer/mail.soliserv.php';
	include '../src/FunPHPMailer/mail.reportetecnico.php';
	include_once '../src/FunPHPMailer/class.phpmailer.php';
	 
	function send_mail($mailer_data, $arrData, $send_mail){

		$sbreg = fncloadfileconf('../etc/mail.conf');

		$mail = new PHPMailer();
		$mail->PluginDir = "includes/";
		
		if($sbreg['smtp'])
			$mail->Mailer = "smtp";
		
		if($sbreg['host'])	
			$mail->Host = $sbreg['host'];
				
		if($sbreg["port"])	
			$mail->Port = $sbreg["port"];	
		
		if($sbreg['smtprequery']):
			$mail->SMTPAuth = true;
			$mail->Username = $sbreg['username']; 
			$mail->Password = $sbreg['password'];
		endif;
		
		if($sbreg['timeout'])
			$mail->Timeout = $sbreg['timeout'];
		
		if($sbreg['mail']):
			$mail->From = $sbreg['mail'];
			$mail->FromName = $sbreg['namesoft'];
		else: 
			$mail->From = 'no_reply@plasticel.co';
			$mail->FromName = 'Gestion de Mantenimiento';
		endif;
	
		$mail->IsHTML(true);
		
		//Contenido
		$html = <<<ADSUMAIL
<html> 
	<head> 
		<title>Gestion de Mantenimiento</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
		<meta http-equiv="expires" content="0"> 
		<style type="text/css">
			body {font-family: Arial, Helvetica, sans-serif;}
			.over-table-text { font-size: 12px; }
			.borde-content {border-top: 1px solid #A6C9E2; font-size: 10px; text-align: right;}
			.borde-tabla {border-right: 1px solid #A6C9E2; border-bottom: 1px solid #A6C9E2;}
			.borde-head {background-color:#E8F0F6; border:1px solid #C5DBEC; color:#2E6E9E; font-weight:bold; font-size: 12px; }
			.borde-intabla {border: 1px solid #A6C9E2; }
			.borde-cell {border-top: 1px solid #A6C9E2; border-left: 1px solid #A6C9E2; }
			.borde-incell { background-color:#D4E1EC; font-size: 12px;}
			.borde-datcell { background-color:#E8F0F6; font-size: 12px;}
			.borde-line {border-bottom: 1px dotted #A6C9E2;}
		</style>
	</head>
	<body bgcolor="#FFFFFF" text="#000000">
ADSUMAIL;
	
		$index = 0;
		
		switch ($mailer_data) {
			case 'soliserv': 
				if($sbreg['sendssges']):
					$recept = $send_mail[0];
					$receptccb = $send_mail;
					$index = 1;
					sendMailsoliserv($arrData, $sbreg, $html);
				endif;
			break;
			
			case 'nuevasoliserv': 
				if($sbreg['sendssgen']):
					($sbreg['sendmail']) ? $recept = $sbreg['sendmail'] : $recept = $sbreg['mail'];
					($sbreg['ccmail']) ?  $receptccb = explode(',', $sbreg['ccmail']) : $receptccb = null;
				
					$index = 0;
					sendMailsoliservMant($arrData, $sbreg, $html);
				endif; 
			break;
			
			case 'soliservot': 
				if($sbreg['sendssot']):
					$recept = $send_mail[0];
					$receptccb = $send_mail;
					$index = 1;
					sendMailsolserot($arrData, $sbreg, $html);
				endif; 
			break;
			
			case 'reportot': 
				if($sbreg['sendotrepcer']):
					$recept = $send_mail[0];
					$receptccb = $send_mail;
					$index = 1;
					sendMailReporte($arrData, $sbreg, $html);
				endif; 
			break;
			
			case 'cierreot': 
				if($sbreg['sendotrepcer']):
					$recept = $send_mail[0];
					$receptccb = $send_mail;
					$index = 1;
					sendMailCierre($arrData, $sbreg, $html);
				endif; 
			break;
		}

		$html .= <<<ADSUMAIL
	</body>
</html>
ADSUMAIL;

		//Contenido
		if($recept || $receptccb)
		{
			$mail->AddAddress($recept);
			
			for($b = $index; $b < count($receptccb); $b++)
				$mail->AddCC(trim($receptccb[$b]));

		  	$mail->Subject = $sbreg['subject'];
		  	$mail->Body = $html;
//		  	$mail->AltBody = $html;
		  	$exito = $mail->Send();
		  	
//	  	$intentos = 1; 
//	  	while ((!$exito) && ($intentos < 5)) 
//	  	{
//				sleep(5);
//	     		//echo $mail->ErrorInfo;
//	     		$exito = $mail->Send();
//	     		$intentos = $intentos + 1;	
//	   	}	  	
		  	
	  		if(!$exito) {
				echo "Problemas enviando correo electrónico a ".$valor."<br/>".$mail->ErrorInfo;}	
		   	else {
				echo "Mensaje enviado correctamente";}
		}
	}
