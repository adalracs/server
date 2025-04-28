/***
/
/ Propiedad intelectual de ADSUM (c)
/ Funcion:		cargarcheck
/ Descripcion:  Conserva los checkbox seleccionados por el usuario, 
/			    aun cuando este navega entre los registros de un maestro
/ Autor: 		lfolaya
/ Fecha:		08/02/2006
/
*************************************/
var arr_borrar = new Array;

function cargarcheck(cual)
{
	var arreglo_b = new Array;
	var nomVec = new Array;

	var x = 0;
	var flag = 0;
	for(var m = 0; m < cual.length; m++)
	{
		if(cual.elements[m].type == "checkbox")
		{
			if(cual.elements[m].checked == true)
			{
				arreglo_b[x] = cual.elements[m].value;
				x = x + 1;
				document.form1.arreglo_b.value = arreglo_b;
			}
		}
	}
	if (document.form1.arr_borrar.value == "")
	{
		document.form1.arr_borrar.value = arreglo_b;
	}
	else
	{
		nomVec = document.form1.arr_borrar.value.split(",");

		for (var m = 0; m < arreglo_b.length; m++)
		{
			flag = 0;
			var z = nomVec.length;
			for (var i = 0; i < z; i++)
			{
				if(nomVec[i] == arreglo_b[m])
				flag = 1;
			}
			if(flag == 0){
				nomVec[z] = arreglo_b[m];
			}
		}
		window.document.form1.arr_borrar.value = nomVec;
	}
}