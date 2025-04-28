<html>
<head>
<title>Nuevo registro de ot</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href = "temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
function MM_openBrWindow(theURL,winName,features)
{ //v2.0
  window.open(theURL,winName,features);
}
</script>
<script language="JavaScript" src="motofech.js"></script>
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarDescripciontarea.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarEmpleaselec.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarTransacherram.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarTransacitem.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/fncbotton.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/fncverificarlider.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunSpec/fncshowspanot.js" type="text/javascript" ></script>
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>
<SCRIPT LANGUAGE="JavaScript">
var arreglo_auxdef = new Array;
var arreglo_ite = new Array;
var arreglo_herr = new Array;
function carga()
{
	for(var i=0; i < document.form1.elements['empleaselec'].length; i++)
	{
		arreglo_auxdef[i] = document.form1.empleaselec[i].value;
	}
	document.form1.arreglo_auxdef.value = arreglo_auxdef;
	for(var j=0; j < document.form1.elements['herramcodigo'].length; j++)
	{
		arreglo_herr[j] = document.form1.herramcodigo[j].value;
	}
	document.form1.arreglo_herr.value = arreglo_herr;
	for(var k=0; k < document.form1.elements['itemcodigo'].length; k++)
	{
		arreglo_ite[k] = document.form1.itemcodigo[k].value;
	}
	document.form1.arreglo_ite.value = arreglo_ite;
}
</script>
<!-- Mas trucos y scripts en http://www.javascript.com.mx -->		  
<style> 
<!-- 
#leftright, #topdown{ 
position:absolute; 
left:0; 
top:0; 
width:1px; 
height:1px; 
layer-background-color:black; 
background-color:white; 
z-index:100; 
font-size:1px; 
} 
--> 
</style> 

</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
  <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">

    <tr>
      <td><SPAN id="spnText_equipo" style="display:none;">
        <INPUT type="text" name="equipocodigo_auto" size="18" value=""/>
        </SPAN><SPAN id="spnText_componen" style="display:none;">
        <INPUT type="text" name="componcodigo_auto" size="18" value=""/>
        </SPAN>
        <p>
          <input type="image" name="imageField" src="../img/planos/plano.jpg">
        <div id="leftright" style="width:expression(document.body.clientWidth-2)"></div>
        <div id="topdown" style="height:expression(document.body.clientHeight-2)"></div>
        <script language="JavaScript1.2"> 
<!-- 

/* 
Document crosshair Script- 
By Dynamic Drive (www.dynamicdrive.com) 
*/ 

if (document.all&&!window.print){ 
leftright.style.width=document.body.clientWidth-2 
topdown.style.height=document.body.clientHeight-2 
} 
else if (document.layers){ 
document.leftright.clip.width=window.innerWidth 
document.leftright.clip.height=1 
document.topdown.clip.width=1 
document.topdown.clip.height=window.innerHeight 
} 
  

function followmouse1(){ 
//move cross engine for IE 4+ 
leftright.style.pixelTop=document.body.scrollTop+event.clientY+1 
topdown.style.pixelTop=document.body.scrollTop 
if (event.clientX<document.body.clientWidth-2) 
topdown.style.pixelLeft=document.body.scrollLeft+event.clientX+1 
else 
topdown.style.pixelLeft=document.body.clientWidth-2 
} 

function followmouse2(e){ 
//move cross engine for NS 4+ 
document.leftright.top=e.y+1 
document.topdown.top=pageYOffset 
document.topdown.left=e.x+1 
} 

if (document.all) 
document.onmousemove=followmouse1 
else if (document.layers){ 
window.captureEvents(Event.MOUSEMOVE) 
window.onmousemove=followmouse2 
} 

function regenerate(){ 
window.location.reload() 
} 
function regenerate2(){ 
setTimeout("window.onresize=regenerate",400) 
} 
if ((document.all&&!window.print)||document.layers) 
//if the user is using IE 4 or NS 4, both NOT IE 5+ 
window.onload=regenerate2 

