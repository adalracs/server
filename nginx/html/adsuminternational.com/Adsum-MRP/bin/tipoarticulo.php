<?php
session_start();
if($HTTP_GET_VARS[entorncodigo])
{
	$entorncodigo = $HTTP_GET_VARS[entorncodigo];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML lang=EN>
<HEAD><TITLE>www.tiendaofertas.com</TITLE>

<SCRIPT language=JavaScript src="js/global_functions.js" type=text/javascript></SCRIPT>
<SCRIPT language=javascript src="js/global_css.js"></SCRIPT>
<SCRIPT language=javascript src="js/div_properties.js"></SCRIPT>
<SCRIPT language=JavaScript src="js/DHTML_Menus.js" type=text/javascript></SCRIPT>
<LINK href="css/DHTML_Menus_TiendaOferta.css" type=text/css rel=STYLESHEET>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META 
content="CLICK HERE to save on 3D &amp; Animation. At PC Mall, you will find all of the latest 3D &amp;
Animation along with other Software at extremely competetive prices. Compare 3D &amp; Animation pricing at
 PC Mall and save!" name=description>
<META content="3D &amp; Animation, Software" name=keywords>

<LINK href="imagenes/favicon.ico" rel="shortcut icon">
<STYLE>

BODY {
	BORDER-RIGHT: 0px; 
	PADDING-RIGHT: 0px; 
	BORDER-TOP: 0px; 
	PADDING-LEFT: 0px; 
	BACKGROUND: #ffffff; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 0px; 
	BORDER-LEFT: 0px; 
	PADDING-TOP: 0px; 
	BORDER-BOTTOM: 0px; 
	TEXT-ALIGN: center
}
.displayOn {
	
}
.displayOff {
	DISPLAY: none
}
HR {
	BORDER-RIGHT: #ffffff 1px solid; 
	BORDER-TOP: #ffffff 1px solid; 
	FILTER: progid:DXImageTransform.Microsoft.Shadow(direction=180,color=#cbcbcb,strength=4); 
	BORDER-LEFT: #ffffff 1px solid; 
	WIDTH: 100%; 
	BORDER-BOTTOM: #ababab 1px solid
}
#pcMainHeader {
	PADDING-RIGHT: 0px; 
	PADDING-LEFT: 0px; 
	BACKGROUND: #ffffff; 
	PADDING-BOTTOM: 4px; 
	WIDTH: 750px; 
	PADDING-TOP: 4px; 
	HEIGHT: 72px
}
#pcMainHeader #pcMainSearch {
	BORDER-RIGHT: #ababab 1px solid; 
	BORDER-TOP: #ababab 1px solid; 
	BACKGROUND: #f2f2f2; 
	FLOAT: right; 
	FONT: 10px Arial, Helvetica, sans-serif; 
	BORDER-LEFT: #ababab 1px solid; 
	WIDTH: 300px; 
	COLOR: #003464; 
	BORDER-BOTTOM: #ababab 1px solid; 
	HEIGHT: 64px; 
	TEXT-ALIGN: center
}
#pcMainHeader #pcMainSearch UL {
	PADDING-RIGHT: 2px; 
	PADDING-LEFT: 2px; 
	BACKGROUND: #ffffff; 
	PADDING-BOTTOM: 2px; 
	MARGIN: 0px 0px 5px; 
	WIDTH: 296px; 
	PADDING-TOP: 2px; 
	BORDER-BOTTOM: #ababab 1px solid; 
	LIST-STYLE-TYPE: none; 
	HEIGHT: 20px
}
#pcMainHeader #pcMainSearch LI {
	PADDING-RIGHT: 3px; 
	PADDING-LEFT: 3px; 
	FLOAT: left; 
	PADDING-BOTTOM: 2px; 
	PADDING-TOP: 2px
}
#pcMainHeader #pcMainSearch A {
	FLOAT: left; 
	COLOR: #003464; 
	TEXT-DECORATION: none
}
#pcMainHeader #pcMainSearch A {
	FLOAT: none
}
#pcMainHeader #pcMainSearch LI A:hover {
	BACKGROUND: #f2f2f2
}
#pcMainHeader #pcMainSearch P A:hover {
	BACKGROUND: #ffffff
}
#pcMainHeader FORM {
	PADDING-RIGHT: 0px; 
	PADDING-LEFT: 0px; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 0px; 
	VERTICAL-ALIGN: middle; 
	WIDTH: 100%; 
	PADDING-TOP: 0px
}
#pcMainHeader INPUT {
	BORDER-RIGHT: #003464 1px solid; 
	PADDING-RIGHT: 0px; 
	BORDER-TOP: #003464 1px solid; 
	PADDING-LEFT: 0px; 
	BACKGROUND: #ffffff; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 0px; 
	BORDER-LEFT: #003464 1px solid; 
	PADDING-TOP: 0px; 
	BORDER-BOTTOM: #003464 1px solid
}
#pcMainHeader P {
	PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; MARGIN: 0px; FONT: 10px Arial, Helvetica, sans-serif; WIDTH: 100%; PADDING-TOP: 2px
}
<!--#pcTypeConsumer -->
#pcMainHeaderBar {
	PADDING-RIGHT: 0px; 
	PADDING-LEFT: 0px; 
	BACKGROUND: url(imagenes/bg_headerbar_consumer.gif) #fe0000 repeat-x; 
	PADDING-BOTTOM: 0px; 
	WIDTH: 100%; 
	PADDING-TOP: 0px; 
	BORDER-BOTTOM: #ffffff 2px solid; 
	HEIGHT: 33px
}
#pcTypeBusiness #pcMainHeaderBar {
	PADDING-RIGHT: 0px; 
	PADDING-LEFT: 0px; 
	BACKGROUND: url(imagenes/bg_headerbar_business.gif) #123a7f repeat-x; 
	PADDING-BOTTOM: 0px; 
	WIDTH: 100%; 
	PADDING-TOP: 0px; 
	BORDER-BOTTOM: #ffffff 2px solid; 
	HEIGHT: 33px
}
#pcMainHeaderBar TABLE {
	FONT: bold 12px Arial, Helvetica, sans-serif; 
	COLOR: #ffffff; 
	HEIGHT: 33px
}
#pcMainHeaderBar TD A {
	PADDING-RIGHT: 10px; 
	PADDING-LEFT: 10px; 
	PADDING-BOTTOM: 0px; 
	FONT: bold 12px Arial, Helvetica, sans-serif; 
	COLOR: #094081; 
	PADDING-TOP: 12px; 
	HEIGHT: 33px; 
	TEXT-DECORATION: none
}
<!-- #pcTypeConsumer -->#pcMainHeaderBar #tabs {
	BACKGROUND: url(imagenes/bg_headertabs_consumer.gif) #fe0000 repeat-x
}
<!-- #pcTypeConsumer -->#pcMainHeaderBar #selected {
	PADDING-RIGHT: 10px; 
	PADDING-LEFT: 10px; 
	BACKGROUND: url(imagenes/bg_headertabdown_consumer.gif) #fe0000 repeat-x; 
	PADDING-BOTTOM: 0px; 
	FONT: bold 12px Arial, Helvetica, sans-serif; 
	COLOR: #fe0000; 
	PADDING-TOP: 8px; 
	HEIGHT: 33px
}
#pcTypeBusiness #pcMainHeaderBar #tabs {
	BACKGROUND: url(imagenes/bg_headertabs_business.gif) #123a7f repeat-x
}
#pcTypeBusiness #pcMainHeaderBar #selected {
	PADDING-RIGHT: 10px; 
	PADDING-LEFT: 10px; 
	BACKGROUND: url(imagenes/bg_headertabdown_business.gif) #123a7f repeat-x; 
	PADDING-BOTTOM: 0px; 
	FONT: bold 12px Arial, Helvetica, sans-serif; 
	COLOR: #2b2b61; 
	PADDING-TOP: 8px; 
	HEIGHT: 33px
}
#pcTypeConsumer #pcMainHeaderBar #change_homepage {
	FONT-WEIGHT: normal; 
	COLOR: #ffffff; 
	TEXT-ALIGN: right
}
#pcTypeBusiness #pcMainHeaderBar #change_homepage {
	FONT-WEIGHT: normal; 
	COLOR: #a9abdb; 
	TEXT-ALIGN: right
}
#pcTypeConsumer #pcMainHeaderBar #change_homepage A {
	PADDING-RIGHT: 0px; 
	PADDING-LEFT: 0px; 
	PADDING-BOTTOM: 0px; 
	COLOR: #ffffff; 
	PADDING-TOP: 10px
}
#pcTypeBusiness #pcMainHeaderBar #change_homepage A {
	PADDING-RIGHT: 0px; 
	PADDING-LEFT: 0px; 
	PADDING-BOTTOM: 0px; 
	COLOR: #a9abdb; 
	PADDING-TOP: 10px
}
#pcMainHeaderBar A {
	FLOAT: none
}
#pcTypeConsumer #pcMainHeaderBar .noType {
	BACKGROUND: url(imagenes/bg_headerbar_default.gif) #0066ff repeat-x; 
	HEIGHT: 30px
}
#pcMainMenuBar {
	PADDING-RIGHT: 0px; 
	BORDER-TOP: #acb9c2 1px solid; 
	PADDING-LEFT: 0px; 
	BACKGROUND: #2b2b61; 
	PADDING-BOTTOM: 0px; 
	FONT: 12px Arial, Helvetica, sans-serif; 
	WIDTH: 100%; 
	PADDING-TOP: 0px; 
	BORDER-BOTTOM: #2b2b61 1px solid; 
	HEIGHT: 24px
}
#pcMainMenuBar TABLE {
	BORDER-RIGHT: #acb9c2 1px solid; 
	BACKGROUND: #6785a1; 
	WIDTH: 750px; 
	HEIGHT: 24px
}
#pcMainMenuBar A {
	PADDING-RIGHT: 5px; 
	PADDING-LEFT: 5px; 
	PADDING-BOTTOM: 0px; 
	BORDER-LEFT: #acb9c2 1px solid; 
	WIDTH: 100%; 
	COLOR: #ffffff; 
	PADDING-TOP: 4px; 
	HEIGHT: 24px; 
	TEXT-DECORATION: none
}
#pcMainMenuBar A:hover {
	BACKGROUND: #ffffff; 
	COLOR: #6785a1
}
#pcMainChangeHomepage {
	MARGIN-TOP: 12px
}
#pcMainBody {
	MARGIN-TOP: 12px; 
	BACKGROUND: #ffffff; 
	WIDTH: 750px
}
#pcMainBody .topShadow {
	BACKGROUND: url(imagenes/hr_shadow.gif) repeat-x
}
#pcMainBody #promotion {
	BORDER-RIGHT: #ababab 1px solid; 
	PADDING-RIGHT: 10px; 
	BORDER-TOP: #ababab 1px solid; 
	PADDING-LEFT: 10px; 
	BACKGROUND: #ffffff; 
	PADDING-BOTTOM: 10px; 
	BORDER-LEFT: #ababab 1px solid; 
	PADDING-TOP: 10px; 
	BORDER-BOTTOM: #ababab 1px solid; 
	TEXT-ALIGN: center
}
#pcTypeConsumer #pcMainBody #promotion H1 {
	FONT: bold 14px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #fe0000
}
#pcTypeBusiness #pcMainBody #promotion H1 {
	FONT: bold 14px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #123a7f
}
#pcMainBody #promotion H2 {
	BACKGROUND: url(imagenes/hr_shadow.gif) repeat-x; 
	FONT: bold 24px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #6785a1; 
	PADDING-TOP: 15px
}
#pcMainBody #promotion H3 {
	FONT: bold 14px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #094081
}
#pcMainBody #promotion INPUT {
	BORDER-RIGHT: #003464 1px solid; 
	PADDING-RIGHT: 0px; 
	BORDER-TOP: #003464 1px solid; 
	PADDING-LEFT: 0px; 
	BACKGROUND: #ffffff; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 0px; 
	BORDER-LEFT: #003464 1px solid; 
	PADDING-TOP: 0px; 
	BORDER-BOTTOM: #003464 1px solid
}
#pcMainBody #promotion .popBox {
	BORDER-RIGHT: #ff3333 2px outset; 
	PADDING-RIGHT: 2px; 
	BORDER-TOP: #ff3333 2px outset; 
	PADDING-LEFT: 2px; 
	BACKGROUND: #ff0000; 
	PADDING-BOTTOM: 2px; 
	FONT: bold 12px Verdana, Arial, Helvetica, sans-serif; 
	BORDER-LEFT: #ff3333 2px outset; 
	COLOR: #ffffff; 
	PADDING-TOP: 2px; 
	BORDER-BOTTOM: #ff3333 2px outset
}
#pcLeftNav {
	BORDER-RIGHT: #bababa 1px solid; 
	BORDER-TOP: #bababa 1px solid; 
	BACKGROUND: #ffffff; 
	FONT: 12px Verdana, Arial, Helvetica, sans-serif; 
	BORDER-LEFT: #bababa 1px solid; 
	WIDTH: 172px; 
	BORDER-BOTTOM: #bababa 1px solid; 
	TEXT-ALIGN: left
}
#pcLeftNav UL {
	PADDING-RIGHT: 0px; 
	PADDING-LEFT: 0px; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 0px 0px 5px; 
	PADDING-TOP: 0px; 
	LIST-STYLE-TYPE: none
}
#pcTypeConsumer #pcLeftNav LI H1 {
	PADDING-RIGHT: 5px; 
	DISPLAY: block; 
	PADDING-LEFT: 10px; 
	BACKGROUND: #ffffff; 
	PADDING-BOTTOM: 5px; 
	MARGIN: 0px; 
	FONT: bold 11px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #002b6c; 
	PADDING-TOP: 7px
}
#pcTypeBusiness #pcLeftNav LI H1 {
	PADDING-RIGHT: 5px; 
	DISPLAY: block; 
	PADDING-LEFT: 10px; 
	BACKGROUND: #ffffff; 
	PADDING-BOTTOM: 5px; 
	MARGIN: 0px; 
	FONT: bold 11px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #2b2b61; 
	PADDING-TOP: 7px
}
#pcTypeConsumer #pcLeftNav LI H2 {
	PADDING-RIGHT: 10px; 
	PADDING-LEFT: 10px; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 0px; 
	FONT: bold 11px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #002b6c; 
	PADDING-TOP: 0px
}
#pcTypeBusiness #pcLeftNav LI H2 {
	PADDING-RIGHT: 10px; 
	PADDING-LEFT: 10px; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 0px; 
	FONT: bold 11px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #2b2b61; 
	PADDING-TOP: 0px
}
#pcLeftNav LI P {
	PADDING-RIGHT: 10px; 
	PADDING-LEFT: 10px; 
	PADDING-BOTTOM: 5px; 
	MARGIN: 0px; 
	FONT: 10px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #003464; 
	PADDING-TOP: 3px
}
#pcLeftNav LI A {
	FONT: 10px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #003464; 
	TEXT-DECORATION: none
}
#pcLeftNav LI A:hover {
	BACKGROUND: #f2f2f2
}
#pcLeftNav LI INPUT {
	BORDER-RIGHT: #003464 1px solid; 
	BORDER-TOP: #003464 1px solid; 
	BACKGROUND: #ffffff; 
	FONT: 11px Verdana, Arial, Helvetica, sans-serif; 
	BORDER-LEFT: #003464 1px solid; 
	BORDER-BOTTOM: #003464 1px solid
}
#pcLeftNav LI LI A {
	PADDING-RIGHT: 10px; 
	DISPLAY: block; 
	PADDING-LEFT: 10px; 
	BACKGROUND: url(imagenes/bullet_blue_dash.gif) fixed no-repeat left center; 
	PADDING-BOTTOM: 0px; 
	FONT: 11px Verdana, Arial, Helvetica, sans-serif; 
	MARGIN-LEFT: 10px; 
	COLOR: #003464; 
	PADDING-TOP: 3px; 
	TEXT-DECORATION: none
}
#pcLeftNav LI LI A:hover {
	BACKGROUND: url(imagenes/bullet_blue_dash.gif) #f2f2f2 fixed no-repeat left center
}
#pcHeadlines {
	DISPLAY: block; 
	BACKGROUND: #ffffff; 
	FONT: 12px Verdana, Arial, Helvetica, sans-serif; 
	WIDTH: 100%
}
#pcHeadlines UL {
	BORDER-RIGHT: #bababa 1px solid; 
	PADDING-RIGHT: 10px; 
	BORDER-TOP: medium none; 
	PADDING-LEFT: 10px; 
	BACKGROUND: #f2f2f2; 
	PADDING-BOTTOM: 10px; 
	MARGIN: 0px; 
	BORDER-LEFT: #bababa 1px solid; 
	PADDING-TOP: 10px; 
	BORDER-BOTTOM: #bababa 1px solid; 
	LIST-STYLE-TYPE: none; 
	HEIGHT: 220px
}
#pcHeadlines LI {
	PADDING-RIGHT: 5px; 
	PADDING-LEFT: 20px; 
	BACKGROUND: url(imagenes/arrow.gif) fixed no-repeat left center; 
	PADDING-BOTTOM: 5px; 
	MARGIN-LEFT: 5px; 
	PADDING-TOP: 5px
}
#pcHeadlines LI A {
	DISPLAY: block; 
	FONT: 11px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #012a6c; 
	TEXT-DECORATION: none
}
#pcHeadlines LI A:hover {
	BACKGROUND: #ffffff
}
#pcHeadlines A.more {
	PADDING-RIGHT: 2px; 
	PADDING-LEFT: 20px; 
	BACKGROUND: url(imagenes/arrow_2.gif) fixed no-repeat left center; 
	FLOAT: right; 
	PADDING-BOTTOM: 2px; 
	MARGIN: 5px 10px 5px 0px; 
	FONT: 10px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #012a6c; 
	PADDING-TOP: 2px; 
	TEXT-DECORATION: none
}
#pcHeadlines A.more:hover {
	BACKGROUND: url(imagenes/arrow_2.gif) #f2f2f2 fixed no-repeat left center
}
#pcMainFooter {
	BORDER-RIGHT: #ababab 1px solid; 
	PADDING-RIGHT: 0px; 
	BORDER-TOP: #ababab 1px solid; 
	MARGIN-TOP: 12px; 
	PADDING-LEFT: 0px; 
	BACKGROUND: #ffffff; 
	MARGIN-BOTTOM: 12px; 
	PADDING-BOTTOM: 0px; 
	FONT: 11px Verdana, Arial, Helvetica, sans-serif; 
	BORDER-LEFT: #ababab 1px solid; 
	WIDTH: 750px; 
	COLOR: #003464; 
	PADDING-TOP: 0px; 
	BORDER-BOTTOM: #ababab 1px solid; 
	HEIGHT: 132px; 
	TEXT-ALIGN: center
}
#pcMainFooter UL {
	PADDING-RIGHT: 2px; 
	PADDING-LEFT: 2px; 
	PADDING-BOTTOM: 2px; 
	MARGIN: 25px; 
	WIDTH: 625px; 
	PADDING-TOP: 2px; 
	LIST-STYLE-TYPE: none
}
#pcMainFooter LI {
	PADDING-RIGHT: 5px; 
	PADDING-LEFT: 5px; 
	FLOAT: left; 
	PADDING-BOTTOM: 2px; 
	PADDING-TOP: 2px
}
#pcMainFooter A {
	FLOAT: left; 
	COLOR: #003464; 
	TEXT-DECORATION: none
}
#pcMainFooter A {
	FLOAT: none
}
#pcMainFooter A:hover {
	BACKGROUND: #f2f2f2
}
#pcMainFooter P {
	PADDING-RIGHT: 0px; 
	PADDING-LEFT: 0px; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 20px; 
	FONT: 11px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #003464; 
	PADDING-TOP: 0px
}
#pcSplash {
	BACKGROUND: url(imagenes/bg_splash_wp.gif) #123a7f repeat-y center center
}
#pcSplash A {
	COLOR: #003464; 
	TEXT-DECORATION: none
}
#pcSplash A:hover {
	BACKGROUND: #f2f2f2
}
#pcSplashMainBody {
	WIDTH: 754px; 
	POSITION: relative; 
	HEIGHT: 100%
}
#pcSplashMainBody TABLE {
	MARGIN-TOP: 25px
}
#pcSplashMainBody #tiendaOfertaPhone {
	PADDING-RIGHT: 0px; 
	PADDING-LEFT: 0px; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 30px 0px 60px; 
	FONT: 24px Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #000e83; 
	PADDING-TOP: 0px
}
#pcSplashFooter P {
	PADDING-RIGHT: 0px; 
	PADDING-LEFT: 0px; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 20px; 
	FONT: 11px/200% Verdana, Arial, Helvetica, sans-serif; 
	COLOR: #003464; 
	PADDING-TOP: 0px
}
</STYLE>
<!-- START OF JDC Data Collector TAG -->
<NOSCRIPT>
	<META content="MSHTML 6.00.2900.2604" name=GENERATOR></HEAD>
	<BODY id=pcTypeConsumer bgColor=#ffffff leftMargin=0 topMargin=0>
	<A href="http://www.clicktracks.com/"><IMG alt="Web Analytics" src="" border=0>asasassas</A>
