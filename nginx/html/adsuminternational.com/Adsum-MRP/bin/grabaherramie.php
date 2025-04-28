<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaherramie
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegherramie         Arreglo de datos.
$flagnuevoherramie    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../def/tipocampo.php');
	include ( '../src/FunPerPriNiv/pktblherramie.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include( '../src/FunGen/fncnombexs.php');
	
	function grabaherramie($iRegherramie,&$flagnuevoherramie,&$campnomb, &$herramcodigo)
	{
		$nuconn = fncconn();
		//	No utilice esta parte si va a utilizar la llave primaria como serial
		define("id",43);
		define("errorReg",1);
		define("errorCar",2);
		define("grabaEx",3);
		define("compinst",4);
		define("venccomp",5);
		define("compactu",6);
		define("fecvalid",7);
		define("errormail",8);
		define("editaEx",9);
		define("errorNombExs",18);
		define("errorValneg",23);
		define("errorIng",35);
		$nuidtemp = fncnumact(	id,$nuconn);
		do
		{
			$nuresult = loadrecordherramie($nuidtemp,$nuconn);
			if($nuresult == e_empty)
			{
				$iRegherramie[herramcodigo] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
	
		//	No utilice esta parte si va a utilizar la llave primaria como serial
		if ($iRegherramie)
		{
			// --
			$herramcodigo = $iRegherramie["herramcodigo"];
			// --		
			$iRegtabla["tablnomb"] = "herramie";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
			for($i=0;$i<$num;$i++)
			{
				$sbregtabla = fncfetch($resulttabla,$i);
				if($sbregtabla[tablnomb] == "herramie")
				{
					$tablcodi=$sbregtabla['tablcodi'];
					break;
				}
			}
	
			$iRegCampo["tablcodi"]=$tablcodi;
			$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			$iRegherramie_b = $iRegherramie;
	
			while($elementos = each($iRegherramie))
			{
				$iRegCampo["campnomb"] = $elementos[0];
				$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
				$num = fncnumreg($resultcampo);
				if($num>0)
				{
					$sbregcampo = fncfetch($resultcampo,0);
					if($elementos[0] != "herramcodigo")
					{
						if($sbregcampo["campnomb"] == $elementos[0])
						{
							$respuesta = strcmp($sbregcampo["campnotnull"],"t");
							if($respuesta == 0)
							{
								if($elementos[1] == "")
								{
									$campnomb[$elementos[0]] = 1;
									$flagnuevoherramie = 1;
									$flagerror = 1;
								}
							}
						}
					}
				}
				
				$validar = buscacaracter($elementos[1]);
	
				if($validar == 1)
				{
					$flagnuevoherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
				$validresult = consulmetaherramie($elementos[0],$elementos[1],$nuconn);
	
				if($validresult == 1)
				{
					$flagnuevoherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validresult);
				}
				
				if($elementos[0]=='herramnombre')
				{
					if($elementos[1] != null)
					{
						$validnombre =  fncnombexs('herramie',$iRegherramie_b,$elementos[0],$elementos[1],$nuconn);
						if ($validnombre == 1)
						{
							fncmsgerror(errorNombExs);
							$flagnuevoherramie = 1;
							$flagerror = 1;
							$campnomb[$elementos[0]] = 1;
							unset ($validnombre);
						}
					}
					else 
					{
						$flagnuevoherramie = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
					}
				}
				
				if($elementos[0]=='cencoscodigo' && $elementos[1] == "")
				{
					$flagnuevoherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
				
				if($elementos[0]=='herramvalor' && $elementos[1] < 0)
				{
					fncmsgerror(errorValneg);
					$flagnuevoherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			
			if($flagerror == 1)
			{
				fncmsgerror(errorIng);
			}
			
			if($flagerror != 1)
			{
				$result = insrecordherramie($iRegherramie,$nuconn);
				if($result < 0 )
				{
					ob_end_clean();
					fncmsgerror(errorReg);
					$flagnuevoherramie=1;
				}
				if($result > 0)
				{
					$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
	//				fncmsgerror(grabaEx);
				}
				fncclose($nuconn);
			}
		}
	}
	
	if(!empty($proveedor))
	{
		$iRegherramie[herramcodigo] = $herramcodigo;
		$iRegherramie[cencoscodigo] = $cencoscodigo;
		$iRegherramie[herramnombre] = $herramnombre;
		$iRegherramie[herramvalor] = $herramvalor;
		$iRegherramie[herramdescri] = $herramdescri;
		$iRegherramie[herramdispon] = $herramdispon;
	
		grabaherramie($iRegherramie,$flagnuevoherramie,$campnomb, $herramcodigo);
		
		if(!$flagnuevoherramie)
		{
			$arreglo_aux = $proveedor;
			include('grabaherramieproveedo.php');
			unset($proveedor);
			
			echo '<script language="javascript">'."\n";
			echo '<!--//'."\n";
			echo "alert('Grabado exitoso');"."\n";
			echo '//-->'."\n";
			echo '</script>';
		}
	}
	else 
	{
		echo '<script language="javascript">'."\n";
		echo '<!--//'."\n";
		echo "alert('Debe seleccionar al menos un proveedor');"."\n";
		echo '//-->'."\n";
		echo '</script>';
		
		$flagnuevoherramie = 1;
		$campnomb["proveeselec"] = 1;	
	}