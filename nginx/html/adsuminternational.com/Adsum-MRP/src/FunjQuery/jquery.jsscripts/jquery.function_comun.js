/**
 * Function loadArraylist
 * Funcion verifica y carga el contenido de un array separada por {strArrSep} y lo guarda en una variable tipo hidden
 * @param strValue
 * @param objArrindex
 * @param strArrSep
 */
function loadArraylist(strValue, objArrindex, strArrSep)
{
	if(document.getElementById(objArrindex))
	{
		var strList = document.getElementById(objArrindex).value;
		var arrList = strList.split(strArrSep);
		var booEnc = false;
		
		if(arrList != "")
		{
			for(var i=0; i < (arrList.length); i++)
			{
				if (arrList[i] == strValue)
				{
					booEnc = true;
					break;
				}
			}
			
			if(booEnc == false)
				document.getElementById(objArrindex).value = document.getElementById(objArrindex).value + strArrSep + strValue;
		}
		else
			document.getElementById(objArrindex).value = strValue;
	}
}

/**
 * Function loadArraylistdelete
 * Funcion verifica y descarta los indices contenidos de un array separada por {strArrSep} y lo guarda en una variable tipo hidden
 * @param objArrindex
 * @param strArrSep
 */
function loadArraylistdelete(objArrindex, strArrSep)
{
	if(document.getElementById(objArrindex))
	{
		var strList = document.getElementById(objArrindex).value;
		var strListtmp = document.getElementById(objArrindex + 'tmp').value;
		var arrList = strList.split(strArrSep);
		var arrListtmp = strListtmp.split(strArrSep);
		var strnList = "";
		var booEnc = false;
		
		if(arrList != "")
		{
			for(var i=0; i < (arrList.length); i++)
			{
				for(var j=0; j < (arrListtmp.length); j++)
				{
					if (arrList[i] == arrListtmp[j])
					{
						booEnc = true;
						break;
					}
				}
				
				if(booEnc == false)
					strnList = strnList + ((strnList != "") ? strArrSep : "") + arrList[i];
					
				booEnc = false;
			}
			
			document.getElementById(objArrindex).value = strnList;
			document.getElementById(objArrindex + 'tmp').value = '';
		}
	}
}

/**
 * Function resetHour
 * Funcion generica para activar e inactivar la fecha fin dependiendo de la seleccion de la fecha de inicio
 * el formato requerido de los objetos es 'HH:mm'
 * 
 * @param indinicio
 * @param indfin
 */

function resetHour(indinicio, indfin)
{
	var horfin = document.getElementById(indfin);
	var horini = document.getElementById(indinicio);

	horfin.options[horini.selectedIndex].selected = true;

	for(var i=1; i<horfin.length; i++)
	{
		if(i <= (horini.selectedIndex - 1) )
			horfin.options[i].disabled = true;
		else
			horfin.options[i].disabled = false;
	} 
}


/**
 * Function verocultar
 * Funcion generica para la accion de cambiar icono en los div-animatedcollapse
 * @param cual
 * @param index
 */
function verocultar(cual, index)
{
	if(document.getElementById(cual).style.display == 'none')
		document.getElementById("row" + index).src = "temas/Noise/AscOn.gif";
	else
		document.getElementById("row" + index).src = "temas/Noise/DescOn.gif";
}

/**
 * Function loadlist_func
 * Funcion que carga la seleccion desde listado del pop-up de los tecnicos al 'lsttecnico'
 * @param strtecn
 * @param strindex
 */
function loadlist_func(strtecn, strindex)
{
	if(strtecn != '')
	{
		var arr_strtecn = strtecn.split(strindex); //Caracter con la cual se indexan en el listado del pop-up
		var nstrtecn = "";
			
		for(var a = 0; a < (arr_strtecn.length); a++)
			nstrtecn = nstrtecn + arr_strtecn[a];
		
		document.getElementById('lsttecnico').value = nstrtecn;	
		
		var strParamet = 'iRegArray=' + document.getElementById('lsttecnico').value;
		accionListTecnicos(strParamet, 'involucrados');
	}
}

/**
 * Function loadlist_tecn
 * Funcion que carga la seleccion desde listado del pop-up de los tecnicos al 'lsttecnico'
 * @param strtecn
 * @param strindex
 */
