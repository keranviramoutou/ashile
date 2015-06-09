<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php
echo jq_form_remote_tag(array(
    'update' => 'acc_materiel',
    'url' => 'demandemateriel/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')))
?>  
<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table>
    <tfoot>
        <tr>
            <td colspan="2" align="center">
                <?php echo $form->renderHiddenFields(false) ?>
                &nbsp;

                <?php if (!$form->getObject()->isNew()): ?>
                    &nbsp;<?php echo jq_button_to_remote('Supprimer', array('url' => 'demandemateriel/delete?id=' . $form->getObject()->getId() . '&mdph_id=' . $form->getObject()->getMdphId() , 'update' => 'acc_materiel', 'confirm' => 'Vous êtes sur ?')) ?>
             
					<input type="submit" value="Enregistrer" onclick="return verif();" />
					<?php
					echo jq_button_to_remote('Retour', array(
						'url' => 'demandemateriel/index?mdph_id=' . $form->getObject()->getMdphId(),
						'update' => 'acc_materiel',
					))
					?>
				  <?php endif; ?>
				<?php if ($form->getObject()->isNew()): ?>
					<input type="submit" value="Enregistrer" onclick="return verif();" />
					<?php
					echo jq_button_to_remote('Retour', array(
						'url' => 'demandemateriel/index?mdph_id=' .$sf_request->getUrlParameter('mdph_id'),
						'update' => 'acc_materiel',
					))
					?>
				<?php endif; ?>
				
            </td>
        </tr>
    </tfoot>
    <tbody>
        <?php echo $form->renderGlobalErrors() ?>

        <tr>
            <td>
                <?php echo $form['typemateriel_id']->renderLabel('Matériel demandé * : ' ) ?>
                <?php echo $form['typemateriel_id']->renderError() ?>
                <?php echo $form['typemateriel_id'] ?>
            </td>
		</tr>
		<tr>
		    <td>
                <?php echo $form['notes']->renderLabel('Précision matériel : ') ?>
                <?php echo $form['notes']->renderError() ?>
                <?php echo $form['notes'] ?>
            </td>
        </tr>
    </tbody>
</table>
</form>


<script>
  function verif() {
	
    var message ="";
    var flag = 0;
	var d_1="";
    var d_2="";
	var d_3="";

 

	 if ($j("#demande_materiel_typemateriel_id").val() == ""  || $j("#demande_materiel_typemateriel_id").val() == 0) {
       // alert ("selectionner une établissement  :");
		message = message + " - Saisir un type de matériel ! "+" \n" ;

		 flag = 1;
         }
 
    if(flag == 1){
	  alert(message);
	  return false;
	}else{
      document.body.style.cursor='wait';
       return true;
	}
    }
</script>
