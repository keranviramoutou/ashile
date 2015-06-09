<?php

/**
 * SecteurEtabsco form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SecteurEtabscoForm extends BaseSecteurEtabscoForm
{
  public function configure()
  {
  
  
        $query = Doctrine::getTable('Secteur');
        $this->widgetSchema['secteur_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Secteur',
                    'query' => $query,
                    'add_empty' => 'Choisissez...',
                ));
        $this->widgetSchema['etabsco_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => $this->getRelatedModelName('Etabsco'), 'add_empty' => 'Faites votre choix :'
	));
        // et son validateur
        $this->validatorSchema['etabsco_id'] = new sfValidatorDoctrineChoice(array(
                    'required' => true,
                    'model' => $this->getRelatedModelName('Etabsco'),
                    'column' => 'id',
                ));

        $this->widgetSchema['secteur_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => $this->getRelatedModelName('Secteur'), 'add_empty' => 'Faites votre choix :'
	));
        // et son validateur
        $this->validatorSchema['secteur_id'] = new sfValidatorDoctrineChoice(array(
                    'required' => true,
                    'model' => $this->getRelatedModelName('Secteur'),
                    'column' => 'id',
                ));
     $this->embedRelation('Etabsco');
	 
  }
}