</NOSCRIPT>
<!-- END OF JDC Data Collector TAG -->
<CENTER><!--  Overture Tracking Start -->
<SCRIPT language=JavaScript>

</SCRIPT>
<!--  Overture Tracking End -->
<TABLE height=70 cellSpacing=0 cellPadding=0 width=750 border=0>
  <TBODY>
  <TR>
    <TD width="100%" height=19>
      <DIV id=pcMainHeader><A href="http://www.tiendaofertas.com/" target=_self><IMG 
      style="FLOAT: left" height=64 
      alt="tiendaofertas | Proveedor de soluciones de tecnolog&iacute;a" 
      src="../../img/tiendaofertas.gif" width=160 border=0> 
      </A><SPAN id=pcHeaderBanner style="FLOAT: left; WIDTH: 270px">
      <CENTER>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          
          <TD>
            <DIV align=left></DIV></TD></TR></TBODY></TABLE></CENTER></SPAN>
      <DIV id=pcMainSearch>
      <UL align="left">
        <LI><A href="index.php" target=_self>Home</A> </LI>
        <LI>| </LI>
        <LI><A 
        href="carroCompra.php" 
        target=_self>Ver carro</A> </LI>
        <LI>| </LI>
        <LI><A href="index.php" 
        target=_self>Estado de orden</A> </LI>
        <LI>| </LI>
        <LI><A href="micuenta1.php" 
        target=_self>Mi cuenta</A> </LI>
        <LI>| </LI>
        <LI><A 
        href="login.php" 
        target=_self>Login</A> </LI></UL>
    
	      Buscar: 
	      <INPUT class=searchforms id=newsearch size=15 name=search>
	      <INPUT class=searchforms id=submit1 type=submit value=Buscar name=submit1> 
	      <INPUT id=NavID_Search type=hidden value=false name=NavID_Search> 
	      <INPUT id=CurDSN type=hidden value=simple name=CurDSN>
	      <INPUT id=calledfrom type=hidden value=1 name=calledfrom>
	      <INPUT id=incimage type=hidden value=on name=incimage>
      </FORM>
      <P>
     
      </DIV>
      </DIV>
      </TD></TR></TBODY></TABLE>
 <DIV id=pcMainHeaderBar>
  <TABLE height=0 cellSpacing=0 cellPadding=0 width=100% border=0>
   <TBODY>
  <TR>
    <TD align="center" background="ffffff">
      <TABLE id=pcHeaderTabs height=0 cellSpacing=0 cellPadding=0 border=0 >
        <TBODY>
		<TR>
			<TD id="selected">Productos</TD>
			<TD id="tabs"><IMG height=33 
			src="imagenes/bg_headertabs_consumer_r2_c2.gif" width=20></TD>
			<TD id="tabs"><A id=menumarca onmouseover=DelayShow(this); 
			onmouseout= DelayHide(this); 
			href='#' 
			name=menumarca>Marca</A></TD>
			<TD id="tabs"><IMG height=33 
			src="imagenes/bg_headertabs_consumer_r2_c4.gif" width=17></TD>