//--> 
  </script>
        </p></td>
    </tr>

    <tr>
      <td></td>
    </tr>
  </table>
  <?php if($campnomb){ echo '<font face= "Verdana" >Corregir los campos marcados con *</font>';}?>
  <!-- Datos de ot -->
<input type="hidden" name="accionnuevoot">
<input type="hidden" name="ordtracodigo" value="<?php if(!$flagnuevoot){echo $sbreg[ordtracodigo];}else {echo $ordtracodigo;}?>">
<input type="hidden" name="ordtrahorgen" value="<?php $ordtrahorgen= date("H:i"); echo $ordtrahorgen; ?>">
<input type="hidden" name="ordtrafecgen" value="<?php $ordtrafecgen=date("Y-m-d"); echo $ordtrafecgen;?>">
<input type="hidden" name="ordtratipo" value="1">
<input type="hidden" name="ordtrahorini">
<input type="hidden" name="ordtrahorfin">
<input type="hidden" name="otcantid">
<input type="hidden" name="equipotexto">
<input type="hidden" name="componentetexto">

<!-- Datos de usuariotareot -->
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>">
<input type="hidden" name="arreglo_auxdef" value="<?php echo $arreglo_auxdef;?>">

<!-- Datos de herramienta -->
<input type="hidden" name="arreglo_herr" value="<?php echo $arreglo_herr; ?>">
<input type="hidden" name="loadherram" value="<?php $loadherram; ?>">
<input type="hidden" name="flagsoliot" value="<?php echo $flagsoliot; ?>">
<!-- Datos de item -->
<input type="hidden" name="arreglo_ite" value="<?php echo $arreglo_ite; ?>">
<input type="hidden" name="loaditem" value="<?php echo $loaditem; ?>">

<input type="hidden" name="flagsoliotitem" value="<?php echo $flagsoliotitem; ?>">

<!-- 'Disparador' auxiliar usado para cargar los trabajadores de mantenimiento
	 ( Cambio realizado debido a las modificaciones que sufrio el formulario [Radiobuttion/Button] ) -->
<input type="text" name="radio2" style="border:none; color:#FFFFFF;" onFocus="cargarEmpleaselec(document.form1.arreglo_auxdef.value);" size="1">

<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="valor">
<input type="hidden" name="flag">

<input type="hidden" name="otestacodigo1" value= $otestacodigo>
<input type="hidden" name="palntacodigo1" value= $plantacodigo>
<input type="hidden" name="sistemcodigo1" value= $sistemcodigo>
<input type="hidden" name="equipocodigo1" value= $equipocodigo>
<input type="hidden" name="componcodigo1" value= $componcodigo>
<input type="hidden" name="tipmancodigo1" value= $tipmancodigo>
<input type="hidden" name="prioricodigo1" value= $prioricodigo>
<input type="hidden" name="ordtradescri1" value= $ordtradescri>
<input type="hidden" name="ordtrafecini1" value= $ordtrafecini>
<input type="hidden" name="horini1" value= $horini>
<input type="hidden" name="minini1" value= $minini>
<input type="hidden" name="ordtrafecfin1" value= $ordtrafecfin>
<input type="hidden" name="horfin1" value= $horfin>
<input type="hidden" name="minfin1" value= $minfin>
<input type="hidden" name="empleacod1" value= $empleacod>
<input type="hidden" name="empleanomb1" value= $empleanomb>
<input type="hidden" name="empleaselect1" value= $empleaselect>
<input type="hidden" name="tiptracodigo1" value= $tiptracodigo>
<input type="hidden" name="tipfalcodigo1" value= $tipfalcodigo>
<input type="hidden" name="tareacodigo1" value= $tareacodigo>
<input type="hidden" name="tareaotnota1" value= $tareaotnota>
<input type="hidden" name="herramcodigo2" value= $herramcodigo>
<input type="hidden" name="codigoot" value= $codigoot>
</form>
</body>
</html>