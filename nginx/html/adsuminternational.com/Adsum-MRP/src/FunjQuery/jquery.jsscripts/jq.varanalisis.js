//by ralvear 20131001

$(function(){

	$("#tipcalcodigo").change(function(){ 

		switch ( this.value ) {
    		case "1":
    			$("#tipsolcodigo").val("");

    			$("#lbltipsolcodigo").css("display", "none");
    			$("#objtipsolcodigo").css("display", "none");

       			$("#lbltipitemcodigo").css("display", "block");
       			$("#objtipitemcodigo").css("display", "block");
       			break;
    		case "2":
    			$("#tipitemcodigo").val("");

       			$("#lbltipitemcodigo").css("display", "none");
       			$("#objtipitemcodigo").css("display", "none");

       			$("#lbltipsolcodigo").css("display", "block");
    			$("#objtipsolcodigo").css("display", "block");
       			break;
    		default:
    			$("#tipsolcodigo").val("");
    			$("#tipitemcodigo").val("");

       			$("#lbltipsolcodigo").css("display", "none");
    			$("#objtipsolcodigo").css("display", "none");

       			$("#lbltipitemcodigo").css("display", "none");
       			$("#objtipitemcodigo").css("display", "none");
       	}

	});

	$("#varanatipespe").change(function(){ 

		switch ( this.value ) {
    		case "1":
    			$("#varanadetespmayor").val("");
    			$("#lblvaranadetespmayor").css("display", "none");
    			$("#objvaranadetespmayor").css("display", "none");

    			$("#varanadetespmenor").val("");
    			$("#lblvaranadetespmenor").css("display", "none");
    			$("#objvaranadetespmenor").css("display", "none");

       			$("#lblvaranatole").css("display", "block");
       			$("#objvaranatole").css("display", "block");
       			break;
    		case "2":
    			$("#varanadetespmenor").val("");
       			$("#lblvaranadetespmenor").css("display", "none");
    			$("#objvaranadetespmenor").css("display", "none");

				$("#varanatolems").val("");
				$("#varanatolemn").val("");
       			$("#lblvaranatole").css("display", "none");
       			$("#objvaranatole").css("display", "none");

       			$("#lblvaranadetespmayor").css("display", "block");
    			$("#objvaranadetespmayor").css("display", "block");
       			break;
       		case "3":
       			$("#varanadetespmayor").val("");
       			$("#lblvaranadetespmayor").css("display", "none");
    			$("#objvaranadetespmayor").css("display", "none");

       			$("#varanatolems").val("");
				$("#varanatolemn").val("");
       			$("#lblvaranatole").css("display", "none");
       			$("#objvaranatole").css("display", "none");

       			$("#lblvaranadetespmenor").css("display", "block");
    			$("#objvaranadetespmenor").css("display", "block");
       			break;
          case "5":
          $("#varanadetespmayor").val("");
          $("#lblvaranadetespmayor").css("display", "none");
          $("#objvaranadetespmayor").css("display", "none");

          $("#varanadetespmenor").val("");
          $("#lblvaranadetespmenor").css("display", "none");
          $("#objvaranadetespmenor").css("display", "none");

            $("#lblvaranatole").css("display", "block");
            $("#objvaranatole").css("display", "block");
            break;
    		default:
    			$("#varanadetespmayor").val("");
       			$("#lblvaranadetespmayor").css("display", "none");
    			$("#objvaranadetespmayor").css("display", "none");

    			$("#varanadetespmenor").val("");
    			$("#lblvaranadetespmenor").css("display", "none");
    			$("#objvaranadetespmenor").css("display", "none");

    			$("#varanatolems").val("");
				$("#varanatolemn").val("");
       			$("#lblvaranatole").css("display", "none");
       			$("#objvaranatole").css("display", "none");
       	}


	});

});