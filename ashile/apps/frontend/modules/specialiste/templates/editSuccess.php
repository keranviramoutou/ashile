<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>

<h1>Edition d'un Partenaire</h1>
<?php if ($sf_user->hasFlash('succes')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif; ?>
<?php include_partial('form', array('form' => $form)) ?>
