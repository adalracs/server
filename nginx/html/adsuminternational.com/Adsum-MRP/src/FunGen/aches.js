


function llenaselect(obj,valores){
///limpiamos primero
limpiaselect(obj);
	$H(valores).each(function(t){
		var value	= unescape(t[0]);
		var text	= unescape(t[1]);

		var option	= new Option(text,value);

		try{
			obj.add(option,null);
		}catch (e){
			obj.add(option,-1);
		}
		}) ;
}

function limpiaselect(objDDL,noseleccione){
	objDDL.options.length = 0;
	for(i=objDDL.options.length;i>=0;i--)
    	  objDDL.options[i]=null;
	if (noseleccione!=true){
	var text = unescape('Seleccione');
		var value	= unescape('');
		var option	= new Option(text,value);
		try{
			objDDL.add(option,null);
		}catch (e){
			objDDL.add(option,-1);
		}
	}
}

function filtraselect(filtro, o1n,o2n){
	if (filtro=='') return false;
	var o1 =$(o1n) ;
	var o2 =$(o2n) ;

	limpiaselect(o2,true); //limpia el anterior
	var clase = 'par' ;
	filtro = filtro.toUpperCase();
 	for(i=0;i<o1.options.length ;i++) {
		if (o1.options[i].value!=''){
		var t = o1.options[i].text.toUpperCase();

		 if (  t.include(filtro)==true ){
			var option	= new Option(o1.options[i].text,o1.options[i].value);
			if (clase == 'par' )
			clase = 'impar' ;else clase = 'par' ;
			option.className = clase ;

					try{
						o2.add(option,null);
					}catch (e){
						o2.add(option,-1);
					}
		}
		}
	}
}

function filtradorselect(nselector){

	var selector  = $(nselector) ;
	if (!selector) return false ;
	if (selector.type!='select-one') return false  ;
	if ($(selector.id+'_div'))return false ;
	///crear nuevo al lado del original

	var magia = new Template('<div style="background-color:#d0e0f0;border:1px solid white;color:black;" id="'+selector.id+'_div'+'">'+
				'Ingrese texto a buscar: <input AUTOCOMPLETE = "off" type="text" id="#{id}" name="#{name}" size="5" value="" maxlength="15" onkeyup="filtraselect(this.value,\'#{selector1}\',\'#{selector2}\');"/>'+
				'<a href="javascript:;" onclick="$(\''+selector.id+'\').show();$(\''+selector.id+'_div\').remove();">Cancelar</a>'+
				'<br><select id="#{ids}" style="width:350px;" name="#{names}" size=10"></select>'+
				'<div align="right">Doble click o enter para seleccionar </div>'+
				'</div>')

	new Insertion.After(selector, magia.evaluate({id:selector.id+'_2i',name:selector.name+'_2i' ,selector2:selector.name+'_2',selector1:selector.id,
								ids:selector.id+'_2',names:selector.name+'_2' }))
	$(nselector+'_2i').focus();
	new Event.observe(selector.id+'_2','dblclick', function(f){
		Form.Element.setValue(selector,f.target.value) ;
		
		selector.show(); $(selector.id+'_2i').hide(); $(selector.id+'_div').remove(); } );
	new Event.observe(selector.id+'_2','keyup', function(f){
		if (f.keyCode==Event.KEY_RETURN) {
			Form.Element.setValue(selector,f.target.value) ;
		selector.show(); $(selector.id+'_2i').hide(); $(selector.id+'_div').remove();}} );
	selector.hide()  ;
}

function selectavalor(nobj,valor){


}