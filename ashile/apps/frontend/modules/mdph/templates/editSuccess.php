
<!-- <div class='aide' onClick="<?php echo url_for('mdph/aide') ?>"></div> -->
<h1> Dossier ASH n° <?php echo $form->getObject()->getId()?></h1>


<?php if ($sf_user->hasFlash('succes')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
 <?php endif ?>

<?php if ($sf_user->hasFlash('erreurDelMdph')): ?>
  <div class="flash_error"><?php echo $sf_user->getFlash('erreurDelMdph') ?></div>
 <?php endif ?>

<?php include_partial('form', array('form' => $form,'count_demandeorientations' => $count_demandeorientations,'count_demandemateriels' => $count_demandemateriels,'count_bilans'=>$count_bilans,
'count_demandeavs'=>$count_demandeavs,'count_demandesessads'=>$count_demandesessads,'count_demandetransport'=>$count_demandetransport,'count_autrepiece'=>$count_autrepiece)) ?>
