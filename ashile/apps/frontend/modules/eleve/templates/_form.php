<?php //use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('Text') ?>
<?php use_helper('jQuery') ?>
<?php use_javascript('eleve.js') ?>


<!-- Premier script qui presente les quartiers de la commune selectionée -->
<script>
    $j(document).ready(function(){
        $j.post("<?php echo url_for('@ajax_commune') ?>", {quartier_id: $j("#eleve_quartier_id").val()}, function(data){$j("commune").html(data)});
        $j("#eleve_quartier_id").change(function(){$j.post("<?php echo url_for('@ajax_commune') ?>", {quartier_id: $j("#eleve_quartier_id").val()}, function(data){$j("commune").html(data)});});
    });
</script>

<?php
$idEleve = $form->getObject()->getId();
sfContext::getInstance()->setAttribute('eleve_id', $idEleve);
//affichage du nom de l'eleve
if (!$form->getObject()->isNew()):
    echo 'Edition de la fiche de l\'élève : ' . Doctrine::getTable('Eleve')->find($idEleve)->getNom() . ' ' . Doctrine::getTable('Eleve')->find($idEleve)->getPrenom();
endif;
?>
<?php

     //   if(sfContext::getInstance()->getUser()->getGuardUser()->hasGroup('acad')):
		//	echo '&nbsp;&nbsp;<a href="'.link_to_academie('', array('module' => 'eleve', 'action' => 'recherche','eleve_id'=>$form->getobject()->getId(),'eleve_nom'=>$form->getobject()->getNom(),'eleve_prenom'=>$form->getobject()->getPrenom(),flag_recherche => 1)).'"><button align="right">Retour interface Académique</button></a>';
		//endif;
 
?>
<?php if($count_scolarite_en_cours == 0 && $count_scolarite_spe_en_cours == 0) {$scolarite ='<font color="red"><b>Scolarité</b></font>';}?>
<?php if($count_scolarite_en_cours != 0 && $count_scolarite_spe_en_cours == 0){ $scolarite ='Scolarité';}?>
<?php if($count_scolarite_en_cours != 0 && $count_scolarite_spe_en_cours != 0){ $scolarite ='Scolarité';}?>
<?php if($count_scolarite_en_cours == 0 && $count_scolarite_spe_en_cours != 0){ $scolarite ='Scolarité';}?>

