<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('Text') ?>
<?php use_helper('jQuery') ?>

<?php
echo jq_form_remote_tag(array(
    'update' => 'acc_bilan',
    'url' => 'bilan/' . ($form->getObject()->isNew() ? 'create?mdph_id=' . $form->getObject()->getMdphId() : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() . '&mdph_id=' . $form->getObject()->getMdphId() : '')))
?>
<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table>
    <tfoot>
        <tr>
            <td colspan="4" align="center">
                <?php echo $form->renderHiddenFields(false) ?>
                &nbsp;
 
                <?php if (!$form->getObject()->isNew()): ?>
							&nbsp;
							<?php echo jq_button_to_remote('Supprimer', array('url' => 'bilan/delete?id=' . $form->getObject()->getId() . '&mdph_id=' . $form->getObject()->getMdphId(), 'update' => 'acc_bilan', 'confirm' => 'Vous êtes sur ?')) ?>
				   
						&nbsp;
						<input type="submit" value="Enregistrer" onclick="return verif();" />&nbsp;<button type="button" onClick="partenaire()" > créer partenaire test </button>
						<?php
						echo jq_button_to_remote('Retour', array(
							'url' => 'bilan/index?mdph_id=' .  $sf_request->getUrlParameter('Mdph_id'),
							'update' => 'acc_bilan',
						))
						?>
				 <?php endif; ?>
				  
				<?php if ($form->getObject()->isNew()): ?>  
					<input type="submit" value="Enregistrer" onclick="return verif();" />&nbsp;<button type="button" onClick="partenaire()" > créer partenaire </button>
					<?php
					echo jq_button_to_remote('Retour'.$sf_request->getUrlParameter('Mdph_id'), array(
						'url' => 'bilan/index?mdph_id=' .  $sf_request->getUrlParameter('Mdph_id'),
						'update' => 'acc_bilan',
					))
					?>
				
				 <?php endif; ?>
				
            </td>
        </tr>
    </tfoot>
    <tbody>
        <?php //echo $form ?>
        <?php echo $form->renderGlobalErrors() ?>
        <tr>
            <th><?php echo $form['specialiste_id']->renderLabel('Partenaire *') ?></th>
            <td>
                <?php echo $form['specialiste_id'] ?>
            </td>
            <td>
                <?php echo $form['specialiste_id']->renderError() ?>
            </td>
	    <td>
        </tr>
        <tr>
            <th><?php echo $form['libelle_bilan']->renderLabel('intitulé de la pièce') ?></th>
            <td>
                <?php echo $form['libelle_bilan'] ?>
            </td>
            <td>
                <?php echo $form['libelle_bilan']->renderError() ?>
            </td>
        </tr>
		        <tr>
            <th><?php echo $form['naturebilan_id']->renderLabel('Nature du bilan') ?></th>
            <td>
                <?php echo $form['naturebilan_id'] ?>
            </td>
            <td>
                <?php echo $form['naturebilan_id']->renderError() ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['date_bilan']->renderLabel('Date de réception ') ?></th>
            <td>
                <?php echo $form['date_bilan'] ?>
            </td>
            <td>
                <?php echo $form['date_bilan']->renderError() ?>
            </td>   
        </tr>
        <tr>
            <th><?php echo $form['notes']->renderLabel() ?></th>
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

<script type="text/javascript">
   $j(function() {
       $j("input:submit, input:button, form ul li a").button();
   });
</script>

<script>
function partenaire() {
//ouverture d'une popup
//---------------------
 var url = " <?php echo url_for('specialiste/popup' ) ?>";
 var width  = 700;
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


<script>
  function verif() {
	
    var message ="";
    var flag = 0;
	var d_1="";
    var d_2="";
	var d_3="";

 

	 if ($j("#bilan_specialiste_id").val() == ""  || $j("#bilan_specialiste_id").val() == 0) {
       // alert ("selectionner une établissement  :");
		message = message + " - Sélectionner un partenaire  !"+" \n" ;

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

