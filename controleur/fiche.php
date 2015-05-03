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
	
	public function getPathosByMeridien($meridien)
	{
		include_once('modele/Model.php');
		$model = new Model();
		$table = $model->getPathosByMeridien($meridien);
		//var_dump($table);
		return $table;

	}
	
	public function displayListePatho(){
		include_once('modele/Model.php');
		$model = new Model();
		$table = $model->getListPatho();
		echo '	<table>
					<caption>Liste des pathologies et leur ID</caption>
					<tr>
						<th>ID</th>
						<th>Nom de la pathologie</th>
					</tr>';
		foreach($table as $patho){
			echo "<tr><td>$patho[idP]</td><td>$patho[desc]</td></tr>";
			
		}
		echo '</table>';
		//var_dump($table);
	}

	public function generateXMLMultiples($table,$nom)
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
		$xslt = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="lib/pathologies.xsl"');
		$xml->appendChild($xslt);
		
	//Ajoute des elements 
		$pathos = $xml->createElement('pathologies');
			foreach($table as $tablePatho){
				//Ajout de l'element racine
				$patho = $xml->createElement('pathologie');
				//Element Description
				$desc = $xml->createElement('description',$tablePatho['Description']);
				$patho->appendChild($desc);
				
				$meridien = $xml->createElement('meridien',$tablePatho['Meridien']);
				$patho->appendChild($meridien);
				
				$sympts = $xml->createElement('symptomes');
				
				//var_dump($tablePatho);
				
					foreach($tablePatho['Symptome'] as $cle => $tableSympt){
						$sympt = $xml->createElement('symptome',$tableSympt);
						$sympts->appendChild($sympt);
					}
				$patho->appendChild($sympts);
				$pathos->appendChild($patho);
			}	
			
			$xml->appendChild($pathos);
			
		$xml->save('patho'.$nom.'.xml');
		header('Location: ../patho'.$nom.'.xml');
		exit();
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
		$xslt = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="lib/pathologie.xsl"');
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
			
			//var_dump($tablePatho);
			
				foreach($table as $tableSympt){
					$sympt = $xml->createElement('symptome',$tableSympt['Symptome']);
					$sympts->appendChild($sympt);
				}
			$patho->appendChild($sympts);
			$xml->appendChild($patho);
			
		$xml->save('patho'.$table[0]['idP'].'.xml');
		header('Location: ../patho'.$table[0]['idP'].'.xml');
		exit();
	}
	
}