<?php if($count_sessad_alerte != 0){ $sessad ='<font color="red"><b>Sessad</b></font>';}else{$sessad ='Sessad';} ?>
<?php if($count_transport_alerte != 0){ $transport ='<font color="red"><b>Transport</b></font>';}else{$transport ='Transport';} ?>

	<div id="tab_eleve">
		<ul>
			<li><a href="#div_synthese" >Synthese</a></li>
			<li><a href="#div_eleve">Elève</a></li>
			<li><a href="#div_tuteur">Responsable</a></li>
			<li><a href="#div_scolarite"><?php echo $scolarite ?></a></li>
			<li><a href="#div_histo">Histo</a></li>
			<li><a href="#div_mdph">Mdph</a></li>
			<li><a href="#div_avs">Acc.</a></li>
			<li><a href="#div_materiel">Matériel</a></li>
			<li><a href="#div_transport"><?php echo $transport?></a></li>
			<li><a href="#div_sessad"><?php echo $sessad ?></a></li>
			<li><a href="#div_reunion">Reunions</a></li>
			<li><a href="#div_suivitext">Suivi ext.</a></li>
			<li><a href="#div_dgesco">DGeSco</a></li>
		</ul>
		

		<div id="div_eleve">
		<!-- ouvre la fenetre modal de eleve(identite) -->
		  <div class= 'aide' onClick="aide_eleve()"></div> 
			<form name="eleve" action="<?php echo url_for('eleve/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" onsubmit="return ValiderForm()" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
				<?php if (!$form->getObject()->isNew()): ?>
					<input type="hidden" name="sf_method" value="put" />
				<?php endif; ?>
				<?php echo $form->renderGlobalErrors() ?>
				<fieldset>
					<legend>Informations personnelles
					
					
					</legend>
					<?php //echo $form['ine']->renderRow();
							echo ' N° élève :&nbsp;'.'<b>'.$form->getObject()->getId()."</b>";
					 ?>
					<?php //echo $form['numeromdph']->renderRow();
							//echo '</br> N° MDPH :'."<b>".$form->getObject()->getNumeromdph()."<b>";
					 ?>
				    <?php echo $form['numeromdph']->renderRow() ?>
					<?php echo 'Nom  (*)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$form['nom'].'<a class="info" href="#"><bold><big>&nbsp;&nbsp;<img  src="../../../images/mini_aide.png"></big></bold><span>Nom au moins 3 caractères</span></a><br />'?>
					<?php echo $form['prenom']->renderRow() ?>
					<?php echo $form['datenaissance']->renderRow(); ?>
					<?php echo $form['sexe']->renderRow() ?></br>
					<?php echo $form['notes']->renderRow() ?>
				</fieldset>
				<fieldset>
					<legend>Adresse</legend>
					<?php echo $form['adresseelevebat']->renderRow() ?>
					<?php echo $form['adresseleverue']->renderRow() ?>
					<?php echo $form['quartier_id']->renderRow() ?>
					<p><label>Commune :</label><commune></commune></p>
				</fieldset>
				<fieldset>
					<legend>Fin de suivi et PPS</legend>
					<!--<i>Attention si vous renseignez ces champs, l'eleve sortira definitivement de l'application</i></br></br> -->
					<?php echo $form['datesortie']->renderRow() ?>
					<?php echo $form['motif']->renderRow() ?>
					<?php echo $form['pps_id']->renderRow() ?>
				</fieldset>
				<p class="positionBouton">
					<?php echo $form->renderHiddenFields(false) ?>

					<?php if (!$form->getObject()->isNew()): ?>
						<?php echo link_to('<button>Supprimer</button>', 'eleve/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'etes-vous sur ?')) ?>
					<?php endif; ?>
					<?php $value = $form->getObject()->isNew() ? 'Effacer' : 'Rafraichir' ?>
					<input type="reset" value="<?php echo $value ?>" /> 
					<!-- <input type="submit" value="Enregistrer" /> -->
					   <INPUT type="button" name="bouton" value="Enregistrer" onClick="ValiderForm()" />
					   					<?php
					if (!$form->getObject()->isNew() && $sf_request->getParameter('academie') == 'true')
						echo button_to('Retour liste', link_to_academie('', array('module' => 'eleve', 'action' => 'index')));
					else
						echo button_to('Retour liste élève', 'eleve/listeEleve');
					?>
				</p>
				
			</form>
			<block></block>
			<block><small>champs Obligatoires (*), <b><FONT color="#298A08">champs Obligatoires pour Enquête DGESCO (*)</small></b></font></block>
		</div>
		<div class="TabbedPanelsContent" id="div_synthese" >
			<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'eleve/synthese?eleve_id=' . $idEleve, 'update' => 'div_synthese'))); ?>
		</div>	
		</div>
		
		<!-- ajouté par FG le 25/09/2014 -->
		<div class="TabbedPanelsContent" id="div_eleve" >
			<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'eleve/id=' . $idEleve, 'update' => 'div_eleve'))); ?>
		</div>   
	   <!-- fin ajout par FG le 25/09/2014 -->		
		<div class="TabbedPanelsContent" id="div_tuteur">
			<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'tuteur/index?eleve_id=' . $idEleve, 'update' => 'div_tuteur')));
				sfContext::getInstance()->getUser()->setAttribute('eleve_id', $idEleve);
			 ?>
		</div>
		<div class="TabbedPanelsContent" id="div_scolarite">
			<div class="TabbedPanelsContent" id="div_orientation">
				<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'orientation/index?eleve_id=' . $idEleve, 'update' => 'div_orientation')));
						   // quand on vient de Academie ajout d'un attribut 'eleveId'      
						   sfContext::getInstance()->getUser()->setAttribute('eleveId', $idEleve);
				 ?>
			</div>
		<div class="TabbedPanelsContent" id="div_modnonsco">
				<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'modnonsco/index?eleve_id=' . $idEleve, 'update' => 'div_modnonsco'))); ?>
		</div>
		</div>
		<div class="TabbedPanelsContent" id="div_histo">
			<div class="TabbedPanelsContent" id="div_orientation_histo">
				<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'orientation/list?eleve_id=' . $idEleve, 'update' => 'div_orientation_histo'))); ?>
			</div>
			<div class="TabbedPanelsContent" id="div_modnonsco_histo">
				<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'modnonsco/list?eleve_id=' . $idEleve, 'update' => 'div_modnonsco_histo'))); ?>
			</div>
		</div>
		<div class="TabbedPanelsContent" id="div_mdph">
			<?php echo jq_javascript_tag(jq_remote_function(array('update' => 'div_mdph', 'url' => 'mdph/index?eleve_id=' . $idEleve,))); ?>
		</div> 

		<div class="TabbedPanelsContent" id="div_avs">
			<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'eleveavs/index?eleve_id=' . $idEleve, 'update' => 'div_avs'))); ?>
		</div>
		<div class="TabbedPanelsContent" id="div_materiel">
			<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'elevemateriel/index?eleve_id=' . $idEleve, 'update' => 'div_materiel'))); ?>
		</div>
		<div class="TabbedPanelsContent" id="div_transport">
			<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'transportobtenu/index?eleve_id=' . $idEleve, 'update' => 'div_transport'))); ?>
		</div>
		<div class="TabbedPanelsContent" id="div_sessad">
			<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'sessadobtenu/index?eleve_id=' . $idEleve, 'update' => 'div_sessad'))); ?>
		</div>
		<div class="TabbedPanelsContent" id="div_reunion">
			<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'reunion/index?eleve_id=' . $idEleve, 'update' => 'div_reunion'))); ?>
		</div>
			<div class="TabbedPanelsContent" id="div_suivitext">
			<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'suivitexterne/index?eleve_id=' . $idEleve, 'update' => 'div_suivitext'))); ?>
		</div>
		<div class="TabbedPanelsContent" id="div_dgesco">
			<?php echo jq_javascript_tag(jq_remote_function(array('url' => 'dgesco/index?eleve_id=' . $idEleve, 'update' => 'div_dgesco'))); ?>
		</div>
	</div>

<?php

function link_to_academie($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateAcademieUrl($name, $parameters);
}
?>

<!-- petite fonction qui interdit l'accé aux differents onglets si eleve n'existe pas -->
<script type="text/javascript">
<?php if (!isset($idEleve)): ?>
            $j( "#tab_eleve" ).tabs({ disabled: [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] });
            var disabled = $j( "#tab_eleve" ).tabs( "option", "disabled" );
            $j( "#tab_eleve" ).tabs( "option", "disabled", [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] );
<?php endif; ?>
        $j( "#tab_eleve" ).tabs({ selected: 13 });
</script>

<!-- Le second script pour le pop up d'aide -->

<script>

		
	function aide_eleve() {
	var src = "<?php echo url_for('eleve/aide#synthese') ?>";
		$j.modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
			closeHTML:"",
			containerCss:{
				backgroundColor:"#fff",
				borderColor:"#fff",
				height:450,
				padding:0,
				width:600
			},
			overlayClose:true
		});
	}


</script>

