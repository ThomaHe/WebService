<?php
	
	require('vue/header.html');
	require('vue/vueAccueil.html');
	
	if (isset($_GET['section']) && $_GET['section'] == 'fiche'){
		require('controleur/fiche.php');
		$vue = new Fiche();
		$vue->execute($_GET['id']);
	}
	require('vue/footer.html');
