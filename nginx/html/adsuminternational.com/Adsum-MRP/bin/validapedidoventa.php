<?php 
	
	
	
	function grabapedidoventa($iRegpedidoventa,&$flagnuevopedidoventa,&$campnomb,$tipevecodigo)
	{
		$nuconn = fncconn();
		//	No utilice esta parte si va a utilizar la llave primaria como serial
		define("id",115);
		define("idm",114);
		define("errorReg",1);
		define("errorCar",2);
		define("grabaEx",3);
		define("compinst",4);
		define("venccomp",5);
		define("compactu",6);
		define("fecvalid",7);
		define("errormail",8);
		define("editaEx",9);
		define("errorIng",35);

		$nuidtemp = fncnumact(id,$nuconn);
		do
		{
			$nuresult = loadrecordpedidoventa($nuidtemp,$nuconn);
			if($nuresult == e_empty)
				$iRegpedidoventa[pedvencodigo] = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		
		$nuidtempm = fncnumact(idm,$nuconn);
		do
		{
			$nuresult = loadrecordpedidoventa($nuidtemp,$nuconn);
			if($nuresult == e_empty)
				$iRegpedidoventa[pedvencodigo] = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		
		if($tipevecodigo == 4)
		{			
    		$nuidtempm = fncnumact(idm,$nuconn);
    		($nuidtempm < 1)? $iRegpedidoventa['pedvennumero'] = 'M1': $iRegpedidoventa['pedvennumero'] = 'M'.$nuidtempm;
    		$iRegpedidoventa['pedvenfecelb'] = date('Y-m-d');
		}
		
		if($iRegpedidoventa)
		{
			$iRegtabla["tablnomb"] = "pedidoventa";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
			for($i=0;$i<$num;$i++)
			{
				$sbregtabla = fncfetch($resulttabla,$i);
				if($sbregtabla[tablnomb] == "pedidoventa")
				{
					$tablcodi=$sbregtabla['tablcodi'];
					break;
				}
			}

			$iRegCampo["tablcodi"]=$tablcodi;
			$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			$iRegpedidoventa_b = $iRegpedidoventa;
	
			while($elementos = each($iRegpedidoventa))
			{
				$iRegCampo["campnomb"] = $elementos[0];
				$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
				$num = fncnumreg($resultcampo);
				if($num>0)
				{
					$sbregcampo = fncfetch($resultcampo,0);
						if($sbregcampo["campnomb"] == $elementos[0])
						{
							$respuesta = strcmp($sbregcampo["campnotnull"],"t");
							if($respuesta == 0)
							{
								if($elementos[1] == "")
								{
									$campnomb[$elementos[0]] = 1;
									$flagnuevopedidoventa = 1;
								}
							}
						}
				}
				
				/*
				 $validar = buscacaracter($elementos[1]);	

				if($validar == 1)
				{
					$flagnuevopedidoventa = 1;
					$campnomb[$elementos[0]] = 1;
				}
				*/
				
				$validresult = consulmetapedidoventa($elementos[0],$elementos[1],$nuconn);

				if($validresult == 1)
				{
					$flagnuevopedidoventa = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validresult);
				}
			}
		}	
	}

grabapedidoventa($iRegpedidoventa,$flagnuevopedidoventa,$campnomb,$tipevecodigo);
//$flagnuevoproducto = $flagnuevopedidoventa;

?>