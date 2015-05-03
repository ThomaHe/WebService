<?php

/**
 * Classe pour le singleton PDO

 */

class PDO1 extends PDO {

	private static $_instance;
	
/**
*
*    Modifier ces paramètres pour la connexion a la bdd locale     
*/
	public static $host = 'localhost';
	public static $dbname = 'acubd';
	public static $login = 'root';
	public static $pwd = '';

	
	public function __construct( ) {
	
	}
	
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			try {
				self::$_instance = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname.';charset=utf8', self::$login, self::$pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			} catch (PDOException $e) {
				die('Erreur : ' . $e->getMessage());
			}
		} 
		return self::$_instance; 
	}
}
