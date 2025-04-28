<html>
<link rel="stylesheet" href="style.css" type="text/css">

<body bgcolor="#FFFFFF">
<h1>PHP Report class</h1>
<h2>Introdu&ccedil;&atilde;o.</h2>
<p>A classe PHP Report &eacute; utilizada para criar relat&oacute;rios html de 
  um vetor (array) de dados gen&eacute;ricos. Este<br>
  vetor pode conter quaisquer tipos de dados, data, numeros, valores financeiros, 
  etc.. O mais comum &eacute; te-lo como<br>
  um resultado de uma query SQL. Estes veetores n&atilde;o est&atilde;o normalmente 
  prontos para serem mostrados e precisam<br>
  de algum trabalho de formata&ccedil;&atilde;o.<br>
  <br>
  Esta classe &eacute; usada para processar estes dados usando classes para moldes 
  (templates) HTML. <br>
  As classes de moldes suportadas aqui s&atilde;o: PEAR::HTML_Template_IT e a 
  classe moldes do PHPLib <br>
  (A classe PEAR::HTML_Template_PHPLIB ainda n&atilde;o foi testada, <i>it is 
  in my TODO list</i>). </p>
<p>As classes que voc&ecirc; vai precisar dentro do pacote para download s&atilde;o 
<menu> 
  <li> <a href="/report/source.php?script=Report.php">Report.php</a> THE class. 
  <li> <a href="/report/source.php?script=Report_template.php">Report_template.php</a> 
    'Interface' para o PHPLib template original. 
  <li><a href="/report/source.php?script=Report_PHPLIB.php">Report_PHPLIB.php</a> 
    'Interface' para o PEAR::HTML_Template_PHPLIB. <img src="newico.jpg" width="23" height="12"> 
  <li> <a href="/report/source.php?script=Report_IT.php">Report_IT.php</a> 'Interface' 
    para o PEAR::HTML_Template_IT (<img src="newico.jpg" width="23" height="12"> 
    fixed!). 
  <li><a href="/report/source.php?script=Report_Sigma.php">Report_Sigma.php</a> 
    'Interface' para o PEAR::HTML_Template_Sigma (<img src="newico.jpg" width="23" height="12"> 
    mas... ainda n&atilde;o esta ok, com pau <br>
    no processamento de blocos). 
</menu>
<p></p>

  
<p>al&eacute;m de suporte a PEAR instalado no seu servidor.<br>
  <br>
  Estas classes, a documenta&ccedil;&atilde;o e alguns exemplos est&atilde;o aqui 
  no 'tarball' para <a href="report.tar.gz">download</a>.</p>

<h2>O que eu fa&ccedil;o com isto?</h2>
<p> Algumas vezes, bem..., sempre:) que voc&ecirc; precisa mostrar um resultado 
  de uma query SQL &eacute; necess&aacute;rio<br>
  trabalhar um pouco antes envia-lo para o usu&aacute;rio. Pense em um carrinho 
  de compras. Voc&ecirc; pode ter que listar os produtos,<br>
  adicionar colunas, calcular o total <i>quantidade</i>*<i>valor unit&aacute;rio</i>, 
  para no final mostrar a p&aacute;gina ao usu&aacute;rio.<br>
  Isto sem que as datas apare&ccedil;am com padr&otilde;es estranhos da base de 
  dados e os n&uacute;meros com 8 casas decimais<br>
  depois da v&iacute;rgula. <br>
  <br>
  Tudo isto &eacute; feito pela classe Report. Voc&ecirc; tem apenas que alimenta-la 
  com o seu array e um molde html,<br>
  fazer uns ajustes, e no final voc&ecirc; tem uma p&aacute;gina com padr&atilde;o 
  profissional para mostrar.<br>
  <br>
  Atualmente &eacute; poss&iacute;vel processar os resultados e:<br>
<menu> 
  <li> ter totais das colunas ao final,
  <li>aplicar opera&ccedil;&otilde;es (f&oacute;rmulas gen&eacute;ricas) em colunas 
    acrescentando o resultado a outra coluna, ou n&atilde;o, 
  <li> aplicar fun&ccedil;&otilde;es predefinidas for voc&ecirc; sobre estas opera&ccedil;oes 
    ou 
  <li>aplicar fun&ccedil;&otilde;es diretamente sobre as colunas ou sobre f&oacute;rmulas. 
