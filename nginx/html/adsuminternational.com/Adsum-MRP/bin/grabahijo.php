<?php
/*
Propiedad intelectual de Adsum (c).
Funcion         : fnchijo
Decripcion      : Encuentra los hijos de un componente del menu.
Parametros      : Descripicion
   $intusuacodi   codigo  del usuario.
Retorno         : Descripicion
  true  = 1
  false = 0
Autor           : ariascos
Fecha           : 20-mar-2001

Modificación	: lfolaya
Fecha			: 07-abr-2005
Descripción		: Encuentra los hijos de un componente, organizando por modulos,submodulos,opcion del menu, componente y subcomponente.
*/

define ("n",0);
define ("n1",1);
define ("n2",2);
define ("n3",3);
define ("n4",4);

$rectemp [n][n]=" ";
$rectemp1 [n]=" ";
$cont = n;
$cant = n;

// *********** funcion recursiva **********************
function recursiva($inumecocopa)
{
    global $rectemp,$rectemp1,$cont,$cant;
	for($j = n ; $j < $cont; $j++)
	{
	    if($inumecocopa == $rectemp[n1][$j])
		{
			$rectemp1[$cant] = $rectemp[n][$j];
            $cant ++;
            recursiva($rectemp[n][$j]);
   		}
	}
    return;
}

function grabahijo($inuarr,$inuarrpad,$inuidgrupotemp)
{
    define ("e_conn",-1);
	define ("e_db",-2);
	define ("e_empty",-3);
	
    global $rectemp,$rectemp1,$cont,$cant;
    $nuconn = fncconn();
    $nuresult = fullscanmenucomp($nuconn);
    if($nuresult && $nuresult != e_empty && $nuresult != e_db && $nuresult != e_conn)
    {
        $nucantrow = fncnumreg($nuresult);
        
        for($j = n;$j < $nucantrow; $j++)
        {
            $recresult = fncfetch($nuresult,$j);
            $rectemp[n][$j]= $recresult[mecocodi];

            $rectemp[n1][$j]= $recresult[mecocopa];
            $cont ++;
        }
    }
    
    if($inuarr)
    {
    	include('../src/FunPerPriNiv/fnccommit.php');
    	// Ciclo para grabar las opciones del menu(maestros) y subcomponentes
    	for($i = 0;$i < count($inuarr); $i++)
        {
            $carr1 = array("grupcodi"=>$inuidgrupotemp,"mecocodi"=>$inuarr[$i]);	//submodulos
            
            $gresult=insrecordgrupcomp($carr1,$nuconn);
            recursiva($inuarr[$i]);
        }
    
       	// Ciclo para hallar y grabar los submodulos
    	for($i = 0;$i < count($inuarr); $i++)
        {
        	$resultmenu = loadrecordmenucomp($inuarr[$i],$nuconn);
        	if($resultmenu["timecodi"] == 4)
        	{
        		$resultmenuco = loadrecordmenucomp($resultmenu["mecocopa"],$nuconn);
        		if($resultmenuco["timecodi"] == 3)
        		{
        			$carrsub = array("grupcodi"=>$inuidgrupotemp,"mecocodi"=>$resultmenuco["mecocodi"]);	//maestros
            		$resultsub = insrecordgrupcomp($carrsub,$nuconn);
        		}
        	}
        	
        	$carr1 = array("grupcodi"=>$inuidgrupotemp,"mecocodi"=>$inuarr[$i]);	//maestros
            $gresult=insrecordgrupcomp($carr1,$nuconn);
            //recursiva($inuarr[$i]);
        }
    }
// ------------------
	
    for($z = 0; $z < count($inuarrpad); $z++)
    {
        $carr2 = array("grupcodi"=>$inuidgrupotemp,"mecocodi"=>$inuarrpad[$z]);	//MOdulo
        $gresult=insrecordgrupcomp($carr2,$nuconn);
    }
    
    for($c = n; $c < count($rectemp1); $c++)
    {
    	$resultcomp = loadrecordmenucomp($rectemp1[$c],$nuconn);
    	
    	if($resultcomp["timecodi"] == 6)
    	{
    		$arr = array("grupcodi"=>$inuidgrupotemp,"mecocodi"=>$rectemp1[$c]);
    		$gcresult = insrecordgrupcomp($arr,$nuconn);
    	}
    }
    fnccommit($inuconn);
    fncclose($nuconn);
}
?>