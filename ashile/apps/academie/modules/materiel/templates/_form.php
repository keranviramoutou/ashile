<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Text') ?>


<div>
  <table>
	<td style="width: 40%; position:top">
		<form action="<?php echo url_for('materiel/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
		<?php if (!$form->getObject()->isNew()): ?>

		<input type="hidden" name="sf_method" value="put" />
		<?php endif; ?>
		<table>

			<tbody>
			  <?php echo $form->renderGlobalErrors() ?>
			  
			  <?php if ($form->getObject()->isNew()): ?>
			  <tr>
				<th><?php echo $form['marque_id']->renderLabel('Marque *') ?></th>
				<td>
				  <?php echo $form['marque_id']->renderError() ?>
				  <?php echo $form['marque_id'] ?>
				</td>
			  </tr>
			  <tr>
				<th><?php echo $form['typemateriel_id']->renderLabel('Type (<small>correspond à la demande) *</small>') ?></th>
				<td>
				  <?php echo $form['typemateriel_id']->renderError() ?>
				  <?php echo $form['typemateriel_id'] ?>
				</td>
			  </tr>

			  <?php endif; ?>
			  
		      <th><?php echo $form['catmateriel_id']->renderLabel('Catégorie') ?></th>
				<td>
				  <?php echo $form['catmateriel_id']->renderError() ?>
				  <?php echo $form['catmateriel_id'] ?>
				</td>
			  </tr>
			  <tr>
				<th><?php echo $form['libellemateriel']->renderLabel('Libelle *') ?></th>
				<td>
				  <?php echo $form['libellemateriel']->renderError() ?>
				  <?php echo $form['libellemateriel'] ?>
				</td>
			  </tr>
			  <tr>
				<th><?php echo $form['caracteristiquemateriel']->renderLabel('Caractéristiques') ?></th>
				<td>
				  <?php echo $form['caracteristiquemateriel']->renderError() ?>
				  <?php echo $form['caracteristiquemateriel'] ?>
				</td>
			  </tr>
			  <tr>
				<th><?php echo $form['numeromateriel']->renderLabel('Numéro de série') ?></th>
				<td>
				  <?php echo $form['numeromateriel']->renderError() ?>
				  <?php //echo $form['numeromateriel'] ?>
				  <!-- javascript pour eviter l'enregistrement de plusieurs materiels avec le même numéro -->
				  <?php //if ($form->isNew()){ ?>
					<!-- <input type="text" id="materiel_numeromateriel" name="materiel[numeromateriel]" value="" onChange="if(this.value !== ''){materiel_nbmateriel.value = '1'}" /> -->
				 <?php	echo $form['numeromateriel']; //}	?>
		
				 <!---------------------------------------------------------------------------------------->
				 
				</td>
			  </tr>
			  <tr>
				<th><?php echo $form['fournisseur_id']->renderLabel() ?></th>
				<td>
				  <?php echo $form['fournisseur_id']->renderError() ?>
				  <?php echo $form['fournisseur_id'] ?>
				</td>
			  </tr>
			  	<tr>
				<th><?php echo $form['prixachat']->renderLabel('Prix d\'achat') ?></th>
				<td>
				  <?php echo $form['prixachat']->renderError() ?>
				  <?php echo $form['prixachat'] ?>
				</td>
			   </tr>
			  	<tr>
				<th><?php echo $form['dateachat']->renderLabel('Date d\'achat') ?></th>
				<td>
				  <?php echo $form['dateachat']->renderError() ?>
				  <?php echo $form['dateachat'] ?>
				</td>
			  </tr>

			  <tr>
				<th><?php echo $form['commentaire']->renderLabel('Notes') ?></th>
				<td>
				  <?php echo $form['commentaire']->renderError() ?>
				  <?php echo $form['commentaire'] ?>
				</td>
			  </tr>
			  

			  <?php 
				if($form->getObject()->isNew()):
						  echo "<tr>";
						  echo  	"<th>".$form['nbmateriel']->renderLabel('Nombre de matériels à dupliquer')."</th>";
						  echo      "<td>".
						$form['nbmateriel']->renderError();
			  ?>
			  								
				<input type="number" id="materiel_nbmateriel" size="5" name="materiel[nbmateriel]" value="1" onChange="if(this.value !== '1'){materiel_numeromateriel.value = ''}" />
				&nbsp;<small> Ce champ renseigne le nombre de matériel à créer,
				</small><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>si plus d'un materiel ne pas renseigner le champ numero materiel</small>						
					
				<?php			
						  echo 		"</td>";
						  echo "</tr>";
				endif;?> 
				
			</tbody>
			
			 <tfoot>
			 <?php // if(!$form->isNew() && $form->getObject()->getNumeromateriel()):?> 
			 <!-- <tr>
				  <td colspan="2">
					  <fieldset><legend>Nouveau Mouvement Pour ce Materiel</legend>
					  <?php //echo $form['newMouvementMateriel'] ?>
					  </fieldset>
				  </td>
			 </tr> -->
			 <?php //endif; ?>

			 <tr>	  
				<td colspan="2">

				  <?php echo $form->renderHiddenFields(false) ?>
				  	<br> * champs obligatoires<br>
				    <input type=button onClick=window.open("<?php echo url_for('mouvement_materiel/popup?materiel_id='.$sf_request->getParameter('id')) ?>","Mouvement","bgColor='lightgreen',menubar=no,width=400,height=400,left=150,top=200,toolbar=0,status=0,"); value="Nouveau Mouvement">
				  <input type="submit" value="Enregistrer" onClick= "if(materiel_nbmateriel.value !== '1'){materiel_numeromateriel.value = ''}" />
				
				 &nbsp;<input type="button" value="Retour" onclick="history.go(-1)">
				</td>
			  </tr>
			</tfoot>
			</table>

			</form>
		</td>
    </table>
</div>



