<?php
session_register("nombre");
/*
Propiedad intelectual de Adsum (c).
Funcion         : fncmenu
Decripcion      : Genera el menu de usuario.
Parametros      : Descripicion
    $intusuacodi   codigo  del usuario.
Retorno         : Descripicion
true  = 1
false = 0
Autor           : ariascos
Fecha           : 22-mar-2004
Modificacion	: Se modificó el ciclo en donde se organiza el arreglo de modulos
			  	  porque se estaba omitiendo la ordenacion de la matriz en 
			  	  funcion del campo mecoorde de la tabla menucomp.
Autor			: jcortes
Fecha           : 13-jun-2005
*/

		/* organiza el arreglo de modulos en orden de como deben aparecer */

include_once( '../src/FunPerSecNiv/fncnumreg.php');
include_once( '../src/FunPerPriNiv/fncselectcomgrup.php');
include_once( '../src/FunPerSecNiv/fncfetch.php');
include_once( '../src/FunPerSecNiv/fncconn.php');
include_once( '../src/FunPerSecNiv/fncclose.php');
include_once( '../src/FunPerPriNiv/pktblusuario.php');
include_once( '../src/FunPerPriNiv/pktblusuagrup.php');
include_once( '../src/FunPerPriNiv/pktblgrupcomp.php');
include_once( '../src/FunPerPriNiv/pktblmenucomp.php');
include_once( '../src/FunPerPriNiv/selectincomp.php');
include_once( '../src/FunGen/Menu/fnccomgrunew.php');
include_once( '../src/FunGen/Menu/fncgeninimen.php');
include_once( '../src/FunGen/Menu/fncusugrunew.php');
include_once( '../src/FunGen/Menu/fncgenmennew.php');

define ("n",0);
define ("n1",1);
define ("n2",2);
define ("n3",3);
define ("n4",4);
define ("n5",5);
define ("modulo",2);
define ("submodulo",3);
define ("opcionmenu",4);
define ("componente",5);
settype($rectemp,"array");
settype($rectemp1,"array");
settype($rectemp2,"array");
$cont1 = n;
$GLOBALS[usuacodi]= $_COOKIE[usuacodi];
/*   ***** funcion recursiva ***** */

