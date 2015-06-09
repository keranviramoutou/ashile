<?php if ($sf_user->hasFlash('succesEnseignant')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('succesEnseignant') ?></div>
<?php endif; ?>
<?php include_partial('form', array('form' => $form, 'orientation' => $orientation)) ?>
