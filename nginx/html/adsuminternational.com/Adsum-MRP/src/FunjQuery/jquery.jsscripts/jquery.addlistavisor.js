	/**
	 * Function sel_row_luminarias
	 * @param index
	 * @param arr_data
	 * @return
	 */
	function sel_row_luminarias(index, arr_data)
	{
		var arr_row = arr_data.split('{#}');
		var arr_subrow = arr_row[1].split('{~}');
		var caplumpotenc = window.parent.document.form1.elements['caplumpotenc'];
		var caplumperdid = window.parent.document.form1.elements['caplumperdid'];
//		var caplumestado = window.parent.document.form1.elements['caplumestado'];
		
		var row_list = window.parent.document.form1.row_list;
		var dirow_list = window.parent.document.form1.dirow_list;
		//-----
//		selselect(caplumestado, arr_subrow[2]);
		//-----

		caplumpotenc.value = arr_subrow[0];
		caplumperdid.value = arr_subrow[1];

		row_list.value = index;
		dirow_list.value = arr_subrow[3];
	}
	
	/**
	 * Function selselect
	 * @param selectlist
	 * @param value
	 * @return
	 */
	function selselect(selectlist, value)
	{
		for(var i=0; i < (selectlist.length); i++)
		{
			if(selectlist.options[i].value == value)	
			{
				selectlist.options[i].selected = true;
				break;
			}
		}
	}