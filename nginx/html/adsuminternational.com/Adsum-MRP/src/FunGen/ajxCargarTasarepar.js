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
* Descripcion:		Recibe la respuesta del servidor, y crea elementos en el formulario dinamicamente
*
* Fecha: 03-OCT-2006
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		  | Motivo
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

function sendReq(variableValues)
{
	var arrayParams;
	var arrayCodes;
	var serverFile;
	var variableNames;
	var i;

	if (variableValues != "")
	{
		if (document.form1.strdata.value.indexOf(variableValues + ',') != -1)
		{
			alert("El item seleccionado ya se encuentra en la lista");

			return;
		}
//		onclick="window.opener.document.form1.strdata.value+=\'e|'.$equipocod.',\';
		else {
			arrayCodes  = variableValues.split('|');
			variableValues = arrayCodes[1];

			switch (arrayCodes[0])
			{
				case 'e':
					serverFile = "procAjxEquipo.php";
					variableNames = "equipocodigo";
				break;

				case 'c':
					serverFile = "procAjxComponen.php";
					variableNames = "componcodigo";
				break;

				default:
				return;
			}
		}
		document.form1.strdata.value += arrayCodes[0]+'|'+arrayCodes[1]+',';
	}

	if (serverFile != null)
	{
		xmlhttp.open('get', serverFile+'?'+variableNames+'='+variableValues);
	    xmlhttp.onreadystatechange = handleResponse;
    	xmlhttp.send(null);
	}
}

function handleResponse()
{
	if (xmlhttp.readyState < 4)
	{
		// Cargando informacion
		document.getElementById('imgLoading').style.display='inline';
	}

	if (xmlhttp.readyState == 4)
	{
		if (xmlhttp.status == 200)
		{
			// Respuesta de la solicitud
			var responseText = xmlhttp.responseText;
			var itemData = responseText.split(',');
			var itemDataAux = itemData[0].split('|');
			// Oculta la animacion
			document.getElementById('imgLoading').style.display='none';
			// Referencia de la tabla
			var tblRef = document.getElementById('dynamicTable');
			var lastTblRow = tblRef.rows.length;
			var iteration = lastTblRow;

			if (tblRef.rows.length == 1)
				document.getElementById('tableHeader').style.display='inline';

			var tblRow = tblRef.insertRow(lastTblRow);

			for (var i=0; i<document.form1.elements.length; i++)
			{
				if (document.form1.elements[i].type == "text")
				{
					if (document.form1.elements[i].name.indexOf("horasOperac_") != -1)
					{
						var tmpIterationVar = document.form1.elements[i].name.split('_');
						iteration = parseInt(tmpIterationVar[1])+1;
					}
				}
			}

			if (iteration == 0)
				iteration += 1;
//			Primera celda
			var tblCell_1 = tblRow.insertCell(0);
			var txtItem_1 = document.createTextNode(itemDataAux[1]);
			tblCell_1.appendChild(txtItem_1);
//			Sedunda celda
			var tblCell_2 = tblRow.insertCell(1);
			var txtItem_2 = document.createTextNode(itemData[1]);
			tblCell_2.appendChild(txtItem_2);
//			Tercera celda
			var tblCell_3 = tblRow.insertCell(2);
			var btnRemove = document.createElement("INPUT");
			btnRemove.type = "BUTTON";
			btnRemove.value = "-";
			btnRemove.id = itemData[0];
			btnRemove.onclick = function () {
				var delRow = this.parentNode.parentNode;
				var tblRowArr = new Array(delRow);

				for (var i=0; i<tblRowArr.length; i++) {
					var rIndex = tblRowArr[i].sectionRowIndex;
					tblRowArr[i].parentNode.deleteRow(rIndex);
				}
//				Oculta la tabla
				if (tblRef.rows.length == 1)
					document.getElementById('tableHeader').style.display='none';
//				Elimina los codigos de strdata; datos finales sobre los cuales se realiza la consulta
				var fIndex;
				var searchParam = this.id.substring(1, this.id.length) + ',';
				var iniPosic = window.document.form1.strdata.value.indexOf(searchParam);
				var strData = window.document.form1.strdata.value;

				if (!iniPosic)
				{
					fIndex = strData.indexOf(',');
					strData = strData.substr(fIndex+1);
				}
				else
				{
					var strDataAux = strData.substr(0, iniPosic);

					strData = strData.substr(iniPosic, strData.length);
					fIndex = strData.indexOf(',');
					strData = strData.substr(fIndex+1);
					strData = strDataAux + strData;
				}
				window.document.form1.strdata.value = strData;
			};
			tblCell_3.appendChild(btnRemove);
		}
    }
}