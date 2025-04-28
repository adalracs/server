<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabareporte
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegreporte         Arreglo de datos.
$flagnuevoreporte    Bandera de validacion
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
include ( '../src/FunGen/fncprintreportmant.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblreporte.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include('../src/FunPerPriNiv/pktbltabla.php');

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

	fncprintreportmant($iRegreporte, $codigo, $nuconn);
	$reportselect = $iRegreporte['reportselect'];
/*
	for ($i=0; $i<strlen($reportselect); $i++)
	{
		if ($reportselect[$i] == "'")
		$reportselect[$i] = "*";
	}
	$iRegreporte['reportselect'] = $reportselect;

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
	}*/
	fncclose($nuconn);
}
// -------- Se construye la consulta --------
$idcon = fncconn();
$sqlQuery = "SELECT ";

/**
* Codigos de las tablas sobre las cuales se realizara la consulta,
* con sus respectivos atributos
*/


$strSelectedTables="75,10,59,102,67";
$strSelectedFields="44,503,505,368,371,432";

$arrCodTables = explode(",", $strSelectedTables);
$arrCodFields = explode(",", $strSelectedFields);

foreach ($arrCodTables as $codTabla) {
	$arrDatTable = loadrecordtabla($codTabla, $idcon);

	if (is_array($arrDatTable)) {
		$strTables .= $arrDatTable['tablnomb'].', ';
	}
}
$strTables = substr($strTables, 0, (strlen($strTables)-2));


foreach ($arrCodFields as $codField) {
	$arrDatField = loadrecordcampo($codField, $idcon);

	if(is_array($arrDatField)) {
		$arrDatTableAux = loadrecordtabla($arrDatField['tablcodi'], $idcon);

		if (is_array($arrDatTableAux)) {
			$strFields .= $arrDatTableAux['tablnomb'].'.'.$arrDatField['campnomb'].', ';
		}
	}
}
$strFields = substr($strFields, 0, (strlen($strFields)-2));

$sqlQuery = $sqlQuery.$strFields." FROM ".$strTables;

if (!empty($strSelectedPrecon))
{
	$sqlQuery .= " WHERE";
	/**
 	* $arrCodPreFields -> Codigos de los atributos que hacen parte de las precondiciones
 	* $arrValCondition -> Operadores como 'Igual', 'Mayor que', etc.
 	* $arrCodPosFields -> Codigo/Valor de los atributos que hacen parte de las postcondiciones
 	* $arrValConnector -> AND/OR
 	* $qtyQueries -> Cantidad de condiciones
 	*/
	$arrCodPreFields = explode(',', $strSelectedPrecon);
	$arrValCondition = explode(',', $strSelectedCondit);
	$arrCodPosFields = explode(',', $strSelectedPoscon);
	$arrValConnector = explode(',', $strSelectedConnec);

	$qtyQueries = count($arrCodPreFields);

	for ($i=0; $i<$qtyQueries; $i++)
	{
		$QarrDatFields = loadrecordcampo($arrCodPreFields[$i], $idcon);

		if (is_array($QarrDatFields)) {
			$QarrDatTable = loadrecordtabla($QarrDatFields['tablcodi'], $idcon);

			if (is_array($QarrDatTable)) {
				$strQueryPart .= " ".$QarrDatTable['tablnomb'].'.'.$QarrDatFields['campnomb']." ";
			}
		}
		$strQueryPart .= " ".$arrValCondition[$i]." ";

		if (ereg("\|$", $arrCodPosFields[$i]))
		{
			$postValue = substr($arrCodPosFields[$i], 0, (strlen($arrCodPosFields[$i])-1));
			(trim($arrValCondition[$i]) == "LIKE") ? $strQueryPart .= "'%".$postValue."%'": $strQueryPart .= "'".$postValue."'";
		}
		else
		{
			$QarrDatFieldsAux = loadrecordcampo($arrCodPosFields[$i], $idcon);
			
			if (is_array($QarrDatFieldsAux))
			{
				$QarrDatTableAux = loadrecordtabla($QarrDatFieldsAux['tablcodi'], $idcon);

				if (is_array($QarrDatTableAux))
				$strQueryPart .= " ".$QarrDatTableAux['tablnomb'].'.'.$QarrDatFieldsAux['campnomb']." ";
			}
		}

		if (!(($i+1) == $qtyQueries))
		$strQueryPart .= " ".$arrValConnector[$i]." ";
	}
	$sqlQuery .= $strQueryPart;
}

// ORDER BY
if (!empty($orderby)) {
	$arrFieldOrderBy = loadrecordcampo($orderby, $idcon);

	if (is_array($arrFieldOrderBy)) {
		$arrTableOrderBy = loadrecordtabla($arrFieldOrderBy['tablcodi'], $idcon);

		if (is_array($arrTableOrderBy)) {
			$strOrderBy = $arrTableOrderBy['tablnomb'].'.'.$arrFieldOrderBy['campnomb'];
		}
	}
	$sqlQuery .= " ORDER BY ".$strOrderBy;
}

fncclose($idcon);
// -- END --


$reportnombre="Reporte de Mantenimiento x OT Cerrada";

