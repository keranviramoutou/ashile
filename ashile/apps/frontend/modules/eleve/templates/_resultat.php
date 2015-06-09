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
		    "bJQueryUI": true,
		    "iDisplayLength": 50,
			"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
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



<?php 	if( $resultat[0]['eleve_id'] ){	?>	


		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
		  <thead>
			<tr>
			  <th>Situation de l'élève</th>
			  <th>Scolarisation</th>
			  <th>Secteur</th>
			</tr>
		  </thead>

		
		
		<?php foreach($resultat as $eleve):?>
	<!--		 <!-- contrôle de l'accès a la fiche élève si élève mêm secteur que l'ERF
		<tr>
			<?php
				//dernière scolarisation de l'élève en cours à la date du jour
				//--------------------------------------------------------------
				$dersco = Doctrine_Core::getTable('Orientation')->getDerSco($eleve['id']);
				$count_dersco = count($dersco);
			   ?>
			   
			 	<?php
				//dernière scolarisation en milieu spé de l'élève en cours à la date du jour
				//--------------------------------------------------------------
				$DerModnonsco = Doctrine_Core::getTable('Modnonsco')->getDerModnonSco($eleve['id']);
				$count_DerModnonsco = count($DerModnonsco); -->
			 
			    <?php
				//dernier accompagnement en cours de l'élève  à la date du jour
				//---------------------------------------------------------------------
				//$eleve_avss = Doctrine_Core::getTable('EleveAvs')->getDerEleveAcc($eleve['id']);
				//$count_avs = count($eleve_avss);
			   ?>
		
					
					<!-- situation de l'élève -->
					<!-------------------------->
					<td>
					 <?php if ($secteur[0]['secteur_id'] == $eleve['secteur_id']){ ?> 
				    <a href="<?php echo url_for('eleve/edit?id='. $eleve['id']); ?>">
					<?php echo $eleve['nom'].'  '.$eleve['prenom'].'&nbsp;('.$eleve['id'].')&nbsp;'.'</a><small>&nbsp;-&nbsp'.$eleve['libellesecteur'].'<br>&nbsp;né(e) le :&nbsp;'.format_date($eleve['datenaissance'],'dd/MM/yyyy').'</small></a>' ?>
		            <?php }else{ ?>
					<?php echo $eleve['nom'].'  '.$eleve['prenom'].'&nbsp;<small>('.$eleve['id'].')</small>&nbsp;'.'</a><small>&nbsp;-&nbsp'.$eleve['libellesecteur'].'<br>&nbsp;né(e) le :&nbsp;'.format_date($eleve['datenaissance'],'dd/MM/yyyy').'</small>' ?>
      				<?php	} ?>
					</td>
					<td>
					<!-- scolarisation de l'élève en milieu ordinaire -->
					<?php if ($count_dersco > 0){ ?>
					<?php echo '<small>-&nbsp;'.$dersco[0]['typetab'].'&nbsp'.$dersco[0]['nometabsco'].'&nbsp;('.$dersco[0]['rne'].'&nbsp;)'.'</a><br>'?>
					<?php echo '&nbsp;classe :&nbsp;'.$dersco[0]['nomlongtypeclasse']. '</small><br>'?>
				    <?php }else{ 
					echo '<small>non scolarisé(e) en mileu ordinaire<br></small>';
					} ?>
					<!-- scolarisation de l'élève en milieu spécialisé -->
					<?php if ($count_DerModnonsco > 0){ ?>
					<?php echo '<small>-&nbsp;'.$DerModnonsco[0]['nometabnonsco'].'&nbsp;<br>à&nbsp;'.$DerModnonsco[0]['nom_quartier'] ?>
					<?php }else{ 
					 // echo '<small> non scolarisé(e) en mileu spécialisé</small>';
					} ?>
					</td>
					<td>
					<?php echo $eleve['libellesecteur'] ?>
					</td>
			
	
					

	
			</tr>	
		 <?php endforeach; ?>

		</table>

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



