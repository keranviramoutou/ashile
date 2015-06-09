<?php use_stylesheet('main.css') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>


<h3>Dossier MDPH > Demande d'accompagnant >  Suivi de la Demande de Poste</h3>
<fieldset>
<?php include_partial('form', array('form' => $form)) ?>
</fieldset>