<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>


<?php
echo jq_form_remote_tag(array(
    'update' => 'div_reunion',
    'url' => 'reunion/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?eleve_id=' . $form->getObject()->getEleveId() . '&id=' . $form->getObject()->getId() : '')))
?>
<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
        <tr>
            <td colspan="2">
                <?php echo $form->renderHiddenFields(false) ?>
                &nbsp;

                <?php if (!$form->getObject()->isNew()): ?>
                    &nbsp;
                    <?php echo jq_button_to_remote('Supprimer', array('url' => 'reunion/delete?id=' . $form->getObject()->getId(), 'update' => 'div_reunion', 'confirm' => 'Vous êtes sûr?')) ?>
                <?php endif; ?>
                <input type="submit" value="Enregistrer" onclick="return verif();"/>&nbsp;
				<?php
                echo jq_button_to_remote('Retour', array(
                    'url' => 'reunion/index?eleve_id='.$form->getObject()->getEleveId(),
                    'update' => 'div_reunion',
                ))
                ?>
            </td>
        </tr>
    </tfoot>
    <tbody>
      <?php //echo $form ?>
	      <?php echo $form->renderGlobalErrors() ?>

        <tr>
            <th><?php echo $form['typereunion_id']->renderLabel('Nature de la Réunion (*)') ?></th>
            <td>
                <?php echo $form['typereunion_id'] ?>
            </td>
            <td>
                <?php echo $form['typereunion_id']->renderError() ?>
            </td>
        </tr>
		
        <tr>
            <th><?php echo $form['libellereunion']->renderLabel('Intitulé') ?></th>
            <td>
                <?php echo $form['libellereunion'] ?>
            </td>
            <td>
                <?php echo $form['libellereunion']->renderError() ?>
            </td>
         </tr>
		 <tr>
            
            <th><?php echo $form['datereunion']->renderLabel('Date') ?></th>
            <td>
                <?php echo $form['datereunion'] ?>
            </td>
            <td>
                <?php echo $form['datereunion']->renderError() ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['observation']->renderLabel('Observation') ?></th>
            <td>
                <?php echo $form['observation'] ?>
            </td>
            <td>
                <?php echo $form['observation']->renderError() ?>
            </td>

        </tr>
    </tbody>
  </table>
</form>
<script>
  function verif() {
	
    var message ="";
    var flag = 0;
	  
	  
	  if ($j("#reunion_typereunion_id").val() == "" || $j("#reunion_typereunion_id").val() == 0 ) {
        //alert ("selectionner une établissement  :");
		message = message + " - Sélectionner un type de réunion  " + " \n" ;
		 flag = 1;

      }

 

    if(flag == 1){
	  alert(message);
	  return false;
	  $j("#reunion_typereunion_id").focus() ;
	}else{
        return true;
	}
    }
</script>

<script language="javascript">
  $(document).ready(function(){
  $("#reunion_typereunion_id").change(function(){
			//initialisation 
				
				alert($("#reunion_typereunion_id").val() );
	$j.post("<?php echo url_for('@ajax_reunion') ?>", { typereunion_id: $j("#reunion_typereunion_id").val(), selected: selectedVal},
	$j("#reunion_libellereunion") = $("#reunion_typereunion_id").val() 


				});
  });
</script>
