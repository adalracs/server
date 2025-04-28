/*
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : fncverificarlider
Decripcion      : Verifica que el campo codigo del colaborador de mantenimiento lider de la OT, haya sido escrito
o escogido y ademas revisa si la cadena escrita en el campo es un numero o no.
registrarse en la programaci�n
Parametros      : Descripicion 
    $empleacod   Campo del formulario que almacena el codigo del colaborador de mantenimiento.
Retorno         : 
		void	= 1 
		false	= 0 
Autor           : jcortes
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 21102005 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
function fncverificarlider(empleacod)
{
	if(empleacod.value=="")
	{
		alert("Por favor escoja un colaborador de mantenimiento");
		empleacod.focus();
		return false;
	}
	else
	{
		if(isNaN(empleacod.value))
		{
			alert("Por favor escriba un numero en el campo Codigo del colaborador de mantenimiento");
			empleacod.value="";
			empleacod.focus();
			return false;
		}
	}
	return true;
}
