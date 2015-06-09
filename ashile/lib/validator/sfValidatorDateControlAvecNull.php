<?php

class sfValidatorDateControlAvecNull extends sfValidatorBase
{
    function __construct()
    {
        parent::__construct();
    }

    protected function doClean($values)
    {
     //   if ($values['dateenvoiedossier'] < $values['datecreationpps'])
     //       throw new sfValidatorError($this, 'La date d\'envoi doit etre supéeurr à la date de creation');
     //   return $values;

    }
}

?>
