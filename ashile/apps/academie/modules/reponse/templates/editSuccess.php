<h3>Enquêtes DGESCO> paramètrage > Modification d'une Question > saisie d'une réponse</h3>

<br>
<fieldset>
<?php echo 'N° Question :&nbsp;<b>'.$info_question[0]['num_question'].'</b><br>' ?>
<?php echo 'Question :&nbsp;<b>'.$info_question[0]['libellequestion'].'</b>' ?>
</fieldset>
<fieldset>
<?php include_partial('form', array('form' => $form)) ?>
</fieldset>
