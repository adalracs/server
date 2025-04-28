<?php
include ('../src/FunGen/fncsumdate.php');
include ('../src/FunPerPriNiv/pktblprogramacion.php');

$idConn = fncconn ();

if ($idConn) {
	$sbSql = "SELECT programacion.progracodigo, programacion.prografecini, programacion.prograhorini, 
	programacion.prografrecue, tipomedi.tipmeddescri, tipomedi.tipmedtiempo,programacion.prograrepot
			     FROM programacion, tipomedi WHERE programacion.tipmedcodigo = tipomedi.tipmedcodigo 
			     and programacion.prograacti=1 and programacion.plantacodigo in ($GLOBALS[usuaplanta])
			      order by programacion.progracodigo";
	$nuResultf = pg_exec ( $idConn, $sbSql );
	unset ( $sbSql );
	
	if ($nuResultf) {
		$nuCantRow = pg_numrows ( $nuResultf );
		if ($nuCantRow > 0) {
			for($i = 0; $i < $nuCantRow; $i ++) {
				$sbRow = pg_fetch_row ( $nuResultf, $i );

				$sbLista = array ("progracodigo" => $sbRow [0], "prografecini" => $sbRow [1], "prograhorini" => $sbRow [2], "prografrecue" => $sbRow [3], "tipomeddescri" => $sbRow [4], "tipmedtiempo" => $sbRow [5], "prograrepot" => $sbRow [6] );

				if ($sbLista [tipomeddescri]) {
					switch ($sbLista [tipmedtiempo]) {
						case 1 : //Minutos
							$frechors = ($sbLista [prografrecue] * $sbLista [tipomeddescri]) / 60;
							break;
						case 2 : //Horas
							$frechors = ($sbLista [prografrecue] * $sbLista [tipomeddescri]);
							break;
						case 3 : //Dias
							$frechors = ($sbLista [prografrecue] * $sbLista [tipomeddescri]) * 24;
							break;
					}
					
					$datenext = fncsumdate ( date ( $sbLista [prografecini] ), date ( $sbLista [prograhorini] ), $frechors );
					$fechaactivado = explode ( "/", $datenext );
					$arr_fecha = explode ( "-", $fechaactivado [0] );
					
					$pr = (($sbLista [prografrecue] * $sbLista [tipomeddescri]) * 0.20);
					$fechafs = mktime ( 0, 0, 0, $arr_fecha [1], $arr_fecha [2], $arr_fecha [0] ) - ($pr * 24 * 60 * 60);
					$dia_fin = date ( 'Y-m-d', $fechafs );
					$arr_fechass = explode ( "-", $dia_fin );
					$timestamp3 = mktime ( 0, 0, 0, $arr_fechass [1], $arr_fechass [2], $arr_fechass [0] );
					
					if ($timestamp3 <= mktime ( date ( "H" ), date ( "i" ), date ( "s" ), date ( "m" ), date ( "d" ), date ( "Y" ) )) {
						$ircRecord [progracodigo] = $sbLista [progracodigo];
						$ircRecord [prograrepot] = 1;
						$nuResult = uprecordprogramacionactivado ( $ircRecord, $idConn );
					}
				}
			}
		}
	}
}

?>