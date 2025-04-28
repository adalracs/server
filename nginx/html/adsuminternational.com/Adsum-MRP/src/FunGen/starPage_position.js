function starpag_position(xpos,maestro){
	document.form1.inicio.value = parseInt(xpos) - 20;
	document.form1.fin.value = parseInt(xpos) - 1;
	document.form1.mov.value = "mas";
	document.form1.action = maestro;
	document.form1.submit();
}