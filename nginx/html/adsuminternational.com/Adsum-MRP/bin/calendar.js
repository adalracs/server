/* Adsum SA (c) 
-Todos los derechos reservados- 
Descripción : Ventana secundaria que contiene un calendario de facil manejo
Autor: Andr�s A. Riascos D. - lfolaya
Fecha: 27072005*/
var idContenedor = "miCalendario" //id del contenedor donde se insertará el calendario
var idCampofecha = "fechaCalendario" //id para el campo donde se mostrará la fecha
var fSalidaNombreMes = false //true escribe el mes por su nombre; false por su número
var fMesAbreviado = true // abrevia el nombre del mes a sus 3 primeras letras
var separadorFecha = "-" //separador para la fecha de salida
var celda = 90 //anchura en pixels para cada cuadro del calendario
var altoencabezado= 20
var borde = 1 //anchura en pixels para los bordes 
var colorBorde = "#666666" //color de los bordes

/*No tocar nada a partir de aqui */
var hoy = new Date()
var mes = hoy.getMonth()
var dia = 1
var anio = hoy.getFullYear()
var diasSemana = new Array ('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo')
var meses = new Array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre')
var tunIex=navigator.appName=="Microsoft Internet Explorer"?true:false;
if(tunIex && navigator.userAgent.indexOf('Opera')>=0){tunIex = false}
tunOp = navigator.userAgent.indexOf('Opera')>=0 ? true: false;
var tunSel = false
function tunCalendario()
{
	dia2 = dia
	var anCa = celda * 7
	anCa += borde * 6
	if(tunIex || tunOp){anCa +=2}
	tab = document.createElement('div')
	tab.id = 'calendario'
	tab.style.width = anCa + "px"
	tab.style.padding = "1px"
	tab.style.backgroundColor = colorBorde
	document.getElementById(idContenedor).appendChild(tab)
	fCalendario = document.createElement('input')
	fCalendario.type = "hidden"
	fCalendario.className = "selectores"
	fCalendario.id = idCampofecha
	fCalendario.name = idCampofecha
	fCalendario.onfocus = function(){this.blur()}
	document.getElementById(idContenedor).appendChild(fCalendario)
	fi2 = document.createElement('div')
	fi2.id = 'mes'
	fi2.style.clear = "both"
	fi2.style.height = altoencabezado + "px"
	fi2.style.marginBottom = borde + "px"
	fi2.appendChild(document.createTextNode(meses[mes] + "  -  " + anio))
	fi = document.createElement('div')
	fi.appendChild(fi2)
	fi.className = 'fila'
	fi.style.clear = "both"
	tab.appendChild(fi)
	fi.style.height = altoencabezado + "px"
	fi.style.marginBottom = borde + "px"
	for(m=0;m<7;m++){
		ce = document.createElement('div')
		ce.style.width = celda + "px"
		ce.style.height = altoencabezado + "px"
		ce.style.marginRight = borde + "px"
		ce.className = "diaS"
		tunIex ? ce.style.styleFloat = "left" : ce.style.cssFloat ="left"
		ce.appendChild(document.createTextNode(diasSemana[m]))
		fi.appendChild(ce)
		if(m == 6){ce.style.marginRight = 0}
	}
	var escribe = false
	var escribe2 = true
	fecha = new Date(anio,mes,dia)
	var d = fecha.getDay()-1
	if(d<0){d = 6}
	while(escribe2){
		fi = document.createElement('div')
		fi.className = 'fila'
		fi.style.clear = "both"
		fi.style.marginBottom = borde + "px"
		fi.style.height = celda + "px"
		co = 0
		for(t=0;t<7;t++){
			ce = document.createElement('div')
			ce.style.width = celda + "px"
			ce.style.height = celda + "px"
			ce.style.marginRight = borde + "px"
			ce.style.position = "relative"
			if(escribe && escribe2){
				fecha2 = new Date(anio,mes,dia)
				if(fecha2.getMonth() != mes){escribe2 = false;}
				else{
					ce.appendChild(document.createTextNode(dia));
					dia++;
					co++;
					ce.onclick = marcaCalendario
				}
			}
			if(d == t && !escribe){
				ce.appendChild(document.createTextNode(dia))
				dia++;co++
				escribe = true
				ce.onclick = marcaCalendario
			}
			fi.appendChild(ce)
			if(hoy.getDate()+1 == dia && mes == hoy.getMonth() && anio == hoy.getFullYear()){ce.className = "Hoy"}
			else{ce.className = 'celda'}
			tunIex ? ce.style.styleFloat = "left" : ce.style.cssFloat ="left"
			if(t == 6){ce.style.marginRight = 0}
		}

		if(co>0){tab.appendChild(fi)}

	}
	dia = dia2
}
function marcaCalendario(){
	salidaMes = mes +1
	if(salidaMes < 10){
		salidaMes = "0"+salidaMes}
	if(fSalidaNombreMes){
		salidaMes = meses[mes]
		if(fMesAbreviado){
			salidaMes = salidaMes.substring(0,3)
		}
	}
	if(this.firstChild.nodeValue < 10){
		var diasel = "0"+this.firstChild.nodeValue}
		else
			var diasel = this.firstChild.nodeValue
	document.getElementById(idCampofecha).value = anio + separadorFecha + salidaMes + separadorFecha + diasel
	var strval = document.form1.calencodigo.value;
	window.opener.document.form1.elements[strval].value = document.getElementById(idCampofecha).value;
	window.close();

	ceSe = document.createElement('div')
	ceSe.id = "tunSeleccionado"
	with(ceSe.style){
		borderWidth = "1px"
		borderStyle = "solid"
		borderColor = "#ff0000"
		width = celda -2 + "px"
		height = celda -2 + "px"
		position = "absolute"
		left = 0
		top = 0
		zIndex = "200"
	}
	if(tunSel){
		tunSel.removeChild(tunSel.firstChild.nextSibling)
	}
	tunSel = this
	this.appendChild(ceSe)
}

function borra()
{
	document.getElementById(idContenedor).removeChild(document.getElementById('calendario'))
	document.getElementById(idContenedor).removeChild(document.getElementById(idCampofecha))
}
function establecerFecha()
{
	tunFe = new Date()
	document.getElementById('tunMes').options[tunFe.getMonth()].selected = true
	document.getElementById('tunAnio').value = tunFe.getFullYear()
}