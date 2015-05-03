<?php
	
	require('vue/header.html');
	require('vue/vueAccueil.html');
	require('controleur/fiche.php');
	
	$vue = new Fiche();
	
	if (isset($_GET['section']) && $_GET['section'] == 'id'){
		$table = $vue->getPathoById($_GET['id']);
		$vue->generateXML($table);
	}
	
	else if (isset($_GET['section']) && $_GET['section'] == 'patho'){
		$table = $vue->getPathoByName($_GET['nom']);
		//var_dump($table);
		$vue->generateXML($table);
	}
	
	else if (isset($_GET['section']) && $_GET['section'] == 'meridien'){
		$table = $vue->getPathosByMeridien($_GET['meridien']);
		//var_dump($table);
		$vue->generateXML($table);
	}
	
	else{
		$vue->displayListePatho();
	}

	require('vue/footer.html');
