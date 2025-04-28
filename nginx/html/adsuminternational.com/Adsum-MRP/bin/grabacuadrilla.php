<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabacuadrilla
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegcuadrilla         Arreglo de datos. 
    $flagnuevocuadrilla    Bandera de validaci�n 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : cbedoya
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 30-November-2007
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblcuadrilla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
 
function grabacuadrilla($iRegcuadrilla,&$flagnuevocuadrilla,&$campnomb, &$cuadricode)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",91); 
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(	id,$nuconn); 
	do{ 
		$nuresult = loadrecordcuadrilla($nuidtemp,$nuconn); 
		if($nuresult == e_empty)
		{ 
			$iRegcuadrilla[cuadricodigo] = $nuidtemp; 
			$cuadricode = $nuidtemp;
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegcuadrilla)
	{ 
		$iRegtabla["tablnomb"] = "cuadrilla";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "cuadrilla")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegcuadrilla))
		{
		    $iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num > 0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "cuadricodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevocuadrilla = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]); 
			
			if($validar == 1)
			{ 
				$flagnuevocuadrilla = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			} 
			$validresult = consulmetacuadrilla($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{ 
				$flagnuevocuadrilla = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				unset ($validresult); 
			} 
			
			/*
			if($elementos[0]=='cuadrinombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('cuadrilla',$iRegcuadrilla,$elementos[0],$elementos[1],$nuconn);
					
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevocuadrilla = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flagnuevocuadrilla = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			} */
		} 
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = insrecordcuadrilla($iRegcuadrilla,$nuconn); 
			
			if($result < 0 )
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevocuadrilla = 1; 
			} 
			if($result > 0) 
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
			fncclose($nuconn); 
		} 
	} 
} 

if($lsttecnico && !$usualider)
{
	echo '<script language= "javascript">';
	echo '<!--//'."\n";
	echo 'alert("Debe seleccionar el lider de cuadrilla")';
	echo '//-->'."\n";
	echo '</script>';
	$flagnuevocuadrilla = 1;
	$campnomb['lider'] = 1;
}
else
{
	$iRegcuadrilla[cuadricodigo] = $cuadricodigo; 
	$iRegcuadrilla[cuadrinombre] = $cuadrinombre; 
	$iRegcuadrilla[servicicodigo] = $servicicodigo; 
	$iRegcuadrilla[cuadriacti] = $cuadriacti; 
	$iRegcuadrilla[arefuncodigo] = $arefuncodigo; 

	grabacuadrilla($iRegcuadrilla, $flagnuevocuadrilla, $campnomb, $cuadricode); 

	if(!$flagnuevocuadrilla)
	{
		$idcon = fncconn();
		
		if($lstzona)
		{
			include_once '../src/FunPerPriNiv/pktblcuadrizona.php';
			delrecordcuadrizona($cuadricode, $idcon);
			
			$arr_zona = explode(',', $lstzona);
			$arr_subzona = explode(',', $lstsubzona);
			
			for($a = 0; $a < count($arr_zona); $a++)
			{
				for($b = 0; $b < count($arr_subzona); $b++)
				{
					$sar_subzona = explode('|', $arr_subzona[$b]);
					
					if($sar_subzona[0] == $arr_zona[$a])
					{
						$iRegcuadrizona['cuadricodigo'] = $cuadricode;
						$iRegcuadrizona['zonacodigo'] = $sar_subzona[0];
						$iRegcuadrizona['subzoncodigo'] = $sar_subzona[1]; 
				
						insrecordcuadrizona($iRegcuadrizona, $idcon);
						
						$ret = true;
					}
					unset($iRegcuadrizona);
				}
				
				if(!$ret)
				{
					$iRegcuadrizona['cuadricodigo'] = $cuadricode;
					$iRegcuadrizona['zonacodigo'] = $arr_zona[$a];
			
					insrecordcuadrizona($iRegcuadrizona, $idcon);
					unset($iRegcuadrizona);
				}
				unset($ret);
			}
		}
		
		if($lsttecnico)
		{
			include( '../src/FunPerPriNiv/pktblcuadrillausuario.php');
			
			$arr_tecnico = explode(",",$lsttecnico);
			
			for($i = 0; $i < count($arr_tecnico); $i++)
			{
				$iRegcuadrillausuario['cuadricodigo'] = $cuadricode;
				$iRegcuadrillausuario['usuacodi'] = $arr_tecnico[$i];
				$iRegcuadrillausuario['cuausulider'] = 'f';
				
				if($arr_tecnico[$i] == $usualider)
					$iRegcuadrillausuario['cuausulider'] = 't';
					
				insrecordcuadrillausuario($iRegcuadrillausuario, $idcon); 
			}
		}
		
		if($arrcalendario)
		{
			include '../src/FunPerPriNiv/pktblcalendario.php';
			include '../src/FunPerPriNiv/pktblusuacalendario.php';
			
			$rw_calendar = explode(":-:", $arrcalendario);
			$arr_tecnico = explode(",",$lsttecnico);
			
			$nuidtemp = fncnumact(101, $idcon); 
			do{ 
				$nuresult = loadrecordcalendario($nuidtemp, $idcon); 
				if($nuresult == -3)
					$calendcodigo = $nuidtemp; 
				$nuidtemp ++; 
			}while ($nuresult != -3); 
			
			
			for($a = 0; $a < count($rw_calendar); $a++)
			{
				$rw_event = explode("::", $rw_calendar[$a]);
				
				if($rw_event[0] < 0 || !$rw_event[0] || $rw_event[0] == '0' || $rw_event[0] == '-1' )
				{
					$recordCalendar['calendcodigo'] = $calendcodigo;
					$calendcodigo ++;
				}
				else
					$recordCalendar['calendcodigo'] = $rw_event[0];
					
				$recordCalendar['cuadricodigo'] = $cuadricode;
				$recordCalendar['calendfecini'] = $rw_event[1];
				$recordCalendar['calendhorini'] = $rw_event[2];
				$recordCalendar['calendfecfin'] = $rw_event[3];
				$recordCalendar['calendhorfin'] = $rw_event[4];
				
				$result = insrecordcalendario($recordCalendar, $idcon);
				
				if($result > 0)
				{
					delrecordusuacalendario($recordCalendar['calendcodigo'], $idcon);					
					
					for($i = 0; $i < count($arr_tecnico); $i++)
					{
						$iRegusuacalendario['calendcodigo'] = $recordCalendar['calendcodigo'];
						$iRegusuacalendario['usuacodi'] = $arr_tecnico[$i];
						$iRegusuacalendario['usucallider'] = 'f';
						
						if($arr_tecnico[$i] == $usualider)
							$iRegusuacalendario['usucallider'] = 't';
							
						insrecordusuacalendario($iRegusuacalendario, $idcon); 
					}
				}
				
				
			}
			$nuresult1 = fncnumprox(101,$calendcodigo,$idcon);
		}
		
		fncmsgerror(3);
		unset($lsttecnico, $usualider, $arrcalendario, $lstzona, $cuadrinombre);
	}
}