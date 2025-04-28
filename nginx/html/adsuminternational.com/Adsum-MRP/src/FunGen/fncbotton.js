/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : 	add_record
Decripcion      : 	adiciona una lista de elementos a un combo.
Parametros      : 	lista
new_name
new_value
Retorno         :
Autor           : ariascos - lfolaya
Fecha           : 18052005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

function add_record(lista, new_name, new_value)
{
	var dummy = new Array;
	var i;
	for (i=0; i<lista.length;i++)
	{
		if ((lista.options[i].text == new_name)&&
		(lista.options[i].value ==new_value ))
		return;
	}

	for (i=0; i<lista.length;i++)
	{
		dummy[i] = new Array;
		dummy[i][0] = lista.options[i].text;
		dummy[i][1] = lista.options[i].value;
	}

	for (i=dummy.length; i>0; i--)
	lista.options[i] = null;
	lista.length= 0;

	for (i=0; i<dummy.length; i++)
	{
		lista.options[i] = new Option(dummy[i][0],dummy[i][1]);
	}
	lista.options[i] = new Option(new_name, new_value);
	lista.length = dummy.length + 1;
}

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : 	delete_record
Decripcion      : 	Borra una lista de elementos de un combo.
Parametros      : 	lista
indice
Retorno         :
Autor           : ariascos - lfolaya
Fecha           : 18052005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
function delete_record( lista, indice )
{
	var dummy = new Array;
	var i;
	for (i=0; i<lista.length;i++)
	if (i < indice) {
		dummy[i] = new Array;
		dummy[i][0] = lista.options[i].text;
		dummy[i][1] = lista.options[i].value;
	}
	else
	if (i > indice)  {
		dummy[i-1] = new Array;
		dummy[i-1][0] = lista.options[i].text;
		dummy[i-1][1] = lista.options[i].value;
	}
	for (i=lista.length; i>0;i--)
	lista.options[i] = null;
	lista.length= 0;
	for (i=0; i<dummy.length; i++) {
		lista.options[i] = new Option(dummy[i][0],dummy[i][1]);
	}
	lista.length = dummy.length;
}
var DELIMITER = ';';
var deleteList = new Array;
var counterArray=0;
var auxiliar = new Array;
var counterArray=0;

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : 	tranferTo
Decripcion      : 	adiciona de un combo a otro el option seleccionado.
Parametros      : 	idselec
iddelet
Retorno         :
Autor           : ariascos - lfolaya
Fecha           : 18052005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
function transferTo(idselec,iddelet)
{
	var idempl,textempl;

	if(idselec.options.selectedIndex == -1)
	{
		alert('No ha seleccionado elementos de la lista');
		return;
	}

	for(var i = 0; i < idselec.length; i++)
	{
		if (idselec.options[i].selected)
		{
			idempl   = idselec.options[i].value;
			textempl = idselec.options[i].text;
			arrayOfStrings = idempl.split(";");
			add_to_deleteList (idselec,i);
			add_record( iddelet, textempl, idempl )

		}
	}
	delete_list(idselec);
}

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : 	add_to_deleteList
Decripcion      : 	elimina de un combo a otro el option seleccionado
Parametros      : 	lstOrigen
i
Retorno         :
Autor           : ariascos - lfolaya
Fecha           : 18052005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
function add_to_deleteList (lstOrigen,i)
{
	deleteList[counterArray]=lstOrigen.options[i].value;
	// 	delvalores[counterArray]=deleteList[counterArray];
	counterArray=counterArray+1;
}

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : 	delete_list
Decripcion      : 	elimina una lista de elementos de un combo.
Parametros      : 	lstOrigen
Retorno         :
Autor           : ariascos - lfolaya
Fecha           : 18052005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
function delete_list(lstOrigen)
{
	for (var counter=0; counter<counterArray; counter++)
	{
		for (var counter2=0; counter2<lstOrigen.options.length; counter2++)
		{
			if (deleteList[counter]==lstOrigen.options[counter2].value)
			{
				delete_record( lstOrigen,counter2);
			}
		}
	}
	counterArray=0;
	deleteList= new Array;
}

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : 	transferWholeList
Decripcion      : 	adiciona de un combo a otro el todas las opciones.
Parametros      : 	idselec
iddelet
Retorno         :
Autor           : ariascos - lfolaya - mstroh
Fecha           : 08112006
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
function transferWholeList(idselec, iddelet)
{
	var idempl,textempl;

	if (idselec.length == 0)
	{
		alert("La lista se encuentra vacia");

		return;
	}

	for(var i=0; i<idselec.length; i++)
	{
		idempl   = idselec.options[i].value;
		textempl = idselec.options[i].text;
		arrayOfStrings = idempl.split(";");
		add_to_deleteList (idselec,i);
		add_record(iddelet, textempl, idempl);
	}
	delete_list(idselec);
}