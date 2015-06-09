<?php
 
class KDateException extends Exception
{

  public function __construct($message, $code = 0) {
	$message = "Format de date non valide. ".$message;
    parent::__construct($message, $code);
  }

}

?>