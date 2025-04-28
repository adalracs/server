/***
/
/ Propiedad intelectual de ADSUM (c)
/ Funcion:		setForm
/ Descripcion:  Cambia valores en el formulario de tal forma que se puedan cambiar 
/               los items del formulario (RADIOBUTTON/CHECKBOX)
/ Autor: 		mstroh
/ Fecha:		08/02/2006
/
*************************************/

function setForm(inicio, fin, mov)
{
	var chk_a = window.document.form1.flagcheck;

//  ---------------------------------------------------------	
	(chk_a.value == "") ? chk_a.value = 1 : chk_a.value = "";
//  ---------------------------------------------------------
	if(mov == "")
	{
		window.document.form1.inicio.value = "";
		window.document.form1.fin.value = "";
	}
	else
	{
		window.document.form1.mov.value = mov;
	}
	window.document.form1.submit();
}