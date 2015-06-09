<?php use_helper('Date') ?>

<h1>Edition du Transport obtenu</h1>

<?php if ($sf_user->hasFlash('succes')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif; ?>


<!--------------------------------------------------------------------->
	<fieldset>
	<h4><?php echo 'Demande de Transport attachée au dossier ASH n°'.$demandetransport[0]['mdph_id'].'</b>' ?> </h4>
		<?php //echo 'count'.$count_demndesessad ?>
		<?php if($count_demndetransport > 0){ ?>
		<?php $trans = Doctrine::getTAble('Demandetransport')->findOneById($demandetransport[0]['demandetransport_id']); ?>
	
		<p ><?php echo 'Type de Transport : <b>'.$trans->getTransport().'</b>'; ?></p>
					
				<?php if($demandetransport[0]['datedebut']){ ?>
				<p><?php echo 'Notifiée du: <b>'.format_date($demandetransport[0]['datedebut'] ,'dd/MM/yyyy') ; ?>
				<?php } ?>
				
				<?php if($demandetransport[0]['datefin']){ ?>
				<?php echo '</b>Au  <b>'.format_date($demandetransport[0]['datefin'] ,'dd/MM/yyyy').'</b>';  ?></p>
				<?php } ?>
				<p><?php echo 'Décision de la CDA du : <b>'.format_date($demandetransport[0]['datedecisioncda'] ,'dd/MM/yyyy').'</b>'?></p>
		<?php }else{ echo "cet élève n'as pas de demandes transport"; } ?>
	</fieldset>

	<div >
		<?php include_partial('form', array('form' => $form)) ?>
	</div>