<?php 
include ("db/include.lib.php");
include ('../../src/FunPerPriNiv/pktblentorno.php');
include ('../../src/FunPerSecNiv/fncnumreg.php');
include ('../../src/FunPerSecNiv/fncfetch.php');

$cx = new conexion;
$cx->conectar();
$cx->sql = "select * from linea where estadocodigo = 1 and entorncodigo = 1";
$cx->consultar();
$rtasql1 = $cx->rtasql;
$num = $cx->numRegistros();
//echo "<br>num ".$num;
//$num = 4;
for($i=0;$i<$num;$i++)
{
	$sbRegLinea = $cx->fncfetch($i);
	echo '<TD id="tabs"><A id=menu'.$sbRegLinea[lineacodigo].'
	onmouseover=DelayShow(this); onmouseout= DelayHide(this);
	href="linea.php?lineacodigo='.$sbRegLinea[lineacodigo].'" 
	name=menu'.$sbRegLinea[lineacodigo].' target=_self>'.$sbRegLinea[lineanombre].'</A><!--</TD>-->';
	
	if($i==($num-1))
	{
		echo '<TD id="tabs"><IMG height=33 
            src="imagenes/bg_headertabs_consumer_r2_c8.gif" 
        width=17></TD>';
	}
	else
	{
		echo '
          <TD id="tabs"><IMG height=33 
            src="imagenes/bg_headertabs_consumer_r2_c4.gif" width=17></TD>';
	}
}
 ?>
