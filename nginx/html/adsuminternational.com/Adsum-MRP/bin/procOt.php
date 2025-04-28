<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos m�todos como funciones queremos que nuestro servidor tenga a su disposicion
Parametros      : null
Retorno         : null
Autor           : jcortes
Fecha           : 15-jul-2005
Modificaci�n:
|Autor		|Motivo												|Fecha
*/
    /*
    incluimos rsServer.php que contiene la class rs_server que ser� la que "extenderemos" 
    */
	include ( '../src/FunGen/fnctimecmp.php'); 
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblparte.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/pktbltransacitem.php');
	include ( '../src/FunPerPriNiv/pktblitemtareot.php');
	include ( '../src/FunGen/sesion/fnccantrow.php'); 
	include ( '../src/FunGen/rsServer.php');
	class procesos_admin extends rs_server
	{

		/*
		Propiedad intelectual de adsum (c).
		Funcion         : mostrarOt
		Decripcion      : realiza la consulta en la base de datos de los datos de una respectiva
						  OT de acuerdo al codigo recibido
		Parametros      : $paramaters el valor de la llave primaria de la OT
		Retorno         : $str		Datos de la OT
		Autor           : jcortes
		Fecha           : 15-jul-2005
		*/	
		function mostrarOt($paramaters)
		{
			if($paramaters[0])
			{
				$idcon = fncconn();
				$sbregot = loadrecordot($paramaters[0],$idcon);
			
				if($sbregot['plantacodigo'])
				{
					$sbregplanta = loadrecordplanta($sbregot['plantacodigo'],$idcon);
					$str = "plantanombre�".$sbregplanta['plantanombre'];
				}
				
				if($sbregot['sistemcodigo'])
				{
					$sbregsistema = loadrecordsistema($sbregot['sistemcodigo'],$idcon);
					$str = $str."@sistemnombre�".$sbregsistema['sistemnombre'];
				}
				
				if($sbregot['equipocodigo'])
				{
					$sbregequipo = loadrecordequipo($sbregot['equipocodigo'],$idcon);
					$str = $str."@equiponombre�".$sbregequipo['equiponombre'];
				}
				
				if($sbregot['componcodigo'])
				{
					$sbregcomponente = loadrecordcomponen($sbregot['componcodigo'],$idcon);	
					$str = $str."@componnombre�".$sbregcomponente['componnombre'];
				}
				
				if($sbregot['partecodigo'])
				{
					$sbregparte = locadrecordparte($sbregot['partecodigo'],$idcon);
					$str = $str."@partenombre�".$sbregparte['partenombre'];
				}
				
				if($sbregot['tipmancodigo'])
				{
					$sbregtipomant = loadrecordtipomant($sbregot['tipmancodigo'],$idcon);
					$str = $str."@tipmannombre�".$sbregtipomant['tipmannombre'];
				}
				
				if($sbregot['prioricodigo'])
				{
					$sbregpriorida = loadrecordpriorida($sbregot['prioricodigo'],$idcon);
					$str = $str."@priorinombre�".$sbregpriorida['priorinombre'];
				}
				
/*				if($sbregot['ordtrafecini'])
				{
					$anno = strtok($sbregot['ordtrafecini'],"-");
					$mes = strtok("-");
					$dia = strtok("-");
					$str = $str."@anno�".$anno;
					$str = $str."@mes�".$mes;
					$str = $str."@dia�".$dia;
				}*/
				
				/*if($sbregot['ordtrafecfin'])
				{
					$anno1 = strtok($sbregot['ordtrafecfin'],"-");
					$mes1 = strtok("-");
					$dia1 = strtok("-");
					$str = $str."@anno1�".$anno1;
					$str = $str."@mes1�".$mes1;
					$str = $str."@dia1�".$dia1;
				}*/
				
				
				if($sbregot['ordtracodigo'])
				{
					$sbregtareot = loadrecordtareot2($sbregot['ordtracodigo'],$idcon);
					$sbregtipotrab = loadrecordtipotrab($sbregtareot['tiptracodigo'],$idcon);
					$str = $str."@tiptracodigo�".$sbregtipotrab['tiptracodigo'];
					$str = $str."@tiptranombre�".$sbregtipotrab['tiptranombre'];
					
					$sbregtarea = loadrecordtarea($sbregtareot['tareacodigo'],$idcon);
					$str = $str."@tareacodigo�".$sbregtarea['tareacodigo'];
					$str = $str."@tareanombre�".$sbregtarea['tareanombre'];
					
					$sbregusuariotareot = loadrecordusuariotareot2($sbregtareot['tareotcodigo'],$idcon);
					$sbregusuario = loadrecordusuario($sbregusuariotareot['usuacodi'],$idcon);
					$str = $str."@empleacod�".$sbregusuario['usuacodi'];
					$str = $str."@empleanomb�".$sbregusuario['usuanombre']." ".$sbregusuario['usuapriape']
					." ".$sbregusuario['usuasegape'];
					
					$ircRecord['usutarcodigo'] = "";
					$ircRecord['usuacodi'] = "";
					$ircRecord['tareotcodigo'] = $sbregtareot['tareotcodigo'];
					$ircRecord['usutarlider'] = "";
					
					$nuResult = dinamicscanusuariotareot($ircRecord,$idcon);
					if($nuResult>0)
					{
						$num=fncnumreg($nuResult);
						if($num>0)
						{
							for($i=0;$i<$num;$i++)
							{
								$auxiliares = fncfetch($nuResult,$i);
								if($auxiliares[usutarlider]=="f")
									$arreglo_aux = $arreglo_aux.$auxiliares[usuacodi].",";
							}
							$str = $str."@arreglo_aux�".$arreglo_aux;
						}
					}
					
					$ircRecord = null;
					$ircRecord['tareotcodigo'] = $sbregtareot['tareotcodigo'];
					/*$nuResult = dinamicscantareotherramie($ircRecord,$idcon);
					
					if($nuResult>0)
					{
						$num=fncnumreg($nuResult);
						if($num>0)
						{
							
							for($i=0;$i<$num;$i++)
							{
								$sbregtareotherramie = fncfetch($nuResult,$i);
								if($sbregtareotherramie['transhercodigo'])
								{
									$sbregtransacherramie = loadrecordtransacherramie(
									$sbregtareotherramie['transhercodigo'],$idcon);
									if($sbregtransacherramie)
									{
										$loadherram = $loadherram.$sbregtransacherramie['herramcodigo']."-".
										$sbregtransacherramie['transhercanti'].",";
									}
								}
							}
							$str = $str."@loadherram�".$loadherram;
						}
					}*/

					//
					$nuResult = dinamicscanitemtareot($ircRecord,$idcon);
					if($nuResult>0)
					{
						$num=fncnumreg($nuResult);
						if($num>0)
						{							
							for($i=0;$i<$num;$i++)
							{
								$sbregitemtareot = fncfetch($nuResult,$i);
								if($sbregitemtareot['itemtarecodigo'])
								{
									$sbregtransacitem = loadrecordtransacitem(
									$sbregitemtareot['transitecodigo'],$idcon);
									if($sbregtransacitem)
									{
										$loaditem = $loaditem.$sbregtransacitem['itemcodigo']."-".
										$sbregtransacitem['transitecantid'].",";
									}
								}
							}
						}
						$str = $str."@loaditem�".$loaditem;
					}
					
					//
				}
				$reporttiedur = fnctimecmp($sbregot["ordtrafecini"],date("Y-m-d"),$sbregot["ordtrahorini"],
				date("H:i:s"));
				if($reporttiedur>=0)
					$str = $str."@reporttiedur�".$reporttiedur;				
				
				while($elementos = each($sbregot))
				{
					$str = $str."@".$elementos[0]."�".$elementos[1];
				}
				
				if($sbregot['ordtrahorini'])
				{
					$hora = strtok($sbregot['ordtrahorini'],":");
					$minuto = strtok(":");
					if($hora>12)
					{
						$pasadmerini = 1;
						$hora = $hora-12;
						if($hora<10)
							$hora = "0".$hora;
					}
					else
					{
						$pasadmerini = 0;
					}
					$str = $str."@pasadmerini�".$pasadmerini;
					$ordtrahorini=$hora.":".$minuto;
					$str = $str."@ordtrahorini�".$ordtrahorini;
				}
				
				if($sbregot['ordtrahorfin'])
				{
					$hora1 = strtok($sbregot['ordtrahorfin'],":");
					$minuto1 = strtok(":");
					if($hora1>12)
					{
						$pasadmerfin = 1;
						$hora1 = $hora1-12;
						if($hora1<10)
							$hora1 = "0".$hora1;
					}
					else
					{
						$pasadmerfin = 0;
					}
					$str = $str."@pasadmerfin�".$pasadmerfin;
					$ordtrahorfin=$hora1.":".$minuto1;
					$str = $str."@ordtrahorfin�".$ordtrahorfin;
				}
				
				if($sbregot['ordtrahorgen'])
				{
					$horagen = strtok($sbregot['ordtrahorgen'],":");
					$minutogen = strtok(":");
					if($horagen>12)
					{
						$horagen = $horagen-12;
						if($horagen<10)
							$horagen = "0".$horagen;
					}
					$ordtrahorgen=$horagen.":".$minutogen;
					$str = $str."@ordtrahorgen�".$ordtrahorgen;
				}
				
				if($str)
				{
					return $str;
				}
				else
				{
					fncclose($idcon);
					return "";
				}
				fncclose($idcon);
			}
			else
			{
				return "";
			}
		}
	}
	
    /* 
        cuando creamos el objeto que tiene los procesos debemos indicar como �nico par�metro un 
        array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
        a cualquier m�todo del objeto.    
    */
    
    $oRS = new procesos_admin( array( 'mostrarOT'));
    // el metodo action es el que recoge los datos (POST) y actua en consideraci�n ;-)
    $oRS->action();
?>