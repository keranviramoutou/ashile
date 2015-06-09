<h1>Nouveau Partenaire</h1>
		  <?php if ($form->getObject()->isNew()): ?>
				<span><button onClick="window.location.href='<?php echo url_for('organismesuivit/new')  ?>'">Créer  un Etablissement de suivi</button></span>
		<?php endif; ?>
<?php include_partial('form', array('form' => $form)) ?>