<!--        <TR>
          <TD id="selected">Home / Small Office</TD>
          <TD id="tabs"><IMG height=33 
            src="imagenes/bg_headertabs_consumer_r2_c2.gif" width=20></TD>
          <TD id="tabs"><A 
            href="#" 
            target=_self>Business</A></TD>
          <TD id="tabs"><IMG height=33 
            src="imagenes/bg_headertabs_consumer_r2_c4.gif" width=17></TD>
          <TD id="tabs"><A href="#" target=_self>PC Mall 
            Gov</A></TD>
          <TD id="tabs"><IMG height=33 
            src="imagenes/bg_headertabs_consumer_r2_c4.gif" width=17></TD>
          <TD id="tabs"><A href="#" 
            target=_self>MacMall</A></TD>
          <TD id="tabs"><IMG height=33 
            src="imagenes/bg_headertabs_consumer_r2_c4.gif" width=17></TD>
          <TD id="tabs"><A href="#" 
            target=_self>iPod</A></TD>
          <TD id="tabs"><IMG height=33 
            src="imagenes/bg_headertabs_consumer_r2_c8.gif" 
        width=17></TD></TR>-->
		</TBODY>
		</TR>
	</TABLE>
   </TD>
  </TR>
   </TBODY>
  </TABLE>
