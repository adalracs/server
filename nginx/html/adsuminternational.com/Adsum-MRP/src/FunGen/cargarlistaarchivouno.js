function cargarlista(valor){
	alert(valor);
   	jsrsExecute("cargaitem.php", cargarListaResultado, "cargarlista", valor );
}

function cargarListaResultado(cadena){
		alert(cadena);
	    window.document.form1.arr_registro1.value = cadena;	    
}