</menu>
<p> Estas classes n&atilde;o s&atilde;o codigo alfa, j&aacute; que vem sendo usadas 
  &agrave; quase 2 anos, como base para sistemas de<br>
  gest&atilde;o on-line, e-commerce, e portais que tenho desenvolvido e mantido.<br>
  <br>
  A seguir vou mostrar como come&ccedil;ar a utilizar este pacote para simplificar 
  seu trabalho. 
<h2> Exemplo 0</h2>
<h3>Um exemplo simples</h3>
Este primeiro exemplo esta aqui apenas para ilustrar a caracteristica comum de 
processamento de blocos<br>
herdada das classes de moldes no qual a classe Repor se baseia. N&atilde;o da 
para chamar de relat&oacute;rio ou algo<br>
que o valha ainda. Mas repare que a formata&ccedil;&atilde;o de datas e n&uacute;meros 
j&aacute; foi usada.<br>
<br>
Suponha que sua query SQL te forne&ccedil;a um arranjo parecido com o dado a seguir: 
<pre> 
Ex.: Resultados iniciais:
----------------------------------------------------------------------------------
Store location		Description		Aquisition date 		qtd		unid. price
<?php 
require_once("./examples/array.php");
	foreach ($test as $i => $a) {
	        echo implode("\t\t",$a) . "<br>";
	}
?>
</pre>
<p>See the array <a href="./examples/showarray.php">here</a><br>
  <br>
  N&oacute;s agora queremos processar estes dados e gerar uma p&aacute;gina HTML 
  com a mostrada abaixo:<br>
  <img src="report-example.gif" width="350" height="374"> <font size="2"><br>
  (tirando coment&aacute;rios, o c&oacute;digo usado para isto tem 10 linhas apenas)</font> 
  <br>
  <br>
  Para fazer do arrando de dados acima um relat&oacute;rio, vamos proceder passo 
  a passo.<br>
  Primeiro vamos adicionar alguns titulos.</p>
<p>Abra o seu editor HTML preferido (vi?) e escreva uma pagina como esta ( se 
  for pregui&ccedil;oso(a): copy/paste): </p>
