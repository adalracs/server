//
//  jsrsClient.js - javascript remote scripting client include
//  Author:  Brent Ashley [jsrs@megahuge.com]
//  make asynchronous remote calls to server without client page refresh
//  see license.txt for copyright and license information

/*
see history.txt for full history
2.0  26 Jul 2001 - added POST capability for IE/MOZ
*/

// callback pool needs global scope
var jsrsContextPoolSize = 0;
var jsrsContextMaxPool = 100;
var jsrsContextPool = new Array();
var jsrsBrowser = jsrsBrowserSniff();
var jsrsPOST = true;

// constructor for context object
function jsrsContextObj( contextID ){
  
  // properties
  this.id = contextID;
  this.busy = true;
  this.callback = null;
  this.container = contextCreateContainer( contextID );
  // methods
  this.POST = contextPOST;
  this.getPayload = contextGetPayload;
  this.setVisibility = contextSetVisibility;
}

//  method functions are not privately scoped 
//  because Netscape's debugger chokes on private functions
function contextCreateContainer( containerName ){
  // creates hidden container to receive server data 
  var container;
  switch( jsrsBrowser ) {
    case 'NS':
      container = new Layer(100);
      container.name = containerName;
      container.visibility = 'hidden';
      container.clip.width = 100;
      container.clip.height = 100;
      break;
    
    case 'IE':
      document.body.insertAdjacentHTML( "afterBegin", '<span id="SPAN' + containerName + '"></span>' );
      var span = document.all( "SPAN" + containerName );
      var html = '<iframe name="' + containerName + '" src=""></iframe>';
      span.innerHTML = html;
      span.style.display = 'none';
      container = window.frames[ containerName ];
      break;
      
    case 'MOZ':  
      var span = document.createElement('SPAN');
      span.id = "SPAN" + containerName;
      document.body.appendChild( span );
      var iframe = document.createElement('IFRAME');
      iframe.name = containerName;
      span.appendChild( iframe );
      container = iframe;
      break;
    default:
      var span = document.createElement('SPAN');
      span.id = "SPAN" + containerName;
      document.body.appendChild( span );
      var iframe = document.createElement('IFRAME');
      iframe.name = containerName;
      span.appendChild( iframe );
      container = iframe;
      break;
  }
  return container;
}

function contextPOST( rsPage, func, parms ){

  var d = new Date();
  var unique = d.getTime() + '' + Math.floor(1000 * Math.random());
  var doc = (jsrsBrowser == "IE" ) ? this.container.document : this.container.contentDocument;
  doc.open();
  doc.write('<html><body>');
  doc.write('<form name="jsrsForm" method="post" target="" ');
  doc.write(' action="' + rsPage + '?U=' + unique + '">');
  doc.write('<input type="hidden" name="RS_Container" value="' + this.id + '">');

  // func and parms are optional
  if (func != null){
  doc.write('<input type="hidden" name="RS_Function" value="' + func + '">');

    if (parms != null){
      if (typeof(parms) == "string"){
        // single parameter
        doc.write( '<input type="hidden" name="RS_Parameters[]" '
                 + 'value="' + jsrsEscapeQQ(parms) + '">');
      } else {
        // assume parms is array of strings
        for( var i=0; i < parms.length; i++ ){
          doc.write( '<input type="hidden" name="RS_Parameters[]"' + 'value="' + jsrsEscapeQQ(parms[i]) + '">');
        }
      } // parm type
    } // parms
  } // func

  doc.write('</form></body></html>');
  doc.close();
  doc.forms['jsrsForm'].submit();
}

function contextGetPayload(){
  switch( jsrsBrowser ) {
    case 'NS':
      return this.container.document.forms['jsrs_Form'].elements['jsrs_Payload'].value;
    case 'IE':
      return this.container.document.forms['jsrs_Form']['jsrs_Payload'].value;
    case 'MOZ':
      return window.frames[this.container.name].document.forms['jsrs_Form']['jsrs_Payload'].value; 
    default:
        return this.container.document.forms['jsrs_Form'].elements['jsrs_Payload'].value;
  }  
}

