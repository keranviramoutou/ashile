<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('mail/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          		   <button type="button" onclick="location.href='<?php echo url_for('mail/index' ) ?>'">Retour</button>
				
          <?php if (!$form->getObject()->isNew()): ?>
		     <?php echo button_to('Envoi mail à l\'ERF', 'mail/envoimessage?sujet='.$form->getObject()->getSujet() . '&destinataire='.$form->getObject()->getsfGuardUser_id().'&texte='.$form->getObject()->getTexte().'&mail_id='.$form->getObject()->getId()) ?>
            &nbsp; &nbsp;<?php echo button_to('Supprimer', 'mail/delete?id='.$form->getObject()->getId(), 'confirm = etes vous sur ? popup=true') ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
	  <div class='aide' onClick="<?php echo url_for('mail/aide') ?>"> </div>
      <tr>
        <th><?php echo $form['eleve_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['eleve_id']->renderError() ?>
          <?php echo $form['eleve_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sfGuardUser_id']->renderLabel('ERF destinataire :*') ?></th>
        <td>
          <?php echo $form['sfGuardUser_id']->renderError() ?>
          <?php echo $form['sfGuardUser_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['date']->renderLabel() ?></th>
        <td>
          <?php echo $form['date']->renderError() ?>
          <?php echo $form['date'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sujet']->renderLabel() ?></th>
        <td>
          <?php echo $form['sujet']->renderError() ?>
          <?php echo $form['sujet'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['texte']->renderLabel() ?></th>
        <td>
          <?php echo $form['texte']->renderError() ?>
          <?php echo $form['texte'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>


<script>
var src = "<?php echo url_for('mail/aide') ?>";

$j(document).ready(function(){
        $j('.aide').click(function (){
                $j.modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
                        closeHTML:"",
                        containerCss:{
                                backgroundColor:"#fff",
                                borderColor:"#fff",
                                height:450,
                                padding:0,
                                width:830
                        },
                        overlayClose:true
                });
        });
});

</script>