<p> 
<pre>
<?php
$content_array = file("./examples/report0.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>  
<b> O relat&oacute;rio gerado esta<a href="examples/report0.php"> aqui</a>:</b>
<br>
OBS: este &eacute; o arquivo report0.htm no tarball para download.
</pre>
<h2>Exemplo 1</h2>
<h3>Somando algumas colunas</h3>
Agora vamos colocar um t&iacute;tulo no relat&oacute;rio e adicionar colunas para 
vermos alguns totais no final<br>
Para ter um titulo temos que colocar um <b>bloco</b> ao molde html. 
<p> Blocos, como voc&ecirc; pode imaginar da p&aacute;gina acima, s&atilde;o coment&aacute;rios 
  especiais em HTML:<br>
  Este aqui marca o inicio de um bloco:<br>
  <font color="#FF0000"> &lt;!-- BEGIN block_name --&gt</font> 
<p> e este outro marca o final<br>
  <font color="#FF0000"> &lt;!-- END block_name --&gt</font> <br>
  NOTA: n&atilde;o esque&ccedil;a o espa&ccedil;o no inicio e no fim do coment&aacute;rio 
  pois isto pode causar alguns problemas. 
<p> O arquivo de molde HTML fica assim agora: <br>
<pre>
<?php
$content_array = file("./examples/report1.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>

(NOTA: <i>O 'b_' foi adicionado para previnir conflitos entre nomes de blocos<br>e nomes de rotulos (tags) nas classes de moldes. Ele &eacute; um prefixo adicionado por padr&atilde;o pela<br>classe Report a cada um dos blocos, mas voc&ecirc; pode alterar este prefixo se necess&aacute;rio</i>)

</pre>
<b>Usando os mesmo arranjo de resultados como antes nos agora <a href="examples/report1.php">temos 
isto como resultado</a>.</b> 
<p><b>Comment: </b>E se quisermos somar os resultados parciais no final de cada 
  subbloco?<br>
  Para isto n&oacute;s precisamos colocar um &uacute;ltimo block nofinal de nosso 
  relat&oacute;rio para conter o resultado.<br>
  Se n&oacute;s escolhermos o nome deste &uacute;ltimo bloco como usando uma chama 
  ao m&eacute;todo<br>
  $report-&gt;setGranTotalBlock(&quot;bigtotal&quot;), o novo bloco dever&aacute; 
  ser chamado &quot;bigtotal&quot;. As vari&aacute;veis de marca&ccedil;&atilde;o 
  {vars} <br>
  que vc colacar&aacute; dentro deste novo bloco devem ter os mesmos nomes das 
  que vc deseja obter o total. <br>
  O seu modelo deve ficar parecido com este:<br>

<pre>
<?php
$content_array = file("./examples/report1_1.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>
</pre>
<br>
Clique aqui para ver <a href="examples/report1_1.php">o que mudou.</a> 
<h1>Exemplo 2</h1>
<h3>Aplicando f&oacute;rmulas &agrave;s colunas</h3>
Agora come&ccedil;a a divers&atilde;o. Como temos uma coluna <i>qtd</i> e uma 
coluna <i>value</i> n&oacute;s queremos agora saber quanto n&oacute;s obtemos<br>
quando multiplicamos as duas. O que temos que fazer &eacute; aplicar uma f&oacute;rmula 
simples e colocar os resultado em uma nova<br>
coluna que n&atilde;o existe ainda no arranjo original (claro que vc poderia ter 
feito isto na query, mas isto &eacute; um exemplo e simples). <br>
Vamos fazer isto agora e acrescentar um n&iacute;vel a mais de filtragem, separando 
mais uma coluna com subt&iacute;tulo.<br>
<p> Primeiro temos que alterar nosso molde novamente, e acrescentar a nova coluna 
  e o novo bloco.<br>
<pre>
<?php
$content_array = file("./examples/report2.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>
</pre>
Express&otilde;es s&atilde;o formulas matem&aacute;ticas gerais que usam rotulos 
de como em {qtd}*{value}.<br>
Isto &eacute; o que obtemos <b><a href="examples/report2.php"> agora</a>.</b> 
<p> Por enquanto &eacute; s&oacute;, pessoal. 
<p> <a href="report.tar.gz">Download the package</a><br>
  leia os exemplos, distribua, divirta-se, e se resolvi um pepino seu, paga uma 
  pizza :) 
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="rocha@i-node.com.br">
  <input type="hidden" name="item_name" value="PHP Report class">
  <input type="hidden" name="no_note" value="1">
  <input type="hidden" name="currency_code" value="USD">
  <input type="hidden" name="tax" value="0">
  <input type="image" src="https://www.paypal.com/images/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
;). 
<p> Vou continuar atualizando esta p&aacute;gina at&eacute; transformar esta classe 
  no framework php que utilizo atualmente para desenvolvimento.<br>
  Com ele hoje levo 5 minutos para criar uma p&aacute;gina para editar, remover, 
  listar e adicionar registros em uma tabela de base de dados. 
<p>Mas isto &eacute; outra hist&oacute;ria ... ;) 
<p> Autor: Sebastião Rocha Aladim Neto (a.k.a Neto, a.k.a toomuchcoffeman) 
<p> Fique a vontade para contactar-me se tiver d&uacute;vidas ou sugest&otilde;es 
  em : <b>rocha at i-node dot com dot br</b>. 
<h2>Mailing list</h2>
Se deseja se envolver, ajudar no desenvolvimento ou ter not&iacute;cias sobre 
o pacote, inscreva-se na lista, enviando uma mensagem para:<br>
<a href="mailto:phpreport-subscribe@i-node.com.br">phpreport-subscribe@i-node.com.br<br>
</a> 
<h2>Novidades</h2>
<h2></h2>
<ul>
  <li> 5 de setembro 2003 - Suporte e testes para algumas das classes de modelo 
    do <a href="http://pear.php.net">PEAR</a> acrescentados. Funcionando para 
    PHPLIB<br>
    e IT. Ainda com problemas para Sigma. IT n&atilde;o estava funcionando antes, 
    arrumado agora.<br>
  </li>
  <li>29 de agosto 2003 - Um novo exemplo mostrando como adicionar as somas parciais 
    dos subblocos ao final do processamento.</li>
  <li>6 de junho, site inicial traduzido para portugu&ecirc;s, afinal.</li>
  <li>April 26, 2003 - Changed capability to apply a multi argument function to 
    a column. That was working unless you<br>
    use a argument that is already being used as a title, or subtitle. In that 
    case the class was crashing.</li>
  <li>April 6, 2003 - Added some methods to have a gran totals block parsed at 
    the end of the report. No examples yet...</li>
  <li>March 27, 2003 - This site is put on-line </li>
</ul>
</body>
</html>
