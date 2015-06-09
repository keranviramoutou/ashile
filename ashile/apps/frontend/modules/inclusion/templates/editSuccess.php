<?php if ($sf_user->hasFlash('succesInclusion')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('succesInclusion'); ?></div>
<?php endif; ?>
<?php include_partial('form', array('form' => $form, 'orientation' => $orientation)) ?>
