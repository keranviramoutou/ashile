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


 <div id="demande_avs">  
<table width='99%' height='20px'>
<tr>
<td width='55%'>
 <?php echo '<h1>Dossier ASH : Demandes des élèves du secteur du ' .trim($secteur).'</h1>' ?>
</td>
<td width='45%'>
  <div class= 'aide' onClick="aide_alertes()">
  </td>
</tr>
<td width='100%'>
 <?php echo 'avec des notications qui se terminent dans moins de 6 mois<br> et pour lesquels il n\'y pas de renouvellement demande' ?>
</td>
<td width='0%'>

  </td>
<tr>
<tr>

</table>	

 
 
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Elève</th>
	   <th>Suivi des notifications</th>
	
    </tr>
  </thead>
   <tbody>
<?php 	foreach($suividemandes as $demande): ?>	
<?php
				//  demande sessad droit ouvert
				//--------------------------------
				$demande_sessads_droitouvert= Doctrine_core::getTable('DemandeSessad')->getDemandeSessaddroitouvert6mois($demande['eleve_id']) ;
				$count_sessad_droitouvert = count($demande_sessads_droitouvert);
				
		
?>

<?php
				//  demande sessad demande en cours
				//--------------------------------
				$demande_sessads_demandeencours= Doctrine_core::getTable('DemandeSessad')->getDemandeSessadencour($demande['eleve_id']) ;
				$count_demande_sessads_demandeencours = count($demande_sessads_demandeencours);
				
		
?>
<?php
				// demande transport en cours
				//----------------------------

			    $demande_transport_cour = Doctrine_core::getTable('DemandeTransport')->getDemandetransportencour($demande['eleve_id']);
				$count_transportencours = count($demande_transport_cour );	
?>

<?php
				//  demande transport droit  ouvert
				//---------------------------------
				$demande_transport_droitouvert= Doctrine_core::getTable('DemandeTransport')->getDemandetransportdroitouvert6mois($demande['eleve_id']) ;
				$count_transport_droitouvert = count($demande_transport_droitouvert);
	
?>


<?php

				// demande d'orientation en cours
				//---------------------------------
				  $demande_orientation_cour = Doctrine_core::getTable('DemandeOrientation')->getDemandeorientationencour($demande['eleve_id']);
				  $count_orientationencours = count($demande_orientation_cour );	
?>

<?php

				// demande d'orientation droit ouvers
				//---------------------------------
				  $demande_orientation_droitouvert = Doctrine_core::getTable('DemandeOrientation')->getDemandeorientationdroitouvert6mois($demande['eleve_id']);
				  $count_orientation_droitouvert = count($demande_orientation_droitouvert );	
?>

<?php 			// demande d'AVS en cours
				//-----------------------
	   			$demande_avs_cour = Doctrine_core::getTable('DemandeAvs')->getDemandeAVSencour($demande['eleve_id']);
				$count_accencours = count($demande_avs_cour );	
?>

<?php 			// demande d'AVS droit ouvert
				//----------------------------
	   			$demande_acc_droitouvert = Doctrine_core::getTable('DemandeAvs')->getDemandeAvsdroitouvert6mois($demande['eleve_id']);
				$count_acc_droitouvert = count($demande_acc_droitouvert );	
?>

<?php 				// demande materiel en cours
				//--------------------------------
				$demande_materiel_cour = Doctrine_core::getTable('DemandeMateriel')->getDemandematerielencour($demande['eleve_id']);
				$count_materielencours = count($demande_materiel_cour );
?>

<?php 				// demande materiel droit ouvert
				//--------------------------------
				$demande_materiel_droitouvert = Doctrine_core::getTable('DemandeMateriel')->getDemandematerieldroitouvert6mois($demande['eleve_id']);
				$count_materiel_droitouvert = count($demande_materiel_droitouvert  );
?>
					

<?php if ( ($count_sessad_droitouvert> 0 && $count_demande_sessads_demandeencours == 0) || ($count_transport_droitouvert > 0 && $count_transportencours == 0) || ( $count_orientation_droitouvert > 0 
&& $count_orientationencours == 0) || ($count_acc_droitouvert > 0 && $count_accencours == 0) || ($count_materiel_droitouvert > 0 && $count_materielencours== 0)): ?>
	
	<tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $demande['eleve_id']))  ?>'"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
       
			 <td>
			 <?php echo $demande['nom'].'&nbsp;'.$demande['prenom'] ?>
			 </td>
			 
			 <td>
			 
			    <?php   if ($count_sessad_droitouvert> 0 && $count_demande_sessads_demandeencours == 0){	?>	 
					  <input type="checkbox" name="sessad" value="sessad" checked="checked" disabled="disabled"  >&nbsp;<small><b>Sessad</b> notifé jusqu'au &nbsp;<?php echo format_date($demande_sessads_droitouvert[0]['datefinnotif'],'dd/MM/yyyy').'</small><br>'  ?>	 
				<?php } ?>

				<?php if  ($count_acc_droitouvert > 0 && $count_accencours == 0) { ?>   
				      <?php foreach($demande_acc_droitouvert as $demande_acc_droitouverts): ?>	
						<input type="checkbox" name="Accompagnant" value="Acc" checked="checked" disabled="disabled"  >&nbsp;<small><b>Accompagnant</b> notifié jusqu'au&nbsp;<?php echo format_date($demande_acc_droitouverts['datefinnotif'],'dd/MM/yyyy').'</small><br>'  ?>
				       <?php endforeach; ?>
				<?php } ?>
			
				<?php if  ($count_transport_droitouvert > 0 && $count_transportencours == 0) { ?>   
						<input type="checkbox" name="transport" value="transport" checked="checked" disabled="disabled"  >&nbsp;<small><b>Transport</b> notifié jusqu'au&nbsp;<?php echo format_date($demande_transport_droitouvert[0]['datefinnotif'],'dd/MM/yyyy').'</small><br>'  ?>
				<?php } ?>
				
			   	<?php if  ($count_orientation_droitouvert > 0 && $count_orientationencours == 0) { ?>  
				
					  <?php 	foreach($demande_orientation_droitouvert as $demande_orientation_droitouverts): ?>	
						<input type="checkbox" name="orientation" value="orientation" checked="checked" disabled="disabled"  >&nbsp;<small><?php echo '<b>Orientation :&nbsp'.$demande_orientation_droitouverts['libelleclasseext'] .'</b>&nbspnotifiée jusqu\'au' ?>&nbsp;<?php echo format_date($demande_orientation_droitouverts['datefinnotif'],'dd/MM/yyyy').'</small><br>'  ?>
				       <?php endforeach; ?>
					   
				<?php } ?>
				
				<?php if  ($count_materiel_droitouvert > 0 && $count_materielencours== 0) { ?>  
				
					  <?php foreach($demande_materiel_droitouvert as $demande_materiel_droitouverts): ?>	
						<input type="checkbox" name="materiel" value="materiel" checked="checked" disabled="disabled"  >&nbsp;<small><?php echo '<b>Matériel :&nbsp'.$demande_materiel_droitouverts['typemateriel'] .'</b>&nbspnotifiée jusqu\'au' ?>&nbsp;<?php echo format_date($demande_materiel_droitouverts['datefinnotif'],'dd/MM/yyyy').'</small><br>'  ?>
				       <?php endforeach; ?>
					   
				<?php } ?>
			 </td>
			 
			 

           
    </tr>	
	 <?php endif; ?>
	  
     <?php endforeach; ?>

  </tbody>

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



