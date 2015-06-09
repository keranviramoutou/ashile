<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<?php $mdph = Doctrine::getTable('Mdph')->find($form->getObject()->getMdph());
         $orientation = Doctrine::getTable('Orientation')->findOneByEleveId($mdph->getEleveId());

  echo '<fieldset><legend><h3>Synthèse </h3></legend>';
         echo '<p><i> vous traitez l\'éleve :<strong> '.$mdph->getEleve().'</strong><br><br>Scolarité&nbsp;:&nbsp;<strong> ';
         
         if($orientation):
         echo $orientation->Etabsco->Typeetablissement->nomtypeetablissement.'&nbsp;'.$orientation->Etabsco->nometabsco.'</strong>&nbsp&nbsp Niveau scolaire :&nbsp<strong>'.$orientation->Niveauscolaire->nomniveauscolaire.'</strong>&nbsp&nbspClasse :&nbsp&nbsp<strong>'.$orientation->Classe->TypeClasse->nomtypeclasse.'</strong></i></p>';
         endif;
         
  echo '<p><i> Dossier MDPH n °&nbsp  <strong>' .$mdph->id.'</strong>&nbsp Date ESS  :&nbsp'.format_date($mdph->dateess,'dd/MM/yyyy').'&nbsp Date envoi dossier : ' .format_date($mdph->dateenvoiedossier,'dd/M/yyyy').'</i></p></fieldset>';
?>


<fieldset>
<form action="<?php echo url_for('demandeorientation/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2" align="left">
          &nbsp; <button type="button" onclick="location.href='<?php echo url_for('demandeorientation/index' ) ?>'">Retour</button>
		  
          <?php if (!$form->getObject()->isNew()): ?>
             &nbsp;<?php echo jq_button_to_remote('Supprimer', array('url' => 'demandeorientation/delete?id=' . $form->getObject()->getId() ,'confirm' => 'Etes vous sur?')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
		<th><?php echo $form['mdph_id']->renderLabel(' ') ?></th>
        <td>
          <?php echo $form['mdph_id']->renderError() ?>
          <?php echo $form['mdph_id'] ?>
        </td>
		<tr>
			<th><?php echo $form['date_demande_orientation']->renderLabel('Demande saisie le : ').'&nbsp;'.format_date($form['date_demande_orientation']->getvalue(),'dd/MM/yyyy') ?></th>
	
		</tr>
		<tr>
			<th><?php echo $form['classeext_id']->renderLabel('Classe demandée') ?></th>
			<td>
				<?php echo $form['classeext_id'] ?>
			</td>
			<td>
				<?php echo $form['classeext_id']->renderError() ?>
			</td>
		</tr>
		<tr>
			<th><?php echo $form['demijournee_id']->renderLabel('Demi-journées') ?></th>
			<td>
				<?php echo $form['demijournee_id'] ?>
			</td>
			<td>
				<?php echo $form['demijournee_id']->renderError() ?>
			</td>
		</tr>
      <tr>
        <th><?php echo $form['decisioncda']->renderLabel('Décision de la CDA (cocher ACCEPTEE/ décocher REFUSEE)').'&nbsp&nbsp' ?></th>
        <td>
          <?php echo $form['decisioncda']->renderError(). '&nbsp'. $form['datedecisioncda']->renderError()  ?>
          <?php echo $form['decisioncda'].'&nbsp&nbsp le &nbsp'.$form['datedecisioncda'] ?>
      </tr>
        <tr>
        <th><?php echo $form['datedebutnotif']->renderLabel('Décison CDA notifié du :') ?></th>
        <td>
          <?php echo $form['datedebutnotif']->renderError().'&nbsp'.$form['datefinnotif']->renderError() ?>
          <?php echo $form['datedebutnotif'] .'&nbsp au &nbsp'.$form['datefinnotif']?>
        </td>
       </tr> 
	   		<tr>
			<th><?php echo $form['notes']->renderLabel('Commentaire') ?></th>
			<td>
				<?php echo $form['notes'] ?>
			</td>
			<td>
				<?php echo $form['notes']->renderError() ?>
			</td>
		</tr>
        
    </tbody>
  </table>
</form>
</fieldset>