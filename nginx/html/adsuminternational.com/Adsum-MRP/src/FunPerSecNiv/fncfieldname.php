<?php 
/*
Propiedad intelectual de Adsum SA (c).
Funcion         : fncfieldname
Decripcion      : Presenta el nombre de un  campo. 
Parametros      : Descripicion
  $inuidtrans     Id de transaccion.
  $inupos		  Posicion  del campo
Retorno         : Descripicion
 $osbnombre   	  Nombre del campo.
Autor           : ariascos
Fecha           : 03-dec-2001  
*/
function  fncfieldname($inuidtrans,$inupos)
{
	
	$osbnombre = pg_fieldname($inuidtrans,$inupos);
	return $osbnombre;
	/*
	$idcon = fncconn();
	ora_columnname($idcon,$inuidtrans);
	return $osbnombre;
	*/
}
?>
