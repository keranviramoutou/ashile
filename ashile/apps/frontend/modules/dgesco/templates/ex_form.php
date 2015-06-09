<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<script language="javascript">
    $j(document).ready(function(){
        if ($j("#dgesco_question_id").val() == "")
            $j("#dgesco_reponse_id").attr('disabled', 'disabled');
        else{
            executeHtmlSelect("#dgesco_reponse_id", $j("#dgesco_reponse_id").val());
        }
        $j("#dgesco_question_id").change( function() {executeHtmlSelect("#dgesco_reponse_id", null);});
    });
    function executeHtmlSelect(idSelect, selectedVal){
        $j.post("<?php echo url_for('@ajax_reponse') ?>", { question_id: $j("#dgesco_question_id").val(), selected: selectedVal},
        function(data){$j(idSelect).html(data);});
        if ($j("#dgesco_question_id").val() == "")
            $j(idSelect).attr('disabled', 'disabled');
        else
            $j(idSelect).removeAttr('disabled');
    }
</script>
<?php
echo jq_form_remote_tag(array(
    'update' => 'div_dgesco',
    'url' => url_for('dgesco/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : ''))))
?>
<form action="<?php echo url_for('dgesco/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <?php echo $form ?>
    <?php echo jq_button_to_remote('Retour liste', array('url' => 'dgesco/index?eleve_id=' . $form->getObject()->getEleveId(), 'update' => 'div_dgesco')) ?>
    <?php if (!$form->getObject()->isNew()): ?>
    <?php echo jq_button_to_remote('Supprimer', array('url' => 'dgesco/delete?id=' . $form->getObject()->getId(), 'update' => 'div_dgesco', 'confirm' => 'Etes-vous sûr de vouloir supprimer ce Dgesco ?')) ?>
    <?php endif; ?>
    <input type="submit" value="Enregistrer" />
</form>
