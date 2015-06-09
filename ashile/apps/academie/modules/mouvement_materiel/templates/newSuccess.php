 <?php use_javascript( 'jquery-1.7.2.min.js');// ce fichier a été placé dans "/web/js" ?>
<?php include_javascripts(); // pour l'inclure maintenant, on en a besoin !! ?>


<h3>Nouveau mouvement pour le matériel </h3>
<!------------------------------------------------------------------>
  <?php echo 'gggg'.$sf_content ?>
<?php	


	  echo '<fieldset>';
	  echo  'matériel :&nbsp;<strong>'.$materiels[0]['libelletypemateriel'].'&nbsp; '.$materiels[0]['libelleMateriel'].'&nbsp;</strong>Marque&nbsp;<strong> '.$materiels[0]['marque'].
	  '</strong>&nbsp&nbsp n°: <strong>'.$materiels[0]['numeroMateriel'].'</strong>';
	  echo '</fieldset>';
	  
	  
?>
<?php include_partial('form', array('form' => $form)) ?>

