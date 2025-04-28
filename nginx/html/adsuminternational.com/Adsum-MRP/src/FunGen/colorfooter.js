function cambiar_color_over(celda){ 
   celda.style.backgroundColor="#e3e3e3" 
} 
function cambiar_color_out1(celda){ 
   celda.style.backgroundColor="#f0f6ff" 
} 
function cambiar_color_out2(celda){ 
   celda.style.backgroundColor="#E8F0F6" 
}


/**
 * Function setClassHover
 * Funcion para evento del mouse move o mouse over
 * @param celda
 * @return
 */
function setClassHover(row)
{ 
	row.className = "ui-widget-header-row";
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


function selec_opt(valopt, skip){
	var mms = "rdobutt" + valopt;

	if (skip != ""){
		if(document.form1.seltack.value == valopt){ 
			document.form1.seltack.value = "";
		}else{
			if(document.getElementById(mms).checked == true){
				document.getElementById(mms).checked = false;
			}else{
				document.getElementById(mms).checked = true;
			} 
		}
	}else{
		document.getElementById(mms).checked = true;
		if(document.getElementById('selstar') != null)
			document.getElementById('selstar').value = 1;
		
		if(document.getElementById('printotp'))
			document.getElementById('printotp').value = document.getElementById(mms).value;
	}
}