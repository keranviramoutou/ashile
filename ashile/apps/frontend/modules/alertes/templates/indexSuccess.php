<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>

<div class= 'aide' onClick="<?php echo url_for('alertes/aide') ?>"></div> 

<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#dataTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage" : {
                "sProcessing":     "Traitement en cours...",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sInfo":           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sSearch":         "Rechercher&nbsp;:",
                "sLoadingRecords": "Téléchargement...",
                "sUrl":            "",
                "oPaginate": {
                    "sFirst":    "Premier",
                    "sPrevious": "Pr&eacute;c&eacute;dent",
                    "sNext":     "Suivant",
                    "sLast":     "Dernier"
                }
            }
        });
    } );
</script>
<h1>Liste des alertes sur les dernières demandes</h1>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="dataTable">
    <thead>
        <tr>
            <th>nom</th>
            <th>prenom</th>
			 <th>n° dossier MDPH</th>
		     <th>Date de fin <br>de notification</th>
            <th>Type de demande <br>notifiée</th>
            <th>Echéance Notification</th>
			<th>Echéance envoi dossier</th>
        </tr>
    </thead>
    <tbody>
        <?php foreachDemande($demandeAvss, 'AVS'); ?>
        <?php foreachDemande($demandeMateriels, 'MATERIEL'); ?>
        <?php foreachDemande($demandeSessads, 'SESSAD'); ?>
        <?php foreachDemande($demandeTransports, 'TRANSPORT'); ?>
    </tbody>
</table>

<?php

// Factorisation des foreach des 4 demandes
function foreachDemande($demandes, $notif)
{
    foreach ($demandes as $demande):
	
	      //recherche du dossier MDPH correspondant à la demande
		 //------------------------------------------------------
        $req = Doctrine_Query::create()
                ->select('*')
                ->from('Mdph m')
				->where('m.id =?',$demande->Mdph->getId())
				->limit(1)
                ->fetcharray();
				$nbmdph = count($req );
				
		//définition des niveaux d'alertes pour échéance envoi dossier par rapport à la date de signature de la demande CERFA
		//-----------------------------------------------------------------------------------------------------------
      if(!$req[0]['dateenvoiedossier']){ //si date date envoie par renseignée

		
			$nbjours =60- round((strtotime(date('Y-m-d', time())) - strtotime($req[0]['datecreationpps']))/(60*60*24)); 
			if($nbjours <= 15 && $nbjours >= 0)
			{
			$alertecerfa = 'échéance dans moins de 15 jours';
				$flagalerte = 1;
			}
			if($nbjours <= 30 && $nbjours > 15)
			{
			$alertecerfa = 'échéance entre 1 mois et 15 jours';
				$flagalerte = 1;
			}
			
			if($nbjours > 30 &&  $nbjours <= 45)
			{
			$alertecerfa = 'échéance entre 1 de 1 mois 1/2';
			//$alertecerfa ='';
				$flagalerte = 1;
			}
			
			if($nbjours > 45 &&  $nbjours <= 60)
			{
			//$alertecerfa = 'échéance entre 1 mois et 1/2 de 2 mois';
				$alertecerfa ='';
			$flagalerte = 0;
			}
	       	if($nbjours < 0 )
			{
			$alertecerfa = 'délais dépassé';
			$flagalerte = 1;
			}
			
	

        }		
				
		if(($demande->getDecisioncda() == true && $demande->alerte() != null) || (!$req[0]['dateenvoiedossier'] && $flagalerte == 1)):
       ?>                
			<tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $demande->Mdph->Eleve->getId())) ?> '"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer" >
				<td><?php echo $demande->Mdph->Eleve->getNom() ?></td>
				<td><?php echo $demande->Mdph->Eleve->getPrenom() ?></td>
				<td><?php echo $demande->Mdph->getId() ?></td>
				<td class="center"><?php echo format_date($demande['datefinnotif'],'dd/MM/yyyy') ?></td>
				<td><?php echo $notif ?></td>
		
				<td>
						<?php
				$alerte = $demande->alerte();
			
				//$style = $alerte == 1 ? '#B6D4D0"' : ($alerte == 2 ? '#A397C6' : '#F24545');
				//$style = $alerte == 1 ? '#F24545"' : ($alerte == 2 ? '#A397C6' : '#B6D4D0');
				//$alerte ="'>&nbsp;" ;
			    echo $alerte 
				?>
				</td>
				<td> <?php echo $alertecerfa  ?></td>
                               <!-- <td> <?php echo '<div class='.$alerte.'>&nbsp  <div>' ?></td> -->
			</tr>
			<?php
		endif;	
    endforeach;
}
?>

<!-- Le second script pour le pop up d'aide -->
<script>
var src = "<?php echo url_for('alertes/aide') ?>";

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
