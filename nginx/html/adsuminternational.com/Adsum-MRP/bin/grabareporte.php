<?php

include ( '../src/FunGen/floadDijkstra.php');
include ( '../src/FunGen/floadparseo.php');
include ( '../src/FunGen/floadarmaarreglo.php');
include('../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/fncprintreport.php');
include('../src/FunPerPriNiv/pktblreporte.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');

function grabareporte($iRegreporte, &$flagnuevoreporte, &$campnomb, $codigo)
{
	define("id",90);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);

	$nuconn = fncconn();
	$nuidtemp = fncnumact(id,$nuconn);

	do
	{
		$nuresult = loadrecordreporte($nuidtemp, $nuconn);

		if($nuresult == e_empty)
		{
			$iRegreporte['reportcodigo'] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	
	$result = insrecordreporte($iRegreporte,$nuconn);


	
	if($result < 0 )
	{
		ob_end_clean();
		fncmsgerror(errorReg);
		$flagnuevoreporte=1;
	}
	if($result > 0)
	{
		$nuresult1 = fncnumprox(id, $nuidtemp, $nuconn);
		fncmsgerror(grabaEx);
	}
	fncclose($nuconn);
}

$idcon = fncconn();	
$sbregtablas = fullscantablaordenada($idcon);
$nuCantRow2 = fncnumreg($sbregtablas);

// I identifica relaciones nulas.
define('I',1000);

// Tamaño de la matriz
$matrixWidth = intval($nuCantRow2);



//Funcion de parseo XML
$data= parseoxml('../etc/data.xml');

// $arrCodFields arma un arreglo con las tablas seleccionadas

// $arrCodTables arma un arreglo con los campos seleccionados 
$arrCodFields = explode(",", $strSelectedFields);
$arrCodTables = explode(",", $strSelectedTables);

// funcion encargada de armar el arreglo xml para que pueda ser interpretado por el algoritmo Dijkstra
$arr=armararreglo($data,$nuCantRow2,$idcon);

// clase encargada de inicializar la funcion Dijkstra
$dijkstra = new Dijkstra($arr, I,$matrixWidth);

// funcion encargada de buscar el camino mas corto entre un punto a hasta un punto b
$dijkstra->findShortestPath(($arrCodTables[0])-1,($arrCodTables[count($arrCodTables)-1]-1));

// donde $arrCodTables[0] comienzo y $arrCodTables[count($arrCodTables)-1] es el fin 

// devuelve la ruta 
$arreglo=$dijkstra -> getResults();

$arrCodTables = explode(",", $arreglo);

//$i=0;
$sqlQuery = "SELECT  ";

for ($t=0;$t<count($arrCodTables);$t++)
{
	$arrCodTables[$t]=$arrCodTables[$t]+1;
}


// este ciclo arma el string de tablas 
foreach ($arrCodTables as $codTabla) {
	$arrDatTable = loadrecordtabla($codTabla, $idcon);
	if (is_array($arrDatTable)) {
		$strTables .= $arrDatTable['tablnomb'].', ';
	}
}
// esta funcion arma el string de los campos
foreach ($arrCodFields as $codField) {
	$arrDatField = loadrecordcampo($codField, $idcon);
	if(is_array($arrDatField)) {
		$arrDatTableAux = loadrecordtabla($arrDatField['tablcodi'], $idcon);

		if (is_array($arrDatTableAux)) {
			$strFields .= $arrDatTableAux['tablnomb'].'.'.$arrDatField['campnomb'].', ';
		}
	}
}



// esta funcion se encarga de armar el join sql consiste en comparar 
// si un nombre de la llave primaria se encuentra en la siguiente tabla 
//si se encuentra arma el join tanto con la tabla primera tabla y con la segunda  y la segunda con la siguiente
//en caso de que hubiera 
for ($l=0;$l<count($arrCodTables);$l++)
{
	
	
	$result=fullscancampocodigo($arrCodTables[$l],$idcon);
    
	if($result)
	$numReg=fncnumreg($result);

	if($numReg){
		for ($i = 0; $i < $numReg; $i++ ){
			$arr = fncfetch( $result,$i );
			
            // esta funcion lista todo los campos de las tablas con el nombre codigo de la tablas intermedias
			$result2= fullscancampocodigo($arrCodTables[$l+1],$idcon);
           
			if($result2)
			$numReg2=fncnumreg($result2);
			if($numReg2){
				for ( $y = 0; $y < $numReg2; $y++ ){
					$arr2 = fncfetch( $result2,$y );
					
					if ($arr2[campnomb]==$arr[campnomb] && $arr[camppkey]=='t') {

						$cadenajoin.= $arr['tablnomb'].'.'.$arr["campnomb"].' = '. $arr2['tablnomb'].'.'.$arr2["campnomb"];
                       
						$y=$numReg2;

                        

					}

				}

			}



		}
	}

	$cadenajoin.= ' and ';




}
//esta arma el orden como se debe ordenar el select 
if (!empty($orderby)) {
	$arrFieldOrderBy = loadrecordcampo($orderby, $idcon);

	if (is_array($arrFieldOrderBy)) {
		$arrTableOrderBy = loadrecordtabla($arrFieldOrderBy['tablcodi'], $idcon);

		if (is_array($arrTableOrderBy)) {
			$strOrderBy = $arrTableOrderBy['tablnomb'].'.'.$arrFieldOrderBy['campnomb'];
		}
	}
}
// estos arman los campos a mostar de lo campos a mostar, de las tablas a consultar
// y el join sql
$strFields = substr($strFields, 0, (strlen($strFields)-2));
$strTables = substr($strTables, 0, (strlen($strTables)-2));
$strJoin = substr($cadenajoin, 0, (strlen($cadenajoin)-9));

// esta es la consulta sql 
$sqlQuery = $sqlQuery.$strFields." FROM ".$strTables .' where '.$strJoin ;
$sqlQuery .= " ORDER BY ".$strOrderBy;
/// estos son los datos que se almacenan en la db
$iRegreporte['reportselect']=$sqlQuery;
$iRegreporte['reportcodcam']=$strSelectedFields;
$iRegreporte['reportfecha']  = date('Y-m-d');
$iRegreporte['reportnombre'] = $reportnombre;
$iRegreporte['reportcodigo'] = $reportcodigo;
// funcion encargada de imprimir la consulta devuelta
$res=fncprintreport($iRegreporte, $codigo, $idcon);

// si hay consulta se dispone a grabar los datos
if ($res!=true) 
{
	grabareporte($iRegreporte, $flagnuevoreporte, $campnomb, $codigo);
}

?>
