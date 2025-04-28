<!-- Adsum SA (c) 
-Todos los derechos reservados- 
Descripción : Ventana secundaria que contiene un calendario de facil manejo
Autor: Andr�s A. Riascos D. - lfolaya
Fecha: 27072005--> 
<html>
<head>
<title>Calendario</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<SCRIPT language=JavaScript src="calendar.js"		type="text/javascript" ></SCRIPT>
<style type="text/css">
#calendario{
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	text-align: center;
	font-weight: bold;
	margin-left: auto;
	margin-right: auto;
}

/*#mes para configurar aspectos de la caja que muestra el mes y el año*/
#mes{
	font-weight: bold;
	text-align: center;
	color: #FFFFFF;
	background-color: #5961a0;


}
/*.diaS para configurar aspectos de la caja que muestra los días de la semana*/
.diaS{
	color: #ffffff;
	background-color: #D4E1EC;

}
/*.celda para configurar aspectos de la caja que muestra los días del mes*/
.celda {
	background-color: #FFFFFF;
	color: #000000;
	font-weight : normal;
	cursor: default;
}
/*.Hoy para configurar aspectos de la caja que muestra el día actual*/
.Hoy{
	color: #ffffff;
	background-color: #666666;
	font-weight: normal;
	cursor: default;
}
#miCalendario{
	text-align: center;
}
/*.selectores para configurar aspectos de los campos para el mes y el año*/
.selectores{
	font-family: verdana;
	font-size: 11px;
	color: #000000;
	margin-bottom: 2px;
	margin-top: 2px;
}
</style>
</head>
<body onload="tunCalendario(); establecerFecha(); this.focus();">
<p id="miCalendario">  
<select id="tunMes" class="selectores" onchange="mes=this.selectedIndex;borra();tunCalendario()">
    <option value="0" selected>Enero</option>

    <option value="1">Febrero</option>
    <option value="2">Marzo</option>
    <option value="3">Abril</option>
    <option value="4">Mayo</option>
    <option value="5">Junio</option>
    <option value="6">Julio</option>

    <option value="7">Agosto</option>
    <option value="8">Septiembre</option>
    <option value="9">Octubre</option>
    <option value="10">Noviembre</option>
    <option value="11">Diciembre</option>
  </select>

  <input type="text" id="tunAnio" class="selectores" onblur="if(!isNaN(this.value)){anio=this.value;borra();tunCalendario()}" size="4" maxlength="4" />
  <form name="form1" method="post"  enctype="multipart/form-data"> 
  <input type="hidden" name="calencodigo" value="<?php echo $calencodigo;?>">
  </form> 
</p>
</body>
</html>


