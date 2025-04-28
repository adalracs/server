<!-- Validación de formas -->
<!-- Realizado por:  Luis fernando Olaya -->
<!-- Fecha:23/02/2004 -->

function Validar_cencosto(form) { 

if (form.cencoscodigo.value == "") {
alert("Por favor digite el codigo.");
form.cencoscodigo.focus();
form.submit();
}

if (form.cencosnombre.value == "") {
alert("Por favor digite el nombre.");
form.cencosnombre.focus();
form.submit();
}

}
