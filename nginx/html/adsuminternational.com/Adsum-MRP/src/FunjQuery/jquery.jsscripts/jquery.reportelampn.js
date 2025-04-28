$(function(){
	
	$("#equipocodigo").change(function(){ document.form1.submit(); });
	
	$("#patestnombre").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/jquery.atcpatronestruc.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item)
			{
				document.getElementById('patestcodigo').value = ui.item.id;
			}
			else
			{
				document.getElementById('patestcodigo').value = "";
			}
		}
	});
});