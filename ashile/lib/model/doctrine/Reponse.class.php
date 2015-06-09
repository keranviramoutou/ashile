<?php

/**
 * Reponse
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Reponse extends BaseReponse
{
	public function __toString()
	{
		return $this->getNumReponse(). ' - '.$this->getReponse().' '.$this->getLibelleReponse();
		//return $this->decryptReponse($this->getReponse());

	}
	
	public function decryptReponse($reponse){
		// les données sont cryptées sur la base de données, on les décrypte
		$encryption_key = '123456';
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $encryption_key, base64_decode($reponse), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	}	

	
/*	// on surcharge la methode save pour crypter les données enregistrées
	 public function save(Doctrine_Connection $conn = null) {
		// on crypte le champ reponse
		$data = $this->getReponse();
		// -- creation d'une clef unique et temporaire (une par / an)
		
		try {
				$options = Array (
					'encryption_key' => '123456',
					'data_to_encrypt' => $data
				);
		
			$e = new AES($options);
			$enc = $e->encrypt();
			//$dec = $e->decrypt();
			
			$this->setReponse($enc);
			//echo "The encrypted Base64/AES string is:  ".$enc."<br />The decrypted Base64/AES string is:  ".$dec;
		
		}catch(Exception $e){
			 return $e->getMessage();
		}
		parent::save($conn);
    } */
}
