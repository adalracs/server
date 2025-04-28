# /bin/bash

# Propiedad intelectual de Adsum (c). 
# -Todos los derechos reservados- 
# Funcion         : security 
# Decripcion      : Verifica que el esquema de seguridad del licenciamiento se cumpla. 
# Parametros      : Descripicion 
#     $archivo     Archivo de entrada. 
#     $archivo1    Archivo2. 
# Retorno         : 
#	true	= 1 
#	false	= 0 
# Autor           : ariascos
# Escrito con     : Manualmente 
# Fecha           : 26052004 
# Historial de modificaciones 
# | Fecha | Motivo				| Autor 	| 

if rm -rf ../desarrollo/fncfetch.php
then
	echo "Se borró el archivo fetch";
	if rm -rf ../desarrollo/fncconn.php
	then
		echo "Se borró el archivo conn";
	else
		echo "No se encontró al archivo conn";
	fi
else
	echo "No se encontró el archivo fetch";
fi
