<?php use_stylesheets_for_form($form) ?>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<div id="tab_eleve">
	<form action="<?php echo url_for('organismesuivit/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>
	  <table>
		<tfoot>
		  <tr>
			<td colspan="2">
			  
		
			  <?php if (!$form->getObject()->isNew()): ?>
							  &nbsp;<?php echo button_to('Supprimer', 'organismesuivit/delete?id='.$form->getObject()->getId(),'confirm = etes vous sur ? popup=true') ?>
			  <?php endif; ?>
			  <input type="submit" value="Enregister" onclick="return validform();"  />&nbsp;<button type="button" onclick="window.close()" >Fermer</button>
			</td>
		  </tr>
		</tfoot>
		<tbody>
		  <?php //echo $form ?>
		        <tr>
		          <th><?php echo $form['secteur_id']->renderLabel(' ') ?></th>
               <td>
                <?php echo $form['secteur_id']->renderError() ?>
                <?php echo $form['secteur_id'] ?>
              </td>
              </tr>
			  		        <tr>
		          <th><?php echo $form['typeetablissement_id']->renderLabel('Type etablissement ') ?></th>
               <td>
                <?php echo $form['typeetablissement_id']->renderError() ?>
                <?php echo $form['typeetablissement_id'] ?>
              </td>
              </tr>
		  
				<tr>
	
				<th><?php echo $form['nometabnonsco']->renderLabel('Nom de l\'établissement (*)') ?></th>
                <td><?php echo $form['nometabnonsco']->renderError(); ?>
                    <?php echo $form['nometabnonsco']; ?>

				</td>
                </tr>  
				<tr>
	
				<th><?php echo $form['adresseetabnonscobat']->renderLabel('Adresse') ?></th>
                <td><?php echo $form['adresseetabnonscobat']->renderError(); ?>
                    <?php echo $form['adresseetabnonscobat']; ?>

				</td>
                </tr> 
				<tr>
	
				<th><?php echo $form['adresseetabnonscorue']->renderLabel('Adresse suite') ?></th>
                <td><?php echo $form['adresseetabnonscorue']->renderError(); ?>
                    <?php echo $form['adresseetabnonscorue']; ?>

				</td>
                </tr> 	
				<tr>
				
				<th><?php echo $form['quartier_id']->renderLabel('Commune *') ?></th>
                <td><?php echo $form['quartier_id']->renderError(); ?>
                    <?php echo $form['quartier_id']; ?>

				</td>
                </tr> 	
				<tr>
	
				<th><?php echo $form['teletabnonsco']->renderLabel('Téléphone') ?></th>
                <td><?php echo $form['teletabnonsco']->renderError(); ?>
                    <?php echo $form['teletabnonsco']; ?>

				</td>
                </tr> 	
				<tr>
	
				<th><?php echo $form['faxetabnonsco']->renderLabel('Fax') ?></th>
                <td><?php echo $form['faxetabnonsco']->renderError(); ?>
                    <?php echo $form['faxetabnonsco']; ?>

				</td>
                </tr> 	

				<tr>
	
				<th><?php echo $form['emailetabnonsco']->renderLabel('Mail') ?></th>
                <td><?php echo $form['emailetabnonsco']->renderError(); ?>
                    <?php echo $form['emailetabnonsco']; ?>

				</td>
                </tr> 	


				<tr>
	
				<?php echo $form['_csrf_token']->renderError() ?>
				<?php echo $form['_csrf_token'] ?>

				</td>
                </tr> 


				<tr>
	
				<th><?php echo $form['libellesuivit']->renderLabel(' ') ?></th>
                <td><?php echo $form['libellesuivit']->renderError(); ?>
                    <?php echo $form['libellesuivit']; ?>

				</td>
                </tr> 				
					
		</tbody>
	  </table>
	</form>
</div>


<script>

function validform() {
    
   var flag = 0;
   var titi = $j("#organisme_suivit_nometabnonsco").val()
   var message= "";
	
	
    //controle saisie du secteur
	  if (titi == ""   ) {
       	message =  " - Saisir un Nom d'établissement " + " \n" ;
		 flag = 1;

      }
	  
//alert(titi+ flag);
	  
	if(flag == 1){
	  alert(message);
	  return false;
	}else{
	
       return true;
	}
}

</script>
