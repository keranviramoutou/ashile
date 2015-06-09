<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php
echo jq_form_remote_tag(array(
    'update' => 'acc_pieces',
    'url' => 'piecesdossier/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : ''))) ?>  
<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table>
    <tfoot>
        <tr>
            <td colspan="2" align="center">
                <?php echo $form->renderHiddenFields(true) ?>

                <?php if (!$form->getObject()->isNew()): ?>
                    &nbsp;<?php echo jq_button_to_remote('Supprimer', array('url' => 'piecesdossier/delete?id=' . $form->getObject()->getId() . '&mdph_id=' . $form->getObject()->getMdphId() , 'update' => 'acc_pieces', 'confirm' => 'Vous êtes sur ?')) ?>
                <?php endif; ?>
                <input type="submit" value="Enregistrer" onclick="return verif();" />&nbsp;
				<?php
                echo jq_button_to_remote('Retour', array(
                    'url' => 'piecesdossier/index?mdph_id=' . $form->getObject()->getMdphId(),
                    'update' => 'acc_pieces',
                ))
                ?>
            </td>
        </tr>
    </tfoot>
    <tbody>
        <?php echo $form->renderGlobalErrors() ?>
        <tr>
            <td>
                <?php echo $form['libellepiece']->renderLabel('Libellé de la pièce * :' ) ?>
                <?php echo $form['libellepiece']->renderError() ?>
                <?php echo $form['libellepiece'] ?>
            </td>
		</tr>
		
		<tr>
		    <td>
                <?php echo $form['daterecep']->renderLabel('Restitué le : ') ?>
                <?php echo $form['daterecep']->renderError() ?>
                <?php echo $form['daterecep'] ?>
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

 

	 if ($j("#pieces_dossier_libellepiece").val() == ""  || $j("#pieces_dossier_libellepiece").val() == 0) {
       // alert ("selectionner une établissement  :");
		message = message + " - Saisir un libellé ! "+" \n" ;

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