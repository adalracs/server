<?php 
	$ajax = 1;
	
	include_once '../../FunGen/floadtipo'.$acron.'camperequipo.php';
	include_once '../../FunPerSecNiv/fncnumreg.php';
	include_once '../../FunPerSecNiv/fncfetch.php';
	include_once '../../FunPerSecNiv/fncconn.php';
	include_once '../../FunPerSecNiv/fncclose.php';
	
	include_once('../../FunPerPriNiv/pktblcampo.php');
	include_once('../../FunPerPriNiv/pktbltipo'.$origen.'.php');
	include_once('../../FunPerPriNiv/pktbltipo'.$origen.'camperequipo.php');
	include_once('../../FunPerPriNiv/pktblcamperequipo.php');
	
	$idcon = fncconn();
	$nuResult = call_user_func('floadtipo'.$acron.'camperequipo',$codigo,$campnomb,$flagsistema,$idcon);
	fncclose($idcon);