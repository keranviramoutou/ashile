<?php //use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>
<?php use_javascript('orentation.js') ?>

<script language="javascript">
	

    $j(function() {
        $j("#accordion").accordion({ collapsible: true, active: false, clearStyle: true});
    });
    $j(document).ready(function(){
		
	//alert($j("#autocomplete_orientation_etabsco_id").val()); ----------> OK
		
        // Au lancement si la valeur de l'etabsco est une chaine vide, ça veut dire "Veulliez choisir",
        // le choix de la classe est desactivé
		<?php $classeIncluId = ($form->getObject()->isNew()) ? '#orientation_new_Inclusion_classe_id' : '#orientation_Inclusion_classe_id' ?>
        classeIncluId = "<?php echo $classeIncluId ?>";
        if ($j("#autocomplete_orientation_etabsco_id").val() == "")
         //   $j("#orientation_classe_id, #inclusion_classe_id").attr('disabled', 'disabled');
		  $j("#orientation_classe_id, #inclusion_classe_id").attr('enabled', 'enabled');
        else{
			
				//alert($j("#autocomplete_orientation_etabsco_id").val()); //--------> OK
				
				//alert($j("#orientation_classe_id").val()); // -!!!! KO  retourne NULL !!!
				
				//alert($j("#orientation_niveauscolaire_id").val()); //--------------> OK
	
            executeHtmlSelect("#orientation_classe_id", $j("#orientation_classe_id").val());
            executeHtmlSelect("#inclusion_classe_id", $j("#inclusion_classe_id").val());
		    executeHtmlSelectNiveau("#orientation_niveauscolaire_id", $j("#orientation_niveauscolaire_id").val());
        }
  
        	$j("#orientation_niveauscolaire_id").focus( function(){
			//executeHtmlSelect("#orientation_classe_id, #inclusion_classe_id, #orientation_niveauscolaire_id", null);
			
		    executeHtmlSelectNiveau("#orientation_niveauscolaire_id", null);
			});
			
		  $j("#orientation_classe_id").focus( function(){
			//executeHtmlSelect("#orientation_classe_id, #inclusion_classe_id, #orientation_niveauscolaire_id", null);
			executeHtmlSelect("#orientation_classe_id, #inclusion_classe_id", null);
			});	
			
        // Quand on change d'etabsco, on appelle la fonction executeHtmlSelect sans parametre #orientation_new_Inclusion_classe_id
        $j("#autocomplete_orientation_etabsco_id").change(function(){
			//initialisation 
				//alert($j("#autocomplete_orientation_etabsco_id").val());
				//alert('choisissez la classe'); commenté par FG
				executeHtmlSelect("#orientation_classe_id, #inclusion_classe_id", null);
				executeHtmlSelectNiveau("#orientation_niveauscolaire_id", null);

				});
		});

 
   
    /*
     * Cette fonction poste l'url qui appelle la fonction ajax pour avoir les resultats de la liste des classes appartenant à l'
     * etabsco choisi. Et change les options de select classe par le resultat de la requete (voir action executeAjaxClasse, et son template)
     * parametre: selectedVal, la classe en cas de edit, sera selectionné par defaut
     * */
     
    function executeHtmlSelect(idSelect, selectedVal){
        // Ici on poste l'url pour appleler le module action (voir routing.yml), avec des paramettre etabsoo_id et selectedVal
        //alert($j("#orientation_etabsco_id").val());
        $j.post("<?php echo url_for('@ajax_classe') ?>", { etabsco_id: $j("#orientation_etabsco_id").val(), selected: selectedVal},
        // Changer les options de select
        function(data){$j(idSelect).html(data);});
        if ($j("#orientation_etabsco_id").val() == "")
        // Desactiver classe si aucun etabsco choisi
          //  $j(idSelect).attr('disabled', 'disabled');
			   $j(idSelect).attr('enabled', 'enabled');
        else
        // Sinon reactiver
            $j(idSelect).removeAttr('disabled');
    }
	
	
	
		 function executeHtmlSelectNiveau(id2Select, selectedVal){
        // Ici on poste l'url pour appleler le module action (voir routing.yml), avec des paramettre etabso_id et selectedVal
        //alert($j("#orientation_etabsco_id").val());
			
        $j.post("<?php echo url_for('@ajax_niveau') ?>", { etabsco_id: $j("#orientation_etabsco_id").val(), selected: selectedVal},
        // Changer les options de select
        function(data2){$j(id2Select).html(data2);});
        if ($j("#orientation_etabsco_id").val() == "")
        // Desactiver le nievau si aucun etabsco choisi
           // $j(id2Select).attr('disabled', 'disabled');
		   $j(idSelect).attr('enabled', 'enabled');
        else
		
	
        // Sinon reactiver
            $j(id2Select).removeAttr('disabled');
				
    }