function selecciona($imenupadre,$isbnombre,$inutipo = 0)
{
	global $rectemp2,$cont1;
	$nucont1 = n1;
	$cont2 = n;
	for($j = n ; $j < $cont1; $j++)
	{
		if($imenupadre == $rectemp2[n1][$j])
		{
			$rectemp3[n][$cont2] = $rectemp2[n][$j];
			$rectemp3[n1][$cont2] = $rectemp2[n2][$j];
			$rectemp3[n2][$cont2] = $rectemp2[n3][$j];
			$rectemp3[n3][$cont2] = $rectemp2[n4][$j];
			$rectemp3[n4][$cont2] = $rectemp2[n5][$j];
			$cont2++;
		}
	}
	//----------------------
	if($cont2 > n1)
	{
		for($i1= n;$i1 < $cont2 - n1  ; $i1++)
		{
			for($j1 = $i1 + n1 ;$j1 < $cont2; $j1++)
			{
				if($rectemp3[n1][$j1] < $rectemp3[n1][$i1])
				{
					$temporal1 = $rectemp3[n][$i1];
					$temporal1a = $rectemp3[n1][$i1];
					$temporal2a = $rectemp3[n2][$i1];
					$temporal3a = $rectemp3[n3][$i1];
					$temporal4a = $rectemp3[n4][$i1];
					
					$rectemp3[n][$i1] = $rectemp3[n][$j1];
					$rectemp3[n1][$i1] = $rectemp3[n1][$j1];
					$rectemp3[n2][$i1] = $rectemp3[n2][$j1];
					$rectemp3[n3][$i1] = $rectemp3[n3][$j1];
					$rectemp3[n4][$i1] = $rectemp3[n4][$j1];
					
					$rectemp3[n][$j1] = $temporal1;
					$rectemp3[n1][$j1] = $temporal1a;
					$rectemp3[n2][$j1] = $temporal2a;
					$rectemp3[n3][$j1] = $temporal3a;
					$rectemp3[n4][$j1] = $temporal4a;
				}
			}
		}
		for($i2= n;$i2 < $cont2; $i2++)
		{
			$recsubmodulo[n][$i2] = $rectemp3[n][$i2];
			$recsubmodulo[n1][$i2] = $rectemp3[n3][$i2];
			$recsubmodulo[n2][$i2] = $rectemp3[n2][$i2];
			$recsubmodulo[n3][$i2] = $rectemp3[n4][$i2];
			$recsubmodulo1[$i2] = $rectemp3[n][$i2];
		}
	}
	else
	{
		if($cont2 != n)
		{
			$recsubmodulo[n][n]= $rectemp3[n][n];
			$recsubmodulo[n1][n]= $rectemp3[n3][n];
			$recsubmodulo[n2][n] = $rectemp3[n2][n];
			$recsubmodulo[n3][n] = $rectemp3[n4][n];
			$recsubmodulo1[n] = $rectemp3[n][n];
			
		}
		
	}
	
	$cant = count ($recsubmodulo1);
	if($inutipo == opcionmenu && $cant == n)
	{
		echo '"'.", ".'"'."text".'"'."));"."\n";
	}
	$nucont2 = n;
	$nucont3 = n;
	$nuflag =n;
	for($k = n; $k < $cant; $k++)
	{
		
		if ($recsubmodulo[n2][$k] == submodulo)
		{
			echo "".$isbnombre.'.'."MTMAddItem(new MTMenuItem(".'"'.
			$recsubmodulo[n1][$k].'"'."));"."\n";
			$sbnombre = $isbnombre."_".$nucont1;
			echo "var ".$sbnombre." = null".";"."\n";
			echo "".$sbnombre."= new MTMenu();"."\n";
			$nuflag =n1;
		}
		else
		{
			if($recsubmodulo[n2][$k] == opcionmenu)
			{
				echo "".$isbnombre.'.'."MTMAddItem(new MTMenuItem(".'"'.
				$recsubmodulo[n1][$k].'"'.", ".'"'.$recsubmodulo[n3][$k]."?codigo=".$recsubmodulo[n][$k];
				
			}
			else
			{
				if($recsubmodulo[n2][$k] == componente)
				{
					$nucont3 ++;
					if($nucont3 < $cant)
					{
						echo '&'.$recsubmodulo[n1][$k].'=1';
					}
					else
					{
						if($nucont3 == $cant)
						{
							echo '&'.$recsubmodulo[n1][$k].'=1'
							.'"'.", ".'"'."text".'"'."));"."\n";
						}
					}
				}
			}
		}
		selecciona($recsubmodulo[n][$k],$sbnombre,$recsubmodulo[n2][$k]);
		if($nuflag == n1)
		{
			
			echo "".$isbnombre.'.'."items[".$nucont2."]".'.'
			."MTMakeSubmenu(".$sbnombre.");"."\n";
			$nuflag = n;
			$nucont2++;
			$nucont1++;
		}
	}
	return;
}