$arreglofec=split("-",$fecini);
$fecini=$arreglofec[0].$arreglofec[1].$arreglofec[2];

$arreglofec=split("-",$fecfin);
$fecfin=$arreglofec[0].$arreglofec[1].$arreglofec[2];

/*$sqlQuery=
"SELECT cierreot.cierotcodigo,reportot.reportcodigo,reportot.tipmancodigo,ot.ordtracodigo,(ot.tipmancodigo) as tipmanot, ot.plantacodigo
FROM ot, cierreot, reportot, planta
WHERE ot.ordtracodigo = reportot.ordtracodigo AND cierreot.reportcodigo=reportot.reportcodigo AND ot.plantacodigo = planta.plantacodigo";

$sqlQuery=$sqlQuery." AND ot.ordtrafecini BETWEEN ".$fecini." AND ".$fecfin." AND ot.plantacodigo IN (".$arrplantas.")
 ORDER BY cierreot.cierotcodigo";
*/

// Mantenimientos Realizados

/*$sqlMantenimientos = "SELECT planta.plantanombre, tipomant.tipmannombre,(select count(ot.ordtracodigo)from
ot where ot.ordtracodigo = reportot.ordtracodigo AND cierreot.reportcodigo=reportot.reportcodigo AND ot.plantacodigo = planta.plantacodigo AND ot.plantacodigo IN (".$arrplantas.") AND ot.ordtrafecini BETWEEN ".$fecini." AND ".$fecfin." AND ot.tipmancodigo = tipomant.tipmancodigo) as 
mantenimientos,tipomant.tipmannombre,(select count(reportot.ordtracodigo)from
reportot where reportot.ordtracodigo = ot.ordtracodigo AND reportot.reportcodigo = cierreot.reportcodigo AND ot.plantacodigo = planta.plantacodigo AND ot.plantacodigo IN (".$arrplantas.") AND ot.ordtrafecini 
BETWEEN ".$fecini." AND ".$fecfin." AND ot.tipmancodigo = tipomant.tipmancodigo) as manten_reporte,
(select count(ot.ordtracodigo)from ot
where ot.ordtracodigo = reportot.ordtracodigo AND cierreot.reportcodigo=reportot.reportcodigo
AND ot.plantacodigo IN (".$arrplantas.") AND ot.ordtrafecini BETWEEN ".$fecini." AND ".$fecfin." AND ot.plantacodigo = planta.plantacodigo) as planta
 from tipomant, planta";


*/

/*$sqlMantenimientos = "SELECT tipomant.tipmannombre,(select count(ot.ordtracodigo)from
ot where ot.ordtracodigo = reportot.ordtracodigo AND cierreot.reportcodigo=reportot.reportcodigo AND ot.plantacodigo IN (".$arrplantas.") AND ot.ordtrafecini BETWEEN ".$fecini." AND ".$fecfin." AND ot.tipmancodigo = tipomant.tipmancodigo) as 
mantenimientos,tipomant.tipmannombre,(select count(reportot.ordtracodigo)from
reportot where reportot.ordtracodigo = ot.ordtracodigo AND reportot.reportcodigo = cierreot.reportcodigo AND ot.plantacodigo IN (".$arrplantas.") AND ot.ordtrafecini 
BETWEEN ".$fecini." AND ".$fecfin." AND ot.tipmancodigo = tipomant.tipmancodigo) as manten_reporte,
(select count(ot.ordtracodigo)from ot
where ot.ordtracodigo = reportot.ordtracodigo AND cierreot.reportcodigo=reportot.reportcodigo
AND ot.plantacodigo IN (".$arrplantas.") AND ot.ordtrafecini BETWEEN ".$fecini." AND ".$fecfin.") as planta from tipomant";
*/

$sqlMantenimientos = "SELECT planta.plantanombre,tipomant.tipmannombre,(select count(reportot.tipmancodigo)from
reportot where reportot.reportcodigo = cierreot.reportcodigo AND reportot.tipmancodigo = tipomant.tipmancodigo
AND reportot.ordtracodigo = ot.ordtracodigo AND ot.plantacodigo = planta.plantacodigo
AND ot.plantacodigo IN (".$arrplantas.") AND ot.ordtrafecini 
BETWEEN ".$fecini." AND ".$fecfin.") as mant_reporte,
(select count(ot.ordtracodigo)from ot
where ot.ordtracodigo = reportot.ordtracodigo AND cierreot.reportcodigo=reportot.reportcodigo
AND ot.plantacodigo IN (".$arrplantas.") AND ot.ordtrafecini BETWEEN ".$fecini." AND ".$fecfin.") as total_mant from tipomant";

$iRegreporte['reportcodigo'] = $reportcodigo;
$iRegreporte['reportnombre'] = $reportnombre;
$iRegreporte['reportselect'] = $arrplantas;
$iRegreporte['reportmant'] = $sqlMantenimientos;
$iRegreporte['reportcodcam'] = $strSelectedFields;
$iRegreporte['reportfecha']  = date('Y-m-d');

$iRegreporte['reportfechasreporte']  = $fecini."--".$fecfin;

grabareporte($iRegreporte, $flagnuevoreporte, $campnomb, $codigo);

?>
