<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabatransaction
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : 
Retorno         : 
Autor           : lfolaya 
Escrito con     : WAG Adsum version 3.1.1 
Fecha           : 25022004 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
18012005 Implementacion			lfolaya
26012006 Implementacion 		mstroh
*/ 

include_once('grabatransaction2.php');
define("grabaEx",3);

if($arreglo_herr)
{
	$nuconn = fncconn();
	transaction($arreglo_herr,$arrtransac,$arrtransacherr,$nuconn,$sbregquery,$sbregcod);
	$result = grabatransaction($sbregquery,$nuconn);
	fncclose($nuconn);

	include('grabatareotherramie.php');
	
	unset($sbregquery);
	unset($sbregcod);
}

if($arreglo_ite)
{
	$nuconn = fncconn();
	transaction($arreglo_ite,$arrtransacitem,$arrtransactran,$nuconn,$sbregquery,$sbregcod);
	
	$result = grabatransaction($sbregquery,$nuconn);
	fncclose($nuconn);
	
	include('grabaitemtareot.php');
	
	unset($sbregquery);
	unset($sbregcod);
	
}
if ($flagpedido)
{ 	 
	fncmsgerror(grabaEx); 
	echo '<script language="javascript">'; 
	echo '<!--//'."\n"; 
	echo 'location ="maestablpedido.php?codigo='.$codigo.';"'; 
	echo '//-->'."\n"; 
	echo '</script>';
}
?>