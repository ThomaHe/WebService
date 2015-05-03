<?php

class Fiche
{
	public function execute($id)
	{
		include_once('modele/Model.php');
		$model = new Model('Pathologies');
		$table = $model->getPathoById($id);

		//var_dump($table);
	
	//création d'un nouveau document
		$xml = new DOMDocument( "1.0", "UTF-8" );
		
	//Indentation
		$xml->preserveWhiteSpace = false;
		$xml->formatOutput = true;

	//Ajout doctype
	 	$xml->schemaValidate("schema_pathos.xsd");
		/*$xml->appendChild($doctype); */
		
	//Lien vers le XSL
		$xslt = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="patho.xsl"');
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
		$xml->save('patho'.$id.'.xml');
		header('Location: ../patho'.$id.'.xml');
		exit();
	}
}