</DIV>
<table>
<tr>
<td>

<?php
//Aqui se muestra el submenu de las lineas
//Aqui se muestra el submenu de las marcas
echo '<DIV class=submenuStyle id=submenumarca 
onmouseover="clearSubDelayHide(); window.setTimeout(sShowCmd, 0);" 
onmouseout="subDelayHide("submenumarca");" 
name="submenumarca">
<TABLE cellSpacing=0 cellPadding=0 border=0>
<TBODY>
<TR>
<TD noWrap>';
$cx->sql = "select * from marca where estadocodigo = 1";
$cx->consultar();
for($j=0;$j<$cx->numRegistros();$j++)
{
	$sbRegMarca = $cx->fncfetch($j);
	echo '<DIV><A 
	href="detallarMarca.php?marcacodigo='.$sbRegMarca[marcacodigo].'">'.
	$sbRegMarca[marcanombre].'</A></DIV>';
}
echo '</TD></TR></TBODY></TABLE></DIV>';

for($i=0;$i<$num;$i++)
{
	$cx->rtasql = $rtasql1;
	$sbRegLinea = $cx->fncfetch($i);

	$cx->sql = "select * from tipoarticulo where lineacodigo=".$sbRegLinea[lineacodigo].
	"and estadocodigo = 1";
	$cx->consultar();
	
	echo '<DIV class=submenuStyle id=submenu'.$sbRegLinea[lineacodigo].' 
	onmouseover="clearSubDelayHide(); window.setTimeout(sShowCmd, 0);" 
	onmouseout="subDelayHide("submenu'.$sbRegLinea[lineacodigo].'");" 
	name="submenu'.$sbRegLinea[lineacodigo].'">
	<TABLE id=pcHeadersubmenu cellSpacing=0 cellPadding=0 border=0>
    <TBODY>
    <TR>
    <TD id="tabs">';
	for($j=0;$j<$cx->numRegistros();$j++)
	{
		$sbRegTipoArticulo = $cx->fncfetch($j);
          echo '<DIV id="tabs"><A 
            href="tipoarticulo.php?lineacodigo='.$lineacodigo.'&tipartcodigo='.
          $sbRegTipoArticulo[tipartcodigo].'">'.$sbRegTipoArticulo[tipartnombre].'</A></DIV>';
	}
	echo '</TD></TR></TBODY></TABLE></DIV>';
}
?>
</td></tr></table>
<TABLE height=25 cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR align=middle>
    <TD 
    style="BORDER-RIGHT: #bbbaba 0px solid; PADDING-RIGHT: 3px; BORDER-TOP: #bbbaba 0px solid; PADDING-LEFT: 3px; PADDING-BOTTOM: 3px; BORDER-LEFT: #bbbaba 0px solid; PADDING-TOP: 3px; BORDER-BOTTOM: #bbbaba 0px solid; BACKGROUND-COLOR: #f2f2f2">
      <SCRIPT language=JavaScript>
					function getCookie(name)
					{
					    var dc = document.cookie;
					    var prefix = name + "=";
					    var begin = dc.indexOf("; " + prefix);
					    if (begin == -1)
					    {
					        begin = dc.indexOf(prefix);
					        if (begin != 0) return document.cookie;
					    }
					    else
					    {
					        begin += 2;
					    }
					    var end = document.cookie.indexOf(";", begin);
					    if (end == -1)
					    {
					        end = dc.length;
					    }
					    return unescape(dc.substring(begin + prefix.length, end));
					}
					function getCookie2(name)
					{
					    var sTemp=getCookie(name);
					    var sFirstName = '';					   
											    
					    if((sTemp.indexOf('&firstname=')>0) && (sTemp.indexOf('&email')>0)) 
					    {
							sFirstName= sTemp.substring(sTemp.indexOf('&firstname=')+11,sTemp.indexOf('&email'));		
						}
						
						return sFirstName;			    
					    
					}
					function getCookie3(name)
					{
					    var sTemp=getCookie(name);
					    var sLastName = '';
					    
					     if((sTemp.indexOf('&firstname=')>0) && (sTemp.indexOf('&email')>0)) 
					    {
							sLastName= sTemp.substring(sTemp.indexOf('LastName=')+9,sTemp.indexOf('&MI'));		
						}
						
						return sLastName;			    
					    
					}
						
					// var a = 'Welcome! ';

					 //document.write (a + (getCookie2('sblnAuthenticated')));
					 var sFirstName = (getCookie2('sblnAuthenticated'));
					 var sLastName = (getCookie2('sblnAuthenticated'));

					  if (sFirstName > '0')
					  {  document.writeln(
					                      '<table width=100% border=0 cellspacing=0 cellpadding=1>'
					                    + '<tr align=center><td><font color="#000000" face="Arial, Helvetica, sans-serif">Hello, '
					                    + '<strong>'
					                    + (getCookie2('sblnAuthenticated'))
					                    + ' '
					                    + (getCookie3('sblnAuthenticated'))					                    
					                    + '. '
					                    + '</strong>'
					                     + '<font color="#000000" face="Arial, Helvetica, sans-serif">&#40'
					                    + '<font color="#000000" face="Arial, Helvetica, sans-serif">If you'
					                    + '<font color="#000000" face="Arial, Helvetica, sans-serif">&#39'
					                    + '<font color="#000000" face="Arial, Helvetica, sans-serif">re not '
					                    + (getCookie2('sblnAuthenticated'))
					                    + ' '
					                    + (getCookie3('sblnAuthenticated'))
					                    + '.'
					                                        + '<tr><td height=0><img src="imagenes/spacer.gif" width="1" height="0"></td></tr>'
					                    + '</table>');
					}else{
                    document.writeln(
                      '<table width=100% border=0 cellpadding=1 cellspacing=0><tr  align=center><td><font color="#000000" face="Arial, Helvetica, sans-serif"><strong>Nuevo usuario? </strong></font>'
                    + '<font color="#000000" face="Arial, Helvetica, sans-serif">Haga click aqui para registrarse.</td></tr>'
                    + '<td height=0><img src="imagenes/spacer.gif" width="1" height="0"></td></tr>'
                    + '</table>');
                }
							</SCRIPT>
      </STRONG></FONT></TD></TR></TBODY></TABLE>
