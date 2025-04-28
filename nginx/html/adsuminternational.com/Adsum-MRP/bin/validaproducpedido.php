<?php 
	
	
	
	function grabaproducpedido($iRegproducpedido,&$flagnuevoproducpedido,&$campnomb)
	{
		$nuconn = fncconn();
		//	No utilice esta parte si va a utilizar la llave primaria como serial
		define("id",116);
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
		
		/*
		 * Consecutivo para producto pedido
	 	*/
		$nuidtemp = fncnumact(116,$nuconn);
		do
		{
			$nuresult = loadrecordproducpedido($nuidtemp,$nuconn);
			if($nuresult == e_empty)
				$iRegproducpedido[propedcodigo] = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		unset($nuidtemp);

		if($iRegproducpedido)
		{
			$iRegtabla["tablnomb"] = "producpedido";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
			for($i=0;$i<$num;$i++)
			{
				$sbregtabla = fncfetch($resulttabla,$i);
				if($sbregtabla[tablnomb] == "producpedido")
				{
					$tablcodi=$sbregtabla['tablcodi'];
					break;
				}
			}

			$iRegCampo["tablcodi"]=$tablcodi;
			$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			$iRegproducpedido_b = $iRegproducpedido;
	
			while($elementos = each($iRegproducpedido))
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
									$flagnuevoproducpedido = 1;
								}
							}
						}
				}
				
				$validar = buscacaracter($elementos[1]);	

				if($validar == 1)
				{
					$flagnuevoproducpedido = 1;
					$campnomb[$elementos[0]] = 1;
				}
			
				$validresult = consulmetaproducpedido($elementos[0],$elementos[1],$nuconn);

				if($validresult == 1)
				{
					$flagnuevoproducpedido = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validresult);
				}
			}
		}	
	}
	
grabaproducpedido($iRegproducpedido,$flagnuevoproducpedido,$campnomb);
//$flagnuevoproducto = $flagnuevoproducpedido;

?>