function  fncmenu($intusuacodi)
{
	$sbflag  =n;
	$menor = 1000;
	$cont = n;
	$nuconn = fncconn();
	global $rectemp,$rectemp1,$rectemp2,$cont1;
	$reccadena = call_user_func('fncgenmennew',$intusuacodi,$nuconn);
	if ($reccadena)
	{
		//$reccadena1 = call_user_func('fncelidup',$reccadena);
		$recunique = array_unique($reccadena);
		reset($recunique);
		do
		{
			$reccadena1[]=current($recunique);
			next($recunique);
		}while(current($recunique));
		
		if ($reccadena1)
		{
			//----------------------------------
			
			fncdatacompmenu($reccadena1,$rectemp1,$rectemp2,$cont,$cont1,$nuconn);
			//-----------------------------------------------------------
		}
		

		
		/* organiza el arreglo de modulos en orden de como deben aparecer */
				
		for($i= n;$i < $cont - n1  ; $i++)
		{
			for($j = $i + n1 ;$j < $cont; $j++)
			{
				if($rectemp1[n1][$j] < $rectemp1[n1][$i])
				{
					$temporal = $rectemp1[n][$i];
					$temporal1 = $rectemp1[n1][$i];
					$temporal2 = $rectemp1[n2][$i];
					
					$rectemp1[n][$i] = $rectemp1[n][$j];
					$rectemp1[n1][$i] = $rectemp1[n1][$j];
					$rectemp1[n2][$i] = $rectemp1[n2][$j];
					
					$rectemp1[n][$j] = $temporal;
					$rectemp1[n1][$j] = $temporal1;		
					$rectemp1[n2][$j] = $temporal2;
				}
			}
		}

		
		for($i1= n;$i1 < $cont; $i1++)
		{
			$recmodulo[n][$i1] = $rectemp1[n][$i1];
			$recmodulo[n1][$i1] = $rectemp1[n2][$i1];
		}
		
		/* *****    pinta el menu ***** */
		
		$nucont = n1;
		for($i= n;$i < $cont; $i++)
		{
			$menupadre = $recmodulo[n][$i];
			echo "menu".'.'."MTMAddItem(new MTMenuItem(".'"'.
			$recmodulo[n1][$i].'"'."));"."\n";
			$sbnombre ="number_".$nucont;
			echo "var ".$sbnombre." = null".";"."\n";
			echo "".$sbnombre."= new MTMenu();"."\n";
			$nucont++;
			selecciona($menupadre,$sbnombre);
			
			echo "menu".'.'."items[".$i."]".'.'
			."MTMakeSubmenu(".$sbnombre.");"."\n";
		}
		echo "</script>"."\n";
		echo "</head>"."\n";
		echo "<body onload=".'"'."MTMStartMenu()".'"'." bgcolor=".'"'."#DFE8F6".'"'." text=".'"'."#ffffcc".'"'.
		" link=".'"'."yellow".'"'." alink=".'"'."red".'">'."\n";
		echo "</body>"."\n";
		echo "</html>"."\n";
	}
	fncclose($nuconn);
}
/*
Propiedad intelectual de Adsum (c).
Funcion         : fncdatacompmenu
Decripcion      : Selecciona la data que sera pintada

Parametros      : Descripicion
$ireccomp       :Arreglo con los codigos de los componentes
$rectemp1       :Matriz en donde se guardara la data de los modulos
$rectemp2		:Matriz en donde se guardara el resto de la data
$inuconn		:Id de coneccion
$cont			:contador	
$cont1			:contador
Retorno         : Descripicion
$oreccresult	:matriz con la data de los componentes
Autor           :freina
Fecha           : 21-ago-2001
*/
function fncdatacompmenu($ireccomp,&$rectemp1,&$rectemp2,&$cont,&$cont1,$inuconn)
{
	settype($sbcomp,"array");
	
	$sbcomp = implode(',',$ireccomp);
	
	$nuresult=selectincomp($sbcomp,$inuconn);
	if(is_resource($nuresult))
	{
		$nucantrow = fncnumreg ($nuresult);
		if($nucantrow > n)
		{
			for($i=n;$i<$nucantrow;$i++)
			{
				$rectemp = fncfetch ($nuresult,$i);
				if($rectemp["timecodi"] == modulo)
				{
					$rectemp1[n][$cont] = $rectemp["mecocodi"];
					$rectemp1[n1][$cont] = $rectemp["mecoorde"];
					$rectemp1[n2][$cont] = $rectemp["meconomb"];
					$cont++;
				}
				else
				{
					if($rectemp["timecodi"] == submodulo ||
					$rectemp["timecodi"] == opcionmenu   ||
					$rectemp["timecodi"] == componente)
					{
						$rectemp2[n][$cont1] = $rectemp["mecocodi"];
						$rectemp2[n1][$cont1] = $rectemp["mecocopa"];
						$rectemp2[n2][$cont1] = $rectemp["mecoorde"];
						$rectemp2[n3][$cont1] = $rectemp["timecodi"];
						$rectemp2[n4][$cont1] = $rectemp["meconomb"];
						$rectemp2[n5][$cont1] = $rectemp["mecoscri"];
						$cont1 ++;
					}
				}				
			}
		}
	}
}
fncmenu($usuacodi);
?>