function loadlist_tecn(strtecn, strindex)
{
	if(strtecn != '')
	{
		var arr_strtecn = strtecn.split(strindex); //Caracter con la cual se indexan en el listado del pop-up
		var nstrtecn = "";
		
		for(var a = 0; a < (arr_strtecn.length); a++)
			nstrtecn = nstrtecn + arr_strtecn[a];
		
		document.getElementById('lsttecnico').value = nstrtecn;	
		window.document.getElementById('lsttecnicovisor').src = 'detallarlistasvisor.php?form_data=lsttecnico&iReg_array=' + document.getElementById('lsttecnico').value  + '&usualider=' + document.getElementById('usualider').value + '&alldata=';
	}
}

/**
 * Function loadlist_tecncuadrilla
 * Funcion que carga la seleccion desde listado del pop-up de las cuadrillas al 'lsttecnicoot'
 * @param cdgcuadri
 * @param typesource
 * @param strindex
 */
function loadlist_tecncuadrilla(cdgcuadri, typesource, strindex)
{
	if(cdgcuadri != '')
	{
		var arr_cdgcuadri = cdgcuadri.split(strindex); //Caracter con la cual se indexan en el listado del pop-up
		
		if(typesource == 'user')
		{
			var nstrtecn = "";
				
			for(var a = 0; a < (arr_cdgcuadri.length); a++)
				nstrtecn = nstrtecn + arr_cdgcuadri[a];
			document.getElementById('lsttecnicoot').value = nstrtecn;
		}
		else
			document.getElementById('lsttecnicoot').value = arr_cdgcuadri[0];
		
//		window.document.getElementById('lsttecnicootvisor').src = 'detallarlistasvisor.php?form_data=lsttecnicoot&iReg_array=' + document.getElementById('lsttecnicoot').value  + '&typesource=' + typesource + '&usualider=' + document.getElementById('usualider').value + '&alldata=';
		
		var fecini = '';
		var fecfin = '';
		
		if(document.getElementById('ordtrafecini'))
			fecini = document.getElementById('ordtrafecini').value;
		
		if(document.getElementById('ordtrafecfin'))
			fecfin = document.getElementById('ordtrafecfin').value;
		
	}
	else
	{
		 document.getElementById('lsttecnicoot').value = '';
		 document.getElementById('usualider').value = ''; 
	}
	
	var strParamet = 'iRegArray=' + document.getElementById('lsttecnicoot').value + '&usualider=' + document.getElementById('usualider').value + '&typesource=' + typesource + '&fecini=' + fecini + '&fecfin=' + fecfin;
	accionListTecnicoOt(strParamet, 'involucrados');
}

/**
 * Function ret_tecn
 * Funcion generica recargar la lista de tecnicos no retirados
 * @param strtecn
 */
function ret_tecn(strtecn)
{
	if(strtecn != '')
	{
		document.getElementById('lsttecnico').value = strtecn;
		window.document.getElementById('lsttecnicovisor').src = 'detallarlistasvisor.php?form_data=lsttecnico&iReg_array=' + document.getElementById('lsttecnico').value  + '&usualider=' + document.getElementById('usualider').value + '&alldata=';
	}
}

/**
 * Function ret_tecncuadrilla
 * Funcion generica recargar la lista de tecnicos no retirados
 * @param strtecn
 */
function ret_tecncuadrilla(strtecn)
{
	if(strtecn != '')
	{
		document.getElementById('lsttecnicoot').value = strtecn;
		window.document.getElementById('lsttecnicootvisor').src = 'detallarlistasvisor.php?form_data=lsttecnicoot&iReg_array=' + document.getElementById('lsttecnicoot').value  + '&typesource=user&usualider=' + document.getElementById('usualider').value + '&alldata=';
	}
}

/**
 * Function blockdiv_fcheck
 * Funcion abre o cierra un bloque tipo "<div>" por medio de un objeto checkbox
 * @param object
 * @param obj_div
 */
function blockdiv_fcheck(object, obj_div)
{
	if(object.checked == true)
		document.getElementById(obj_div).style.display = 'block';
	else
		document.getElementById(obj_div).style.display = 'none';
}



/**
 * Function loaddata
 * Funcion unicamente para el uso de campos personalizados en sistema, equipo y componente
 * @param data
 * @param indice
 */
function loaddata(data, indice)
{
	var arr_gen =  document.form1.arreglo_cam.value
	var arreglogen = arr_gen.split(":|:");
	var enc = 0;
	var new_arreglo ="";

	if (arreglogen != "")
	{
		for(var i=0; i < (arreglogen.length); i++)
		{
			var index_data = arreglogen[i].split(":-:");

			if (index_data[0] == indice)
			{
				if (new_arreglo == '')
					new_arreglo = index_data[0] + ':-:' + data;
				else
					new_arreglo = new_arreglo + ":|:" + index_data[0] + ':-:' + data;
				enc = 1;
			}
			else
			{
				if (new_arreglo == '')
					new_arreglo = arreglogen[i];
				else
					new_arreglo = new_arreglo + ":|:" + arreglogen[i];
			}
		}
	}

	if(enc == 0)
	{
		if (new_arreglo == "")
			new_arreglo = indice + ":-:" + data;	
		else
			new_arreglo = indice + ":-:" + data + ":|:" + new_arreglo;
	}
		
	document.form1.arreglo_cam.value = new_arreglo;
}

