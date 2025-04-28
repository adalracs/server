$(function(){

	$("#opclote").change(function(){ 

		switch ( this.value ) {
    		case "1":
    			$("#lotenumero").val("");

    			$("#sesionlote").css("display", "none");

       			$("#sesionnuevolote").css("display", "block");
       			break;
    		case "2":
    			$("#lotecodigo").val("");
    			$("#lotenumeron").val("");
    			$("#proveecodigo").val("");
    			$("#fabricodigo").val("");
    			$("#lotefecfabri").val("");
    			$("#lotefecperio").val("");

    			$("#sesionnuevolote").css("display", "none");

    			$("#sesionlote").css("display", "block");
       			break;
    		default:
    			$("#lotecodigo").val("");
    			$("#lotenumero").val("");
    			$("#lotenumeron").val("");
    			$("#proveecodigo").val("");
    			$("#fabricodigo").val("");
    			$("#lotefecfabri").val("");
    			$("#lotefecperio").val("");

    			$("#sesionnuevolote").css("display", "none");

    			$("#sesionlote").css("display", "none");
       	}

	});


	$('#proveecodigo').change(function() {
		$("#fabricodigo").val("");
		fajaxloadfabricante(this.value);
	});

	$("#itedesnombre").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/desarrollo/jquery.atcmaterialdesa.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item){
				document.getElementById('itedescodigo').value = ui.item.id;
			}else{
				document.getElementById('itedescodigo').value = "";
				document.getElementById('itedesnombre').value = "";
			}
		}
	});

	$("#lotenumeron").autocomplete({
		source: "../src/FunjQuery/jquery.phpcombobox/calidad/jq.atclote.php",
		minLength: 0,
		select: function(event, ui) {
			if(ui.item){
				document.getElementById('lotecodigo').value = ui.item.id;
			}else{
				document.getElementById('lotecodigo').value = "";
				document.getElementById('lotenumeron').value = "";
			}
		}
	});

	var dates = $('#lotefecfabri,#lotefecperio').datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		onSelect: function(selectedDate) {
			var option = this.id == "lotefecfabri" ? "minDate" : "maxDate";
			var instance = $(this).data("datepicker");
			var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			dates.not(this).datepicker("option", option, date);
		}
	});

});

function fajaxloadfabricante( proveecodigo ){

	if( proveecodigo ){

		$.ajax({
			url: "../src/FunGen/floadfabricante.php",
			type: "POST",
			dataType: "html",
			data:{ proveecodigo:proveecodigo, ajax : 1, fload : "floadfabricanteproveedor" },
			beforeSend: function(data){ }, 
			success: function(data, textStatus, xhr) {

				if( data ){
					$("#fabricodigo").html('<option value="">--Seleccione--</td>' + data);
				}else{
					$("#fabricodigo").html('<option value="">--Seleccione--</td>');
				}
			}

		});

	}

}