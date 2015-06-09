<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Text') ?>


<script language="javascript">
 /*   $j(document).ready(function(){
        if ($j("#dgesco_question_id").val() == "")
            $j("#dgesco_reponse_id", "#dgesco_libelle_reponse").attr('disabled', 'disabled');
        else{
            executeHtmlSelect("#dgesco_reponse_id", $j("#dgesco_reponse_id").val());
        }
        $j("#dgesco_question_id").change( function() {executeHtmlSelect("#dgesco_reponse_id", null);});
    });
    function executeHtmlSelect(idSelect, selectedVal){$j.post("<?php echo url_for('@ajax_reponse') ?>", { question_id: $j("#dgesco_question_id").val(), selected: selectedVal},
        function(data){$j(idSelect).html(data);});
						
        if ($j("#dgesco_question_id").val() == "")
            $j(idSelect).attr('disabled', 'disabled');
        else
            $j(idSelect).removeAttr('disabled');
  }
 */
</script>


<?php
echo jq_form_remote_tag(array(
    'update' => 'div_dgesco',
    'url' => 'dgesco/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?eleve_id=' . $form->getObject()->getEleveId() . '&id=' . $form->getObject()->getId(): '')))
?>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>

          <?php if (!$form->getObject()->isNew()): ?>
            
          <?php endif; ?>
          <input type="submit" value="Enregistrer et passer à la question suivante"   />&nbsp	 
		           
		         <?php
                echo jq_button_to_remote('Retour à la liste', array(
                    'url' => 'dgesco/index?eleve_id=' . $form->getObject()->getEleveId(),
                    'update' => 'div_dgesco',
                ))
                ?>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
		<?php //echo $form ?>
		 <tr>
            <th><?php echo $form['question_id']->renderLabel('Question :') ?></th>
            <td>
                <?php echo '<strong>'.$form->getObject()->getQuestion().'</strong>' ?>
	
            </td>
            <td>
                <?php echo $form['question_id']->renderError() ?>
            </td>
        </tr>
        
        <tr>
            <th><?php echo $form['reponse_id']->renderLabel('Sélectioner la réponse : ') ?></th>
            <td>
                <?php echo '<small>'.$form['reponse_id'].'</small>' ?>
            </td>
            <td>
                <?php echo $form['reponse_id']->renderError() ?>
            </td>            
        </tr> 
                
        <tr>
            <th><?php echo $form['libelle_reponse']->renderLabel('Réponse selectionnée :') ?></th>
            <td>
                <?php
				//libelle du secteur de l'ERF
				//////////////////////////////////
				$secteur_user = sfContext::getInstance()->getUser()->getAttribute('secteur');
			
				//année scolaire en cours
				///////////////////////////
				$anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours()->getDatedebutanneescolaire();
				
				//contruction de la clef de cryptage
				////////////////////////////////////
				$clef_cryptage = $anneeScolaire.'azertyazertyazerty'.$secteur_user;
				
				
				if(strlen($form->getObject()->getLibelleReponse()) > 0){
				$reponse = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$clef_cryptage, base64_decode($form->getObject()->getLibelleReponse()), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
				echo '<strong>'.$reponse.'</strong>';
				}else{ echo '';} ?>
            </td>
            <td>
                <?php echo $form['libelle_reponse']->renderError() ?>
                
            </td>            
        </tr>
       
      </tr>
    </tbody>
  </table>
</form>

<?php 
foreach($form->getErrorSchema()->getErrors() as $e) {
  echo $e->__toString();          
}
?>
