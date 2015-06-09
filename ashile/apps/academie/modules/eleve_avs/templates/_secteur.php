<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>


<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
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


		
        <p>Seules les affectations élèves sans date de Fin dacc.ou avec une date de fin d'acc. supérieure à la date du jour pas être modifiées</p>
	    <small>* le contrat affiché est celui actif à la date du jour </small>
		 <br><small>* la demande avs affiché est celle active à la date du jour </small></br>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
		<thead>
			<tr>   
                
				<th>Eleve</th>
                <th> Etab. d'affectation  </th>
                <th>Demande AVS en cours</th>
				<th>Avs</th>
                <th>Affectation</th>
				<th>Q.H.</th>
				<th>Affect. du</th>
				<th>au</th>
				<th>Etat acc.</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($eleve_avss as $eleve_avs): ?>
			  <?php
				//liste des Dernières demande AVS en cours à la date du jour pour l'élève selectionné
				//-----------------------------------------------------------------------
				$dem_avs = Doctrine_Core::getTable('DemandeAvs')->getListDerDemandeAcc($eleve_avs['eleve_id']);
				$count_dem_avs = count($dem_avs);
			   ?>
				<tr>
					
					<td><a href="<?php //echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve_avs['EleveId'],  'academie' => 'true')) 
					
						echo url_for('eleve/edit?id='.$eleve_avs['eleve_id'].'&secteur_id=' . $eleve_avs['secteur_id']);
					
					?>"> <?php echo $eleve_avs['nomeleve'].'  '.$eleve_avs['prenomeleve'].'</a>&nbsp<br><small>né(e) le&nbsp;:&nbsp;'.format_date($eleve_avs['datenaissance'],'dd/MM/yyyy').'</small>'?></td>
					<td><?php echo '<br>'.$eleve_avs['rne'].'</br>'.$eleve_avs['nomtypeetab'].'  '.$eleve_avs['nometabsco'] ?></td>
					<td>
					
				    <!-- affichage de la dernière demande avs avec la décision en cours à la date du jour -->
					 <?php if ($count_dem_avs > 0){ ?>
					 <?php foreach($dem_avs as $dem_avss):?>	
					 	<?php if($dem_avss['decisioncda'] = 1 ){ ?>
						<?php $decisioncda='&nbsp;Acceptée&nbsp;';} ?>
						<?php if($dem_avss['decisioncda'] = 0 ){ ?>
						<?php $decisioncda='&nbsp;Refusée&nbsp;';} ?>
					
					 <a href="<?php echo url_for('suiviDSM/edit?id=' . $dem_avss['DemandeAvsId']) ?>"><?php echo '<br><small>- dem n°:&nbsp;'.$dem_avss['DemandeAvsId'].'</small>&nbsp;de type :&nbsp;'.$dem_avss['naturecontrat'] ?></a> 
					 <?php  echo '<br><small>-'.$decisioncda.'par la CDA du :&nbsp;'.format_date($dem_avss['datedecisioncda'],'dd/MM/yyyy').'&nbsp;<br>- du&nbsp;'.format_date($dem_avss['datedebutnotif'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($dem_avss['datefinnotif'],'dd/MM/yyyy').
					 '<br>- QH notifiée :&nbsp;'.$dem_avss['quotitehorrairenotifie'].'&nbsp;Heure(s)</small>'; ?>
					 <?php endforeach; ?>
					<?php }else{
					  echo 'pas de demande en cours';
                     } ?>
					</td> 
					<?php if(date('Y-m-d', time()) < $eleve_avs['date_fin_contrat']) { ?>
					 <td><?php echo $eleve_avs['nomavs'].'&nbsp;-&nbsp;'.$eleve_avs['prenomavs'].'<br><small> - contrat * :&nbsp<b>'.$eleve_avs['typecontrat'].'</b><br>Temps hebd. :&nbsp;<b>'.$eleve_avs['temps_hebdo'].'</b>&nbsp;heure(s)'.
					 '</b><br>&nbsp;du&nbsp;<b>'.format_date($eleve_avs['date_debut_contrat'],'dd/MM/yyyy').'</b>&nbsp;au&nbsp<b>'.format_date($eleve_avs['date_fin_contrat'],'dd/MM/yyyy').'</b></small></br> '?></td>
					<?php }else{ ?>
					 <td><?php echo $eleve_avs['nomavs'].'&nbsp;-&nbsp;'.$eleve_avs['prenomavs']?></td>
					<?php } ?>
					<td><?php if($eleve_avs['etat_acc'] < $eleve_avs['datefin']) { ?>
					<a href="<?php echo url_for('eleve_avs/edit?id='.$eleve_avs['id'].'&eleve_id=' . $eleve_avs['eleve_id'] . '&avs_id=' . $eleve_avs['avs_id'].'&secteur_id=' . $eleve_avs['secteur_id']); ?>"><?php echo 'Modifier'  ?></a>
					&nbsp;<a><?php echo link_to('Créer ', 'eleve_avs/new?eleve_id=' . $eleve_avs['eleve_id'].'&secteur_id=' . $eleve_avs['secteur_id'] ) ?></a></td>
					<?php }else{ ?>
					  <?php echo link_to('Créer ', 'eleve_avs/new?eleve_id=' . $eleve_avs['eleve_id'] .'&secteur_id=' . $eleve_avs['secteur_id'] ) ?></a></td>
					<?php } ?>
					<td><?php echo $eleve_avs['quotite'] ?></td>
					<td><?php echo format_date($eleve_avs['datedebut'],'dd/MM/yyyy') ?></td>
					<td><?php echo format_date($eleve_avs['datefin'],'dd/MM/yyyy') ?></td>
					<td><?php echo format_date($eleve_avs['etat_acc'],'dd/MM/yyyy') ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>





