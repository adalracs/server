<!--Propiedad intelectual de adsum (c). -->
<!--Funcion         : cargarFormahistoriaot -->
<!--Decripcion      : llena los campos pertinentes del formulario -->
<!--Parametros		: v -> cadena con los codigos de los auxiliares de mantenimiento
<!--Autor           : mstroh -->
<!--Fecha           : 08-Ene-2006-->

function cargarFormahistoriaot(v)
{
	window.document.form1.empleaselec.options.length = 0;

	if(!(window.document.form1.usuarios_aux.value == ""))
	{
		window.document.getElementById('auxiliares').style.display = 'inline';
		cargarEmpleaselec(v);
	}
	else
	{
		window.document.getElementById('auxiliares').style.display = 'none';
	}
}

function limpiaSelects(ref)
{
	window.document.form1.tipmancodigo_h.options[1] = null;
	window.document.form1.prioricodigo_h.options[1] = null;
	window.document.form1.tiptracodigo_h.options[1] = null;
	window.document.form1.tareacodigo_h.options[1] = null;

	ref.style.display = 'none';
}

function abreVentanas(codigo, flag)
{
	var ordtracodigo = window.document.form1.ordtracodigo.value;

	if(flag)
	{
		window.open('ingrnuevreportotitem.php?codigo='+codigo+'&ordtracodigo='+ordtracodigo+'','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
	}
	else
	{
		window.open('ingrnuevreporotherramie.php?codigo='+codigo+'&ordtracodigo='+ordtracodigo+'','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
	}
}

function showDivs(str, flag)
{
	if(flag == 0)
	{
		window.document.getElementById('herram_dev').style.display = 'none';
		window.document.getElementById('items_dev').style.display = 'none';
		return;
	}
	else
	{
		if(str != "")
		{
			if(str.indexOf(",") == -1)
			{
				if(str == 1)
				{
					window.document.getElementById('items_dev').style.display = 'inline';
					window.document.getElementById('herram_dev').style.display = 'none';
				}
				else
				{
					window.document.getElementById('herram_dev').style.display = 'inline';
					window.document.getElementById('items_dev').style.display = 'none';
				}
			}

			else
			{
				window.document.getElementById('items_dev').style.display = 'inline';
				window.document.getElementById('herram_dev').style.display = 'inline';
			}
		}

		else
		{
			window.document.getElementById('items_dev').style.display = 'none';
			window.document.getElementById('herram_dev').style.display = 'none';
		}
	}
}