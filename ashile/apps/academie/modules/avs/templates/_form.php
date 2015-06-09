<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>






<form  name = "avs" action="<?php echo url_for('avs/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

  <table>
    <tfoot>
      <tr>
        <td colspan="2">
		  (*) champs obligatoires  <br>
    
		
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('<button>Supprimer</button>', 'avs/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'êtes vous sur?')) ?>
			<!-- <button type="button" onclick="location.href='<?php echo url_for('contrat_avs/new?avs_id='.$form->getObject()->getId()  ) ?>';document.body.style.cursor='wait'">Créer un contrat</button> -->
				<button type="button" onClick="contrat()" >Nouveau contrat</button>
		          <?php endif; ?>
          <INPUT type="button" name="bouton" value="Enregistrer" onClick="return ValiderForm()" />
		   &nbsp;<button type="button" onclick="location.href='<?php echo url_for('avs/recherche?avs_nom='.$sf_request->getParameter('avs_nom').'&avs_prenom='.$sf_request->getParameter('avs_prenom')  ) ?>';document.body.style.cursor='wait'">Retour</button>

        </td>
      </tr>
    </tfoot>
    <tbody>
						<?php echo $form->renderGlobalErrors() ?>
						<tr>
							<th><?php echo $form['numen']->renderLabel('NUMEN') ?></th>
							<td>
								<?php echo $form['numen']->renderError() ?>
								<?php echo $form['numen'] ?>
							</td>
						</tr>
					    
						<tr>
						
							<th><?php echo $form['nom']->renderLabel('Nom (*)') ?></th>
							<td>
								<?php echo $form['nom']->renderError();?>
								<?php echo $form['nom'] ?>
							</td>
						</tr>
						<tr>
							<th><?php echo $form['nom_nais']->renderLabel('Nom de Naissance') ?></th>
							<td>
								<?php echo $form['nom_nais']->renderError();?>
								<?php echo $form['nom_nais'] ?>
							</td>
							
						</tr>						
						
						<tr>
							<th><?php echo $form['prenom']->renderLabel('Prénom (*)') ?></th>
							<td>
								<?php echo $form['prenom']->renderError() ?>
								<?php echo $form['prenom'] ?>
							</td>
						
						</tr>
						
						<tr>
							<th><?php echo $form['date_naissance']->renderLabel('Date de Naissance (*)') ?></th>
							<td>
								<?php echo $form['date_naissance']->renderError();?>
								<?php echo $form['date_naissance'] ?>
							</td>
						</tr>
						<tr>
							<th><?php echo $form['adressebat']->renderLabel('adresse') ?></th>
							<td>
								<?php echo $form['adressebat']->renderError() ?>
								<?php echo $form['adressebat'] ?>
							</td>
						</tr>
						<tr>
							<th><?php echo $form['adresserue']->renderLabel('adresse suite') ?></th>
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
						</tr>
						<tr>
							<th><?php echo $form['tel1']->renderLabel('Téléphone 1') ?></th>
							<td>
								<?php echo $form['tel1']->renderError(). $form['tel2']->renderError() ?>
								<?php echo $form['tel1']. '&nbsp;&nbsp;&nbsp;&nbsp;Téléphone 2 :&nbsp;&nbsp;&nbsp;'.$form['tel2']  ?>
							</td>
					    </tr>
						<tr>

							<th><?php echo $form['email']->renderLabel('Mail') ?></th>
							<td>
								<?php echo $form['email']->renderError() ?>
								<?php echo $form['email'] ?>
							</td>

						</tr>

						<tr>
							<th><?php echo $form['commentaire']->renderLabel('commentaire') ?></th>
							<td>
								<?php echo $form['commentaire']->renderError() ?>
								<?php echo $form['commentaire'] ?>
							</td>
						</tr>

    </tbody>
  </table>
</form>
<SCRIPT language="javascript">
   function ValiderForm() {
     document.body.style.cursor='wait';
	 var message ="Renseigner :";
	   if ( $j("#avs_date_naissance").val() == "" ) { var message = message +"la date de Naissance," } ;
       if ( $j("#avs_nom").val() == "" ) { var message = message +"le Nom , " } ;
	   if ( $j("#avs_prenom").val() == "" ) { var message = message + "le Prénom" } ;
      if ($j("#avs_nom").val() != "" && $j("#avs_prenom").val() != "" && $j("#avs_date_naissance").val() != "" ) { document.avs.submit() }
      else {
      alert( message );
      }
   }
</SCRIPT>


<script>
function contrat() {
//ouverture d'une popup
//---------------------
document.body.style.cursor='wait';
 var url = " <?php echo url_for('contrat_avs/popup?avs_id='.$form->getObject()->getId() ) ?>";
 var width  = 600;
 var height = 500;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'windowname5', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->

</script>