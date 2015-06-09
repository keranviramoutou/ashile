<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>


<script type="text/javascript">

   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ AVS",
               "sZeroRecords":    "Aucun &eacute;l&egrave;ve &agrave; afficher",
               "sInfo":           "Affichage de l'&eacute;l&egrave;ve _START_ &agrave; _END_ sur _TOTAL_ AVS",
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
<div id="recherche_avs">
<?php if( $resultat[0]['id'] ){	?>	

        <?php	if($_POST['nom_avs']){ ?>
		<?php echo ' le Nom de l\'AVS contenant: <strong>'.$_POST['nom_avs'].'</strong>' ?>
		<?php }?>
		
		<?php	if($_POST['avs_nomjf']){ ?>
		<?php echo 'le Nom de jeune fille l\'AVS contenant : <strong>'.$_POST['avs_nomjf'].'</strong>' ?>
		<?php }?>
		
		<?php 	if($_POST['prenom_avs']){?>	
			<br><?php echo ' le Prénom de l\'AVS contenant: <strong>'.$_POST['prenom_avs'].'</strong>'?></br> 
		<?php }?>
					

	
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable" >
		  <thead>
			<tr>
			  <th>Nom prénom</th>
			   <th> Contrat en cours</th>
			    <th> élève(s) suivi(s) en cours</th>
				<th> Quotité H. disponible</th>
			  <th> Contrat *</th>
			</tr>
		  </thead>

		<?php foreach($resultat as $avs):?>
			<tr>
			
			<?php 
		  // liste des contrats en cours pour l'avs selectionne
		  //---------------------------------------------------

				$ContratEnCour = Doctrine_Core::getTable('ContratAvs')->ContratsAcc($avs['id']);
				$existContratEnCour =count($ContratEnCour);
			?>
		
			<?php
			//liste des élèves avec personnel accompagnant à la date du jour
			//--------------------------------------------------------------
			$eleve_avs = Doctrine_Core::getTable('EleveAvs')->getRechEleveviaAcc($avs['id']);
			?>
			
			<?php
			//historique des élèves accompagnés pour un avs selectionné
			//--------------------------------------------------------------
			$eleve_avs_histo = Doctrine_Core::getTable('EleveAvs')->getHistoEleveAcc($avs['id']);
			$existeleve_avs_histo =count($eleve_avs_histo);
			?>
		
			<?php 
		    // liste de tous les contrats  pour l'avs selectionne
		    //-----------------------------------------------------
 		    $ListContrat = Doctrine_Core::getTable('ContratAvs')->ListeContratsAcc($avs['id']);
		    $existContrat =count($ListContrat);
			?>
					
			<?php 
		    // liste de toutes les postions des contrats  pour l'avs selectionne
		    //----------------------------------------------------------------------
 		    $ListPos = Doctrine_Core::getTable('ContratAvs')->getListeContratsAccavecPos($avs['id']);
		    $existListPos =count($ListPos);
			?>
				<!-- affichage de l'AVS -->	
				
					<td><a href="<?php echo url_for('avs/edit?id='.$avs['id'].'&avs_nom=' .$avs['nom'].'&avs_prenom=' .$avs['prenom'] ) ?>" onclick="document.body.style.cursor='wait'"><?php echo $avs['nom'].'  '.$avs['prenom'] ?></a><?php echo '&nbsp;<strong>Id :&nbsp;</strong>'.$avs['id'].'&nbsp;<br><small>&nbsp;né(e) le :&nbsp;'.format_date($avs['datenaissance'],'dd/MM/yyyy').'</small><br>' ?>
					<?php if($avs['nom_nais']) { ?>
					<?php echo 'Nom de jeune fille&nbsp;:&nbsp;'.$avs['nom_nais']?>
					<?php } ?>
					<?php echo link_to('Supprimer', 'avs/delete?id='.$avs['id'].'&avs_nom =' .$avs['nom'].'&avs_prenom='.$avs['prenom'], array('method' => 'delete', 'confirm' => 'Are you sure?')) ?></td>
				
				<!-- affichage des contrats en cours -->
				   <td><?php if($existContratEnCour > 0){ ?>
					 <?php foreach($ContratEnCour as $ContratEnCours):?>
					 <?php echo 'type :<small>'.$ContratEnCours['typecontrat'].'&nbsp- Temps hebdo :&nbsp'.$ContratEnCours['temps_hebdo'].'&nbsp;Heure(s)<br>du&nbsp;'.format_date($ContratEnCours['date_debut_contrat'],'dd/MM/yyyy').'&nbspau&nbsp'.format_date($ContratEnCours['date_fin_contrat'],'dd/MM/yyyy') ?>
	
					<?php if($ContratEnCours['date_fin_contrat'] >= format_date(time(),'dd/MM/yyyy') || !$ContratEncours['date_fin_contrat'] ) { ?>
					 <a href="<?php echo url_for('contrat_avs/edit?id='.$ContratEnCours['contratId'].'&avs_id='.$avs['id'].'&avs_nom='.$avs['nom'].'&avs_prenom='.$avs['prenom'].'&retour=1'  ) ?>"onclick="document.body.style.cursor='wait'"> <?php echo '<br>Modifier' ?></a>
					 <?php  echo '&nbsp;'.link_to('Supprimer', 'contrat_avs/delete?id='.$ContratEnCours['contratId'].'&avs_id='.$avs['id'].'&avs_nom='.$avs['nom'].'&avs_prenom='.$avs['prenom'].'&retour=1', array('method' => 'delete', 'confirm' => 'Etes vous sur ?')) ?></small>
					<?php } ?>
					<?php endforeach; ?>
			 
					<?php } ?>

					</td>
					
					<!-- affichage des élèves accompagnés  à la date du jour -->
					<td> <?php foreach($eleve_avs as $eleve_avss):?>
							<?php echo '<small>-&nbsp'.$eleve_avss['nom']. '&nbsp'.$eleve_avss['prenom'].'&nbsp;Quotité :&nbsp;'.$eleve_avss['quotite'].'&nbsp;Heure(s)<br>'.
							'du&nbsp;'.format_date($eleve_avss['datedebut'],'dd/MM/yyyy').'&nbspau&nbsp'.format_date($eleve_avss['datefin'],'dd/MM/yyyy').'&nbsp;' ?>
						    </small><a href="<?php echo url_for('eleve_avs/edit?id='.$eleve_avss['id'].'&eleve_id=' . $eleve_avss['EleveId'] . '&avs_id=' . $eleve_avss['avs_id']); ?>" onclick="document.body.style.cursor='wait'"><?php echo 'Modifier'  ?></a></br>
						 <?php endforeach; ?>
						 
			            <!-- affichage de l'historique des élèves accompagnés  -->
				        <?php if($existeleve_avs_histo > 0) { ?>
						 <?php //echo link_to('Liste', 'eleve_avs/list1?avs_id='.$avs['id'] ) ; ?>
						 <?php echo link_to('<p><u>Liste</u><br>', 'eleve_avs/list1?avs_id='.$avs['id']. '&retour='. 1, 
						array('popup' => array('popupWindow', 'width=650,height=400,left=200,top=60','scrollbars=yes')) )  ?>
						<?php } ?>
					</td>
					<td>
					    <?php $quotite_avs=0 ?>
						 <?php if($existcontratavs > 0 ) {?>
					    <?php foreach($eleve_avs as $eleve_avss):?>
					     <!-- calcul du disponible horaire -->
						
					     <?php $quotite_avs = $quotite_avs + $eleve_avss['quotite'] ;     ?>
					
					     <?php endforeach; ?>
						 
						 <?php if($existContratEnCour > 0){ ?>
						  <?php $dispo = $ContratEnCour[0]['temps_hebdo'] - $quotite_avs; ?>
						 <?php } ?>
						 
						<?php	if ($dispo < 0 ){
							$dispo= '<FONT COLOR="red" ><blink>'.$dispo.'&nbsp;Heure(s)</FONT></blink>';
							}else{ //disponible horaire positif
							$dispo= $dispo.'&nbsp;Heure(s)';
							}
						    echo  $dispo ; $dispo = 0 ;$quotite_avs = 0;
						  } ?>
					</td>
					<td> <?php echo link_to('Créer', 'contrat_avs/new?avs_id='.$avs['id'].'&avs_nom='.$avs['nom'].'&avs_prenom='.$avs['prenom'] ) ?>
					<?php if($existContrat > 0) {?>
						<?php echo link_to('Liste', 'contrat_avs/list?avs_id='.$avs['id'].'&avs_nom='.$avs['nom'].'&avs_prenom='.$avs['prenom'] ) ; ?>
					<?php } ?>
					<?php if( $existListPos	> 0){ ?>			        
						<?php echo link_to('<p><u>Position(s)</u><br>', 'contrat_avs/listpos?avs_id='.$avs['id']. '&retour='. 1, 
						array('popup' => array('popupWindow', 'width=600,height=300,left=350,top=60','scrollbars=yes')) )  ?>
					<?php } ?>
					</td>
					

			</tr>	
		 <?php endforeach; ?>
        <br>* dans la colonne contrat apparait "liste" si l'Avs a déja eu au moins un contrat</br>
		</table>

<?php }else{ ?>

		<?php 	if($_POST['nom_avs']){	?>
			<?php 	if($_POST['nom_avs']){ ?>
				<br><?php $recherche =' le Nom de l\'AVS contenant : <strong>'.$_POST['nom_avs'].'</strong>' ?></br>
			<?php }?>
			
			<?php 	if($_POST['prenom_avs']){?>	
				<br><?php $recherche = $recherche .'&nbsp,le Prénom de l\'AVS contenant : <strong>'.$_POST['prenom_avs'].'</strong>'?></br> 
			<?php }?>
			<?php echo '<br><u><strong>Pas de résultats correspondant au(x) critère(s) de recherche ! :&nbsp;</strong></u>'.$recherche .'</br>'?>
		<?php }?>
			
		<?php 	if($_POST['avs_nomjf'] ){	?>
			<?php 	if($_POST['avs_nomjf']){ ?>
				<br><?php $recherche =' le Nom de jeune fille l\'AVS contenant : <strong>'.$_POST['avs_nomjf'].'</strong>' ?></br>
			<?php }?>
			
			<?php 	if($_POST['prenom_avs']){?>	
				<br><?php $recherche = $recherche .'&nbsp,le Prénom de jeune fille de l\'AVS contenant : <strong>'.$_POST['prenom_avs'].'</strong>'?></br> 
			<?php }?>
			<?php echo '<br><u><strong>Pas de résultats correspondant au(x) critère(s) de recherche ! :&nbsp;</strong></u>'.$recherche .'</br>'?>
		<?php }?>
	
		
	
<?php } ?>
</div>
<script>
var src = "<?php echo url_for('avs/aide') ?>";

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

<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>


