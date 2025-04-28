/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Funcion: 			createRequestObject()
* Argumentos: 		void
* Descripcion:		Crea un objeto XMLHttp, para realizar solicitudes al servidor
*					sin necesidad de recargar el formulario.
*
* Funcion: 			sendReq()
* Argumentos: 		serverFileName -> Nombre del archivo en el servidor, al cual se le realizara
*									  la solicitud.
*					variableNames  -> Nombre de las variables que se enviaran en la solicitud
*					variableValues -> Valor de las variables que se enviaran en la solicitud
*
* Descripcion:		Realiza la solicitud al servidor, enviando valores segun sea el caso
*
*
* Funcion: 			handleResponse()
* Argumentos: 		void
* Descripcion:		Recibe la respuesta del servidor, y se realizan las acciones pertinentes al la
*					situacion necesaria
*
* Fecha: 02-JUN-2006
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		  | Motivo
*
* mstroh	02-JUN-2006   Implementacion
*
*/

var xmlhttp = createRequestObject();
var objectId = '';

function createRequestObject()
{
    var obj;
    var browser = navigator.appName;

    (browser == "Microsoft Internet Explorer") ? obj = new ActiveXObject("Microsoft.XMLHTTP") : obj = new XMLHttpRequest();

    return obj;
}

function sendReq(serverFileName, variableNames, variableValues)
{
	var paramString = '';

	variableNames = variableNames.split(',');
	variableValues = variableValues.split(',');

	for(i=0; i<variableNames.length; i++)
	{
		paramString += variableNames[i]+'='+variableValues[i]+'&';
	}
	paramString = paramString.substring(0, (paramString.length-1));

	if (paramString.length == 0) {
	   	xmlhttp.open('get', serverFileName);
	}
	else {
		xmlhttp.open('get', serverFileName+'?'+paramString);
	}
    xmlhttp.onreadystatechange = handleResponse;
    xmlhttp.send(null);
}

function handleResponse() {

	if(xmlhttp.readyState == 4)
	{
		responseText = xmlhttp.responseText;
		var spot = window.document.form1.allfield.options.length;
		var cadenaResponse = responseText.split(',');

		for(var i=0; i<cadenaResponse.length; i++)
		{
			selectValues = cadenaResponse[i].split('|');

			for(var j=0; j<window.document.form1.elements.length; j++)
			{
				if((window.document.form1.elements[j].name.indexOf("pre_") != -1) ||
				   (window.document.form1.elements[j].name.indexOf("post_") != -1))
				{
					window.document.form1.elements[j].options[spot+1] = new Option(selectValues[0], selectValues[1], false, false);
				}
			}

			window.document.form1.allfield.options[spot] = new Option(selectValues[0], selectValues[1], false, false);
			window.document.form1.orderby.options[spot+1] = new Option(selectValues[0], selectValues[1], false, false);
			spot++;
		}
//		document.getElementById(objectId).innerHTML = responseText;
    }
}