<DIV class=displayOff id=pcMainChangeHomepage></DIV>
<SCRIPT language=JavaScript>
			
			document.getElementById("change_homepage").innerHTML = 
				"<a href='javascript: chp_ChangeHomepage();' target='_self'><!--Change Homepage Preference--></a>";
			
			
			function checkCookie() {
				var bikky = document.cookie;
				var name = 'consumertype';
				var index = bikky.indexOf(name + "=");
				if (index == -1) return null;
				index = bikky.indexOf("=", index) + 1; // first character
				var endstr = bikky.indexOf(";", index);
				if (endstr == -1) endstr = bikky.length; // last character
				return unescape(bikky.substring(index, endstr));
			}			
			
			if (checkCookie() == null ) 
			{
				chp_ChangeHomepage();
			}
			
	
		</SCRIPT>


	<!--aqui corte BLOQUE guradado en misdocumentos\tiendaoferta\tipoarticulo.txt-->


<?php 
$cx->sql = "select * from tipoarticulo where tipartcodigo = ".$tipartcodigo;
$cx->consultar();
$num = $cx->numRegistros();
$sbRegTipoArticulo = $cx->fncfetch(0);
?>
          <TD class=wb-lg bgColor=#000000 height=20>&nbsp;&nbsp; Categor&iacute;a - 
          <?php  echo $sbRegTipoArticulo[tipartnombre];?>
           </TD>
        </TR>
        <TR>
          <TD class=blh vAlign=top bgColor=#dddddd>
