<?php 
/* 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
Funcion         : borracertitinrep 
Decripcion      : Valida la data a borrar y la lleva al paquete. 
Parametros      : Descripicion 
    $        Codigo a borrar. 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
function borracertitinrep($certircodigo) { 
	$nuconn = fncconn (); 
	$ircRecord['certircodigo'] = $certircodigo;
	$ircRecord['certirdelrec'] = 0;
	
	$result = delrecordcertitinrep($ircRecord, $nuconn); 
	if ($result < 0) { 
		echo '<script language="javascript">'; 
		echo '<!--//' . "\n"; 
		echo 'alert("El registro no se puede eliminar porque se encuentra en uso")'; 
		echo '//-->' . "\n"; 
		echo '</script>'; 
	} 
	if ($result > 0) { 
		echo '<script language="javascript">'; 
		echo '<!--//' . "\n"; 
		echo 'alert("Borrado exitoso")'; 
		echo '//-->' . "\n"; 
		echo '</script>'; 
	} 
	fncclose ( $nuconn ); 
} 
borracertitinrep ( $certircodigo1 ); 
?> 
