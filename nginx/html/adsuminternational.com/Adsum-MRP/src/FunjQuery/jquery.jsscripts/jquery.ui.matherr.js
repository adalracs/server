$(function(){
	$('#agregarmaterial').click(function(){
		accionListMaterial(document.getElementById('arr_sol_material').value, 'arr_sol_material', document.getElementById('soat').value);
	});
	
	$('#quitarmaterial').click(function(){
		quitar_register(window.frames['arr_sol_material_view'].document.form1.arr_delitem.value, document.getElementById('arr_sol_material').value, 'arr_sol_material')
	});

				
	$('#agregarherramienta').click(function(){
		accionListHerramienta(document.getElementById('arr_sol_herramienta').value, document.getElementById('soat').value);
	});
	
	$('#quitarherramienta').click(function(){
		quitar_register(window.frames['arr_sol_herramienta_view'].document.form1.arr_delitem.value, document.getElementById('arr_sol_herramienta').value, 'arr_sol_herramienta')
	});
	
	$('#agregarmaterialc, #quitarmaterialc,#agregarmaterial, #quitarmaterial, #agregarherramienta, #quitarherramienta' ).hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
});


/**************/
function loadregister(objselection, type)
{
	if(objselection.checked == true)
		anexa_register(objselection.value, type);
	else
		quitar_register(objselection.value, document.getElementById(type).value, type);
}

function quitar_register(arr_deldata, arr_data, type)
{
	var arr_delitemtemp = "";
	var enc = 0;
	var arr_delitem = arr_deldata.split(",");
	var arr_alldata = arr_data.split(":-:");

	for(var i=0; i < (arr_alldata.length); i++)
	{
		var arr_subdata = arr_alldata[i].split("::");
		
		for (var j=0; j < (arr_delitem.length); j++)
		{
			if(arr_subdata[0] == arr_delitem[j])
			{
				enc = 1
				break;
			}
		}
		
		if(enc == 0)
		{
			if (arr_delitemtemp == "")
				arr_delitemtemp = arr_alldata[i];
			else
				arr_delitemtemp = arr_delitemtemp + ":-:" + arr_alldata[i];
		}
		enc = 0;
	}

	document.getElementById(type).value = arr_delitemtemp;	
	window.document.getElementById(type + '_view').src = 'detallarlistasvisor.php?form_data=' + type + '&iReg_array=' + document.getElementById(type).value  + '&alldata=&ordtracodigo=' + document.form1.ordtracodigo.value;
}

function anexa_register(sel_data, type)
{
	if(sel_data != '')
	{
		var arr_data = document.getElementById(type).value;

		if(arr_data != '')
		{
			var arr_alldata = arr_data.split(":-:");
			var arr_sel = sel_data.split(",");
		
			var arr_delitemtemp = arr_data;
			var enc = 0;
		
			for(var j=0; j < (arr_sel.length); j++)
			{
				for(var i=0; i < (arr_alldata.length); i++)
				{
					var arr_subdata = arr_alldata[i].split("::");
					
					if(arr_subdata[0] == arr_sel[j])
					{
						enc = 1
						break;
					}
				}
				
				if(enc == 0)
					arr_delitemtemp = arr_delitemtemp + ':-:' + arr_sel[j] + '::1';
			
				enc = 0;
			}
		}
		else
			var arr_delitemtemp = sel_data + '::1';
	
		document.getElementById(type).value = arr_delitemtemp;	
		window.document.getElementById(type + '_view').src = 'detallarlistasvisor.php?form_data=' + type + '&iReg_array=' + document.getElementById(type).value  + '&alldata=&ordtracodigo=' + document.form1.ordtracodigo.value;
	}
}

function change_value(id, value, type)
{
	var arr_data = document.getElementById(type).value;
	var arr_alldata = arr_data.split(":-:");
	var arr_delitemtemp = "";

	for(var i=0; i < (arr_alldata.length); i++)
	{
		var arr_subdata = arr_alldata[i].split("::");

		if(arr_subdata[0] == id)
			var subvalue = arr_subdata[0] + '::' + value;
		else
			var subvalue = arr_alldata[i];
		
		if (arr_delitemtemp == "")
			arr_delitemtemp = subvalue;
		else
			arr_delitemtemp = arr_delitemtemp + ":-:" + subvalue;
	}

	document.getElementById(type).value = arr_delitemtemp;	
}