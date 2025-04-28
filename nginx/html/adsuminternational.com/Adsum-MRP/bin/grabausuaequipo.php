<?php
/*
 -Todos los derechos reservados-
 Propiedad intelectual de Adsum (c).
 Funcion         : grabausuaequipo
 Decripcion      : Valida la data a grabar y la lleva al paquete.
 Parametros      : Descripicion
 $iRegusuaequipo         Arreglo de datos.
 $flagnuevousuaequipo    Bandera de validaci�n
 Retorno         :
 true	= 1
 false	= 0
 Autor           : ariascos
 Escrito con     : WAG Adsum versi�n 3.1.1
 Fecha           : 18082004
 Historial de modificaciones
 | Fecha | Motivo				| Autor 	|
 */
include ( '../src/FunPerPriNiv/pktblusuaequipo.php');

function grabausuaequipo($iRegusuaequipo,&$flagnuevousuaequipo,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("idusuaequipo",53);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	$nuidtemp = fncnumact(idusuaequipo,$nuconn);
	do
	{
		$nuresult = loadrecordusuaequipo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegusuaequipo[usuequcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	if ($iRegusuaequipo[usuacodi] != null)
	{
		$result = insrecordusuaequipo($iRegusuaequipo,$nuconn);
		$nuresult1 = fncnumprox(idusuaequipo,$nuidtemp,$nuconn);
		fncclose($nuconn);
		if($result > 0)
		{
			fncmsgerror(grabaEx);
		}
	}
}
$iRegusuaequipo[usuequcodigo] = $usuequcodigo;
$iRegusuaequipo[usuacodi]     = $usuacodigo;
$iRegusuaequipo[equipocodigo] = $equipocod;

grabausuaequipo($iRegusuaequipo,$flagnuevousuaequipo,$campnomb);
?>
