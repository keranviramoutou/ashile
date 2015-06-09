<?php

/**
 * Commande form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommandeForm extends BaseCommandeForm
{
  public function configure()
  {
    //$this->widgetSchema['date_commande'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
	$this->widgetSchema['date_commande'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',));
	$this->validatorSchema['date_commande'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));
				 
				     
		if(!$this->isNew()){
		// --------- insertion des detail commande -----------------------------------------
		//---------------------------------------------------------------------------------------
			$newDetailCommande = new DetailCommande();
			$newDetailCommande->setCommande($this->getObject());
			$newDetailCommandeForm = new DetailCommandeForm($newDetailCommande);
			$this->embedForm('newDetailCommande', $newDetailCommandeForm);
			
			$this->embedRelation('DetailCommande');
		}
}}	
/*	
    protected function doBind(array $values)
    {
        if ('' === trim($values['newDetailCommande']['typemateriel'])) {
            unset($values['newDetailCommande'], $this['newDetailCommande']);
        }

        if (isset($values['DetailCommande'])) {
            foreach ($values['DetailCommande'] as $key => $DetailCommande) {
                if (isset($DetailCommande['delete']) && $DetailCommande['id']) {
                    $this->numbersToDelete[$key] = $DetailCommande['id'];
                }
            }
        }
        parent::doBind($values);
    }

    protected function doUpdateObject($values)
    {
        if (count($this->numbersToDelete)) {
            foreach ($this->numbersToDelete as $index => $id) {
                unset($values['DetailCommande'][$index]);
                unset($this->object['DetailCommande'][$index]);
                DetailCommandeTable::getInstance()->findOneById($id)->delete();
            }
        }

        parent::doUpdateObject($values);
    }

    public function saveEmbeddedForms($con = null, $forms = null)
    {
        if (null === $con) {
            $con = $this->getConnection();
        }

        if (null === $forms) {
            $forms = $this->embeddedForms;
        }

        foreach ($forms as $form) {
            if ($form instanceof sfFormObject) {
                if (!in_array($form->getObject()->getId(), $this->numbersToDelete)) {
                    $form->saveEmbeddedForms($con);
                    $form->getObject()->save($con);
                }
            } else {
                $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
            }
        }
    }		
		
        //---------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------				     
    
  }

*/
