<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('reponse/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php // echo $form->renderHiddenFields(true) ?>
          &nbsp;<a href="<?php echo url_for('question/edit?id='.$form->getObject()->getQuestionId()) ?>"><button>Retour à la Question</button></a>
          <?php if (!$form->getObject()->isNew()): ?>
		  <input type="hidden" name="sf_method" value="put" />
            &nbsp;<?php echo link_to('<button>Supprimer</button>', 'reponse/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
	  	<tr>
        <th><?php echo $form['num_reponse']->renderLabel('N° de codage : (*)') ?></th>
        <td>
          <?php echo $form['num_reponse']->renderError() ?>
          <?php echo $form['num_reponse'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['reponse']->renderLabel() ?></th>
        <td>
          <?php echo $form['reponse']->renderError() ?>
          <?php echo $form['reponse'] ?>
        </td>
      </tr>

      <tr>
        <th><?php echo $form['libelle_reponse']->renderLabel('Libellé de la Réponse : (*)') ?></th>
        <td>
          <?php echo $form['libelle_reponse']->renderError() ?>
          <?php echo $form['libelle_reponse'] ?>
        </td>
      </tr>
	   <tr>
        <th><?php echo $form['degreetabsco']->renderLabel('Scolarité de degré : (*)') ?></th>
        <td>
          <?php echo $form['degreetabsco']->renderError() ?>
          <?php echo $form['degreetabsco'] ?>
        </td>
      </tr>
	  

	  

	  
	  	 <tr>
        <th><?php echo $form['question_id']->renderLabel(' ') ?></th>
        <td>
          <?php echo $form['question_id']->renderError() ?>
          <?php echo $form['question_id'] ?>
        </td>
      </tr>

    </tbody>
  </table>
</form>
