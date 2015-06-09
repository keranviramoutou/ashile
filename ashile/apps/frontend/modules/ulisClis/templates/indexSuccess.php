<?php use_helper('jQuery') ?>
<?php  use_stylesheet('data_table.css') ?>
<?php  use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
	     "iDisplayLength": 50, 
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



<div id="listeEleve" >

<table width='95%'>
<tr height='20px'>
<td width='65%' valign ="center" >
<h1>Liste des Eleves en Clis ou Ulis secteur : <?php echo $classeClisEtUlis[0]['libellesecteur']?></h1>
</td>
<td width='35%' align="right" valign ="center">
<button style="float: right" onClick="window.location.href='<?php echo url_for(array('module' => 'ulisClis', 'action' => 'excel')) ?>'">Export Excel</button>&nbsp;
<button style="float: right" onClick="window.location.href='<?php echo url_for(array('module' => 'ulisClis', 'action' => 'pdf')) ?>'">&nbsp;Export Pdf&nbsp;&nbsp;</button>
</td>
</tr>
</table>


- <input type="checkbox" name="avs" value="Avs" checked="checked" disabled="disabled"  ><small> si case à cocher demande en cours (en attente de décision CDA)</small><br>
- <small>la date présente dans les colonnes (Acc., matériel, orientation, transport, Sessad) correspond à la date de fin de notification (droit ouvert)</small><br></br>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
   <thead>
       <tr>
        
           <th>Elève</th>
           <th>Etablissement </th>
		   <th>Classe</th>
		   <th>Acc. </th>
		   <th>Matériel</th>
			<th>Orientation</th>
			<th>Transport</th>
			<th>Sessad</th>

       </tr>
   </thead>
   <tbody>
       <?php foreach ($classeClisEtUlis as $eleve): ?>
           <tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve['eleveId']))  ?>'"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
        <?php
				//  demande sessad en cours
				//--------------------------------
				$demande_sessads_cour = Doctrine_core::getTable('DemandeSessad')->getDemandeSessadencour($eleve['eleveId']) ;
				$count_sessad = count($demande_sessads_cour);
				//  demande sessad droit ouvert
				//--------------------------------
				$sessads_do = Doctrine_core::getTable('DemandeSessad')->getDemandeSessaddroitouvert($eleve['eleveId']) ;  
				$count_sessads_do = count($sessads_do);
				// demande d'AVS en cours
				//-----------------------
	   			$demande_avs_cour = Doctrine_core::getTable('DemandeAvs')->getDemandeAVSencour($eleve['eleveId']);
				$count_avs = count($demande_avs_cour );		
				// demande d'AVS droit ouvert
				//----------------------------
				$avs_do = Doctrine_core::getTable('DemandeAvs')->getDemandeAVSdroitouvert($eleve['eleveId']);	
                $count_avs_do = count($avs_do);				
				
				// demande materiel en cours
				//--------------------------------
				$demande_materiel_cour = Doctrine_core::getTable('DemandeMateriel')->getDemandematerielencour($eleve['eleveId']);
				$count_materiel = count($demande_materiel_cour );	
				// demande materiel droit ouvert
				//--------------------------------
				$demande_materiel_do = Doctrine_core::getTable('DemandeMateriel')->getDemandematerieldroitouvertdiff($eleve['eleveId']);
				$count_materiel_do = count($demande_materiel_do);	
				// demande transport en cours
				//----------------------------
			    $demande_transport_cour = Doctrine_core::getTable('DemandeTransport')->getDemandetransportencour($eleve['eleveId']);
				$count_transport = count($demande_transport_cour );	
				// demande transport droit ouvert
				//--------------------------------
				 $demande_transport_do = Doctrine_core::getTable('DemandeTransport')->getDemandetransportdroitouvert($eleve['eleveId']);
				$count_transport_do = count( $demande_transport_do);
					
				// demande d'orientation en cours
				//---------------------------------
				  $demande_orientation_cour = Doctrine_core::getTable('DemandeOrientation')->getDemandeorientationencour($eleve['eleveId']);
				  $count_orientation = count($demande_orientation_cour );
				// demande d'orientation droit ouvert
				//-----------------------------------
				$demande_orientation_do = Doctrine_core::getTable('DemandeOrientation')->getDemandeorientationdroitouvert($eleve['eleveId']);				  
				$count_orientation_do = count($demande_orientation_do);
				?>
		
               <td><?php echo $eleve['nom'].' '.$eleve['prenom'].'<br><small>né(e) le '. format_date( $eleve['datenaissance'],'dd/MM/yyyy').'</small>'?></td>
            
               <td><?php echo $eleve['typetab'].'&nbsp;'.$eleve['nometabsco'].'<br>'.$eleve['rne'] ?></td>
			   <td><?php echo $eleve['nomlongtypeclasse']; ?> </td>
			   <td>			 
			 <?php if ($count_avs > 0 ): ?>
			  <input type="checkbox" name="avs" value="Avs" checked="checked" disabled="disabled"  >demande en cours<br>
			  <?php endif; ?>
			  <?php if ($count_avs_do > 0 ): ?>
			  <?php echo '<small>'.format_date($avs_do[0]['datefinnotif'],'dd/MM/yyyy').'</small>&nbsp;&nbsp;' ?>
			  <?php endif; ?>
			  </td>
             <td>			 
			 <?php if ($count_materiel > 0 ): ?>
			  <input type="checkbox" name="materiel" value="materiel" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
			  <?php endif; ?>
			  <?php if (count($count_materiel_do) > 0){ 
				foreach ($demande_materiel_do as $demande_materiel_dos):
					$affichedatefinnotif = format_date($demande_materiel_do['datefinnotif'],'dd/MM/yyyy') .'&nbsp;-&nbsp;' .$affichedatefinnotif  ;
				endforeach;
				} ?>
			 </td>
			 <td>			 
			 <?php if ($count_orientation > 0 ): ?>
			  <input type="checkbox" name="orientation" value="orientation" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
			  <?php endif; ?>
			  <?php if ($count_orientation_do > 0 ): ?>
			  <?php echo '<small>'.format_date($demande_orientation_do[0]['datefinnotif'],'dd/MM/yyyy').'</small>&nbsp;&nbsp;' ?>
			  <?php endif; ?>
			 </td>
			 <td>			 
			 <?php if (	$count_transport > 0 ): ?>
			  <input type="checkbox" name="transport" value="transport" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
			  <?php endif; ?>
			  <?php if ($count_transport_do > 0 ): ?>
			  <?php echo '<small>'.format_date($demande_transport_do[0]['datefinnotif'],'dd/MM/yyyy').'</small>&nbsp;&nbsp;' ?>
			  <?php endif; ?>
			 </td>
			 <td>			 
			 <?php if ($count_sessad> 0): ?>
			  <input type="checkbox" name="sessad" value="sessad" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
			  <?php endif; ?>
			  <?php if ($count_sessads_do > 0 ): ?>
			  <?php echo '<small>'.format_date($sessads_do[0]['datefinnotif'],'dd/MM/yyyy').'</small>&nbsp;&nbsp;' ?>
			  <?php endif; ?>
			 </td>
		

           </tr>
       <?php endforeach; ?>
   </tbody>
</table>
<br />
</DIV>

