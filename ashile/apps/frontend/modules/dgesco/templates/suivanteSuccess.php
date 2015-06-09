<h1>Saisie de l'enquête Dgesco</h1>
<?php if ($sf_user->hasFlash('dgescoSuccess')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('dgescoSuccess') ?></div>
<?php endif; ?>

<?php //echo '&nbsp;Libellé de la Question :&nbsp;<strong>'. $form->getObject()->getQuestion().'</strong>' ; ?>
<?php include_partial('form', array('form' => $form)) ?>
