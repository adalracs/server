<?php
 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaopp
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegopp         Arreglo de datos.
$flagnuevoopp    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

ini_set('display_errors',1);
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblopp.php');
include ( '../src/FunPerPriNiv/pktblopextrusion.php');
include ( '../src/FunPerPriNiv/pktblitemdesa.php');
include ( '../src/FunPerPriNiv/pktblprogramaextrusion.php');
include ( '../src/FunPerPriNiv/pktblprogramacorteextrusion.php');
include ( '../src/FunPerPriNiv/pktblopcorteextrusion.php');
include ( '../src/FunPerPriNiv/pktbloppvelocidadpn.php');
include ( '../src/FunPerPriNiv/pktbloppajustepn.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabaopp(&$iRegopp,&$flagnuevoopp,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",147);
	define("id1",145);
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
		$nuresult = loadrecordopp($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegopp[ordoppcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegopp)
	{
		$iRegtabla["tablnomb"] = "opp";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "opp")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegopp_b = $iRegopp;

		while($elementos = each($iRegopp))
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
								$flagnuevoopp = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			$validresult = consulmetaopp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
		}
		
		if($flagnuevoopp == 1)
		{
			$flagerror = 1;
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordopp($iRegopp,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoopp=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);	
				insrecordprogramaextrusion(array('ordoppcodigo' => $iRegopp['ordoppcodigo'], 'prograindice' => 9999),$nuconn);			
			}
			fncclose($nuconn);
		}
	}

}

$iRegopp['ordoppcodigo'] = $ordoppcodigo;
$iRegopp['usuacodi'] = $usuacodi;
$iRegopp['ordoppcantkg'] = $ordoppcantkg;
$iRegopp['ordoppanchot'] = $ordoppanchot;
$iRegopp['equipocodigo'] = $equipocodigo;
$iRegopp['plantacodigo'] = $plantacodigo;
$iRegopp['ordoppcorte'] = $ordoppcorte;
$iRegopp['ordoppcantmt'] = $ordoppcantmt;
$iRegopp['ordoppancref'] = $ordopprefile;
$iRegopp['ordoppcomfir'] = 0;

//antedes de ingresar al graba de opp se valida que se haya ingresado el item y destino de la o las op
unset($arrObject);
if($arrop) $arrObject = explode(',',$arrop);
$idcon = fncconn();
for ($a = 0; $a < count($arrObject); $a++)
{
	$obj_pistas = 'pista_'.$arrObject[$a];
    $obj_proced = 'procedimiento_'.$arrObject[$a];
    $obj_itedes = 'itedescodigo_'.$arrObject[$a];
    
    if(validaint4($$obj_pistas) > 0 || !$$obj_pistas){$campnomb[$obj_pistas] = 1;$flagnuevoopp = 1;}
    if(validaint4($$obj_proced) >0 || !$$obj_proced){$campnomb[$obj_proced] = 1;$flagnuevoopp = 1;}
    if(validaint4($$obj_itedes) > 0 || !$$obj_itedes)
    {	
    	$campnomb[$obj_itedes] = 1;
    	$flagnuevoopp = 1;
    }
    else
    {
	    if($$obj_itedes)
	    {
	    	unset($rwItemdesa);
	    	$rwItemdesa = loadrecorditemdesa($$obj_itedes,$idcon);
	    	if($rwItemdesa < 0)
	    	{
	    		$campnomb[$obj_itedes] = 1;
	    		$flagnuevoopp = 1;
	    	}
	    }
	}
}

if(!$arrvelocidadpn)
{
	$campnomb['arrvelocidadpn'] = 1;
	$flagnuevoopp = 1;
}

if(!$arrajustepn)
{
	$campnomb['arrajustepn'] = 1;
	$flagnuevoopp = 1;
}

fncclose($idcon);
grabaopp($iRegopp,$flagnuevoopp,$campnomb);

