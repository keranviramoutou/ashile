<?php

/**
 * Etabsco form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EtabscoForm extends BaseEtabscoForm
{
  public function configure()
  {
  

					
	$this->widgetSchema['nometabsco'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
   $this->widgetSchema['adresseetabscobat'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
   $this->widgetSchema['adresseetabscorue'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
   $this->widgetSchema['emailetabsco'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
   $this->widgetSchema['rne'] = new sfWidgetFormInputText(array(), array("style"=>'width: 80px;'));
  // $this->widgetSchema['degreetabsco'] = new sfWidgetFormInputText(array(), array("style"=>'width: 20px;'));
$this->setWidget('degreetabsco', new sfWidgetFormChoice(array(
   "expanded" => true,
   'choices' => array('1'=>'1','2'=>'2'),
)));
   
   
      $this->widgetSchema->setLabels(array(

	"typeetablissement_id" 	=>	"Type",
	"degreetabsco"		=>	"Degre (1/2)",
	"adresseetabscobat"	=>	"Adresse (bat)",
	"adresseetabscorue"	=>	"Adresse (rue)",
	"telephoneetabsco"	=>	"Téléphone",
	"faxetabsco"		=>	"Fax",
	"emailetabsco"		=>	"Email",
	"etabref"		=>	"Etablissement référent",
	"directeuretab_id"		=>	"Directeur",
	"inclusionetab_id"		=>	"Ulis/Clis",
	
					));	
  }
  
  // modification du widget pour utilisation filtres Admin
   //  $this->widgetSchema['id']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
      public function formatterRadio($widget, $inputs)
    {
        $rows = array();
        foreach ($inputs as $input) {
            $rows[] = '<span class="radio">' . $input['input'] . $input['label'] . '</span>';
        }
        return "" . implode("", $rows) . "";
    }
}
