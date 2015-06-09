<?php

/**
 * SecteurEtabsco filter form.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SecteurEtabscoFormFilter extends BaseSecteurEtabscoFormFilter
{
  public function configure()
  {
          $query =  Doctrine_Core::getTable('secteur')
	      ->createQuery('a')
		  ->orderBy('a.libellesecteur');
		 

        $this->widgetSchema['secteur_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Secteur',
                    'query' => $query,
                    'add_empty' => 'Choisissez...',
                ));
				
		       $this->widgetSchema['typeetablissement_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' =>'Typeetablissement', 'add_empty' => 'Faites votre choix :'));

        $this->widgetSchema['etabsco_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => $this->getRelatedModelName('Etabsco'), 'add_empty' => 'Faites votre choix :'
	));
        // et son validateur
        $this->validatorSchema['etabsco_id'] = new sfValidatorDoctrineChoice(array(
                    'required' => false,
                    'model' => $this->getRelatedModelName('Etabsco'),
                    'column' => 'id',
                ));

        // et son validateur
        $this->validatorSchema['secteur_id'] = new sfValidatorDoctrineChoice(array(
                    'required' => false,
                    'model' => $this->getRelatedModelName('Secteur'),
                    'column' => 'id',
                ));
				
	 }

  
   public function addTypeetablissementIdColumnQuery(Doctrine_Query $q, $field,$value)
  {
   // if($value) //je cherche à trouver les admins
   // {
      $a = $q->getRootAlias();
	    $q->innerJoin($a . '.Etabsco e ')
        ->innerJoin('e.Typeetablissement t')
        ->Where('t.id LIKE ?',$value);
  //  }

    return $q;
  }

  
   public function getFields()
  {
 
  $fields = parent::getFields();
  //the right 'virtual_column_name' is the method to filter
  $fields['typeetablissement_id'] = 'typeetablissement_id';
  return $fields;

  }
}
