<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form  onsubmit="CloseAndRefresh()" action="<?php echo url_for('mouvement_materiel/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
		       
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Supprimer', 'mouvement_materiel/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
        <input type="submit" value="Enregistrer" /> <button type="button" onclick="window.close()" >Fermer</button>
		  </td>
      </tr>
    </tfoot>
    <tbody >
      <?php echo $form->renderGlobalErrors() ?>
            <tr>
        <th><?php echo $form['materiel_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['materiel_id']->renderError() ?>
          <?php echo $form['materiel_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['mouvement_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['mouvement_id']->renderError() ?>
          <?php echo $form['mouvement_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['datedebut']->renderLabel('date début') ?></th>
        <td>
          <?php echo $form['datedebut']->renderError() ?>
          <?php echo $form['datedebut'] ?>
        </td>
      </tr>
	  

	   <?php if (!$form->getObject()->isNew()){ ?>
      <tr>
        <th><?php echo $form['datefin']->renderLabel('date de fin') ?></th>
        <td>
          <?php echo $form['datefin']->renderError() ?>
          <?php echo $form['datefin'] ?>
		
        </td>
      </tr>
	  <?php } ?>
	  <tr>
        <th><?php echo $form['notes']->renderLabel() ?></th>
        <td>
          <?php echo $form['notes']->renderError() ?>
          <?php echo $form['notes'] ?>
        </td>
      </tr>

    </tbody>
  </table>
</form>
<script>
 function CloseAndRefresh()
{
 
fencent.close();
window.close();
opener.location.reload(true);
//opener.location.href=url;  
 self.close(); 
 top.close() 
//document.forms.submit(); 

}


function zone() 
{ window.opener.location.href=idzone;return(true); window.close(); }
</script>