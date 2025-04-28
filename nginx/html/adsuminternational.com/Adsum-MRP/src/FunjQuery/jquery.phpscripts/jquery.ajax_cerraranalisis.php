<?php 
	include '../../FunPerPriNiv/pktblcierreanalisismp.php';
	include '../../FunPerPriNiv/pktblcierreanalisispr.php';
	include '../../FunPerPriNiv/pktblanalisismp.php';
	include '../../FunPerPriNiv/pktblanalisispr.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunGen/cargainput.php';
	
	
	define("e_connection",-1);
	define("e_db",-2);
	define("e_empty",-3);
	define("cero",0);
	define("n1",1);

	$idcon = fncconn();

	if($idcon){

		if($idcierre == 1){

			$iRcierreanalisismp["cierrecodigo"] = $cierrecodigo;
			$iRcierreanalisismp["cierrefecha"] = date("Y-m-d");
			$iRcierreanalisismp["cierrehora"] = date("H:i:s");
			$iRcierreanalisismp["tipcumcodigo"] = $tipcumcodigo;
			$iRcierreanalisismp["usuacodi"] = $idusuario;
			$iRcierreanalisismp["cierredescri"] = $cierredescri;

			if(insrecordcierreanalisismp($iRcierreanalisismp,$idcon)  > 0)	{

				unset($iRanalisismp);
				$iRanalisismp["analiscodigo"]= $cierrecodigo;
				$iRanalisismp["analisestado"]= 2;//estado cierre
				uprecordanalisismp($iRanalisismp,$idcon);

			}else{

				echo e_db;break;

			}
		

		}else if($idcierre == 2){

			$iRcierreanalisispr["cierrecodigo"] = $cierrecodigo;
			$iRcierreanalisispr["cierrefecha"] = date("Y-m-d");
			$iRcierreanalisispr["cierrehora"] = date("H:i:s");
			$iRcierreanalisispr["tipcumcodigo"] = $tipcumcodigo;
			$iRcierreanalisispr["usuacodi"] = $idusuario;
			$iRcierreanalisispr["cierredescri"] = $cierredescri;

			if(insrecordcierreanalisispr($iRcierreanalisispr,$idcon)  > 0)	{

				unset($iRanalisismp);
				$iRanalisismp["analiscodigo"]= $cierrecodigo;
				$iRanalisismp["analisestado"]= 2;//estado cierre
				uprecordanalisispr($iRanalisismp,$idcon);

			}else{

				echo e_db;break;

			}

		}else{

			echo e_connection;break;

		}

	}else{
		echo e_connection;break;
	}


	echo n1;break;
?>