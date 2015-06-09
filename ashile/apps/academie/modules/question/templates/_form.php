<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('question/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<?php echo button_to('Retour à la Liste','question/index') ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('<button>Supprimer cette question</button>', 'question/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Etes vous sur?')) ?>
             <?php //echo button_to('Créer une Réponse possible', 'reponse/new?question_id='.$form->getObject()->getId()) ?>    
						<?php echo link_to('<u><b><button>Créer une réponse </button></b></u>', 'reponse/popup?question_id='.$form->getObject()->getId(), 
          array('popup' => array('popupWindow', 'width=650,height=300,left=350,top=60','scrollbars=yes')) )  ?>
			 
		<?php endif; ?>

		 

          <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
	        <tr>
        <th><?php echo $form['num_question']->renderLabel('N° Question :(*)') ?></th>
        <td>
          <?php echo $form['num_question']->renderError() ?>
          <?php echo $form['num_question'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['question']->renderLabel() ?></th>
        <td>
          <?php echo $form['question']->renderError() ?>
          <?php echo $form['question'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
