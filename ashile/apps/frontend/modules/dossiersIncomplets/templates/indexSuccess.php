<?php use_helper('jQuery') ?>
<?php  use_stylesheet('data_table.css') ?>
<?php  use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>

<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
		   		    "iDisplayLength": 50,
			"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ &eacute;l&egrave;ves",
               "sZeroRecords":    "Aucun &eacute;l&eagrave;ve &agrave; afficher",
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
<table width='99%' height='20px'>
<tr>
<td width='75%'>
<h1>Liste des dossiers ASH incomplets pas encore envoyés à la MDPH et non déposé par les parents</h1>
</td>
<td width='25%'>
 <div class= 'aide' onClick="<?php echo url_for('dossiersIncomplets/aide') ?>"></div> 
  </td>
</tr>
</table>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
   <thead>
       <tr>
        
           <th>Elève </th>
           <th>Scolarité en cours</th>
           <th>Pièces obligatoires<br>manquantes</br></th>
		    <th>Pièces complémentaires<br>manquantes (bilans)</th>
		   <th>Autres pièces<br>manquantes</br></th>
		   <th>Suivi envoi dossier MDPH </small></th>

   
       </tr>
   </thead>
   <tbody>
        <?php foreach ($dossierIncomplets as $dossierIncomplet): ?>

         <tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $dossierIncomplet['id'])); ?>'" style="cursor: pointer">
        
 			
						<td><?php echo $dossierIncomplet['nom'].' - '.$dossierIncomplet['prenom'].'&nbsp;(<small>'.$dossierIncomplet['id'].'</small>)' .'<br>né(e) le&nbsp;'.format_date($dossierIncomplet['datenaissance'],'dd/MM/yyyy')?></td>&nbsp;
						<td><?php echo '<small>'.$dossierIncomplet['typetab'].'&nbsp;'.$dossierIncomplet['nometabsco'].'<br>'.$dossierIncomplet['rne'].'</small>' ?></td>
						<td>
                          <!-- liste des pièces obligatoires non fournies  -->
							<?php	if(isset($dossierIncomplet['pjobligatoire'])){
										foreach ($dossierIncomplet['pjobligatoire'] as $dossier):
										 echo link_to('<small><u> Dossier n°:&nbsp;'.$dossier['Mdph_id'].'</u></small><br>','eleve/edit?id=' .$dossierIncomplet['id'].'#div_mdph') ;
										if (!$dossier->getDatepjdom()){
										  echo '<small>- justificatif domicile </small><br>';
										  }
										  if (!$dossier->getDatepjident() ){
										  echo '<small>- justificatif d\'identité </small><br>';
										  }
										  if (!$dossier->getDatecreationpps()){
										  echo '<small>- CERFA </small><br>';
										  }
										  
										   if (!$dossier->getDatebilanmedical()){
										  echo '<small>- Bilan Médic. </small><br>';
										  }
											
										endforeach;
									}else{
									echo 'fournies';
									};
							?>
						</td>
						
						
											
						<td>
						 <!-- situation des pièces complémentaires (bilans) -->
						<?php
							if(isset($dossierIncomplet['bilan'])):
								foreach ($dossierIncomplet['bilan'] as $bilan): 
							
								    echo '<Small><u>Dossier  n°:&nbsp;'.$bilan['Mdph_id'].'</u></small><br>';
									echo '<small>Bilan :&nbsp;'.$bilan->getLibelleBilan().'&<br>Type&nbsp:&nbsp'.$bilan->getNaturebilan().'</small><br>'; 
									 echo '<small>à réaliser par :&nbsp;'.$bilan->getSpecialiste().'</small><br>';

								
						endforeach;
						
							endif;
						 ?>
					
						</td>
						
						 <!-- liste des autres pièces non fournies  -->
						<td>
							<?php	if(isset($dossierIncomplet['dossier'])):
							
										foreach ($dossierIncomplet['dossier'] as $dossier):
										echo '<Small><u>Dossier  n°:&nbsp;'.$dossier['Mdph_id'].'</u></small><br>';
											echo '- ' . $dossier->getLibellepiece() . '<br />';
										endforeach;
										
									endif;
							?>
						</td>
						<td>
						<?php 
						
								   if($dossierIncomplet['date2'] <= date('Y-m-d', time()) && $dossierIncomplet['datecreationpps']){
									echo '<small>Dossier n°:&nbsp'. $dossierIncomplet['Mdph_id'].'<br><FONT COLOR="red" >- CERFA signé depuis plus de deux mois</FONT>' ;
									}
									
									if($dossierIncomplet['date2'] > date('Y-m-d', time()) && $dossierIncomplet['date1'] <= date('Y-m-d', time()) && $dossierIncomplet['datecreationpps']){
									echo '<small>Dossier n°:&nbsp'. $dossierIncomplet['Mdph_id'].'<br>- CERFA signé depuis plus d\'un mois' ;
									}
						?>
						</td>
	
	

           </tr>
       <?php endforeach; ?>
   </tbody>
</table>
<br />

    

<!-- Le second script pour le pop up d'aide -->
<script>
var src = "<?php echo url_for('dossiersIncomplets/aide') ?>";

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