//al tener grabado exitoso se procede a actualar las op contenidas en la opp
if(!$flagnuevoopp)
{
	$idcon = fncconn();
	
	unset($arrObject);
	$arrop1 = '';
	if($arrop) $arrObject = explode(',',$arrop);
	for ($a = 0; $a < count($arrObject); $a++)
	{
		$obj_pistas = 'pista_'.$arrObject[$a];
    	$obj_proced = 'procedimiento_'.$arrObject[$a];
    	$obj_itedes = 'itedescodigo_'.$arrObject[$a];
    	
    	$iRegop_opp['ordprocodigo'] = $arrObject[$a];
    	$iRegop_opp['opestacodigo'] = 2;//programada
    	$iRegop_opp['ordoppcodigo'] = $iRegopp['ordoppcodigo'];
    	$iRegop_opp['proceddestin'] = $$obj_proced;
    	$iRegop_opp['equipocodigo'] = $equipocodigo;
    	uprecordop_opp($iRegop_opp,$idcon);
    	$iRegopextrusion_opp['ordprocodigo'] = $arrObject[$a];
    	$iRegopextrusion_opp['ordpropistae'] = $$obj_pistas;
    	$iRegopextrusion_opp['itedescodigo'] = $$obj_itedes;
    	uprecordopextrusion_opp($iRegopextrusion_opp,$idcon);

    	//evento generar orden de corte para extrusion (evento especial)
    	if($ordoppcorte > 0)
		{
			$rwOp = loadrecordop($arrObject[$a],$idcon);

			if($rwOp > 0)
			{
				unset($nuidtemp);$nuidtemp = fncnumact(id1,$idcon);
				do
				{
					$nuresult = loadrecordop($nuidtemp,$idcon);
					if($nuresult == e_empty)
					{
						$rwOp['ordprocodigo'] = $nuidtemp;
					}
					$nuidtemp ++;
				}while ($nuresult != e_empty);

				$rwOp['opestacodigo'] = 1;//generada
				$rwOp['procedcodigo'] = $ordoppcorte;	
				$rwOp['ordoppcodigo'] = null;
				$rwOp['equipocodigo'] = null;
				if( insrecordop($rwOp,$idcon) > 0)
				{
					$arrop1 = ($arrop1)? $arrop1.','.$rwOp['ordprocodigo'] : $rwOp['ordprocodigo'];
					$nuresult1 = fncnumprox(id1,$nuidtemp,$idcon);
				}

				$rwOpextrusion = loadrecordopextrusion($arrObject[$a],$idcon);
				if($rwOpextrusion > 0)
				{
					$rwOpextrusion['ordprocodigo'] = $rwOp['ordprocodigo'];
					$rwOpextrusion['ordpropistae'] = $$obj_pistas;
					$rwOpextrusion['itedescodigo'] = $$obj_itedes;
					$rwOpextrusion['ordproanccxt'] = $rwOpextrusion['ordproancext'];
					$rwOpextrusion['ordproancext'] = null;
					insrecordopcorteextrusion($rwOpextrusion,$idcon);
				}
			}	
		}

	}
	
	unset($arrObject);
	if($arrvelocidadpn) $arrObject = explode(',',$arrvelocidadpn);
	for ($a = 0; $a < count($arrObject); $a++)
	{
		$iRegoppvelocidadpn['ordoppcodigo'] = $iRegopp['ordoppcodigo'];
		$iRegoppvelocidadpn['velocicodigo'] = $arrObject[$a];
		insrecordoppvelocidadpn($iRegoppvelocidadpn,$idcon);
	}
	
	unset($arrObject);
	if($arrajustepn) $arrObject = explode(',',$arrajustepn);
	for ($a = 0; $a < count($arrObject); $a++)
	{
		$iRegoppvelocidadpn['ordoppcodigo'] = $iRegopp['ordoppcodigo'];
		$iRegoppvelocidadpn['ajustecodigo'] = $arrObject[$a];
		insrecordoppajustepn($iRegoppvelocidadpn,$idcon);
	}


	if($ordoppcorte > 0)
	{
		$rwOpp = loadrecordopp($iRegopp['ordoppcodigo'],$idcon);
		if($rwOpp > 0)
		{
			unset($nuidtemp);$nuidtemp = fncnumact(id,$idcon);
			do
			{
				$nuresult = loadrecordopp($nuidtemp,$idcon);
				if($nuresult == e_empty)
				{
					$rwOpp['ordoppcodigo'] = $nuidtemp;
				}
				$nuidtemp ++;
			}while ($nuresult != e_empty);

			$rwOpp['equipocodigo'] = null;

			if( insrecordopp($rwOpp,$idcon) > 0 )
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$idcon);
				insrecordprogramacorteextrusion(array('ordoppcodigo' => $rwOpp['ordoppcodigo'], 'prograindice' => 9999),$idcon);			
			}

			unset($arrObject,$iRegop_opp);
			if($arrop1) $arrObject = explode(',',$arrop1);
			for ($a = 0; $a < count($arrObject); $a++)
			{
		    	$iRegop_opp['ordprocodigo'] = $arrObject[$a];
		    	$iRegop_opp['opestacodigo'] = 2;//programada
		    	$iRegop_opp['ordoppcodigo'] = $rwOpp['ordoppcodigo'];
		    	uprecordop_opp($iRegop_opp,$idcon);
		    }
		}
	}
	
	fncclose($idcon);
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablbandejaextrusion.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}

?> 
