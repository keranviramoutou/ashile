<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
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

<table width='90%'>
<tr>
<td width='75%'>
<h1> Dossier ASH :Demandes en attente de décision CDA</h1>
</td>
<td width='25%'>
  <div class= 'aide' onClick="aide_alertes()"></div>
  </td>
</tr>
</table>	



 <div id="demande_avs">   
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Eleve</th>
      <th>Message</th>
      <th>Avs</th>
	  <th>Matériel</th>
	  <th>Orientation</th>
	  <th>Transport</th>
	   <th>Sessad</th>
    </tr>
  </thead>

<?php
	foreach($suividemandes as $demande): ?>
<tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $demande['eleve_id']))  ?>'"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">

<?php
				//  demande sessad en cours
				//--------------------------------
				$demande_sessads_cour = Doctrine_core::getTable('DemandeSessad')->getDemandeSessadencour($demande['eleve_id']) ;
				$count_sessad = count($demande_sessads_cour);
				
				// demande d'AVS en cours
				//-----------------------
	   			$demande_avs_cour = Doctrine_core::getTable('DemandeAvs')->getDemandeAVSencour($demande['eleve_id']);
				$count_avs = count($demande_avs_cour );				
				
				// demande materiel en cours
				//--------------------------------
				$demande_materiel_cour = Doctrine_core::getTable('DemandeMateriel')->getDemandematerielencour($demande['eleve_id']);
				$count_materiel = count($demande_materiel_cour );	
				
				// demande transport en cours
				//----------------------------

			    $demande_transport_cour = Doctrine_core::getTable('DemandeTransport')->getDemandetransportencour($demande['eleve_id']);
				$count_transport = count($demande_transport_cour );	
					
				// demande d'orientation en cours
				//---------------------------------
				  $demande_orientation_cour = Doctrine_core::getTable('DemandeOrientation')->getDemandeorientationencour($demande['eleve_id']);
				  $count_orientation = count($demande_orientation_cour );	
?>

        
			 <td><?php echo $demande['nom'].'&nbsp;'.$demande['prenom']?></td>
             <td>			 
			 <?php if ($count_avs == 0 && $count_materiel == 0 && $count_orientation == 0 && $count_sessad == 0 && $count_transport == 0): ?>
			  <?php echo 'Dossier ASH sans demandes' ?>
			  <?php endif; ?>
			  </td>
			 <td>			 
			 <?php if ($count_avs > 0 ): ?>
			  <input type="checkbox" name="avs" value="Avs" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
			  <?php endif; ?>
			  </td>
             <td>			 
			 <?php if ($count_materiel > 0 ): ?>
			  <input type="checkbox" name="materiel" value="materiel" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
			  <?php endif; ?>
			 </td>
			 <td>			 
			 <?php if ($count_orientation > 0 ): ?>
			  <input type="checkbox" name="orientation" value="orientation" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
			  <?php endif; ?>
			 </td>
			 <td>			 
			 <?php if (	$count_transport > 0 ): ?>
			  <input type="checkbox" name="transport" value="transport" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
			  <?php endif; ?>
			 </td>
			 <td>			 
			 <?php if ($count_sessad> 0): ?>
			  <input type="checkbox" name="sessad" value="sessad" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
			  <?php endif; ?>
			 </td>
			 
			 

           
    </tr>	
     <?php endforeach; ?>



</table>
</div>
	<script>

		
	function aide_alertes() {
	var src = "<?php echo url_for('alertes/aide') ?>";
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



