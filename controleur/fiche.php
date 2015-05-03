<?php

class Fiche
{
	public function getPathoById($id)
	{
		include_once('modele/Model.php');
		$model = new Model();
		$table = $model->getPathoById($id);
		return $table;
		//var_dump($table);
	}
	
	public function getPathoByName($name)
	{
		include_once('modele/Model.php');
		$model = new Model();
		$table = $model->getPathoByName($name);
		return $table;
		//var_dump($table);
	}
	
	public function getListePatho(){
		include_once('modele/Model.php');
		$model = new Model();
		$table = $model->getListPatho();
		return $table;
		//var_dump($table);
	}

	public function generateXML($table)
	{
	//création d'un nouveau document
		$xml = new DOMDocument( "1.0", "UTF-8" );
		
	//Indentation
		$xml->preserveWhiteSpace = false;
		$xml->formatOutput = true;

	//Ajout doctype


	 	//$xml->schemaValidate("lib/schema_pathos.xsd");


		/*$xml->appendChild($doctype); */
		
	//Lien vers le XSL
		$xslt = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="lib/patho.xsl"');
		$xml->appendChild($xslt);
		
	//Ajoute des elements 
		//Ajout de l'element racine
		$patho = $xml->createElement('pathologie');
		//Element Description
		$desc = $xml->createElement('description',$table[0]['Description']);
		$patho->appendChild($desc);
		
		$meridien = $xml->createElement('meridien',$table[0]['Meridien']);
		$patho->appendChild($meridien);
		
		$sympts = $xml->createElement('symptomes');
			foreach($table as $sympt){
				$sympt = $xml->createElement('symptome',$sympt['Symptome']);
				$sympts->appendChild($sympt);
			}
		$patho->appendChild($sympts);
		
		$xml->appendChild($patho);
		$xml->save('patho'.$table[0]['idP'].'.xml');
		header('Location: ../patho'.$table[0]['idP'].'.xml');
		exit();
	}
	
	
}