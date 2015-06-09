<script>
$j = jQuery.noConflict();
jQuery(function(j$){
	   		   
	//Lorsque vous cliquez sur un lien de la classe poplight
	$j('a.poplight').on('click', function() {
		var popID = $j(this).data('rel'); //Trouver la pop-up correspondante
		var popWidth = $j(this).data('width'); //Trouver la largeur

		//Faire apparaitre la pop-up et ajouter le bouton de fermeture
		$j('#' + popID).fadeIn().css({ 'width': popWidth}).prepend('<a href="#" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>');
		
		//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
		var popMargTop = ($j('#' + popID).height() + 80) / 2;
		var popMargLeft = ($j('#' + popID).width() + 80) / 2;
		
		//Apply Margin to Popup
		$j('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues d'anciennes versions de IE
		$j('body').append('<div id="fade"></div>');
		$j('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
		
		return false;
	});
	
	
	//Close Popups and Fade Layer
	$j('body').on('click', 'a.close, #fade', function() { //Au clic sur le body...
		$j('#fade , .popup_block').fadeOut(function() {
			$j('#fade, a.close').remove();  
	}); //...ils disparaissent ensemble
		
		return false;
	});

 
});
</script>

<!--- STYLE SCROLL --->
<style>
.menuScroll{	
overflow-y: scroll;
overflow-x: hidden;
}
</style>
<!-------------------->


<!-- TEST MENU VERTICAL 3 NIVEAUX -----------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------------------->
    <ul id="rad0" class="radmc">
		

		<li>  <a href="<?php echo url_for('eleve/recherche') ?>"><span>Recherche élève </span></a></li>
		<li> <a href="<?php echo url_for('avs/recherche') ?>"><span>Recherche Accompagnant</span></a></li>
		          <a href="#;">New Item</a><li>
          <a class="radparent" href="#;">Eleves</a>
          <ul><li>
            <a href="<?php echo url_for('eleve/recherche') ?>"><span>Recherche, création élève</span></a></li><li>
            <a href="<?php echo url_for('secteur/recherche') ?>"><span>Liste par secteur</span></a><li>
			<a href="<?php echo url_for('eleve/suppr') ?>"><span>Suppression élève</span></a></li>
          </ul></li>
		<li>
		<li>
		<a class="radparent" href="#">Gestion des Accompagnants</a>
		<ul>
			<li>
				<a href="<?php echo url_for('avs/recherche') ?>"><span>Recherche ou création Acc.</span></a>
			</li>
			<li>
				<a href="<?php echo url_for('type_contrat_avs/recherche') ?>"><span>Liste des contrats par type ou des Acc. sans contrats</a>
			</li>
			<li>
              <a class="radparent" href="#">Gestion des affectations</a>
		  <ul>
			  <li>
				  <a href="<?php echo url_for('secteur/recherche1') ?>"><span>Affectations par secteur</span></a>
				  <a href="<?php echo url_for('secteur/recherche2') ?>"><span>Elèves par secteur sans personnel acc.</span></a>
			 </li>
		  </ul>	
		  </li>
      </ul></li><li>
			<a class="radparent" href="#">Dossier MDPH</a>
			<ul>
				<li>
				<a href="#"></a>
				</li>
				<li> 	
				    <a href="<?php echo url_for('eleve/transfertmdph') ?>"><span>Transfert de dossier </span></a>
					 <a href="<?php echo url_for('mdph/supprMdph') ?>"><span>Suppression de dossier </span></a>
					<a class="radparent" href="#">Demande d'accompagnant</a>
					<ul>
						<li>
							<a href="<?php echo url_for('@DemandeAvs') ?>"><span>Traitement CDA </span></a>
						</li>
						<li>
							<a href="<?php echo url_for('suiviDSM/list') ?>"><span>Suivi de la Demande</span></a>
						</li>
						<li>
							<a href="<?php echo url_for('@AttMoyDemandeAvs') ?>"><span>Affectation des Acc.</span></a>
						</li>
						<li>
							<a href="<?php echo url_for('secteur/recherche1') ?>"><span>Affectations par secteur</span></a>
						</li>
					</ul>
					
					<a class="radparent" href="#">Demande Materiel</a>
					<ul>
						<li>
							<a href="<?php echo url_for('@DemandeMateriel') ?>"><span>Traitement CDA </span></a></li><!-- etape 1/ on renseigne la décision CDA depuis la liste des demandesmateriel-->
						</li>
						<li>
							<a href="<?php echo url_for('@traitementcda') ?>"><span>Traitement CDA par lot </span></a></li>                               
						</li>
						<li>
							<a href="<?php echo url_for('demandemateriel/rdd') ?>"><span>Traitement RDD <small>(prolongation)</small></span></a></li>
						</li>

						<li>
							<a href="<?php echo url_for('@AttMoyDemandeMateriel') ?>"><span>Affectation des ressources</span></a></li><!-- etape 2/ on affecte un matériel aux demandesmateriel validée CDA -->	
						</li>
					</ul>

							<a class="radparent" href="#">Demande Sessad</a>
					<ul>
						<li>
							<a href="<?php echo url_for('@DemandeSessad') ?>"><span>Traitement CDA  </span></a></li>
						</li>
						<li>
							<a href="<?php echo url_for('@AttMoyDemandeSessad') ?>"><span>Affectation des ressources</span></a></li>                               
						</li>
						<li>
							<a href="<?php echo url_for('sessad_obtenu/index') ?>"><span>Sessad obtenus</span></a></li>
						</li>
					</ul>

							<a class="radparent" href="#">Demande d'Orientation</a>
					<ul>
						<li>
							<a href="<?php echo url_for('@DemandeOrientation') ?>"><span>Traitement CDA </span></a></li>
						</li>

						<li>
							<a href="<?php echo url_for('@AttMoyDemandeOrientation') ?>"><span>Demandes avec décision CDA</span></a></li>                    
						</li>
					</ul>
							<a class="radparent" href="#">Demande de Transport</a>
                    <ul>
                        <li>
							<a href="<?php echo url_for('@DemandeTransport') ?> "><span>Traitement CDA </span></a>
						</li>
						<li>
							<a href="<?php echo url_for('@AttMoyDemandeTransport') ?>"><span>Affectation des ressources</span></a>
						</li>
                        <li>
							<a href="<?php echo url_for('transport_obtenu/index') ?>"><span>Transports obtenus</span></a>
						</li>
                    </ul>
                    </li>

				</li>
        <li>
      </ul></li>
      
      
       <a href="#;">New Item</a>
			<li>
        <a class="radparent" href="#">Materiels</a>
       		<ul>
				<li>
				<a href="#"></a>
			<a href=<?php echo url_for('eleve_materiel/recherche') ?>>Recherche </a></li><li>
			<a href="<?php echo url_for('materiel/new') ?>">Création </a></li><li>
			<a href="<?php echo url_for('materiel/traitementMat') ?>">Numérotation matériel en stock</a></li><li>
			<a href="<?php echo url_for('@AttMoyDemandeMateriel') ?>">Liste des élèves en attente d'attribution </a></li><li>
			<a href="<?php echo url_for('secteur/recherche3') ?>"> Bons de livraison</a></li>
   
			</li>
		</ul>
         </li> 

						<li>
							<a href="#;"><span>Enquête DGESCO</span></a>
							<ul>
								<li>
								<!-- <a href="<?php echo url_for('dgesco/index') ?>"><span>Résultats de l'Enquête</span></a> -->
									<a href="<?php echo url_for('eleve/pbscolarite') ?>" onclick="document.body.style.cursor='wait'; return true;"  ><span>0 - Scolarité incomplète</span></a>
									<a href="<?php echo url_for('@question') ?>"><span>1 - Paramètrage </span></a>
									<a href="<?php echo url_for('dgesco/generation') ?>" onclick="document.body.style.cursor='wait'; return true;"><span>2 - Génération collective</span></a>
									<a href="<?php echo url_for('dgesco/generationindividuelle') ?>" onclick="document.body.style.cursor='wait'; return true;"><span>3 - Génération individuelle</span></a>
									<a href="<?php echo url_for('secteur/recherche4') ?>"><span>3 - Résultats par Secteur</span></a>
									<a href="<?php echo url_for('dgesco/supprindividuelle') ?>"><span>4 - Suppression enquête</span></a>
									<a href="<?php echo url_for('dgesco/vidagedgesco') ?>" onclick="document.body.style.cursor='wait'; return true;"  ><span>5 - Archivage enquête</span></a>
                                </li>
                             </ul>
						</li>	  
	 
          <a href="#;">New Item</a>
  
			
	
						<li>
							<a href="#;"><span>Nomenclature Matériel</span></a>

							<ul>
								<li>
							<a href="<?php echo url_for('@fournisseur') ?>"><span>Fournisseurs</span></a><!-- etape 1/ on renseigne la décision CDA depuis la liste des demandesmateriel-->

							<a href="<?php echo url_for('@typemateriel') ?>"><span>Type de materiel ou demande</span></a>                              

							<a href="<?php echo url_for('catmateriel/index') ?>" onclick="document.body.style.cursor='wait'; return true;"><span>Catégorie de materiel ou demande</span></a><!-- etape 2/ on affecte un matériel aux demandesmateriel validée CDA -->	

							<a href="<?php echo url_for('@mouvement') ?>"><span>Type Mouvement </span></a>

							<a href="<?php echo url_for('traitement/index') ?>"><span>Type traitement de la demande </span></a>
				
							<a href="<?php echo url_for('@marque') ?>"><span>Marque </span></a>
							</li>
							</ul>

						</li>
						<li>
							<a href="#;"><span>Nomenclature Domaine</span></a>
							<ul>
								<li>
									<a href="<?php echo url_for('@anneescolaire') ?>"><span>Année scolaire</span></a>
									<a href="<?php echo url_for('@classe') ?>"><span>Classes ordinaire</span></a>
									<a href="<?php echo url_for('@classespe') ?>"><span>Classe (scolarité ext.)</span></a>
									<a href="<?php echo url_for('classeext/index') ?>"><span>Classe (demande d'orient.)</span></a>
                                	<a href="<?php echo url_for('@commune') ?>"><span>Communes</span></a>
									<a href="<?php echo url_for('@quartier') ?>"><span>Codes postaux</span></a>
									<a href="<?php echo url_for('@circonscription') ?>"><span>Circonscriptions</span></a>
									<a href="<?php echo url_for('@etabsco') ?>"><span>Etablissements scolaire</span></a>
									<a href="<?php echo url_for('@etabnonsco') ?>"><span>Etablissements spé</span></a>
									<a href="<?php echo url_for('typeetablissementnonsco/index') ?>"><span>Famille Etablissement spé</span></a>
									<a href="<?php echo url_for('niveauscolaire') ?>"><span>Niveau scolaire</span></a>
									<a href="<?php echo url_for('niveauscolairespe') ?>"><span>Niveau sco. externe</span></a>
									<a href="<?php echo url_for('naturebilan/index') ?>"><span>Type de pièces comp.</span></a>
									<a href="<?php echo url_for('secteurs/index') ?>"><span>Secteurs</span></a>
									<a href="<?php echo url_for('@secteuretabsco') ?>"><span>Secteur-Etablissements</span></a>
									<a href="<?php echo url_for('@sessad') ?>"><span>Sessad</span></a>
									<a href="<?php echo url_for('@specialite') ?>"><span>Specialites</span></a>
									<a href="<?php echo url_for('@typeresponsableeleve') ?>"><span>Type Responsable</span></a>
									<a href="<?php echo url_for('rased/index') ?>"><span>Type de RASED</span></a>
								    <a href="<?php echo url_for('@transport') ?>"><span>Type Transports</span></a>
								</li>
							</ul>
					   </li>	
						<li>
							<a href="#;"><span>Nomenclature Accompagnant</span></a>
							<ul>
								<li>
								  
									<a href="<?php echo url_for('@naturecontratavs') ?>"><span>Nature contrat </span></a>
									<a href="<?php echo url_for('@typecontratavs') ?>"><span>Type de contrat</span></a>
									<a href="<?php echo url_for('@type_position_avs') ?>"><span>Type position contrat</span></a>
									<a href="<?php echo url_for('conditionsuspensive/index') ?>"><span>Condition suspensive</span></a>									
								</li>
							</ul>
					   </li>
					   
	
		   <a href="#;">New Item</a>

		   <li>
			   <a class="radparent" href="#;">Administration</a>
				<ul>
					<li>
										<a href="<?php echo url_for('orientation/bascule') ?>"><span>Bascule d'année</span></a>
										<a href="<?php echo url_for('eleve/compareSecteurScoSecteurEleve') ?>"><span>Synchronisation Secteur</span></a>
					
									
					</li>

	
									<li>
										<a href="<?php echo url_for('@sfguarduser') ?>"><span>Gestion des utilisateurs</span></a>
									</li>

									<li>

										<a href="<?php echo url_for('@sfguardgroup') ?>"><span>Gestion des groupes</span></a>
									</li>

	

									<li>
									<a href="<?php echo url_for('@sfguardpermission') ?>"><span>Gestion des droits</span></a>
									</li>
			
					
				</ul>
		   </li>		   				

	

		
			<li>
			   <a class="radparent" href="#;">Gestion des messages</a>
				<ul>
					<li>
						<a href="<?php echo url_for('mail/index') ?>" onclick="document.body.style.cursor='wait'"><span>Messages aux ERF</span></a>
					</li>
					<li>
						<a href="<?php echo url_for('textAccueil/index') ?>" onclick="document.body.style.cursor='wait'"><span>Message d'accueil</span></a>
					</li>
				</ul>		
			</li>	 
			    <li><a href="<?php echo url_for('menu/mention'); ?>" title="Mentions légales"><span>Mentions légales</span></a></li>  
	            <li><a href="<?php echo url_for('menu/condition'); ?>" title="Mentions légales">Conditions d'utilisation</a></li>  
</ul>

      <li class="radclear"> </li>
    <!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<script type="text/javascript">
//<![CDATA[
rad_create(0,false,0,500,'all',false,false,false,false);
//]]>
</script>
 
<div id="popup1" class="popup_block">
<form method="post" action= "https://portail.ac-reunion.fr/ashile/academie.php/eleve_avs_secteur?secteur_id= 'document.getElementById('size')'"> 
<span>Veillez choisir un secteur </span>
 <select name="size" id="select"  Onchange="document.getElementById('item').value = this.options[selectedIndex].innerHTML;">
	<?php foreach($secteurs as $secteur){ ?>
		<option value="<?php echo $secteur->getId(); ?>"><?php echo $secteur->getLibellesecteur(); ?></option>
	<?php } ?>
</select>
<input type="submit" name="item_number" id="item" value="">
</form>
</div>

