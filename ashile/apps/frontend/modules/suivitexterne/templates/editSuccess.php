<h1>Edition Suivi externe</h1>
<?php if ($sf_user->hasFlash('succes')): ?>
      <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif ?>
<?php include_partial('form', array('form' => $form)) ?>
