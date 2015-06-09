<?php
 
interface IDate
{

public function getDateSysteme();
public function getDateUtilisateur();

public function updateDateSysteme($date);
public function updateDateUtilisateur($date);

}

?>