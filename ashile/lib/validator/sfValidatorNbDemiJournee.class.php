<?php

/**
 * Validation de nombre de demi-journée qui le total d'orientation et modnonsco ne doit pas depasser 8
 *
 */
class sfValidatorNbDemiJournee extends sfValidatorBase
{

    // Pour connaitre le module en cours si c'est orientation ou modnonsco
    protected $module;

    function __construct()
    {
        parent::__construct();
        $this->module = sfContext::getInstance()->getModuleName();
    }

    protected function doClean($values)
    {
        if ($this->getSomme($values) > 8)
            throw new sfValidatorError($this, 'Le total de demi-journée ne doit pas depasser 8');
        return $values;
    }

    protected function getSomme($values)
    {
        $somme = 0;
        if (isset($values['demijournee_id']) && ($values['demijournee_id'] != ''))
        {
            $somme = $values['demijournee_id'] + $this->getDemiJournee($values['eleve_id']);
        }
        else
        {
            $somme = $this->getDemiJournee($values['eleve_id']);
        }
        return $somme;
    }

    protected function getDemiJournee($eleve_id)
    {
        $table = '';
        switch ($this->module)
        {
            case 'orientation':
                $table = 'Modnonsco';
                break;
            case 'modnonsco':
                $table = 'Orientation';
                break;
        }
        $resQ = Doctrine_core::getTable($table)->findOneByEleveId($eleve_id);
        return (!$resQ ? 0 : intval($resQ->getDemijourneeId()));
    }

}

?>