/**
 * Function setSelectionRow
 * Funcion Para el uso de listas de seleccion multiple
 * @param selData
 * @param arreglo
 * @param comodin
 * @param namechkAll
 * @param nameArreglo
 * @return
 */
function setSelectionRow(selData, arreglo, comodin, nameChk)
{
	var find = 0;
	var retArreglo = ""
	var arrArreglo = arreglo.split(comodin);

	if (arrArreglo != "")
	{
		for(var i=0; i < (arrArreglo.length); i++)
		{
			if (arrArreglo[i] == selData)
				find = 1;
			else
			{
				if( arrArreglo[i] != '')
				{
					if (retArreglo == '')
						retArreglo = arrArreglo[i];
					else
						retArreglo = retArreglo + comodin + arrArreglo[i];
				}
			}
		}
	}
				
	if (find == 0) 
	{
		if (retArreglo == "")
			retArreglo = selData;	
		else
			retArreglo = selData + comodin + retArreglo;
	}
	
	if(document.getElementById('arr' + nameChk))
		document.getElementById('arr' + nameChk).value = retArreglo;
	else
		document.getElementById(nameChk).value = retArreglo;
	
	if(document.getElementById('all' + nameChk))
		setVerificaList(nameChk);
}

/**
 * Function setSelectionAll
 * 
 * @param nameChk
 * @param comodin
 * @return
 */
function setSelectionAll(nameChk, comodin)
{
	var chkObject = document.getElementsByName('chk' + nameChk);
	var retArreglo = new Array;
	
	if(document.getElementById('all' + nameChk).checked == true)
	{
		for(var m = 0; m < chkObject.length; m++)
		{
			chkObject[m].checked = true;

			if (retArreglo == "")
				retArreglo = chkObject[m].value;	
			else
				retArreglo = chkObject[m].value + comodin + retArreglo;
		}
	}
	else
	{
		for(var m = 0; m < chkObject.length; m++)
			chkObject[m].checked = false;
	}
	
	document.getElementById('arr' + nameChk).value = retArreglo;
}

/**
 * Function setVerificaList
 * 
 * @param nameChk
 * @return
 */
function setVerificaList(nameChk)
{
	var chkObject = document.getElementsByName('chk' + nameChk);
	
	for(var m = 0; m < chkObject.length; m++)
	{
		if(chkObject[m].checked == false)
		{
			var out = 1;
			break;
		}
	}
	
	if(out)
		document.getElementById('all' + nameChk).checked = false;
	else
		document.getElementById('all' + nameChk).checked = true;
}

/**
 * Function setClassHover
 * Funcion para evento del mouse move o mouse over
 * @param celda
 * @return
 */
function setClassHover(row)
{ 
	row.className = "ui-state-default-hover-row";
}

/**
 * Function setClassIn
 * Funcion para evento del mouse move o mouse over
 * @param celda
 * @return
 */
function setClassIn(row)
{ 
	row.className = "NoiseDataTD";
}

/**
 * Function setClassOut
 * Funcion para evento del mouse move o mouse over
 * @param celda
 * @return
 */
function setClassOut(row)
{ 
	row.className = "NoiseFooterTD"; 
}

/**
 * Funcion solo para formularios de Novedades
 * @return
 */
function calculeDiff()
{
	var arFecini = document.getElementById('usunovfecini').value.split('-');
	var arFecfin = document.getElementById('usunovfecfin').value.split('-');
	var arHorini = document.getElementById('usunovhorini').value.split(':');
	var arHorfin = document.getElementById('usunovhorfin').value.split(':');

	if(arFecini != "" && arFecfin != "" && arHorini != "" && arHorfin != "")
	{
		var dateFrom = new Date();
		var dateTo = new Date();
		
		dateFrom.setDate(parseInt(arFecini[2]));
		dateFrom.setMonth(parseInt(arFecini[1])-1);
		dateFrom.setFullYear(parseInt(arFecini[0]));
		dateFrom.setHours(parseInt(arHorini[0]));
		dateFrom.setMinutes(parseInt(arHorini[1]));
		dateFrom.setSeconds(parseInt(0));

		dateTo.setDate(parseInt(arFecfin[2]));
		dateTo.setMonth(parseInt(arFecfin[1])-1);
		dateTo.setFullYear(parseInt(arFecfin[0]));
		dateTo.setHours(parseInt(arHorfin[0]));
		dateTo.setMinutes(parseInt(arHorfin[1]));
		dateTo.setSeconds(parseInt(0));

		var duracion = dateDiff(dateFrom, dateTo);
		document.getElementById('duracionhe').innerHTML = duracion;  
		document.getElementById('duracion').value = duracion;  
	}
}

