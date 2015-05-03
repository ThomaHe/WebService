<?php
	
	require('vue/header.html');
	require('vue/vueAccueil.html');
	
	
	if (isset($_GET['section']) && $_GET['section'] == 'id'){
		require('controleur/fiche.php');
		$vue = new Fiche();
		$table = $vue->getPathoById($_GET['id']);
		$vue->generateXML($table);
	}
	
	else if (isset($_GET['section']) && $_GET['section'] == 'patho'){
		require('controleur/fiche.php');
		$vue = new Fiche();
		$table = $vue->getPathoByName($_GET['nom']);
		var_dump($table);
		$vue->generateXML($table);
	}
	
	require('vue/footer.html');
