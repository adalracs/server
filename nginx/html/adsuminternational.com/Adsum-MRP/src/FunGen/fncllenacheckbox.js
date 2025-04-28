/*
Propiedad intelectual de Adsum (c).
Funcion         : llenachek
Decripcion      : llena una checkbox dinamicamente.
Parametros      : Descripicion
   $nomb     tiene el objeto del formulario.
Retorno         :
Autor           : lfolaya
Fecha           : 26-may-2005

*/
function llenachek(nomb)
{
	var nombcheck = nomb.name
	var y = 0;
	var valComp = nombcheck.substring(nombcheck.lastIndexOf('-') + 1, nombcheck.length);
	if(nomb.checked == true)
	{
		for (var i = 0; i < document.form1.elements.length; i++)
		{
			if(document.form1.elements[i].type == "checkbox" && document.form1.elements[i].value == valComp)
			{
				document.form1.elements[i].checked = true;
				return;
			}
		}
	}
	else if(nomb.checked == false)
	{
		for (var i = 0; i < document.form1.elements.length; i++)
		{
			if(document.form1.elements[i].type == "checkbox" && document.form1.elements[i].value == valComp)
			{
				for (var j = 0; j < document.form1.elements.length; j++)
				{
					var nomb1 = document.form1.elements[j].name;
					y = nomb1.substring(nomb1.lastIndexOf('-') + 1, nomb1.length);
					if(document.form1.elements[j].type == "checkbox")
					{
						if(valComp == y && document.form1.elements[j].checked == true)
						{
							document.form1.elements[i].checked = true;
							return;
						}
						else
						{
							document.form1.elements[i].checked = false;
						}
					}
				}
			}
		}
	}
}
	  		
/*
Propiedad intelectual de Adsum (c).
Funcion         : llenachek
Decripcion      : llena todos los checkbox dinamicamente.
Parametros      : Descripicion
   $nomb     tiene el objeto del formulario.
Retorno         :
Autor           : lfolaya
Fecha           : 26-may-2005

*/
function llenachekall(nomb)
{
	if(nomb.checked == true)
	{
		for (var k = 0; k < window.document.form1.elements.length; k++)
		{
			if(window.document.form1.elements[k].type == "checkbox")
			{
				window.document.form1.elements[k].checked = true;
			}
		}
	}else if(nomb.checked == false)
	{
		for (var k = 0; k < window.document.form1.elements.length; k++)
		{
			if(window.document.form1.elements[k].type == "checkbox")
			{
				window.document.form1.elements[k].checked = false;
			}
		}
	}
}

/*
Propiedad intelectual de Adsum (c).
Funcion         : llenachek
Decripcion      : llena los hijo del checkbox seleccionado dinamicamente.
Parametros      : Descripicion
   $nomb     tiene el objeto del formulario.
Retorno         :
Autor           : lfolaya
Fecha           : 26-may-2005

*/
function llenachekperm(nomb)
{
	var y;
	if(nomb.checked == true)
	{
		for (var k = 0; k < document.form1.elements.length; k++)
		{
			if(document.form1.elements[k].type == "checkbox")
			{
				var nomb1 = document.form1.elements[k].name;
				y = nomb1.substring(nomb1.lastIndexOf('-') + 1, nomb1.length);
				if(nomb.value == y)
				{
					document.form1.elements[k].checked = true;
				}
			}
		}
	}else if(nomb.checked == false)
	{
		for (var k = 0; k < document.form1.elements.length; k++)
		{
			if(document.form1.elements[k].type == "checkbox")
			{
				var nomb1 = document.form1.elements[k].name;
				y = nomb1.substring(nomb1.lastIndexOf('-') + 1, nomb1.length);
				if(nomb.value == y)
				{
					document.form1.elements[k].checked = false;
				}
			}
		}
	}
}