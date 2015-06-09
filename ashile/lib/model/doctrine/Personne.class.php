<?php

/**
 * Personne
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Labo
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class Personne extends BasePersonne
{

  static public function capitalize($field){  //mettre la chaine en majuscule
  	return strtoupper($field);
  }
  
    static public function format_tel($field){  //formattage numéro de téléphone : 0692 02 02 02
   if (strlen($field) == 10 ){
  	return substr($field,0,4). ' '.substr($field,4,2). ' '.substr($field,6,2).' '.substr($field,8,2);
	}else{
	return $field;
	}
  }
}