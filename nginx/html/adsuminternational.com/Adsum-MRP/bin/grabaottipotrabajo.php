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

include('../bin/grabareportetipotrab.php');

// -------- Se construye la consulta --------
$idcon = fncconn();
$sqlQuery = "SELECT ";

/**
* Codigos de las tablas sobre las cuales se realizara la consulta,
* con sus respectivos atributos
*/


$strSelectedTables="75,10,59,102,67";
$strSelectedFields="44,503,507,432";

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


$reportnombre="Reporte Rutinas de Trabajo";

$arreglofec=split("-",$fecini);
$fecini=$arreglofec[0].$arreglofec[1].$arreglofec[2];

$arreglofec=split("-",$fecfin);
$fecfin=$arreglofec[0].$arreglofec[1].$arreglofec[2];

/*$sqlQuery=
"SELECT cierreot.cierotcodigo,reportot.reportcodigo,reportot.tiptracodigo, ot.plantacodigo
FROM ot, cierreot, reportot, planta, tipotrab
WHERE cierreot.reportcodigo = reportot.reportcodigo AND reportot.tiptracodigo = tipotrab.tiptracodigo 
AND reportot.ordtracodigo = ot.ordtracodigo
AND ot.plantacodigo = planta.plantacodigo";

$sqlQuery=$sqlQuery." AND ot.ordtrafecini BETWEEN ".$fecini." AND ".$fecfin." AND ot.plantacodigo IN (".$arrplantas.")
 ORDER BY cierreot.cierotcodigo";
*/

// Trabajos Realizados

$sqlTrabajos = "SELECT tipotrab.tiptranombre,(select count(reportot.tiptracodigo)from
reportot where reportot.reportcodigo = cierreot.reportcodigo AND reportot.tiptracodigo = tipotrab.tiptracodigo
AND reportot.ordtracodigo = ot.ordtracodigo AND ot.plantacodigo = planta.plantacodigo
AND ot.plantacodigo IN (".$arrplantas.") AND ot.ordtrafecini 
BETWEEN ".$fecini." AND ".$fecfin.") as trabajo_reporte from tipotrab";


$iRegreporte['reportcodigo'] = $reportcodigo;
$iRegreporte['reportnombre'] = $reportnombre;
//$iRegreporte['reportselect'] = $sqlQuery;
$iRegreporte['reporttipotrab'] = $sqlTrabajos;
$iRegreporte['reportcodcam'] = $strSelectedFields;
$iRegreporte['reportfecha']  = date('Y-m-d');

$iRegreporte['reportfechasreporte']  = $fecini."--".$fecfin;

grabareportetipotrab($iRegreporte, $flagnuevoreporte, $campnomb, $codigo);

?>
