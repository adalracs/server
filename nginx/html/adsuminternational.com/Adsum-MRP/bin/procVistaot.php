<?php 
/*
Propiedad intelectual de adsum (c).
Clase       	: procesos_admin
Decripcion      : definimos tantos m::todos como funciones queremos que nuestro servidor tenga a su disposicion
Parametros      : null
Retorno         : null
Autor           : jcortes
Fecha           : 15-jul-2005
Modificaci::n:
|Autor		|Motivo												|Fecha
*/
/*
incluimos rsServer.php que contiene la class rs_server que será la que 'extenderemos'
*/
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktblvistaot.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktbltransacitem.php');
include ( '../src/FunPerPriNiv/pktbltareotherramie.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblunimedida.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
include ( '../src/FunPerPriNiv/pktblitemtareot.php');
include ( '../src/FunGen/sesion/fnccantrow.php');
include ( '../src/FunGen/rsServer.php');

class procesos_admin extends rs_server
{
	/*
	Propiedad intelectual de adsum (c).
	Funcion         : mostrarReporteot
	Decripcion      : realiza la consulta en la base de datos de los datos de un
					  reporte de OT de acuerdo al codigo recibido
	Parametros      : $paramaters el valor de la llave primaria del reporte de OT
	Retorno         : $str		Datos de el reporte de OT
	Autor           : jcortes
	Fecha           : 15-jul-2005
	*/
	function mostrarOt($paramaters)
	{
		if($paramaters)
		{
			$idcon = fncconn();
			$sbregVistaot = loadrecordvistaot($paramaters[0],$idcon);

			if($sbregVistaot['ordtracodigo'])
			{
				$arrot = loadrecordot($sbregVistaot['ordtracodigo'], $idcon);

				$str = $str.'@ordtrahorgen::'.substr($arrot['ordtrahorgen'], 0, 5);
				$str = $str.'@ordtracodigo::'.$sbregVistaot['ordtracodigo'];
				$str = $str.'@ordtrafecgen::'.$sbregVistaot['ordtrafecgen'];
				$str = $str.'@ordtrafecini::'.$sbregVistaot['ordtrafecini'];
				$str = $str.'@ordtrafecfin::'.$sbregVistaot['ordtrafecfin'];
				$str = $str.'@ordtrahorini::'.substr($sbregVistaot['ordtrahorini'], 0, 5);
				$str = $str.'@ordtrahorfin::'.substr($sbregVistaot['ordtrahorfin'], 0, 5);
				$str = $str.'@ordtranota::'.$sbregVistaot['ordtranota'];
				
				// - - Arreglo de consulta en TareOt
				$sbregtareot['ordtracodigo'] = $sbregVistaot['ordtracodigo'];

				$idres = dinamicscantareot($sbregtareot, $idcon);
				// - - 
				if(!is_numeric($idres))
				{
					$arrtareot = fncfetch($idres, 0);
					
					// - -  Arreglo de consulta en UsuarioTareot
					$sbregusuariotareot['tareotcodigo'] = $arrtareot['tareotcodigo'];
					
					$idresusuariotareot = dinamicscanusuariotareot($sbregusuariotareot, $idcon);
					// - -
					if(!is_numeric($idresusuariotareot))
					{
						$arrusuariosaux = '@usuarios_aux::';
						$num = fncnumreg($idresusuariotareot);

						for($i=0; $i<$num; $i++)
						{
							$arrusuariotareot = fncfetch($idresusuariotareot, $i);

							if($arrusuariotareot['usutarlider'] == 'f')
							{
								$arrusuariosaux = $arrusuariosaux.$arrusuariotareot['usuacodi'].',';
							}
						}

						if(strlen($arrusuariosaux) > 15)
						{
							$len = strlen($arrusuariosaux);
							$arrusuariosaux = substr($arrusuariosaux, 0, ($len-1));
							$str = $str.$arrusuariosaux;
						}
					}
					// - - Arreglo de consulta en ItemTareot
					$sbregitemtareot['tareotcodigo'] = $arrtareot['tareotcodigo'];
					
					$idresitemtareot = dinamicscanitemtareot($sbregitemtareot, $idcon);
					// - -
					if(!is_numeric($idresitemtareot))
					{
						$str_items = '@items_aux::';

						$num = fncnumreg($idresitemtareot);
						
						for($i=0; $i<$num; $i++)
						{
							$arritemtareot = fncfetch($idresitemtareot, $i);
							
							// - - Consulta en TransacItem
							if(!empty($arritemtareot['transitecodigo']))
							{						
								$codtrans = $arritemtareot['transitecodigo'];
								$str_items = $str_items."1, ";
								break;
							}
							// - -
						}
					}
					
					$sbregtareotherramie['tareotcodigo'] = $arrtareot['tareotcodigo'];
					
					$idrestareotherramie = dinamicscantareotherramie($sbregtareotherramie, $idcon);
					
					if(!is_numeric($idrestareotherramie))
					{
						$num = fncnumreg($idrestareotherramie);
						
						for($i=0; $i<$num; $i++)
						{
							$arrtareotherramie = fncfetch($idrestareotherramie, $i);
							
							// - - Consulta en TransacHerramie
							if(!empty($arrtareotherramie['transhercodigo']))
							{
								$codtransherr = $arrtareotherramie['transhercodigo'];
								$str_items = $str_items."2, ";
								break;
							}
						}
					}
				}
			}

			if($sbregVistaot['tipmancodigo'])
			{
				$sbregtipomant = loadrecordtipomant($sbregVistaot['tipmancodigo'],$idcon);
				$str = $str.'@tipmannombre::'.$sbregtipomant['tipmannombre'];
				
				$str_reporte = $str_reporte.'@tipmancodigo::'.$sbregtipomant['tipmancodigo'].','.$sbregtipomant['tipmannombre'];
			}

			if($sbregVistaot['tiptracodigo'])
			{
				$sbregtipotrab = loadrecordtipotrab($sbregVistaot['tiptracodigo'],$idcon);
				$str = $str.'@tiptranombre::'.$sbregtipotrab['tiptranombre'];

				$str_reporte = $str_reporte.'@tiptracodigo::'.$sbregtipotrab['tiptracodigo'].','.$sbregtipotrab['tiptranombre'];
			}
			
			if($sbregVistaot['prioricodigo'])
			{
				$sbregpriorida = loadrecordpriorida($sbregVistaot['prioricodigo'],$idcon);
				$str = $str.'@priorinombre::'.$sbregpriorida['priorinombre'];
				
				$str_reporte = $str_reporte.'@prioricodigo::'.$sbregpriorida['prioricodigo'].','.$sbregpriorida['priorinombre'];
			}

			if($sbregVistaot['tareacodigo'])
			{
				$sbregtarea = loadrecordtarea($sbregVistaot['tareacodigo'],$idcon);
				$str = $str.'@tareanombre::'.$sbregtarea['tareanombre'];
				
				$str_reporte = $str_reporte.'@tareacodigo::'.$sbregtarea['tareacodigo'].','.$sbregtarea['tareanombre'];
			}

			if($sbregVistaot['usuacodi'])
			{
				$sbregusua = loadrecordusuario($sbregVistaot['usuacodi'],$idcon);
				$str = $str.'@empleanomb::'.$sbregusua['usuanombre'].' '.$sbregusua['usuapriape'].' '.$sbregusua['usuasegape'];
				$str = $str.'@empleacod::'.$sbregusua['usuacodi'];
			}

			if($sbregVistaot['plantacodigo'])
			{
				$sbregplanta = loadrecordplanta($sbregVistaot['plantacodigo'], $idcon);
				$str = $str.'@plantanombre::'.$sbregplanta['plantanombre'];
			}

			if($sbregVistaot['sistemcodigo'])
			{
				$sbregsistema = loadrecordsistema($sbregVistaot['sistemcodigo'], $idcon);
				$str = $str.'@sistemnombre::'.$sbregsistema['sistemnombre'];
			}

			if($sbregVistaot['equipocodigo'])
			{
				$sbregequipo = loadrecordequipo($sbregVistaot['equipocodigo'], $idcon);
				$str = $str.'@equiponombre::'.$sbregequipo['equiponombre'];
			}

			if($sbregVistaot['componcodigo'])
			{
				$sbregcomponen = loadrecordcomponen($sbregVistaot['componcodigo'], $idcon);
				$str = $str.'@componnombre::'.$sbregcomponen['componnombre'];
			}
			
			
			if(strlen($str_items) > 12)
			{
				$len = strlen($str_items);
				$str_items = substr($str_items, 0, ($len-2));
				$str = $str.$str_items;
			}
			
			if($str)
			{
				return $str.$str_reporte;
			}
			else
			{
				fncclose($idcon);
				return '';
			}
			fncclose($idcon);
		}
		else
		{
			return '';
		}
	}
}

/*
cuando creamos el objeto que tiene los procesos debemos indicar como ::nico par::metro un
array con todas las funciones posibles ... esto se hace para evitar que se pueda llamar
a cualquier m::todo del objeto.
*/

$oRS = new procesos_admin(array('mostrarOt'));
// el metodo action es el que recoge los datos (POST) y actua en consideraci::n ;-)
$oRS->action();
?>