
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Javascript'); ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('modalbox.js') ?>
<?php use_helper('Date') ?>


<?php echo jq_form_remote_tag(array(
		 'update'=>'form_result',
		 'url'=>'mail/new'
		 )); ?>
<div id="form_result">
    <div class="form_row">
	    <?php echo 'ggggggg' ?>
        <?php //echo label_for('comment','Comment'); ?>
        <?php //echo textarea_tag('comment','',array('class'=>'comment')); ?>
    </div>
    <div class="form_row form_submit"><?php //echo submit_tag('Ajout contrat',array('class'=>'submit')); ?></div>
</div>
<div class="form_row"><center><a href="#" title="Close window" onclick="Modalbox.hide(); return false;">Close (X)</a></center></div>
</form>