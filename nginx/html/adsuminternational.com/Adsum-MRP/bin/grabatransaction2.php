<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabatransaction
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : 
Retorno         : 
Autor           : lfolaya 
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 25022004 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
18012005 Implementacion			lfolaya
26012006 Implementacion 		mstroh
*/ 

function transaction($sbregtransac,$sbregsesion1,$sbregsesion2,$nuconn,&$sbregquery,&$sbregcod)
{
	$valposic = explode(",",$sbregtransac);
	$numposic = count($valposic);
		
	//$initransac = begintransaction($nuconn);
	//$sbregquery[] = $initransac;
	for($i = 0; $i < count($valposic); $i++)
	{
		for($j = 0; $j < count($sbregsesion1); $j++)
		{
			if($valposic[$i] == $sbregsesion1[$j][0])
			{
				$sbregquery[] = $sbregsesion1[$j][2];
			}
		}
		for($k = 0; $k < count($sbregsesion2); $k++)
		{
			if($valposic[$i] == $sbregsesion2[$k][0])
			{
				$sbregcod[] = $sbregsesion2[$k][1];
			}
		}
	}
	//$endtransac = committransaction($nuconn);
	//$sbregquery[] = $endtransac;
}

?>