</script>



<form action="<?php echo url_for('orientation/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
	  
	  
	 <!-------------------------------------------------------------------->

    <tfoot>
      <tr>
        <td colspan="3"  >
		<?php $secteur = $sf_request->getParameter('secteur_id') ?>
        		
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('<button>Supprimer</button>', 'orientation/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Etes vous sur ?')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" onclick="return verif_scolarite();" />&nbsp; <button type="button" onclick="location.href='<?php echo url_for('eleve/recherche?eleve_nom='.$sf_request->getParameter('eleve_nom'). '&eleve_prenom=' .$sf_request->getParameter('eleve_prenom').'&eleve_id=' .$sf_request->getParameter('eleve_id').'&flag_recherche=1'  ) ?>'">Retour</button>
								
					
		  
        </td>
      </tr>
    </tfoot>
  
    <!--------------------------------------------------------------------->
    
    
    <tbody>
      <?php //echo $form ?>
 <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<?php echo $form->renderHiddenFields(false) ?>


        <?php echo $form->renderGlobalErrors() ?>
		

        <tr>
            <th><?php echo $form['etabsco_id']->renderLabel('Etablissement : *') ?></th>
            <td>
                <?php echo $form['etabsco_id'] ?>
            </td>
            <td>
                <?php echo $form['etabsco_id']->renderError() ?>
            </td>
        </tr>
		
        <tr>
            <th><?php echo $form['classe_id']->renderLabel('Classe d\'accueil : *') ?></th>
            <td>
                <?php echo $form['classe_id'] ?>
            </td>
            <td>
                <?php echo $form['classe_id']->renderError() ?>
            </td>
            
            
            <th><?php echo $form['libelleclasse']->renderLabel() ?></th>
            <td>
                <?php echo $form['libelleclasse'] ?>
            </td>
            <td>
                <?php echo $form['libelleclasse']->renderError() ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['niveauscolaire_id']->renderLabel('Niveau scolaire : *') ?></th>
            <td>
                <?php echo $form['niveauscolaire_id'] ?>
            </td>
            <td>
                <?php echo $form['niveauscolaire_id']->renderError() ?>
            </td>

            <th><?php echo $form['demijournee_id']->renderLabel() ?></th>
            <td>
                <?php echo $form['demijournee_id'] ?>
            </td>
            <td>
                <?php echo $form['demijournee_id']->renderError() ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['datedebut']->renderLabel('Début de scolarisation :') ?></th>
            <td>
                <?php echo $form['datedebut'] ?>
            </td>
            <td>
                <?php echo $form['datedebut']->renderError() ?>
            </td>
            <th><?php echo $form['datefin']->renderLabel('Fin de scolarisation :') ?></th>
            <td>
                <?php echo $form['datefin'] ?>
            </td>
            <td>
                <?php echo $form['datefin']->renderError() ?>
            </td>
        </tr>
		<tr>
		   <th><?php echo $form['rased_id']->renderLabel('Rased :') ?></th>
            <td>
                <?php echo $form['rased_id'] ?>
            </td>
            <td>
                <?php echo $form['rased_id']->renderError() ?>
            </td>
        </tr>
		
				<tr>
		   <th><?php echo $form['rased2_id']->renderLabel('Rased :') ?></th>
            <td>
                <?php echo $form['rased2_id'] ?>
            </td>
            <td>
                <?php echo $form['rased2_id']->renderError() ?>
            </td>
        </tr>
		<tr>
            <th><?php echo $form['notes']->renderLabel('Notes :') ?></th>
            <td>
                <?php echo $form['notes'] ?>
            </td>
  
        </tr>
    </tbody>
  
