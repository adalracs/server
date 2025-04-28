<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaequipo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegequipo         Arreglo de datos.
$flagnuevoequipo    Bandera de validaci�n
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
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunPerPriNiv/pktblequipotemp.php');
	include ( '../src/FunGen/datecmp.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include( '../src/FunGen/fncnombexs.php');

	function grabaequipo($iRegequipo,&$flagnuevoequipo,&$fecactual,&$campnomb,&$equipocod, &$iRegequicamper)
	{
		$nuconn = fncconn();
		//	No utilice esta parte si va a utilizar la llave primaria como serial
		define("id",47);
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
		define("errorIng",35);
	
		/*
		$nuidtemp = fncnumact(id,$nuconn);
		do
		{
			$nuresult = loadrecordequipo($nuidtemp,$nuconn);
			if($nuresult == e_empty)
			{
				$iRegequipo['equipocodigo'] = $nuidtemp;
				$equipocod = $iRegequipo['equipocodigo'];
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		*/
		
		$equipocod = $iRegequipo[equipocodigo];
		
		if($iRegequipo)
		{
			$iRegtabla["tablnomb"] = "equipo";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
			for($i=0;$i<$num;$i++)
			{
				$sbregtabla = fncfetch($resulttabla,$i);
	
				if($sbregtabla[tablnomb] == "equipo")
				{
					$tablcodi=$sbregtabla['tablcodi'];
					break;
				}
			}
	
			$iRegCampo["tablcodi"]=$tablcodi;
			$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
	
			$iRegequipo_a = $iRegequipo;
		
			while($elementos = each($iRegequipo))
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
								$flagnuevoequipo = 1;
								$flagerror = 1;
							}
						}
					}
				}
				$validar = buscacaracter($elementos[1]);
		
				if($validar == 1)
				{
					var_dump($elementos[0]);
					var_dump($elementos[1]);
					$flagnuevoequipo = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
	
				if($elementos[0] != 'equipofeccom' && $elementos[0] != 'equipovengar' && $elementos[0] != 'equipofecins')
				{
					$validresult = consulmetaequipo($elementos[0],$elementos[1],$nuconn);
	
					if($validresult == 1)
					{
						$flagnuevoequipo = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validresult);
					}
				}
	
				if($elementos[0] == "tipequcodigo")
				{
					if($elementos[1] == "")
					{
						$flagnuevoequipo = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
					}
				}
			}
	
			while ($element_cam = each($iRegequicamper)) 
			{
				$validar_cam = buscacaracter($element_cam[1]);
	
				if($validar_cam == 1)
				{
					$flagnuevoequipo = 1;
					$flagerror = 1;
					$campnomb[$element_cam[0]] = 1;
				}
			}
			
			if($flagerror == 1)
				fncmsgerror(errorIng);
	
			if($flagerror != 1)
			{
				if($iRegequipo[equipoimagen])
					$iRegequipo[equipoimagen] = "../img/picequipos/imgequipos/equipo".$equipocod.substr($iRegequipo[equipoimagen],strlen($iRegequipo[equipoimagen])- 4);
	
				$result = insrecordequipo($iRegequipo,$nuconn);
	
				if($result < 0)
				{
					ob_end_clean();
					fncmsgerror(errorReg);
					$flagnuevoequipo = 1;
				}
	
//				if($result > 0)
//				{
//					$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
//					fncmsgerror(grabaEx);
//				}
				fncclose($nuconn);
			}
		}
	}
	
	$iRegequipo[equipocodigo] = $equipocodigo;
	$iRegequipo[estadocodigo] = $estadocodigo;
	$iRegequipo[sistemcodigo] = $sistemcodigo;
	$iRegequipo[cencoscodigo] = $cencoscodigo;
	$iRegequipo[equiponombre] = trim($equiponombre);
	$iRegequipo[equipodescri] = str_replace("\ "," ",str_replace('"',"",trim($equipodescri)));
	$iRegequipo[equipofabric] = $equipofabric;
	$iRegequipo[equipomarca] = $equipomarca;
	$iRegequipo[equipomodelo] = $equipomodelo;
	$iRegequipo[equiposerie] = trim($equiposerie);
	$iRegequipo[equipolargo] = $equipolargo;
	$iRegequipo[equipoancho] = $equipoancho;
	$iRegequipo[equipoalto] = $equipoalto;
	$iRegequipo[equipopeso] = $equipopeso;
	$iRegequipo[equipovolta] = $equipovolta;
	$iRegequipo[equipocorrie] = $equipocorrie;
	$iRegequipo[equipopoten] = $equipopoten;
	$iRegequipo[equipofeccom] = $equipofeccom;
	$iRegequipo[equipocinv] = $equipocinv;
	$iRegequipo[equipovengar] = $equipovengar;
	$iRegequipo[equipoviduti] = $equipoviduti;
	$iRegequipo[equipofecins] = $equipofecins;
	$iRegequipo[equipoubicac] = $equipoubicac;
	$iRegequipo[equipovalhor] = $equipovalhor;
	$iRegequipo[equiponohs] = $equiponohs;
	$iRegequipo[equipoacti] = 1;
	$iRegequipo[equipotipo] = $equipotipo;
	$iRegequipo[equiponpas] = $equiponpas;
	$iRegequipo[contracodigo] = $contracodigo;
	$iRegequipo[tipequcodigo] = $tipequcodigo;
	$iRegequipo[equipoimagen] = $rutafoto;
	$iRegequipo[codigosrf] = $codigosrf;
	
	$arr_campers = explode(";",$arreglo_cam);
	foreach ($arr_campers as $x)
	{
		$arr_text = explode(":",$x);
		$iRegequicamper[$arr_text[0]] = $arr_text[1];
	}
	
	grabaequipo($iRegequipo,$flagnuevoequipo,$fecactual,$campnomb,$equipocod, $iRegequicamper);
	
	if(!$flagnuevoequipo)
	{
		if($iRegequicamper)
			include('grabaequipocamperequipo.php');
	
		if($arreglo_aux)
		{
			include('grabanormaseguriequipo.php');
			unset($arreglo_aux);
		}
		
		include('grabausuaequipo.php');
		include('grabaequidocu.php');
		
		unset($rutafoto);
		unset($estadocodigo);
		unset($sistemcodigo);
		unset($usuacodigo);
		unset($cencoscodigo);
		unset($usuanombre);
		
		echo '<script language="javascript">';
		echo 'location ="maestablequipotemp.php?codigo='.$codigo.'"';
		echo '</script>';
		
		
		
	}
