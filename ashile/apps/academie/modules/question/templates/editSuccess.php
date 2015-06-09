<h3>Enquêtes> DGESCO> Modification d'une Question</h3>
<br>
<fieldset>
<?php include_partial('form', array('form' => $form)) ?>
</fieldset>
<br>
<?php	if($count_reponses > 0){		
		
			include_partial('reponses', array('reponse' => $reponse));  

		};
?>