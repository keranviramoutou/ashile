<!-- <h1>Modification concernant l' élève</h1> -->
<?php if ($sf_user->hasFlash('succes')): ?>
      <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif ?>
<?php include_partial('form', array('form' => $form,'count_scolarite_en_cours' =>$count_scolarite_en_cours,'count_scolarite_spe_en_cours' =>$count_scolarite_spe_en_cours  ,'count_sessad_alerte'=>$count_sessad_alerte,'count_transport_alerte'=>$count_transport_alerte)) ?>  <!-- passage de variable à _form.php !-->
