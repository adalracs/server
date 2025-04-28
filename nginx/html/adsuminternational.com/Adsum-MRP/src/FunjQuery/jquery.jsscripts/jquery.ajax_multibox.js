function select_multibox(selfilter)
{
	var datapost = 'tipequcodigo=' + document.getElementById('tipequcodigo').value;
	
	if(selfilter == 'tipequcodigo')
	{
		select_reset();
		accionMultiBox(datapost + '&campo=equipomarca', 'equipomarca');
		accionMultiBox(datapost + '&campo=equiponombre', 'equiponombre');
		accionMultiBox(datapost + '&campo=codigosrf', 'codigosrf');
		accionMultiBox(datapost + '&campo=equipocinv', 'equipocinv');
		return;
	}
	else
	{
		var arr_list = document.getElementById('arrlist').value;
		var new_arr_list = '';
		var enc = '1';
		
		if(arr_list != '')
		{
			var arr_split = arr_list.split(',');
			
			for(var i=0; i < (arr_split.length); i++)
			{
				if(new_arr_list != '')
					new_arr_list = new_arr_list + ',' + arr_split[i];
				else
					new_arr_list = arr_split[i];
				
				if(selfilter == arr_split[i])
				{
					enc = '0';
					datapost = datapost + '&' + selfilter + '=' + document.getElementById(selfilter).value;
					
					break;
				}
				else
					datapost = datapost +'&' + arr_split[i] + '=' + document.getElementById(arr_split[i]).value;
			}
			
			if(enc == '1')
			{
				new_arr_list = new_arr_list + ',' + selfilter;
				datapost = datapost + '&' + selfilter + '=' + document.getElementById(selfilter).value;
			}
		}
		else
		{
			new_arr_list = selfilter;
			datapost = datapost + '&' + selfilter + '=' + document.getElementById(selfilter).value;
		}
		
		document.getElementById('arrlist').value = new_arr_list;
		//---------------------------------------------------------
		var arr_split = new_arr_list.split(',');
		var arr_comp = new Array;
		var enc = '1';
		arr_comp[0] = 'equipomarca';
		arr_comp[1] = 'codigosrf';
		arr_comp[2] = 'equipocinv';
		arr_comp[3] = 'equiponombre';
		//---------------------------------------------------------

		for(var j=0; j < 4; j++)
		{
			enc = '1';
			
			for(var i=0; i < (arr_split.length); i++)
			{
				if(arr_comp[j] ==  arr_split[i])
				{
					enc = '2';
					break;
				}
			}
			
			if(enc == '1')
				accionMultiBox(datapost + '&campo=' + arr_comp[j], arr_comp[j]);
		}
	}
}

function select_reset()
{
	document.getElementById('arrlist').value = '';
	document.getElementById('equipomarca').options[0].selected = true;
	document.getElementById('equiponombre').options[0].selected = true;
	document.getElementById('codigosrf').options[0].selected = true;
	document.getElementById('equipocinv').options[0].selected = true;
}




/* Actualizacion de los listados box select del formulario */
/**
 * Funcion accionMultiBox
 * @param datapost
 * @return
 */
function accionMultiBox(datapost, control)
{
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "../src/FunjQuery/jquery.phpcombobox/jquery.cbmx_multibox.php",
		data: datapost,
		beforeSend: function(data){},        
		success: function(requestData){
			document.getElementById('select' + control).innerHTML = requestData;
		},         
		error: function(requestData, strError, strTipoError){   
			alert("Error " + strTipoError +': ' + strError);
		},
		complete: function(requestData, exito){ }                                      
	});
}
/* Actualizacion datos equipo desde soliser */

(function($) { $(function() {}); })(jQuery);