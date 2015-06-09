<?php

class NumeroMdphForm extends sfForm
{

    public function configure()
    {
        
        $this->setWidgets(array('numeromdph' => new sfWidgetFormInputText(), 'eleve_id' => new sfWidgetFormInputHidden()));
        $this->setValidators(array('numeromdph' => new sfValidatorString(array('max_length' => 11, 'required' => true)), 'eleve_id' => new sfValidatorString()));
        $this->widgetSchema->setLabels(array('numeromdph' => 'Numero du dossier Mdph :'));
    }

}

?>
