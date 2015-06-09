<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('Text') ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>
<?php use_javascript('tuteur.js') ?>

<?php $tuteurLegals = Doctrine_core::getTable('Tuteur')->existTuteurLegals($form->getObject()->getEleveId()) ?>
<?php if ($tuteurLegals): ?>
    <script >
        $j(document).ready(function(){
		
		document.body.style.cursor='default';
			
	<!-- on va donner une valeur aux champ de tuteur-->
	$j('#tuteur_new_ResponsableEleve_adresserue').val('<?php echo $adresseRue; ?>') ;
	$j('#tuteur_new_ResponsableEleve_adressebat').val('<?php echo $adresseBat; ?>') ;
	$j('#tuteur_new_ResponsableEleve_quartier_id').val('<?php echo $quartierId; ?>') ;
	$j('#tuteur_new_ResponsableEleve_nom').val('<?php echo $nom; ?>') ;	
	<!------------------------------------------------->			

    <?php
    $existTuteurLegal = 'false';
    $isTuteurLegal = 'false';
	$nbtuteur =0;
    foreach ($tuteurLegals as $tuteurLegal):
        if ($tuteurLegal->getTuteurlegal() == true) {
            $existTuteurLegal = 'true';
			$nbtuteur++;
            if (!$form->getObject()->isNew() &&
                    ($tuteurLegal->getEleveId() == $form->getObject()->getEleveId() &&
                    $tuteurLegal->getResponsableeleveId() == $form->getObject()->getResponsableeleveId()))
                //$isTuteurLegal = 'true';
            break;
        }
    endforeach;
    ?>
            existTuteurLegal = <?php echo $existTuteurLegal ?>;
            isTuteurLegal = <?php echo $isTuteurLegal ?>;
			nbtuteur = <?php echo $nbtuteur ?>;
            $j("#tuteur_tuteurlegal").change(function(){
			     // if(($j("#tuteur_tuteurlegal").attr('checked') && existTuteurLegal == true) && (isTuteurLegal ==  false))
               // if(($j("#tuteur_tuteurlegal").attr('checked') && nbtuteur > 2))
			    if( nbtuteur > 2){
                    alert('il existe déja deux responsables légaux ');
					$j("#tuteur_tuteurlegal").removeAttr('checked');
					}
            });
        });
    </script>
<?php endif; ?>

<!-- ouvre la fenetre modal de eleve(tuteur) -->
     <div class= 'aide' onClick="aide_tuteur()"></div> 
  		<?php //echo 'nnn'.$nbtuteur ?>	  
<?php
echo jq_form_remote_tag(array(
    'update' => 'div_tuteur',
    'url' => 'tuteur/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?eleve_id=' . $form->getObject()->getEleveId() . '&responsableeleve_id=' . $form->getObject()->getResponsableeleveId() : '')

	))
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
                    <?php echo jq_button_to_remote('Supprimer', array('url' => 'tuteur/delete?eleve_id=' . $form->getObject()->getEleveId() . '&responsableeleve_id=' . $form->getObject()->getResponsableeleveId(), 'update' => 'div_tuteur', 'confirm' => 'Vous êtes sûr?')) ?>
                <?php endif; ?>
			
                <!--<input type="submit" value="Enregistrer" /> -->&nbsp;  <INPUT type="submit" name="bouton" value="Enregistrer" onClick="return verif_tuteur()" />
				                <?php
                echo jq_button_to_remote('Retour', array(
                    'url' => 'tuteur/index?eleve_id=' . $sf_request->getUrlParameter('eleve_id'),
                    'update' => 'div_tuteur',
                ))
                ?>

				
            </td>
        </tr>
		<?php //echo 'gggg'.$nbtuteur ; ?>
    </tfoot>
    <tbody>
        <?php echo $form->renderGlobalErrors() ?>
        <tr>
            <th><?php echo $form['tuteurlegal']->renderLabel('Représentant légal : ' ) ?></th>
            <td>
                <?php echo $form['tuteurlegal']->renderError() ?>
                <?php echo $form['tuteurlegal'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['typeresponsableeleve_id']->renderLabel('Lien parental : *') ?></th>
            <td  onclick="activer()" >
                <?php echo $form['typeresponsableeleve_id']->renderError() ?>
                <?php echo $form['typeresponsableeleve_id']->render(array("onchange" => "alert('si autre saisir un autre lien!')" )); ?>  
            </td>
		</tr>
        <tr>		
			<th><?php echo $form['autretyperesponsable']->renderLabel('Lien autre :') ?></th>
            <td>
                <?php echo $form['autretyperesponsable']->renderError() ?>
                <?php echo $form['autretyperesponsable'] ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                    <h1>Informations personnelles</h1>
                    <?php $indice = $form->getObject()->isNew() ? 'new_ResponsableEleve' : 'ResponsableEleve' ?>
                    <?php echo $form[$indice]->renderError() ?>
                    <?php echo $form[$indice] ?>
            </td>
        </tr>
    </tbody>
</table>
</form>


<script>
	function aide_tuteur() {
	var src = "<?php echo url_for('tuteur/aide') ?>";
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
	}


</script>


