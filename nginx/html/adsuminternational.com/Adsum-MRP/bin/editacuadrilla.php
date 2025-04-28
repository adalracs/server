<?php 
include ( '../src/FunPerPriNiv/pktblcuadrilla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editacuadrilla($iRegcuadrilla,&$flageditarcuadrilla,&$campnomb,&$codigo)
{	
	$nuconn = fncconn(); 
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
	
	if ($iRegcuadrilla)
	{ 
		$iRegtabla["tablnomb"] = "cuadrilla";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "cuadrilla")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegcuadrilla))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
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
								$flageditarcuadrilla = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1)
			{ 
				$flageditarcuadrilla = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetacuadrilla($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{ 
				$flageditarcuadrilla = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
//			if($elementos[0]=='cuadrinombre')
//			{
//				if($elementos[1] != null)
//				{
//					$validnombre =  fncnombeditexs('cuadrilla',$iRegcuadrilla,$elementos[0],$elementos[1],'cuadricodigo',$iRegcuadrilla[cuadricodigo],$nuconn);
//					
//					if ($validnombre == 1){
//						fncmsgerror(errorNombExs);
//						$flageditarcuadrilla = 1;
//						$flagerror = 1;
//						$campnomb[$elementos[0]] = 1;
//						unset ($validnombre);
//					}
//				}else{
//					$flageditarcuadrilla = 1;
//					$flagerror = 1;
//					$campnomb[$elementos[0]] = 1;					
//				}
//			}
		} 
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = uprecordcuadrilla($iRegcuadrilla,$nuconn); 
			
			if($result < 0 )
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarcuadrilla=1; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 

$arr_tecnico = explode(',', $lsttecnico);

for($a = 0; $a < count($arr_tecnico); $a++)
	if($arr_tecnico[$a] == $usualider) $enc = 1;

if($lsttecnico && !$enc)
{
	echo '<script language= "javascript">';
	echo '<!--//'."\n";
	echo 'alert("Debe seleccionar el lider de cuadrilla")';
	echo '//-->'."\n";
	echo '</script>';
	$flageditarcuadrilla = 1;
	$campnomb['lider'] = 1;
}
else
{
	$iRegcuadrilla[cuadricodigo] = $cuadricodigo; 
	$iRegcuadrilla[cuadrinombre] = $cuadrinombre; 
	$iRegcuadrilla[servicicodigo] = $servicicodigo; 
	$iRegcuadrilla[cuadriacti] = $cuadriacti;  
	$iRegcuadrilla[arefuncodigo] = $arefuncodigo; 

	editacuadrilla($iRegcuadrilla, $flageditarcuadrilla, $campnomb, $codigo); 

	if(!$flageditarcuadrilla)
	{
		$idcon = fncconn();
		
		if($lstzona)
		{
			include_once '../src/FunPerPriNiv/pktblcuadrizona.php';
	
			delrecordcuadrizona($cuadricodigo, $idcon);
			
			$arr_zona = explode(',', $lstzona);
			$arr_subzona = explode(',', $lstsubzona);
			
			for($a = 0; $a < count($arr_zona); $a++)
			{
				for($b = 0; $b < count($arr_subzona); $b++)
				{
					$sar_subzona = explode('|', $arr_subzona[$b]);
					
					if($sar_subzona[0] == $arr_zona[$a])
					{
						$iRegcuadrizona['cuadricodigo'] = $cuadricodigo;
						$iRegcuadrizona['zonacodigo'] = $sar_subzona[0];
						$iRegcuadrizona['subzoncodigo'] = $sar_subzona[1]; 
				
						insrecordcuadrizona($iRegcuadrizona, $idcon);
						
						$ret = true;
					}
					unset($iRegcuadrizona);
				}
				
				if(!$ret)
				{
					$iRegcuadrizona['cuadricodigo'] = $cuadricodigo;
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
			
			delrecordcuadrillausuario($cuadricodigo ,$idcon);
			$arr_tecnico = explode(",",$lsttecnico);
			
			for($i = 0; $i < count($arr_tecnico); $i++)
			{
				$iRegcuadrillausuario['cuadricodigo'] = $cuadricodigo;
				$iRegcuadrillausuario['usuacodi'] = $arr_tecnico[$i];
				$iRegcuadrillausuario['cuausulider'] = 'f';
				
				if($arr_tecnico[$i] == $usualider)
					$iRegcuadrillausuario['cuausulider'] = 't';
					
				insrecordcuadrillausuario($iRegcuadrillausuario, $idcon); 
			}
		}
		
		if($arrcalendario)
		{
			include_once ( '../src/FunGen/fncnumprox.php');
			include_once ( '../src/FunGen/fncnumact.php');
			include '../src/FunPerPriNiv/pktblcalendario.php';
			include '../src/FunPerPriNiv/pktblusuacalendario.php';
			
			$rw_calendar = explode(":-:", $arrcalendario);
			
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

				$rs_calendario = loadrecordcalendario($rw_event[0], $idcon);
				$cuadricode = $rw_event[0];
				$result = 1;
				
				if($rs_calendario < 0 && $rw_event[0] != 'old')
				{
					if($rw_event[5] == '1')
					{
						$recordCalendar['cuadricodigo'] = $cuadricodigo;
						$recordCalendar['calendfecini'] = $rw_event[1];
						$recordCalendar['calendhorini'] = $rw_event[2];
						$recordCalendar['calendfecfin'] = trim($rw_event[3]);
						$recordCalendar['calendhorfin'] = trim($rw_event[4]);
						$recordCalendar['calenddescan'] = $rw_event[5];
						$recordCalendar['turnocodigo'] = $rw_event[6];
					}
					else
					{
						$recordCalendar['cuadricodigo'] = $cuadricodigo;
						$recordCalendar['calendfecini'] = $rw_event[1];
						$recordCalendar['calendhorini'] = $rw_event[2];
						$recordCalendar['calendfecfin'] = $rw_event[3];
						$recordCalendar['calendhorfin'] = $rw_event[4];
						$recordCalendar['calenddescan'] = $rw_event[5];
						$recordCalendar['turnocodigo'] = $rw_event[6];
					}
				
					$recordCalendar['calendcodigo'] = $calendcodigo;
					$cuadricode = $calendcodigo;
					$calendcodigo ++;
					
					$result = insrecordcalendario($recordCalendar, $idcon);
				}
					
				if($result > 0 && $rw_event[0] != 'old')
				{
					delrecordusuacalendario($cuadricode, $idcon);	
					$iRegusuacalendario['calendcodigo'] = $cuadricode;				
					
					for($i = 0; $i < count($arr_tecnico); $i++)
					{
						$iRegusuacalendario['usuacodi'] = $arr_tecnico[$i];
						$iRegusuacalendario['usucallider'] = 'f';
						
						if($arr_tecnico[$i] == $usualider)
							$iRegusuacalendario['usucallider'] = 't';
							
						insrecordusuacalendario($iRegusuacalendario, $idcon); 
					}
				}
			}
			
			$nuresult1 = fncnumprox(101,$calendcodigo,$idcon);
			$rs_delcalend = explode(',', $arrcaldelete);
			
			for($a = 0; $a < count($rs_delcalend); $a++)
				delrecordcalendario($rs_delcalend[$a], $idcon);
			
		}
		
		fncmsgerror(3); 
		echo '<script language="javascript">'; 
		echo '<!--//'."\n"; 
		echo 'location ="maestablcuadrilla.php?codigo='.$codigo.'";'; 
		echo '//-->'."\n"; 
		echo '</script>'; 
	}
}