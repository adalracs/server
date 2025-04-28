<?php
	function grabaot(&$iRegot,&$flagnuevoot,&$codigoot,&$empleacod)
	{
		$nuconn = fncconn();
		//	No utilice esta parte si va a utilizar la llave primaria como serial
		define("idotprog",34);
		$nuidtemp = fncnumact(idotprog,$nuconn);
		do
		{
			$nuresult = loadrecordot($nuidtemp,$nuconn);
			if($nuresult == e_empty)
			{
				$iRegot[ordtracodigo] = $nuidtemp;
				$codigoot = $iRegot[ordtracodigo];
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);

		//	No utilice esta parte si va a utilizar la llave primaria como serial
		if ($iRegot)
		{
			$result = insrecordot($iRegot,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoot = 1;
			}
			if($result > 0)
			{
				//fncmsgerror(grabaEx);
				$nuresult1 = fncnumprox(idotprog,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				$flagnuevoot = null;
			}
			fncclose($nuconn);
		}
	}
	
	
	function grabahistoriaot($iReghistoriaot,&$flagnuevohistoriaot)
	{
		$nuconn = fncconn();

		define("id_histot", 68);

		$nuidtemp = fncnumact(id_histot,$nuconn);
		do
		{
			$nuresult = loadrecordhistoriaot($nuidtemp,$nuconn);
			if($nuresult == e_empty)
			{
				$iReghistoriaot[histotcodigo] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);

		if($iReghistoriaot)
		{
			$result = insrecordhistoriaot($iReghistoriaot,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevohistoriaot=1;
			}
			if($result > 0)
			{
				//No utilice esta parte si va a utilizar la llave primaria como serial
				$nuresult1 = fncnumprox(id_histot,$nuidtemp,$nuconn);
				$flagnuevohistoriaot = null;
			}
			fncclose($nuconn);
		}
	}
?>