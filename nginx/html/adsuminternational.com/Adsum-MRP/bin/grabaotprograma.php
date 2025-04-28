<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaotprograma
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$arrregtarequipo         Arreglo de datos.
	Indices [0] = progracodigo
			[1] = tipmancodigo
			[2] = equipocodigo
			[3] = sistemcodigo
			[4] = plantacodigo
			[5] = componcodigo
			[6] = tareacodigo
			[7] = tiptracodigo
			[8] = otestacodigo
			[9] = tareottiedur
			[10] = tipmedcodigo
			[11] = prioricodigo

Retorno         :
true	= 1
false	= 0
Autor           : cbedoya
Fecha           : 12-oct-2007
Historial de modificaciones
| Fecha     | Motivo				| Autor 	|
*/

	$GLOBALS["okprograma"] = "1";

	$flagotinicial = true;
	$codigoot = NULL;
	$codigotareot = NULL;
	
	include_once ('../src/FunPerPriNiv/pktblot.php');
	include_once ('../src/FunGen/fncsumdate.php');
	$sbregLista = explode("::", $arrregtarequipo);
	
	$dateini = $prografecini . "/" . $prograhorini;
	$datefin = fncsumdate ( $prografecini, $prograhorini, $sbregLista [9] );
	
	$dateotini = explode ( "/", $dateini );
	$dateotfin = explode ( "/", $datefin );
	
	
	include_once ('../src/FunPerPriNiv/pktblprogramacion.php');
	
	$nuconn = fncconn ();
	$rs_programacion = loadrecordprogramacionserial($sbregLista [0], $nuconn);
	
	
	$prografecgen = date ( "Y-m-d" );
	$prograhorgen = date ( "H:i" );
	
	$tipmancodigo = $sbregLista [1];
	$equipocodigo = $sbregLista [2];
	//$tipmedcodigo = $sbregLista [10];
	$sistemcodigo = $sbregLista [3];
	$plantacodigo = $sbregLista [4];
	$componcodigo = $sbregLista [5];
	//$usuacodi = ??		El mismo usuario Logeado
	$codigoprog = $sbregLista [0];
	$tareacodigo1 = $sbregLista [6];
	$tiptracodigo1 = $sbregLista [7];
	$tareottiedur = $sbregLista [9];
	$progranota1 = $rs_programacion ['progranota'];
	$otestacodigo = $sbregLista [8];
	$prioricodigo = $sbregLista [11];
	$ordtranumpro = $progranumgru;

	include ('grabaprogramot.php');
	
	$ircRecord [progracodigo] = $sbregLista [0];
	$ircRecord [prograhorini] = date ( "H:i" );
	$ircRecord [prograrepot] = 0;

	
// Validacion de fechas futuras

	$arr_fecha = explode ( "-", $dateotini [0] );
	$arr_hora = explode ( ":", $dateotini [1] );



	$comparativos = mktime ( 0, 0, 0, date ( "m" ), date ( "d" ), date ( "Y" ) );
	$timestamp2 = mktime ( 0, 0, 0, $arr_fecha [1], $arr_fecha [2], $arr_fecha [0] );

	if ($comparativos == $timestamp2) 
	{
		$frecuencias = "+1 day";
		$fechafutur = date ( "Y-m-d", strtotime ( $frecuencias, $timestamp2 ) );
		$ircRecord [prografecini] = $fechafutur;
	} else {
		$ircRecord [prografecini] = date ( "Y-m-d" );
	}

	$sbSql = "SELECT  tipomedi.tipmeddescri,tipmedtiempo
			     FROM tipomedi WHERE  tipomedi.tipmedcodigo= " . $sbregLista [10];

	$nuResult = pg_exec ( $nuconn, $sbSql );
	$sbRow = pg_fetch_row ( $nuResult, 0 );
	
	switch ($sbRow [1]) {
		case 1 : //Minutos
			$timestamp2 = mktime ( $arr_hora [0], $arr_hora [1], 0, 0, 0, 0 );
			$frecuencias = "+" . $sbregLista [prografrecue] . "minutes";
			$fechafutur = date ( "H:i", strtotime ( $frecuencias, $timestamp2 ) );
			break;
		case 2 : //Horas
			$timestamp1 = mktime ( date ( 'H' ), date ( 'i' ), 0, 0, 0, 0 );
			$timestamp2 = mktime ( $arr_hora [0], $arr_hora [1], 0, 0, 0, 0 );
			$frecuencias = "+" . $sbregLista [prografrecue] . "hours";
			$fechafutur = date ( "H:i", strtotime ( $frecuencias, $timestamp2 ) );
			break;
		case 3 : //Dias
			$timestamp2 = mktime ( $arr_hora [0], $arr_hora [1], 0, $arr_fecha [1], $arr_fecha [2], $arr_fecha [0] );
			$frecuencias = "+" . ($sbRow [0] * $sbregLista [prografrecue]) . "day";
			$fechafutur = date ( "Y-m-d", strtotime ( $frecuencias, $timestamp2 ) );
			
			break;
	}

	if ($fechafutur == '') {
		$ircRecord [prografechfutur] = $ircRecord [prografecini];
		$frecuencias = "+1 day";
		$fechafutur = date ( "Y-m-d", strtotime ( $frecuencias, $timestamp2 ) );
		
		$ircRecord [prografecini] = $dateotini [0];
	} else {
		$ircRecord [prografechfutur] = $fechafutur;
		$ircRecord [prografecini] = $dateotini [0];
	}
// El sobrante es hasta aquí
	$nuResult = uprecordprogramacion ( $ircRecord, $nuconn );
	fncclose ( $nuconn );

if ($cantequipo == 1) {
	
	echo '<script language="javascript">';
	echo "alert('Grabado exitoso');";
	echo "</script>";
	echo '<script language="javascript">';
	echo "window.open('detallanuevaotprogramacionprint.php?ordtranumpro=$progranumgru','textoo','status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=520');";
	echo "</script>";
	
	$idcon = fncconn ();
	$progranumgru = fncnumprox ( 98, $progranumgru, $idcon ); // Aqui se llama diferente $resultnumgrup
	fncclose ( $idcon );
	unset($GLOBALS["okprograma"]);
}

?>