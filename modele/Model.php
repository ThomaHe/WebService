<?php

	include_once('lib/PDO1.php');
	class Model{
	    private $table;

	    // identifiant de connexion
	    protected $bdd;

	    public function __construct($table)
	    {
			$this->table = $table;
			$this->bdd = PDO1::getInstance();
	    }
	    
	    public function getBdd(){
			return $this->bdd;
	    }
	    
		public function getPathoById($id){
			 $donnees = '';
			try {
				$bdd = $this->bdd;
				$query= 'SELECT p.idP, p.desc as Description,
						p.type as Type,
						m.nom as Meridien,
						m.element as Element,
						s.desc as Symptome
						FROM patho p
						JOIN meridien m ON p.mer = m.code
						JOIN symptPatho sp ON p.idP = sp.idP
						JOIN symptome s ON s.idS = sp.idS
						WHERE p.idP = :id
						group by p.desc,s.desc;';
				$prep = $bdd->prepare($query);
				$prep->bindParam(':id',$id);
				$prep->execute();
				$donnees = $prep->fetchAll(PDO::FETCH_ASSOC);
				$prep->closeCursor();
				$prep = NULL;

			} catch(PDOException $ex) {
				echo 'An Error occured!'.$ex->getMessage(); //user friendly message
			}
			return $donnees;
	    }
		
 
	}	