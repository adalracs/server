<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargaClientes-->
<!--Decripcion      : abre un archivo php que consulta los clientes de acuerdo a los parametros -->
<!--				  ingresados por el usuario, sin recargar el formulario-->
<!--Retorno         : null-->
<!--Autor           : jcortes-->
<!--Modificado      : mstroh-->
<!--Fecha           : 26-ago-2005-->

function cargaClientes(nombtabl,accionconsultarcliente,recarreglo)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibirá el resultado ... recibe siempre un parámetro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero

	*/
	var valor = nombtabl + "." + accionconsultarcliente + "." + recarreglo;
	jsrsExecute("procCliente.php", cargaClientesResultado, "mostrarClientes", valor);
}

function cargaClientesResultado(cadena)
{
	if (cadena == '')
	{
		alert("No se encontraron clientes inscritos al catálogo");
		history.go(-2);
	}
	else
	{
		num = cadena.lastIndexOf(',');
		cadena = cadena.substring(0,(num));
		self.location.href = 'mailto:'+ cadena +'?subject=Catálogo www.TiendaOfertas.com';
		window.opener.focus();
		window.close();
	}
}