<?php
include ('../src/Funexcel/reader.php');
include ('../src/FunPerSecNiv/fncclose.php');
include ('../src/FunPerSecNiv/fncconn.php');
include ('../src/FunPerPriNiv/pktblcomponen.php');

/**
 * @Propiedad Intelectual de Adsum (c).
 * @author :        hgalarza
 * @copyright:      Adsum
 * @Descripcion :   Lee y guarda datos de archivos en formato excel
 * @Fecha:          28-Dic-2009 

 */
$TipoExtencion = substr ( $_FILES ['presenbarra'] ['name'], - 3, 3 );

if ($TipoExtencion == 'xls') {
	$data = new Spreadsheet_Excel_Reader ( );
	$data->setOutputEncoding ( 'CP1251' );
	$data->read ( $presenbarra );
	
	$arrData = array ();
	
	for($i = 2; $i <= $data->sheets [0] ['numRows']; $i ++) {		
		$arrData [componcodigo] = trim ( $data->sheets [0] ['cells'] [$i] [1] );		
		$arrData [equipocodigo] = trim ( $data->sheets [0] ['cells'] [$i] [2] );
		$arrData [componnombre] = trim ( $data->sheets [0] ['cells'] [$i] [3] );
		$arrData [compondescri] = trim ( $data->sheets [0] ['cells'] [$i] [4] );
		$arrData [componfabric] = trim ( $data->sheets [0] ['cells'] [$i] [5] );
		$arrData [componmarca] = trim ( $data->sheets [0] ['cells'] [$i] [6] );
		$arrData [componmodelo] = trim ( $data->sheets [0] ['cells'] [$i] [7] );
		$arrData [componserie] = trim ( $data->sheets [0] ['cells'] [$i] [8] );
		$arrData [componfeccom] = trim ( $data->sheets [0] ['cells'] [$i] [9] );
		$arrData [componfecins] = trim ( $data->sheets [0] ['cells'] [$i] [10] );
		$arrData [componcinv] = trim ( $data->sheets [0] ['cells'] [$i] [11] );
		$arrData [componvengar] = trim ( $data->sheets [0] ['cells'] [$i] [12] );
		$arrData [componviduti] = trim ( $data->sheets [0] ['cells'] [$i] [13] );
		$arrData [componubicac] = trim ( $data->sheets [0] ['cells'] [$i] [14] );
		$arrData [componalto] = trim ( $data->sheets [0] ['cells'] [$i] [15] );
		$arrData [componlargo] = trim ( $data->sheets [0] ['cells'] [$i] [16] );
		$arrData [componancho] = trim ( $data->sheets [0] ['cells'] [$i] [17] );
		$arrData [componpeso] = trim ( $data->sheets [0] ['cells'] [$i] [18] );
		$arrData [tipcomcodigo] = trim ( $data->sheets [0] ['cells'] [$i] [19] );		
		$nuConn = fncconn ();
		$valid = insrecordcomponen  ( $arrData, $nuConn );			
		if ($arrData1) {
			$arrData1 = $arrData1.','.$valid;
		} else {
			$arrData1 = $valid;
		}

	}
	//die("Muere");
	$NumeroFormulario = 2;
	echo '<script type="text/javascript"> location="detallarcargaexcel.php?NumeroFormulario='.$NumeroFormulario.'&arrConDatos='.$arrData1.'"</script>';	
} else {
	echo "<script type='text/javascript'>alert('Formato de archivo incorrecto, seleccione un formato excel xls');</script>";
}
if (!$TipoExtencion) {
	echo '<script type="test/javascript">location="maestablcargaexcel.php"</script>';
}

?>
