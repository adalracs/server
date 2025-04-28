<?php
	$uploaddir_plano = '../img/planos/';


	if(!file_exists($uploaddir_plano))	
		$rs_buffer_log = @mkdir($uploaddir_plano, 0777);	

	$uploadfile = $uploaddir_plano . basename($_FILES['userfile']['name']);

	if(!file_exists($uploadfile))
	{
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
		{
			include_once( '../src/FunPerSecNiv/fncconn.php');
			include_once('../src/FunGen/fncnumprox.php');
			include_once('../src/FunGen/fncnumact.php');
			
			include ( '../src/FunPerPriNiv/pktblplano.php');
			include ('../src/FunPerPriNiv/pktblplanoplanta.php');

			$nuconn = fncconn();
	
			$nuidtemp = fncnumact(	30,$nuconn);
			do
			{
				$nuresult = loadrecordplano($nuidtemp,$nuconn);
				if($nuresult == e_empty)
				{
					$iRegplano[planocodigo] = $nuidtemp;
					$iRegplanoplanta[planocodigo] = $nuidtemp;
				}
				$nuidtemp ++; 
			}while ($nuresult != e_empty);
	
			$iRegplano['planonombre'] = basename($_FILES['userfile']['name']);
			$iRegplano['planoruta'] =  $uploadfile;
			$result = insrecordplano($iRegplano,$nuconn);
			
			$iRegplanoplanta['plantacodigo'] = $plantacodigo;
			$result = insrecordplanoplanta($iRegplanoplanta,$nuconn);

			echo "success";
		}
		else
	  		echo "error";
	}
	else
		echo "error_exist";