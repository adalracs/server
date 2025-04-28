<?php
	if(!$condition)
	{
		include_once( '../src/FunPerSecNiv/fncconn.php');
		include_once('../src/FunGen/fncnumprox.php');
		include_once('../src/FunGen/fncnumact.php');
	}
	
	include ( '../src/FunPerPriNiv/pktblplano.php');
	include ('../src/FunPerPriNiv/pktblmanual.php');
	include ('../src/FunPerPriNiv/pktbldocuequi.php');

	function grabaplano($iRegplano)
	{
		define("id",30);
		$nuconn = fncconn();

		$nuidtemp = fncnumact(	id,$nuconn);
		do
		{
			$nuresult = loadrecordplano($nuidtemp,$nuconn);
			if($nuresult == e_empty)
				$iRegplano[planocodigo] = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);

		$result = insrecordplano($iRegplano,$nuconn);
		fncclose($nuconn);
	}

	function grabamanual($iRegmanual)
	{
		$nuconn = fncconn ();
		define ( "id", 32 );

		$nuidtemp = fncnumact ( id, $nuconn );
		do
		{
			$nuresult = loadrecordmanual ( $nuidtemp, $nuconn );
			if($nuresult == e_empty)
				$iRegmanual [manualcodigo] = $nuidtemp;
			$nuidtemp ++;
		} while ( $nuresult != e_empty );

		$result = insrecordmanual ( $iRegmanual, $nuconn );
		fncclose ( $nuconn );
	}

	function grabadocuequi($iRegdocuequi)
	{
		$nuconn = fncconn();
		define("id",31);

		$nuidtemp = fncnumact(	id,$nuconn);
		do
		{
			$nuresult = loadrecorddocuequi($nuidtemp,$nuconn);
			if($nuresult == e_empty)
				$iRegdocuequi[docequcodigo] = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);

		$result = insrecorddocuequi($iRegdocuequi,$nuconn);
		fncclose($nuconn);
	}
