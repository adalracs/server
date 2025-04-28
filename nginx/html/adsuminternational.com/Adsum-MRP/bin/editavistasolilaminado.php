<?php 
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunPerPriNiv/pktblsoliprog.php');
include ( '../src/FunPerPriNiv/pktblop.php');
include ( '../src/FunPerPriNiv/pktblopp.php');
include ( '../src/FunPerPriNiv/pktbloplaminado.php');  
include ( '../src/FunPerPriNiv/pktblplanearutaitempv.php');    
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
include( '../src/FunGen/fncnombeditexs.php');
//constantes
define("editaEx",9);
//----------------------------------------------------------------------------------------------
//se consulta los valores planeados para traer sus cantidades asignadas
//----------------------------------------------------------------------------------------------
//conexion
$idcon = fncconn();
//escaneo a la tabla planeapadreitem
$nr_op = 0;	
$rsPlaneapadreitem = dinamicscanplaneapadreitem(array("produccodigo" => $produccodigo),$idcon);
//consulta numero de materiales 
$nrPlaneapadreitem = fncnumreg($rsPlaneapadreitem);
//recorre consulta
for($i=0;$i<$nrPlaneapadreitem;$i++)
{
	//trae registo de padre item dependiendo de su indice
	$rwPlaneapadreitem = fncfetch($rsPlaneapadreitem,$i);
	$rwpadreitem = loadrecordpadreitem($rwPlaneapadreitem['paditecodigo'],$idcon);
	//objetos a usar
	if($rwpadreitem['paditeconfig'] == '0')
		$obj_estructura = ($obj_estructura)? $obj_estructura.' / '.$rwpadreitem['paditenombre'] : $rwpadreitem['paditenombre'] ;
	if($rwpadreitem['paditecodigo'] == '23')
	{
		//variables a usar 
		$obj_desempeno = 'desempeno_'.$nr_op;
		$obj_tipo = 'tipo_'.$nr_op;
		$obj_calibre = 'calibre_'.$nr_op;
		$obj_cant_kg = 'cant_kg_'.$nr_op;
		$obj_cant_mt = 'cant_mt_'.$nr_op;
		$obj_ancho = 'ancho_'.$nr_op;
		$obj_laminado = 'laminado_'.$nr_op;
		//valor de las variables
		$$obj_desempeno = $rwPlaneapadreitem['plapaddesem'];
		$$obj_tipo = $rwPlaneapadreitem['plapadtipo'];
		$$obj_calibre = $rwPlaneapadreitem['plapadcalib'];
		$$obj_cant_kg = $rwPlaneapadreitem['plapadcantkg'];
		$$obj_cant_mt = $rwPlaneapadreitem['plapadcantmt'];
		$$obj_ancho = $rwPlaneapadreitem['plapadanchoi'];
		//casos para laminados
		switch ($nr_op) {
    		case 0:
        		$$obj_laminado =  'primer laminado';
        		break;
    		case 1:
        		$$obj_laminado =  'segundo laminado';
        		break;
    		case 2:
        		$$obj_laminado =  'tercer laminado';
        		break;
    		case 3:
    			$$obj_laminado = 'cuarto laminado';
    			break;
    		case 4:
    			$$obj_laminado = 'quinto laminado';
    			break;
		}
		$nr_op++; 	
	}		
}
//----------------------------------------------------------------------------------
//se crea la opp en blanco para unir las op's de laminacion
//----------------------------------------------------------------------------------
//consecutivo opp
$nuidtemp = fncnumact(147,$idcon);
do
{
	$nuresult = loadrecordopp($nuidtemp,$idcon);
	if($nuresult == e_empty)
	{
		$iRegopp[ordoppcodigo] = $nuidtemp;
	}
	$nuidtemp ++;
}while ($nuresult != e_empty);
unset($nuidtemp);
//record de opp
$iRegopp[usuacodi] = $usuacodi;
$iRegopp[ordoppcantid] = 0;
$iRegopp[ordoppanchoe] = 0;
$iRegopp[ordoppcalib] = 0;
$iRegopp[ordoppcorte] = 0;
$iRegopp[ordoppmetros] = 0;
//se inserta el registro
$res= insrecordopp($iRegopp,$idcon);
//se actualiza consecutivo de opp
fncnumprox(147,$iRegopp[ordoppcodigo] + 1,$idcon); 
//----------------------------------------------------------------------------------------------
//se insertas las op necesarias dentro de la opp creada anteriormente
//----------------------------------------------------------------------------------------------
//consecutivo de op
$nuidtemp = fncnumact(145,$idcon);
do
{
	$nuresult = loadrecordop($nuidtemp,$idcon);
	if($nuresult == e_empty)
	{
		$iRegop[ordprocodigo] = $nuidtemp - 1;
	}
	$nuidtemp ++;
}while ($nuresult != e_empty);
unset($nuidtemp);
for($a = 0;$a < $nr_op;$a++){
	//variables a usar 
	$obj_desempeno = 'desempeno_'.$a;
	$obj_tipo = 'tipo_'.$a;
	$obj_calibre = 'calibre_'.$a;
	$obj_cant_kg = 'cant_kg_'.$a;
	$obj_cant_mt = 'cant_mt_'.$a;
	$obj_ancho = 'ancho_'.$a;
	$obj_laminado = 'laminado_'.$a;
	//record para orden de produccion
	$iRegop[ordprocodigo] = $iRegop[ordprocodigo] + 1;
	$iRegop[solprocodigo] = $solprocodigo;
	$iRegop[ordoppcodigo] = $iRegopp[ordoppcodigo];
	$iRegop[usuacodi] = $usuacodi;
	$iRegop[ordprofecgen] = date('Y-m-d');
	$rwhora = getdate(time());
	$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
	$iRegop[ordprohorgen] = $hora;
	$iRegop[plantacodigo] = 1;//planta yumbo
	$iRegop[ordproacti] = 1;//orden activa
	$iRegop[procedcodigo] = $procedcodigo;
	$iRegop[opestacodigo] = 1;//creada esta inicial
	$iRegop[ordprodescri] = $solprodescri;
	//se inserta el registro de orden de produccion
	$res = insrecordop($iRegop,$idcon);
	//validacion de consecutivo de campos personalizado de tipo producto
	if($res == -2)
	{
		//consecutivo para campo personalizado
		$nuidtemp = fncnumact(145,$idcon);
		do
		{
			$nuresult = loadrecordop($nuidtemp,$idcon);
			if($nuresult == e_empty)
			{
				$iRegop[ordprocodigo] = $nuidtemp - 1;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		unset($nuidtemp);
		//re asignacion del codigo
		$iRegop[ordprocodigo] = $iRegop[ordprocodigo] + 1;
		//se ingresa el campo personalizado
		$res = insrecordop($iRegop,$idcon);
	}
	//record para el detalle para la gestion de la op
	$iRegoplaminado[ordprocodigo] = $iRegop[ordprocodigo];
	$iRegoplaminado[ordprolamina] = $$obj_laminado;
	$iRegoplaminado[ordprodesem] = $$obj_desempeno;
	$iRegoplaminado[ordprotipo] = $$obj_tipo;
	$iRegoplaminado[ordprocalib] = $$obj_calibre;
	$iRegoplaminado[ordprocantid] = $$obj_cant_kg;
	$iRegoplaminado[ordproanchop] = $$obj_ancho;
	$iRegoplaminado[ordproanchom] = $ancho;
	$iRegoplaminado[ordpropista] = $nropistas;
	$iRegoplaminado[ordprometros] = $$obj_cant_mt;	
	//se le inserta el registro detallado de la operacion de produccion
	$res = insrecordoplaminado($iRegoplaminado,$idcon);
}
//se actualiza consecutivo de op
fncnumprox(145,$iRegop[ordprocodigo] + 1,$idcon); 
/*
* despues que se registran los diferentes eventos de la gestion 
* se reporta en la tabla de {planearutaitempv} que la solicutud de flexografia 
* cambia de estado referentes a la tabla de {soliprogestado}
*/
//se crea el registro para actualizar planearuteitempv ruta del pedidoventa
$iRegplanearutaitempv_[plarutcodigo] = $plarutcodigo;//programada 
$iRegplanearutaitempv_[estsolcodigo] = 2;//programada 
uprecordplanearutaitempvestado($iRegplanearutaitempv_,$idcon);
//desconectar
$flageditarvistasolilaminado = 1;
fncclose($idcon);
fncmsgerror(editaEx);
echo '<script language="javascript">';
echo '<!--//'."\n";
echo 'location ="maestablvistasolilaminado.php?codigo='.$codigo.';"';
echo '//-->'."\n";
echo '</script>';
?>