</TD></TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width=280 border=0>
        <TBODY>
        <TR>
          <TD><IMG height=30 src="imagenes/bestsellers.gif" width=150 
            border=0></TD></TR>
        <TR>
          <TD width=1 bgColor=#cccccc><IMG height=1 
            src="imagenes/spacer.gif" width=1 
      border=0></TD></TR></TBODY></TABLE>
<?php 
//Aqui se muestran los productos mas vendidos
$cx->sql = "select * from tipoarticulo where tipartcodigo = ".$tipartcodigo;
$cx->consultar();
$rtasql = $cx->rtasql;
$num1 = $cx->numRegistros();
if($num1 > 0)
{
	for($i=0;$i<$num1;$i++)
	{
		$cx->rtasql = $rtasql;
		$sbRegTipoArticulo = $cx->fncfetch($i);
		
		$cx->sql = "SELECT articulo.articucodigo, articutitulo, articuprecio, articudescor, marcanombre, 
		imagennombre from oferta, articulo, marca, imagen  where oferta.articucodigo = articulo.articucodigo 
		and oferta.estadocodigo = 1 and tipofecodigo = 6 and articulo.marcacodigo = marca.marcacodigo and 
		imagen.articucodigo = articulo.articucodigo and imagennumero = 3 and tipartcodigo = ".
		$sbRegTipoArticulo[tipartcodigo];
		$cx->consultar();
		
		$num2 = $cx->numRegistros();
		if($num2>0)
		{
			for($j=0;$j<$num2;$j++)
			{
				$sbRegArticulo = $cx->fncfetch($j);
				
				echo '<TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
		        <TBODY>
		        <TR>
		          <TD vAlign=top align=left width=1><A 
		            href="detallarArticulo.php?articucodigo='.$sbRegArticulo[articucodigo].'"><IMG 
		            height=45 onerror=errNoImage(this); 
		            src="../'.$sbRegArticulo[imagennombre].'" width=45 border=0></A></TD>
		          <TD class=blh vAlign=top width="100%"><SPAN 
		            class=blb-med>'.$sbRegArticulo[marcanombre].'</SPAN><BR><A class=bu 
		            href="detallarArticulo.php?articucodigo='.$sbRegArticulo[articucodigo].'" 
		            &>'.$sbRegArticulo[articudescor].'<BR><SPAN 
		            class=rb>A solo $'.$sbRegArticulo[articuprecio].'<BR></SPAN><IMG height=1 
		            src="imagenes/spacer.gif" width=10 border=0><BR><A 
		            href="detallarArticulo.php?articucodigo='.$sbRegArticulo[articucodigo].'"><IMG 
		            height=22 src="imagenes/details_73x22.gif" width=73 
		            align=center border=0></A><BR><BR></TD></TR></TBODY></TABLE>';
			}
		}
	}
}
?>
	</TD>
    <TD width=1 bgColor=#cccccc><IMG height=1 
      src="imagenes/spacer.gif" width=1 border=0></TD>
    <TD vAlign=top width="100%">
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
         <TR>
          <TD width=1 bgColor=#cccccc><IMG height=1 
            src="imagenes/spacer.gif" width=1 border=0></TD></TR>
        <TR>
          <TD vAlign=top align=middle><IMG height=30 onerror=errNoImage(this); 
            src="imagenes/featured_products.gif" width=335></TD></TR>
        <TR>
          <TD width=1 bgColor=#cccccc><IMG height=1 
            src="imagenes/spacer.gif" width=1 border=0></TD></TR>
        <TR>
          <TD width=1><IMG height=5 src="imagenes/spacer.gif" width=1 
            border=0></TD></TR>
        <TR>
          <TD vAlign=top align=middle width="100%">
