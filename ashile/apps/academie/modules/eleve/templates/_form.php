<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php //use_stylesheet('alertjs.css') ?>
<?php //use_javascript('alertjs.js') ?>
<?php use_javascript('eleve.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>




<form name="eleve" action="<?php echo url_for('eleve/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
		   <?php $secteur = $sf_request->getParameter('secteur_id') ?>
		   <?php $param = $sf_request->getParameter('param') ?>

  
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php //echo link_to('Delete', 'dd1/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
		 
       					<!-- <input type="submit" value="Enregistrer" /> -->
					   <INPUT type="button" name="bouton" value="Enregistrer" onClick="ValiderForm()" />
					    &nbsp;<button type="button" onclick="location.href='<?php echo url_for('eleve/recherche?eleve_id='.$sf_request->getParameter('id').'&eleve_nom='.$sf_request->getParameter('eleve_nom').'&eleve_prenom=' .$sf_request->getParameter('eleve_prenom').'&flag_recherche=1'  ) ?>'">Retour</button>
										

        </td>
        </tr>

    </tfoot>
    <tbody>
<?php //echo $form; ?>
      <?php echo $form->renderGlobalErrors() ?>
	  	          <tr>
        <th><?php echo $form['secteur_id']->renderLabel('Secteur élève ') ?></th>
        <td width= 330px>
          <?php echo $form['secteur_id']->renderError() ?>
          <?php echo $form['secteur_id'] ?>
        </td>
      </tr>
	  	 <tr>
        <th><?php echo $form['nom']->renderLabel('Nom (*)') ?></th>
        <td width= 330px>
          <?php echo $form['nom']->renderError() ?>
          <?php echo $form['nom'] ?>
        </td>
      </tr>
	  	          <tr>
        <th><?php echo $form['prenom']->renderLabel('Prénom (*)') ?></th>
        <td width= 330px>
          <?php echo $form['prenom']->renderError() ?>
          <?php echo $form['prenom'] ?>
        </td>
      </tr>
	          <tr>
        <th><?php echo $form['sexe']->renderLabel('sexe (*)') ?></th>
        <td width= 330px>
          <?php echo $form['sexe']->renderError() ?>
          <?php echo $form['sexe'] ?>
        </td>
      </tr>
	  <tr>
        <th><?php echo $form['datenaissance']->renderLabel('né(e) le (*) ') ?></th>
        <td width= 330px>
          <?php echo $form['datenaissance']->renderError() ?>
          <?php echo $form['datenaissance'] ?>
        </td>
      </tr>
        <tr>
        <th><?php echo $form['adresseleverue']->renderLabel('Adresse ') ?></th>
        <td width= 330px>
          <?php echo $form['adresseleverue']->renderError() ?>
          <?php echo $form['adresseleverue'] ?>
        </td>
      </tr>
	    <tr>
        <th><?php echo $form['adresseelevebat']->renderLabel('Adresse suite') ?></th>
        <td width= 330px>
          <?php echo $form['adresseelevebat']->renderError() ?>
          <?php echo $form['adresseelevebat'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['quartier_id']->renderLabel('Commune') ?></th>
        <td>
          <?php echo $form['quartier_id']->renderError() ?>
          <?php echo $form['quartier_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['etat_acc']->renderLabel('Date de Fin d\'accompagnement (3)') ?></th>
        <td>
          <?php echo $form['etat_acc']->renderError() ?>
          <?php echo $form['etat_acc'] . '&nbsp;&nbsp;en fin d\'accompagnement ne pas oublier de clôturer les accompagnements pour cette élève'?>
        </td>
      </tr>
	     <tr>
        <th><?php echo $form['etat_mat']->renderLabel('Fin de prise en charge matériel (2) ') ?></th>
        <td>
          <?php echo $form['etat_mat']->renderError() ?>
          <?php echo $form['etat_mat'] . '&nbsp;'?>
        </td>
      </tr>
	    <tr>
        <th><?php echo $form['notes']->renderLabel('Notes') ?></th>
        <td>
          <?php echo $form['notes']->renderError() ?>
          <?php echo $form['notes'] ?>
        </td>
      </tr>
	  <tr>
        <th><?php echo $form['pps_id']->renderLabel('Projet personnalisé de scolarisation ') ?></th>
        <td width= 330px>
          <?php echo $form['pps_id']->renderError() ?>
          <?php echo $form['pps_id'] ?>
        </td>
      </tr>
	  	<tr>
        <th><?php echo $form['datesortie']->renderLabel('Fin de prise en charge par l\'ASH (1)') ?></th>
        <td>
          <?php echo $form['datesortie']->renderError() ?>
          <?php echo $form['datesortie'] ?>
        </td>
		</tr>
        <tr>
	   <th><?php echo $form['motif']->renderLabel('Motif de Fin de prise en charge par l\'ASH ') ?></th>
        <td>
          <?php echo $form['motif']->renderError() ?>
          <?php echo $form['motif'] ?>
        </td>
      </tr>
    </tbody>
  </table>
  (1) - l'élève ne dépend plus de l'ASH<br>
  (2) - l'élève dépend toujours de l'ASH, il est sorti du cadre de l'attribution du matériel<br>
  (3) - l'élève dépend toujours de l'ASH, il est sorti du cadre de l'attribution d'un avs 
  
</form>
<script>



 $j(document).ready(function(){
        // Message alerte changement de secteur cloture de la scolarité
        $j("#eleve_secteur_id").change(function(){
			//initialisation 
		
				alert('vous devez avant de changer le secteur de l\'élève,clôturer la scolarité en cours !! ' );

				});
		});


</script>