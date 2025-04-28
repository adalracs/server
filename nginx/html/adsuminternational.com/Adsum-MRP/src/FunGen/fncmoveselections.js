<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : fncmoveselectoptions-->
<!--Decripción      : conjunto de funciones para mover options de un select a otro-->
<!--Nota: -->
<!--Se agrupan varias funciones en este archivo debido a que existen variables globales usadas-->
<!--por varias funciones-->
<!--Parametros      :-->
<!--valor:	llave primaria del grupo de capacitacion escogido-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Fecha           : 21-jun-2005-->

<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : add_record-->
<!--Decripción      : Agregar un nuevo option a un select-->
<!--Parametros      :-->
<!--lista			: select al cual se agregarà un nuevo option-->
<!--new_name		: nombre del nuevo option-->
<!--new_value		: nombre del nuevo option-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Fecha           : 21-jun-2005-->

function add_record( lista, new_name, new_value )
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
	for (i=dummy.length; i>0;i--)
	lista.options[i] = null;
	lista.length= 0;
	for (i=0; i<dummy.length; i++)
	{
		lista.options[i] = new Option(dummy[i][0],dummy[i][1]);
	}
	lista.options[i] = new Option(new_name, new_value);
	lista.length = dummy.length + 1;
}

<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : delete_record-->
<!--Decripción      : Borrar un option de un select-->
<!--Parametros      :-->
<!--lista			: select al cual se borrará el option-->
<!--indice			: Position en el select del option a borrar-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Fecha           : 21-jun-2005-->
function delete_record(lista, indice)
{
	var dummy = new Array;
	var i;
	
	for (i=0; i<lista.length;i++)
	if (i < indice)
	{
		dummy[i] = new Array;
		dummy[i][0] = lista.options[i].text;
		dummy[i][1] = lista.options[i].value;
	}
	else
		if (i > indice)  
		{
			dummy[i-1] = new Array;
			dummy[i-1][0] = lista.options[i].text;
			dummy[i-1][1] = lista.options[i].value;
		}
	
	for (i=lista.length; i>0;i--)
		lista.options[i] = null;
	lista.length= 0;
	
	for (i=0; i<dummy.length; i++) 
	{
		lista.options[i] = new Option(dummy[i][0],dummy[i][1]);
	}
	lista.length = dummy.length;
}
var DELIMITER = ';';
var deleteList = new Array;
var counterArray=0;
var auxiliar = new Array;
var counterArray=0;

<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : trasferTo-->
<!--Decripción      : Transfiere un option de un select a otro-->
<!--Parametros      :-->
<!--idselec			: Select origen del option a mover-->
<!--iddelet			: Select destino del option a mover-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Fecha           : 21-jun-2005-->
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

<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : add_to_deleteList-->
<!--Decripción      : Agrega el valor del option a mover en un arreglo-->
<!--Parametros      :-->
<!--lstOrigen		: Select origen del option a mover-->
<!--i				: Indice del option a mover-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Fecha           : 21-jun-2005-->
function add_to_deleteList (lstOrigen,i) {
	deleteList[counterArray]=lstOrigen.options[i].value;
	// 	delvalores[counterArray]=deleteList[counterArray];
	counterArray=counterArray+1;
}


<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : delete_list-->
<!--Decripción      : Encontrar un option del select origen que coincida con un option que esta en -->
<!--en arreglo delete_list y borrarlo del select origen-->
<!--Parametros      : -->
<!--lstOrigen		: Select origen del option a mover-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes - mstroh-->
<!--Fecha           : 21-jun-2005-->
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