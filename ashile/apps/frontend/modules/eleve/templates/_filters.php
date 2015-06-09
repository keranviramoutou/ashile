<?php use_stylesheets_for_form($filters) ?>
<?php use_javascripts_for_form($filters) ?>
<?php if ($filters->hasGlobalErrors()): ?>
    <?php echo $filters->renderGlobalErrors() ?>
<?php endif; ?>
<form class="lien_ajax" action="<?php echo url_for('eleve/filter') ?>" method="post">
    <?php echo $filters ?>
    <?php echo $filters->renderHiddenFields() ?>
    <input type="submit" value="Filter" /> &nbsp; <a class="lien_ajax" href="<?php echo url_for('eleve/filter?_reset=1') ?>">Initialiser</a>
</form>