<?php 
//Aqui se muestran los productos ofrecidos
$cx->sql = "select * from tipoarticulo where tipartcodigo = ".$tipartcodigo;
$cx->consultar();
$rtasql = $cx->rtasql;
$num1 = $cx->numRegistros();
if($num1 > 0)
{
	for($i=0;$i<$num1;$i++)
	{
		$cx->rtasql = $rtasql;
		$sbRegTipoArticulo = $cx->fncfetch($i);
		
		$cx->sql = "SELECT articulo.articucodigo, articutitulo, articuprecio, articudescor, marcanombre, 
		imagennombre from oferta, articulo, marca, imagen  where oferta.articucodigo = articulo.articucodigo 
		and oferta.estadocodigo = 1 and tipofecodigo = 7 and articulo.marcacodigo = marca.marcacodigo and 
		imagen.articucodigo = articulo.articucodigo and imagennumero = 3 and tipartcodigo = ".
		$sbRegTipoArticulo[tipartcodigo];
		$cx->consultar();
		
		$num2 = $cx->numRegistros();
		if($num2>0)
		{
			for($j=0;$j<$num2;$j++)
			{
				$sbRegArticulo = $cx->fncfetch($j);
				
				echo '<TABLE cellSpacing=1 cellPadding=3 width="100%" border=0>
		        <TBODY>
		        <TR>
		          <TD vAlign=top align=left width=1><A 
		            href="detallarArticulo.php?articucodigo='.$sbRegArticulo[articucodigo].'"><IMG 
		            height=45 onerror=errNoImage(this); 
		            src="../'.$sbRegArticulo[imagennombre].'" width=45 border=0></A></TD>
		          <TD class=blh vAlign=top width="100%"><SPAN 
		            class=blb-med>'.$sbRegArticulo[marcanombre].'</SPAN><BR><A class=bu 
		            href="detallarArticulo.php?articucodigo='.$sbRegArticulo[articucodigo].'" 
		            &>'.$sbRegArticulo[articudescor].'<BR><SPAN 
		            class=rb>A solo $'.$sbRegArticulo[articuprecio].'<BR></SPAN><IMG height=1 
		            src="imagenes/spacer.gif" width=10 border=0><BR><A 
		            href="detallarArticulo.php?articucodigo='.$sbRegArticulo[articucodigo].'"><IMG 
		            height=22 src="imagenes/details_73x22.gif" width=73 
		            align=center border=0></A><BR><BR></TD></TR></TBODY></TABLE>';
			}
		}
	}
}
?>
          
<!--</TD></TR></TBODY></TABLE>--> 

<NOSCRIPT>
	<IMG height=1 src="imagenes/button6.gif" width=1 border=0>
	<IMG height=1 src="imagenes/button6.gif" width=1 border=0>
</NOSCRIPT><!-- END OF WEBTRENDS LIVE TAG --></TD></TR></TBODY></TABLE>
<!--Aqui corte segundo bloque  guardado en misdocumentos\tiendaoferta\tipoarticulo.txt-->
<NOSCRIPT><IMG height=1 src="imagenes/njs.gif" width=1 border=0 
name=DCSIMG> 
</NOSCRIPT><!-- END OF SmartSource Data Collector  TAG --></BODY></HTML>