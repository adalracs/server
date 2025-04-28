<?php
	function grabamailconfig($iRegMailConf)
	{
		$file = fopen('../etc/mail.conf',"w+");
			fwrite($file,"##"."\n");
			fwrite($file,"# Propiedad intelectual de Adsum (c)."."\n");
			fwrite($file,"# Todos los derechos reservados"."\n");
			fwrite($file,"#"."\n");
			fwrite($file,"# Aqui se encuentran definidos los parametros de transasccion de correo"."\n");
			fwrite($file,"# generales de la aplicacion."."\n");
			fwrite($file,"# Toda modificacion realizada en este archivo afectara el"."\n");
			fwrite($file,"# buen funcionamiento del modulo de correos."."\n");
			fwrite($file,"##"."\n");
			
			foreach($iRegMailConf as $key => $value)
				fwrite($file, $key."=".$value."\n");
		fclose($file);
	}
	
	
	$iRegMailConf['url'] = 'http://'.str_replace("http://", "", $url);
	($host) ? $iRegMailConf['host'] = $host : $iRegMailConf['host'] = 'localhost';
	($port) ? $iRegMailConf['port'] = $port : $iRegMailConf['port'] = 25;
	$iRegMailConf['timeout'] = $timeout;
	($smtp) ? $iRegMailConf['smtp'] = 1 : $iRegMailConf['smtp'] = 0;
	($smtprequery) ? $iRegMailConf['smtprequery'] = 1 : $iRegMailConf['smtprequery'] = 0;
	$iRegMailConf['username'] = $username;
	$iRegMailConf['password'] = $password;
	$iRegMailConf['namesoft'] = $namesoft;
	$iRegMailConf['mail'] = $mail;
	$iRegMailConf['sendmail'] = $sendmail;
	$iRegMailConf['ccmail'] = $ccmail;
	
	
	$iRegMailConf['headgen_ss_page'] = str_replace("\n", "[s]", $headgen_ss_page);
	$iRegMailConf['headman_ss_page'] = str_replace("\n", "[s]", $headman_ss_page);
	$iRegMailConf['headges_ss_page'] = str_replace("\n", "[s]", $headges_ss_page);
	$iRegMailConf['headrep_ss_page'] = str_replace("\n", "[s]", $headrep_ss_page);
	$iRegMailConf['headcier_ss_page'] = str_replace("\n", "[s]", $headcier_ss_page);
	$iRegMailConf['headot_ss_page'] = str_replace("\n", "[s]", $headot_ss_page);
	$iRegMailConf['foot_page'] = str_replace("\n", "[s]", $foot_page);
	$iRegMailConf['subject'] = $subject;
	$iRegMailConf['send_off'] = $send_off;

	($sendssgen) ? $iRegMailConf['sendssgen'] = 1 : $iRegMailConf['sendssgen'] = 0;
	($sendssges) ? $iRegMailConf['sendssges'] = 1 : $iRegMailConf['sendssges'] = 0;
	($sendssot) ? $iRegMailConf['sendssot'] = 1 : $iRegMailConf['sendssot'] = 0;
	($sendotasg) ? $iRegMailConf['sendotasg'] = 1 : $iRegMailConf['sendotasg'] = 0;
	($sendotges) ? $iRegMailConf['sendotges'] = 1 : $iRegMailConf['sendotges'] = 0;
	($sendotrepcer) ? $iRegMailConf['sendotrepcer'] = 1 : $iRegMailConf['sendotrepcer'] = 0;
	
	grabamailconfig($iRegMailConf);