<?php use_helper('Date') ?>


<h1>Edition du Sessad </h1>
<?php if ($sf_user->hasFlash('succes')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif ?>
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif ?>


<?php 
	//echo 'heu : '.$test;
	//print_r($test);
	//var_dump($test);
	//print_r($sessadDorigine);
?>




		
		<fieldset>
		<h4><?php echo 'Demande Sessad attachée au dossier ASH n°'.$demandesessad[0]['mdph_id'].'</b>' ?> </h4>
		<?php //echo 'count'.$count_demndesessad ?>
		<?php if($count_demndesessad > 0){ ?>
		<?php $sess = Doctrine::getTAble('TypeSessad')->findOneById($demandesessad[0]['typesessad_id']); ?>
		<p font-style: 'bold'  ><?php echo 'Type de Sessad :<b> '.$sess.'</b>'; ?></p>
			
				<?php if($demandesessad[0]['datedebutnotif']){ ?>
				<p ><?php echo 'Notifiée du :<b> '.format_date($demandesessad[0]['datedebutnotif'] ,'dd/MM/yyyy') ; //.format_date($sessadDorigine->getDatedebutnotif(),'dd/MM/yyyy'); ?>
				<?php } ?>
				
				<?php if($demandesessad[0]['datefinnotif']){ ?>
				<?php echo '</b>Au  <b>'.format_date($demandesessad[0]['datefinnotif'] ,'dd/MM/yyyy').'</b>'; //format_date($sessadDorigine->getDatefinnotif(),'dd/MM/yyyy' ); ?></p>
				<?php } ?>
				<p><?php echo 'Décision de la CDA du : <b>'.format_date($demandesessad[0]['datedecisioncda'] ,'dd/MM/yyyy').'</b>'?></p>
		<?php }else{ echo "cet élève n'as pas de demandes sessad"; } ?>
	</fieldset>



	<div  >
		<?php include_partial('form', array('form' => $form)) ?>
	</div>


