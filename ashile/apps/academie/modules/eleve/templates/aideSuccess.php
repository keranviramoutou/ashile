<?php include_stylesheets() ?>

<div class='aideMod'></div>
                <!-- modal content -->
        <h3> A - Dossier Elèves > Création Fiche élève</h3>	
		<p> le bouton "Créatin fiche élève" permet de créer une fiche élève  à partir de l'interface des ERF, à l'enregistrement de cette fiche ,l'élève est rattaché au secteur 'ND'</p>
		<p> Pour lui attacher son secteur réel, il faut le scolariser, l'élève est attaché au secteur de l'établissement scolaire'</p>
        <p> le secteur de l'élève peut être modifié à partir de la fiche académique si le secteur de l'élève est différent du secteur de l'établissement</p>
		<p> ce cas de figure se produit  quand un élève change d'établissement en cours d'année scolaire si  on a commencé par créer la nouvelle scolarisation puis clôturé l'ancienne scolarisation</p>
		<h3> A - Dossier Elèves > Recherche élèves</h3>	
         <p>A partir de <u>l'identité de l'élève</u> (Nom- Prénom) on consulte le dossier de l'élève à partir de l'interface de l'Enseignant référent </p>
        <h4>Scolarisation </h4>		
		<p> le secteur  affiché est celui de l'élève, il doit correspondre à celui de l'établissement de la scolarité en cours de l'élève</p>
		 <p> le secteur de l'élève est mis à jour au changement ou à la création d'une nouvelle scolarisation <p>
		 <p><u> la scolarité de l'éléve affichée</u> est celle pour laquelle la date de fin est inférieure à la date du jour </p>
		 <p> la création dune nouvelle scolarisation n'entraine pas le clôture de la précédente scolarisation en milieur ordinaire <p>
		 <p> il faut donc toujours clôturer la scolarisation (mettre une date de fin) en cours avant d'en créer une autre </p>
		 <p> si on ne respecte pas cette ordre le secteur de l'élève sera celui de la dernière scolarisation modifiée</P>
         <p>A la création d'une nouvelle scolarité , la date de début et de fin de scolarisation sont initialisées avec les dates de début et de fin de l'année scolaire en cours <p>		 
	    <p><u> la fiche académique</u> permet au gestionnaire académique de renseigner la date de fin d'accompagnement ou la date et ou le motif de sortie du système de 
	    prise en charge par l'ASH</p>
		 <h4>Demande Matériel </h4>
		<p> une demande de matériel peut être supprimée ou modifiée si elle est notifiée et en cours ou en attente de décision CDA</p>
		<p> les demandes de matériels sont affichées sur la liste des "Affectation de ressource" si la décision de la CDA est OK et si la demande de matérile est à l'état "A ATTRIBUER"<p>
		<p> une demande de matériel est classée en fonction du type et de sa catégorie</p>
		<p> les nomenclatures utlisées pour caractériser la demande de  matériel sont : le type et la catégorie (identiques au le matériel)</p>
		 <p>* la création d'une demande matériel créée un nouveau dossier MDPH pour l'élève concerné, si il n'existe pas pas de dossier MDPH pour cet élève</p>
     
		 <h4>Demande d'Avs </h4>
		 <p>* la création d'une demande avs créée un nouveau dossier mdph pour l'élève concerné, si il n'existe pas pas de dossier MDPH pour cet élève</p>
		en cliquant sur cda avs vous retrouver les demandes d'avs créées </p>
		<p> une demande d'avs peut être supprimée ou modifiée si elle est notifiée et en cours ou en attente de décision CDA</p> 
        <h4> Gestion des AVS  - Affectation d'un AVS</h4>
         <p> le gestionnaire peut à partir de ce tableau affecter un AVS pour un élève, il peut modifier également une affectation</p>
		 <p>il est impossible d'affecter un avs si il n'y a pas de demande avs notifiée en cours  l'élève sélectionné (un message le précise) </p>
         <p> il n'y a pas de contrôle  sur les dates de début et de fin d'affectation<p>
		 <p><u>Règle : </u> De manière génèrale un accompagnement en cours n'a pas de date de fin <p>
	     <p>seuls les accompagnements de remplacement sont en cours avec une date de fin </p>
		 <p> seule une affectation en cours peut être supprimée ou modifiée (pas de date de fin) à partir de la "Liste" </p>
		 <h4> Gestion des matériel - Attribution de matériel </h4>
		 <div class="convention" >
		 <p><u> Edition d'une convention </u></p>

		 cette fonctionnalité permet d'éditer une convention qui précise les conditions de prêt du matériel.
		 cliquer sur le lien convention, selectionner le matériel qui doit figurer sur la convention,à la suite de cette édition,
         <br>la date de convention et le numéro de convention sont mis à jour sur la fiche de prêts des matériels concernés.
		 <br>un matériel n'est plus éditable sur la convention si la date d'édition de la convention est renseignée.
		 <br>le nouveau numéro de convention est le dernier enregistré + 1.
         </div>
		  
		 <h3>B - Dossier MDPH > Demande d'accompagnant >liste des AVS affectés </h3>