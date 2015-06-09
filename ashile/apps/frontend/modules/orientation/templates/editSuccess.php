<?php 	use_helper('jQuery'); ?>
<?php if ($sf_user->hasFlash('succes')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')) : ?>
    <br><div class="flash_error"><?php echo html_entity_decode($sf_user->getFlash('error')) ?></div>
<?php endif; ?>



<h1>Edition scolarisation en milieu ordinaire</h1>
<?php if ($count_changesecteur == 0 ){ ?> <!-- seulement visible si pas de changement de secteur en cours -->
 
<!-- <a id="changesect" href="<?php //echo url_for('orientation/changeSecteur?eleve_id='.$eleve_id) ?>"><button>Demande de changement de secteur</button></a> -->
<?php }  ?>
<?php include_partial('form', array('form' => $form)) ?>


<script type="text/javsacript">
<script type="text/javsacript">
function init(){
    document.body.style.cursor='help';
 }

   window.addEventListener?
   window.addEventListener('load',init,false):
   window.attachEvent('onload',init);
</script>



</script>