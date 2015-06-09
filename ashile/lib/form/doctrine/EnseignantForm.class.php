<?php

class EnseignantForm extends BaseEnseignantForm
{

    /**
     * @see PersonneForm
     */
    public function configure()
    {
        parent::configure();
        $this->useFields(array('nom', 'prenom', 'tel1'));
		        $this->widgetSchema->setLabels(array(
            'nom' => 'Nom (*):',
            'prenom' => 'Prénom (*):',
    
        ));
    }

}