</table>
</form>
<?php if (!$form->getObject()->isNew()): ?>
    <?php
    $enseignant = Doctrine_core::getTable('Enseignant')->find($form->getObject()->getEnseignantId());
    
    // la classe d'inclusion est égale à la classe_id selectionnée au départ
    
    $inclusion = Doctrine_core::getTable('Inclusion')->find($form->getObject()->getInclusionId());
    
    
    // Sert à mettre le form en ajax pour le contenu à afficher dans le div eccordeon si c'est orientation qui l'appelle,
    // sinon le personne garde le form standard (voir. transformation _form de personne)
    ?>
    <div id="accordion">
        <h3><a id="titreAccEnseignant" href="#"><?php echo $enseignant ? 'Information sur l\'enseignant' : 'Ajouter un enseignant' ?></a></h3>
        <div id="accEnseignant">
            <?php
            // Si prof n'existe pas encore, le form affiché sera new sinon edit
            echo $enseignant ? jq_javascript_tag(jq_remote_function(array('update' => 'accEnseignant', 'url' => 'enseignant/edit?id=' . $form->getObject()->getEnseignantId() . '&orientation=' . $form->getObject()->getId()))) :
                    jq_javascript_tag(jq_remote_function(array('update' => 'accEnseignant', 'url' => 'enseignant/new?orientation=' . $form->getObject())))
            ?>
        </div>
        <h3><a id="titreAccInclu" href="#"><?php echo $inclusion ? 'Information sur la classe d\'inclusion' : 'Ajouter une classe d\'inclusion' ?></a></h3>
        <div id="accClasseInclu">
            <?php
	            echo $inclusion ? jq_javascript_tag(jq_remote_function(array('update' => 'accClasseInclu', 'url' => 'inclusion/edit?id=' . $form->getObject()->getInclusionId() . '&orientation=' . $form->getObject()->getId().'&etabsco_id='. $form->getObject()->getEtabscoId()))) :
                    jq_javascript_tag(jq_remote_function(array('update' => 'accClasseInclu', 'url' => 'inclusion/new?orientation=' . $form->getObject()->getId())))
            ?>
        </div>
    </div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error') || $sf_user->hasFlash('notice')): ?>
  <div id="feedback">
    <?php if ($sf_user->hasFlash('error')): ?>
    	<p class="error-box">
    		<?php echo $sf_user->getFlash('error') ?>
    	</p>
    <?php endif; ?>
 
    <?php if ($sf_user->hasFlash('notice')): ?>
    	<p class="notice-box">
    		<?php echo $sf_user->getFlash('notice') ?>
    	</p>
    <?php endif; ?>
  </div>
<?php endif; ?>


<?php  
	   //selection de l'année scolaire en cours
		$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
		$deb = $annee->getDatedebutanneescolaire();
		$fin = $annee->getDatefinanneescolaire();
		$affiche_deb =  format_date($deb,'dd/MM/yyyy');
		$affiche_fin =   format_date($fin,'dd/MM/yyyy');
		$orientation = Doctrine_Core::getTable('Orientation')->getDerScoMax( $form['eleve_id']->getvalue());
  	// echo  $orientation[0]['datefin'].'ggggggggggggggggggggggg'.$form['eleve_id']->getvalue() ;
?>
<script>
  
</script>
