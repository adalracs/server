/**
* Propiedad intelectual de ADSUM (c)
* Funcion:		cargarTipoequipo
* Descripcion:  Ejecuta un archivo PHP sin recargar el formulario
* Parametros:   valor
* Retorno:		NULL
* Autor:		mstroh
* Fecha:		16022006
*/

function cargarTipoequipo(valor)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero

	*/
	jsrsExecute("procTipoequipo.php", cargarTipoequipoResultado, "mostrarTipoequipo", valor);
}

function cargarTipoequipoResultado(cadena)
{
	if(cadena != "")
	{
		if(cadena == -1)
		{
			alert('El registro no existe');
			window.document.form1.tipequacroni.value = "";
			window.document.form1.tipequcodigo.value = "";
			
			if((window.document.getElementById('formequipo')) !=  undefined)
				window.document.getElementById('formequipo').style.display = 'none';

			return;
		}
		else
		{
			(isNaN(cadena)) ? window.document.form1.tipequacroni.value = cadena : window.document.form1.tipequcodigo.value = cadena;
			window.document.form1.submit();
		}
	}
}