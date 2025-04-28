<?php
include ('../src/Funexcel/reader.php');
include ('../src/FunPerSecNiv/fncclose.php');
include ('../src/FunPerSecNiv/fncconn.php');
include ('../src/FunPerPriNiv/pktblequipo.php');

/**
 * @Propiedad Intelectual de Adsum (c).
 * @author :        valbuena
 * @copyright:      Adsum
 * @Descripcion :   Lee y guarda datos de archivos en formato excel
 * @Fecha:          23-abr-2009 

 */
$estenxion = substr ( $_FILES ['presenbarra'] ['name'], - 3, 3 );

if ($estenxion == 'xls') {
	$data = new Spreadsheet_Excel_Reader ( );
	$data->setOutputEncoding ( 'CP1251' );
	$data->read ( $presenbarra );
	
	$arr = array ();
	
	for($i = 2; $i <= $data->sheets [0] ['numRows']; $i ++) {
		$arr [equipocodigo] = trim ( $data->sheets [0] ['cells'] [$i] [1] );
		$arr [estadocodigo] = trim ( $data->sheets [0] ['cells'] [$i] [2] );
		$arr [sistemcodigo] = trim ( $data->sheets [0] ['cells'] [$i] [3] );
		$arr [cencoscodigo] = trim ( $data->sheets [0] ['cells'] [$i] [4] );
		$arr [equiponombre] = trim ( $data->sheets [0] ['cells'] [$i] [5] );
		$arr [equipodescri] = trim ( $data->sheets [0] ['cells'] [$i] [6] );
		$arr [equipofabric] = trim ( $data->sheets [0] ['cells'] [$i] [7] );
		$arr [equipomarca] = trim ( $data->sheets [0] ['cells'] [$i] [8] );
		$arr [equipomodelo] = trim ( $data->sheets [0] ['cells'] [$i] [9] );
		$arr [equiposerie] = trim ( $data->sheets [0] ['cells'] [$i] [10] );
		$arr [equipolargo] = trim ( $data->sheets [0] ['cells'] [$i] [11] );
		$arr [equipoancho] = trim ( $data->sheets [0] ['cells'] [$i] [12] );
		$arr [equipoalto] = trim ( $data->sheets [0] ['cells'] [$i] [13] );
		$arr [equipopeso] = trim ( $data->sheets [0] ['cells'] [$i] [14] );
		$arr [equipovolta] = trim ( $data->sheets [0] ['cells'] [$i] [15] );
		$arr [equipocorrie] = trim ( $data->sheets [0] ['cells'] [$i] [16] );
		$arr [equipopoten] = trim ( $data->sheets [0] ['cells'] [$i] [17] );
		$arr [equipofeccom] = trim ( $data->sheets [0] ['cells'] [$i] [18] );
		$arr [equipocinv] = trim ( $data->sheets [0] ['cells'] [$i] [19] );
		$arr [equipovengar] = trim ( $data->sheets [0] ['cells'] [$i] [20] );
		$arr [equipovitudi] = trim ( $data->sheets [0] ['cells'] [$i] [21] );
		$arr [equipofecins] = trim ( $data->sheets [0] ['cells'] [$i] [22] );
		$arr [equipoubica] = trim ( $data->sheets [0] ['cells'] [$i] [23] );
		$arr [equipovalhor] = trim ( $data->sheets [0] ['cells'] [$i] [24] );
		$arr [equiponohs] = trim ( $data->sheets [0] ['cells'] [$i] [25] );
		$arr [equipoacti] = trim ( $data->sheets [0] ['cells'] [$i] [26] );
		$arr [equipotipo] = trim ( $data->sheets [0] ['cells'] [$i] [27] );
		$arr [equiponpas] = trim ( $data->sheets [0] ['cells'] [$i] [28] );
		$arr [contracodigo] = trim ( $data->sheets [0] ['cells'] [$i] [29] );
		$arr [tipequcodigo] = trim ( $data->sheets [0] ['cells'] [$i] [30] );
		$arr [codigosrf] = trim ( $data->sheets [0] ['cells'] [$i] [31] );
		$arr [equipodacr] = trim ( $data->sheets [0] ['cells'] [$i] [32] );
		$arr [equipoimagen] = trim ( $data->sheets [0] ['cells'] [$i] [33] );
		
		$nuConn = fncconn ();
		
		$valid = insrecordequipo ( $arr, $nuConn );
		
		if ($arr1) {
			$arr1 = $arr1.','.$valid;
		} else {
			$arr1 = $valid;
		}
	}	
	$NumeroFormulario = 1;
	echo '<script type="text/javascript"> location="detallarcargaexcel.php?NumeroFormulario='.$NumeroFormulario.'&arr1='.$arr1.'"</script>';	
} else {
	echo "<script type='text/javascript'>alert('Formato de archivo incorrecto, seleccione un formato excel xls');</script>";
}
if (! $estenxion) {
	echo '<script type="test/javascript">location="maestablcargaexcel.php"</script>';
}

?>