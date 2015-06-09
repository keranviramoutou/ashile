<?php

/**
 * Mdph form.
 *
 * @package    ashile
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MdphForm extends BaseMdphForm
{

    public function configure()
    {
        // ici on définit le format des champs de type date => on utilise un calendrier 'JQuery'
     /*   
        $this->widgetSchema['datecreationpps'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
        //date par default aujourd'hui
        $this->widgetSchema['datecreationpps']->setDefault(date('d-m-Y'));
         
        $this->widgetSchema['dateenvoiedossier'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
         
        $this->widgetSchema['dateess'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));

        $this->widgetSchema['datepjdom'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));

        $this->widgetSchema['datpjident'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
*/

	// ---test date
		$this->widgetSchema['datecreationpps'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['datecreationpps'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
                     
		$this->widgetSchema['dateenvoiedossier'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['dateenvoiedossier'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
                     
        $this->widgetSchema['dateess'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['dateess'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
        
        $this->widgetSchema['datepjdom'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['datepjdom'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));                     

        $this->widgetSchema['datepjident'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['datepjident'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
					 
					 
	 $this->widgetSchema['datebilanmedical'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['datebilanmedical'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
                     
         // on commence par declarer les champs du formulaire
        $this->widgetSchema->setLabels(array(
            'numeropps' => 'Numero dossier Pps :',
            'datecreationpps' => 'Dossier créé :',
            'dateenvoiedossier' => 'Dossier envoyé le :',
            'dateess' => 'Dossier ESS :',
            'datepjdom' => 'Date de reception PJ domicile :',
            'datepjident' => 'Date de reception PJ identite :',
        ));

        // on redéfinit  eleve_id     
        $this->setWidget('eleve_id', new sfWidgetFormInputHidden());
        $this->setValidator('eleve_id', new sfValidatorString());

        //controle que date decision cda aprés date creation dossier si date decision cda saisi

        //  $this->validatorSchema->setPostValidator(new sfValidatorDateControlAvecNull());

         // controle des dates  fG 30-09-2012
         //----------------------------------

              $this->validatorSchema->setPostValidator(new sfValidatorOr(array(
                new sfValidatorSchemaCompare ('datecreationpps', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'dateenvoiedossier',
                array('throw_global_error' => true),
                array('invalid' => 'La date de debut d\'attribution ("%left_field%") doit etre inferieure  à la date fin d\'attribution("%right_field%")')
                ),
                new sfValidatorSchemaCompare('dateenvoiedossier', '==', ''),
                )));

         
 
   //  $this->getUser()->setFlash('succes', 'Enregistré avec sduccés');

  /*      $newPiecesDossier = new PiecesDossier();
        $newPiecesDossier->setMdph($this->object);
        $newPiecesDossierForm = new PiecesDossierForm($newPiecesDossier);
        $this->embedForm('newPiecesDossier', $newPiecesDossierForm);

        $this->embedRelation('PiecesDossiers');
    }

    protected function doBind(array $values)
    {
        if ('' === trim($values['newPiecesDossier']['libellepiece'])) {
            unset($values['newPiecesDossier'], $this['newPiecesDossier']);
        }

        if (isset($values['PiecesDossiers'])) {
            foreach ($values['PiecesDossiers'] as $key => $piecesDossier) {
                if (isset($piecesDossier['delete']) && $piecesDossier['id']) {
                    $this->numbersToDelete[$key] = $piecesDossier['id'];
                }
            }
        }
        parent::doBind($values);
    }

    protected function doUpdateObject($values)
    {
        if (count($this->numbersToDelete)) {
            foreach ($this->numbersToDelete as $index => $id) {
                unset($values['PiecesDossiers'][$index]);
                unset($this->object['PiecesDossiers'][$index]);
                PiecesDossierTable::getInstance()->findOneById($id)->delete();
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
    } */
}
}
