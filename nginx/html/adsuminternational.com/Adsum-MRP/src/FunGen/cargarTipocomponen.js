/**
* Propiedad intelectual de ADSUM (c)
* Funcion:		cargarTipocomponen
* Descripcion:  Ejecuta un archivo PHP sin recargar el formulario
* Parametros:   valor
* Retorno:		NULL
* Autor:		mstroh
* Fecha:		16022006
*/

function cargarTipocomponen(valor)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero

	*/
	jsrsExecute("procTipocomponen.php", cargarTipocomponenResultado, "mostrarTipocomponen", valor);
}

function cargarTipocomponenResultado(cadena)
{
	if(cadena != "")
	{
		if(cadena == -1)
		{
			alert('El registro no existe');
			window.document.form1.tipcomacroni.value = "";
			window.document.form1.tipcomcodigo.value = "";
			
			if((window.document.getElementById('formcomponen')) !=  undefined)
				window.document.getElementById('formcomponen').style.display = 'none';

			return;
		}
		else
		{
			(isNaN(cadena)) ? window.document.form1.tipcomacroni.value = cadena : window.document.form1.tipcomcodigo.value = cadena;
			window.document.form1.submit();
		}
	}
}