<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('specialiste.js') ?>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<form action="<?php echo url_for('specialiste/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId().'&secteur_id='.$sf_user->getAttribute('secteur')->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
         
		 
          <?php if (!$form->getObject()->isNew()): ?>&nbsp;<?php echo button_to('Supprimer', 'specialiste/delete?id='.$form->getObject()->getId(),'confirm = etes vous sur ? popup=true') ?>
           <?php endif; ?>
          <input type="submit" value="Enregister" onclick="return confirmation();"  />&nbsp;<button type="button"  onclick="window.close()"  >Fermer</button>

        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php //echo $form ?>
	          <?php echo $form->renderGlobalErrors() ?>
		        <tr>
        <th><?php echo $form['secteur_id']->renderLabel(' ') ?></th>
            <td>
                <?php echo $form['secteur_id']->renderError() ?>
                <?php echo $form['secteur_id'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['nom']->renderLabel('Nom *') ?></th>
            <td>
                <?php echo $form['nom']->renderError() ?>
                <?php echo $form['nom'] ?>
            </td>
        </tr>
		        <tr>
            <th><?php echo $form['prenom']->renderLabel('Prénom *') ?></th>
            <td>
                <?php echo $form['prenom']->renderError() ?>
                <?php echo $form['prenom'] ?>
            </td>
			<tr>
		    <tr>
            <th><?php echo $form['specialite_id']->renderLabel('Spécialité *') ?></th>
            <td>
                <?php echo $form['specialite_id']->renderError() ?>
                <?php echo $form['specialite_id'] ?>
            </td>
			</tr>
			
			        <tr>
            <th><?php echo $form['adressebat']->renderLabel('Adresse ') ?></th>
            <td>
                <?php echo $form['adressebat']->renderError() ?>
                <?php echo $form['adressebat'] ?>
            </td>
        </tr>
		<tr>
            <th><?php echo $form['adresserue']->renderLabel('Adresse suite') ?></th>
            <td>
                <?php echo $form['adresserue']->renderError() ?>
                <?php echo $form['adresserue'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['quartier_id']->renderLabel('Commune') ?></th>
            <td>
                <?php echo $form['quartier_id']->renderError() ?>
                <?php echo $form['quartier_id'] ?>
            </td>

		<tr>
            <th><?php echo $form['tel1']->renderLabel('Téléphone 1') ?></th>
            <td>
                <?php echo $form['tel1']->renderError() ?>
                <?php echo $form['tel1'] ?>
            </td>
        </tr>
		   <tr>
            <th><?php echo $form['tel2']->renderLabel('Téléphone 2') ?></th>
            <td>
                <?php echo $form['tel2']->renderError() ?>
                <?php echo $form['tel2'] ?>
            </td>
        </tr>
		        </tr>
		   <tr>
            <th><?php echo $form['email']->renderLabel('Email') ?></th>
            <td>
                <?php echo $form['email']->renderError() ?>
                <?php echo $form['email'] ?>
            </td>
        </tr>

		  </tr>
		        <tr>
            <th><?php echo $form['organismesuivit_id']->renderLabel('Etablissement principal d\'exercice') ?></th>
            <td>
                <?php echo $form['organismesuivit_id']->renderError() ?>
                <?php echo $form['organismesuivit_id'] ?>
            </td>
        </tr>
		        <tr>
            <th><?php echo $form['commentaire']->renderLabel('Notes') ?></th>
            <td>
                <?php echo $form['commentaire']->renderError() ?>
                <?php echo $form['commentaire'] ?>
			</td>
			<td>
				<?php echo $form['_csrf_token']->renderError() ?>
				<?php echo $form['_csrf_token'] ?>
		
            </td>
        </tr>
		

    </tbody>
  </table>
</form>