/**
 * Function dateDiff
 * Funcion para saber la diferencia entre 2 fechas => @ anio(s) @ dia(s) @ mes(es) @ hora(s) @ minuto(s)
 * @param dateFrom
 * @param dateTo
 * @return string
 */
function dateDiff(dateFrom, dateTo)
{
	/*
		getDate() - Devuelve el día del mes de 1 a 31
		getDay() - Devuelve el día de la semana de 0 a 6
		getMonth() - Devuelve el mes actual de 0 a 11, si queremos mostrar la fecha en formato dd/mm/yyy, tendremos que sumar uno a este valor.
		getFullYear() - Devuelve el año en formato YYYY
		getYear() - Devuelve el año en formato YY
		getHours() - Devuelve la hora de 0 a 23
		getMinutes() - Devuelve los minutos de 0 a 59
		getSeconds() - Devuelve los segundos de 0 a 59
		getMilliseconds() - Devuelve los milisegundos (0-999)
		getTime() - Devuelve la fecha unix (Número de milisegundos desde medianoche del 1 de enero de 1970)
		getTimezoneOffset() - Zona horária del visitante
	*/
	
	/*
	var anio = dateTo.getFullYear() - dateFrom.getFullYear();
	var mes = dateTo.getMonth() - dateFrom.getMonth();
	var dia = dateTo.getDate() - dateFrom.getDate();
	var hora = dateTo.getHours() - dateFrom.getHours();
	var min = dateTo.getMinutes() - dateFrom.getMinutes();
	
	var returnResp = "";


	
	
	if((dateTo.getTime() - dateFrom.getTime()) > 0)
	{
		
		if(min > 0)
			returnResp = min + " minuto(s) ";
		else if(min < 0)
		{
			hora = parseFloat(((hora * 60) +  min) / 60);
			var submin = hora.toString().split('.');
			
			hora = parseInt(submin[0]);
			returnResp = ((60 * parseInt(submin[1])) / 10) + " minuto(s) ";
		}
		
		if(hora > 0)	
			returnResp = hora + " hora(s) " + returnResp;
		else if(hora < 0)
		{
			if(dia > 0)
				dia = dia - 1;
			else
				dia = dia + 1;
			
			hora = 24 + hora;
			returnResp = hora + " hora(s) " + returnResp;
		}
		
		
		if(dia > 0)
			returnResp = dia + " d&iacute;a(s) " + returnResp;	
		else if(dia < 0)
		{
			if(mes > 0)
				mes = mes - 1;
			else
				mes = mes + 1;
			
			dia = dia * -1;
			returnResp = dia + " d&iacute;a(s) " + returnResp;
		}

		if((mes > 0 && anio > 0) || (mes <= 0 && anio > 0))
			returnResp = (mes + 12) + " mes(es) " + returnResp ;	
		else if(mes > 0)
			returnResp = mes + " mes(es) " + returnResp ;
	}
	else
		returnResp = "La fecha/hora de inicio debe ser menor a la fecha/hora fin";
	*/
	
	var diff = dateTo - dateFrom;
	var milliseconds = Math.floor(diff % 1000);
	diff = diff / 1000;
	var seconds = Math.floor(diff % 60);
	diff = diff / 60;
	var minutes = Math.floor(diff % 60);
	diff = diff / 60;
	var hours=Math.floor(diff % 24);
	diff = diff / 24;
	var days = Math.floor(diff);
	
	 var outStr = days + ' dia(s), ' + hours+ ' hora(s), ' + minutes;
     outStr+= ' minuto(s)'; 
	
	return outStr;
}

/*
 * Function selectObjList
 * Funcion generica para la seleccion de de listas obj Select
 * @param index
 * @param value
 * @return
 */
function selectObjList(index, value)
{
	var selObj = document.getElementById(index);

	for(var i=0; i<selObj.length; i++)
	{
		if(selObj.options[i].value == value)
		{
			selObj.options[i].selected = true;
			break;
		}
	} 
}