function contextSetVisibility( vis ){
  switch( jsrsBrowser ) {
    case 'NS':
      this.container.visibility = (vis)? 'show' : 'hidden';
      break;
    case 'IE':
      document.all("SPAN" + this.id ).style.display = (vis)? '' : 'none';
      break;
    case 'MOZ':
      document.getElementById("SPAN" + this.id).style.visibility = (vis)? '' : 'hidden';
      this.container.width = (vis)? 250 : 0;
      this.container.height = (vis)? 100 : 0;
      break;
    default:
      document.getElementById("SPAN" + this.id).style.visibility = (vis)? '' : 'hidden';
      this.container.width = (vis)? 250 : 0;
      this.container.height = (vis)? 100 : 0;
      break;
  }  
}

// end of context constructor

function jsrsGetContextID(){
  var contextObj;
  for (var i = 1; i <= jsrsContextPoolSize; i++)
  {
    contextObj = jsrsContextPool[ 'jsrs' + i ];
    
    if (!contextObj.busy )
    {
      contextObj.busy = true;      
      return contextObj.id;
    }
  }
  // if we got here, there are no existing free contexts
  if ( jsrsContextPoolSize <= jsrsContextMaxPool ){
    // create new context
    var contextID = "jsrs" + (jsrsContextPoolSize + 1);
    jsrsContextPool[ contextID ] = new jsrsContextObj( contextID );
    jsrsContextPoolSize++;
    return contextID;
  } else {
    alert( "jsrs Error:  context pool full" );
    return null;
  }
}

function jsrsExecute( rspage, callback, func, parms, visibility )
{
  // call a server routine from client code
  // rspage      - href to asp file
  // callback    - function to call on return 
  //               or null if no return needed
  //               (passes returned string to callback)
  // func        - sub or function name  to call
  // parm        - string parameter to function
  //               or array of string parameters if more than one
  // visibility  - optional boolean to make container visible for debugging
  
  // get context
  var contextObj = jsrsContextPool[ jsrsGetContextID() ];
  contextObj.callback = callback;

  var vis = (visibility == null)? false : visibility;
  contextObj.setVisibility( vis );
  contextObj.POST( rspage, func, parms );
  return contextObj.id;
}

function jsrsLoaded( contextID ){
  // get context object and invoke callback
  var contextObj = jsrsContextPool[ contextID ];
  if( contextObj.callback != null){
    contextObj.callback( jsrsUnescape( contextObj.getPayload() ), contextID );
  }
  // clean up and return context to pool
  contextObj.callback = null;
  contextObj.busy = false;
}

function jsrsError( contextID, str ){
  alert( unescape(str) );
  jsrsContextPool[ contextID ].busy = false
}

function jsrsEscapeQQ( thing ){
  return thing.replace(/'"'/g, '\\"');
}

function jsrsUnescape( str ){
  // payload has slashes escaped with whacks
  return str.replace( /\\\//g, "/" );
}

function jsrsBrowserSniff(){
  if (document.layers) return "NS";
  if (document.all) return "IE";
  if (document.getElementById) return "MOZ";
  return "OTHER";
}

/////////////////////////////////////////////////
// user functions

function jsrsArrayFromString( s, delim ){
  // rebuild an array returned from server as string
  // optional delimiter defaults to ~
  var d = (delim == null)? '~' : delim;
  return s.split(d);
}

function jsrsDebugInfo(){
  // use for debugging by attaching to f1 (works with IE)
  // with onHelp = "return jsrsDebugInfo();" in the body tag
  var doc = window.open().document;
  doc.open;
  doc.write( 'Pool Size: ' + jsrsContextPoolSize + '<br><font face="arial" size="2"><b>' );
  for( var i in jsrsContextPool ){
    var contextObj = jsrsContextPool[i];
    doc.write( '<hr>' + contextObj.id + ' : ' + (contextObj.busy ? 'busy' : 'available') + '<br>');
    doc.write( contextObj.container.document.location.pathname + '<br>');
    doc.write( contextObj.container.document.location.search + '<br>');
    doc.write( '<table border="1"><tr><td>' + contextObj.container.document.body.innerHTML + '</td></tr></table>' );
  }
  doc.write('</table>');
  doc.close();
  return false;
}