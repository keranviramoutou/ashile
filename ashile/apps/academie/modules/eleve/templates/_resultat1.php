<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php //$form = $form->getObject() ?>

<script type="text/javascript">

   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
	       "iDisplayLength": 50, //initialise le nmbre d'enregistrement par page
           "bJQueryUI": true,
		   	   		"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ &eacute;l&egrave;ves",
               "sZeroRecords":    "Aucun &eacute;l&egrave;ve &agrave; afficher",
               "sInfo":           "Affichage de l'&eacute;l&egrave;ve _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&egrave;ves",
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


<div id="recherche_resultat1">
<?php 	if( $resultat[0]['eleve_id'] ){	?>	

		<?php 	if($_POST['nom_eleve']){	?>
			<?php $recherche = ' le Nom de l\'élève contenant : <strong>'.$_POST['nom_eleve'].'</strong>' ?>
		<?php }?>
		<?php 	if($_POST['prenom_eleve']){	?>	
			<?php $recherche = $recherche . '&nbsp;le Prénom de l\'élève contenant: <strong>'.$_POST['prenom_eleve'].'</strong>'?>
		<?php }?>
		
		<?php //echo '<u>Résultat de la Recherche correspondant à :&nbsp;</u>'.$recherche .''?>
	
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
		  <thead>
			<tr>
			  <th>Situation de l'élève</th>
			  <th>Détail </th>
			  <th>Secteur élève</th>
			  <th>Scolarité en cours</th>
		      
	
			</tr>
		  </thead>

		
		
		<?php foreach($resultat as $eleve):?>
			 <!-- modal content -->
			<tr>
			
				
				<?php
				//dernière scolarisation de l'élève en cours à la date du jour
				//--------------------------------------------------------------
				$dersco1 = Doctrine_Core::getTable('Orientation')->getDerSco($eleve['id']);
				$count_dersco = count($dersco1);
			   ?>
			   
	   

			   

	   
					<?php //echo 1print_r($demande_avs) ?>
					
					<!-- situation de l'élève -->
					<!-------------------------->
					<td><a href="<?php echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve['id'],  'academie' => 'true')) ?>">
					
					<?php echo $eleve['nom'].'  '.$eleve['prenom'].'</a>&nbsp; ('.$eleve['eleve_id'].').<br>&nbsp;né(e) le :&nbsp;'.format_date($eleve['datenaissance'],'dd/MM/yyyy').'' ?>
					<a href="<?php echo url_for('eleve/edit?id='. $eleve['id'].'&eleve_nom='. $eleve['nom'].'&eleve_prenom=' . $eleve['prenom'].'&retour='. 1 ); ?>"><?php echo 'Fiche aca</a></br>'  ?>
						
					
					<?php if ($eleve['datesortie']){
					echo '<br><font color ="RED">Fin de prise en charge par l\'ASH &nbsp;:&nbsp;'.format_date($eleve['datesortie'],'dd/MM/yyyy').'</font><br>';
					  } ?>
					<?php if ($eleve['etat_acc']){
					echo '<br><font color ="RED">Fin de prise en charge AVS &nbsp;:&nbsp;'.format_date($eleve['etat_acc'],'dd/MM/yyyy').'</font><br>';
					  } ?>
					<?php if ($eleve['etat_mat']){
					echo '<br><font color ="RED">Fin de prise en charge matériel&nbsp;:&nbsp;'.format_date($eleve['etat_mat'],'dd/MM/yyyy').'</font><br>';
					  } ?>
					 <!--  affiche d'un message si demande AVS en cours à une condition suspensive -->
		           <?php if ($count_dem_avs > 0){
		             foreach($dem_avs as $dem_avss):?>
						 <?php if ($dem_avss['conditionsuspensive']){ $count_suspensive = $count_suspensive +1;}
						 
					endforeach; 
					 		if ($count_suspensive > 0){
							echo '<small><FONT COLOR="red" ><blink> - Demande AVS notifiée avec close suspensive:&nbsp;'.'</FONT></blink></small>';
				             }
							} ?>
		 
					</td>
										
					<td>
					<a href="<?php echo url_for('eleve/recherche?eleve_nom='.$eleve['nom']. '&eleve_prenom='.$eleve['prenom'].'&eleve_id='.$eleve['eleve_id'].'&flag_recherche=2')  ?>">Détail</a> &nbsp;
					</td>
					<td>
					<?php echo $eleve['libellesecteur']; ?>
						   <?php if($eleve['secteur_id'] != $dersco1[0]['secteur_id_etab']){
		echo '<br><BLINK ><font color ="red">Attention INCOHERENCE</BLINK></font> entre le secteur sur la fiche élève :'.$resultat[0]['libellesecteur']. ' et le secteur de l\'établissement (scolarité en cours) '.$dersco1[0]['libellesecteur_etab'].'<br></br>';
		}

?>
					</td>
					
					
					<!--scolarité en cours -->
					<!----------------------->
					<td>
					<?php echo link_to('Créer', 'orientation/new?eleve_id=' . $eleve['eleve_id']. '&eleve_nom=' . $eleve['nom'].'&eleve_prenom=' . $eleve['prenom']. '&retour='. 1 ).'&nbsp;&nbsp;'  ?>
					<?php if ($count_dersco > 0){ ?>
					<a href="<?php echo url_for('orientation/edit?id=' . $dersco1[0]['orienId'].'&eleve_id=' .$eleve['eleve_id'] .'&secteur_id=' .$eleve['secteur_id']. '&eleve_nom=' .$eleve['nom'].'&eleve_prenom=' . $eleve['prenom']. '&retour='. 1 ) ?>">&nbsp;<?php echo ''.$dersco1[0]['typetab'].'&nbsp'.$dersco1[0]['nometabsco'].'</a>'?>
					<?php echo '&nbsp;('.$dersco1[0]['rne'].'&nbsp;)&nbsp;'.$dersco1[0]['libellesecteur_etab'].'&nbsp;classe :&nbsp;'.$dersco1[0]['nomlongtypeclasse'] ?>
					<?php }else{ 
					echo 'pas scolarisé(e) *'; } ?>
		           
		
					</td>

							
					

			</tr>	
		 <?php endforeach; ?>

		</table>
<?php //$resultat->free() ?>
<?php }else{ ?>
       <?php 	if($_POST['nom_eleve'] || $_POST['prenom_eleve'] ){	?>

			<?php 	if($_POST['nom_eleve']){	?>
				<?php $recherche = ' le Nom de l\'élève contenant : <strong>'.$_POST['nom_eleve'].'</strong>' ?>
			<?php }?>
			<?php 	if($_POST['prenom_eleve']){	?>	
				<?php $recherche = $recherche . ', le Prénom de l\'élève contenant: <strong>'.$_POST['prenom_eleve'].'</strong>'?>
			<?php }?>
			
			<?php echo '<br><u><strong>Pas de résultats correspondant au(x) critère(s) de recherche ! :&nbsp;</strong></u>'.$recherche .'</br><br></br>'?>
	    <?php } ?>
<?php } ?>
</div>
<script>
var src = "<?php echo url_for('eleve/aide') ?>";

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



