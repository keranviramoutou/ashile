<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<!---------------------- tableau JQuery eleves attribués à l avs ------------------------------------>
<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "<?php echo 'Elève :&nbsp;<strong>'.$EleveAvs[0]['nom'] .'&nbsp;'.$EleveAvs[0]['prenom'].'</strong><br>Situation des acc.&nbsp;au&nbsp;'.format_date(time(),'dd/MM/yyyy').'</strong>'?> ",
               "sZeroRecords":    "Aucun &eacute;l&eagrave;ve &agrave; afficher",
               "sInfo":           "Affichage de l'accompagnant _START_ &agrave; _END_ sur _TOTAL_ accompagnants",
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
<br></strong>
<div id="eleve_avs">
<div >
<!--	<h4>Liste des accompagnants pour l'élève :&nbsp<?php echo $EleveAvs[0]['nom'] .'&nbsp;'.$EleveAvs[0]['prenom'].'&nbspsituation&nbsp;au&nbsp;'.format_date(time(),'dd/MM/yyyy')?> </h4> -->
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
			<thead>
			<tr>
				<th>Personnel acc.</th>
				<th>Quotite H.</th>
				<th>Prise en Charge </th>
				<th>Affectation</th>
			</tr>
			</thead>
			<tbody>
				<?php foreach ($EleveAvs as $eleveAvss): ?>
				 <?php 
				  // Liste des contrats en cours à la date du jour pour l'accompagnant selectionne
	             //------------------------------------------------------------------------------   
				 $contratAvs = Doctrine_Core::getTable('ContratAvs')->ContratsAcc($eleveAvss['avs_id']);
		         $existContratAvs = count($contratAvs); ?>				 
	 			<tr class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" >
					   <td><?php echo $eleveAvss['avsnom'].'&nbsp;'. $eleveAvss['avsprenom'].'<br>contrat :&nbsp;'.$contratAvs[0]['typecontrat'].'<br>du '.
					   format_date($contratAvs[0]['date_debut_contrat'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($contratAvs[0]['date_fin_contrat'],'dd/MM/yyyy').
					   '<br>Temps Hebd. :&nbsp;'.$contratAvs[0]['temps_hebdo'].'H'?>
					   </td>	
					   <td><?php echo $eleveAvss['quotitehorraireavs'].'H'; ?></td>
					    <td><?php echo '&nbsp;du&nbsp'.format_date($eleveAvss['datedebut'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($eleveAvss['datefin'],'dd/MM/yyyy') ?></td>
					   <td><a href="<?php echo url_for('eleve_avs/edit?id='.$eleveAvss['id'].'&eleve_id=' . $eleveAvss['EleveId'] . '&avs_id=' . $eleveAvss['avs_id']); ?>"><?php echo 'Modifier'  ?>
						</a>&nbsp;<a><?php echo link_to('Créer ', 'eleve_avs/new?eleve_id=' . $eleveAvss['EleveId'].'&avs_id=' . $eleveAvss['avs_id'] ) ?></a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
        </table>
</div> 
</div>       
 <!--------------------------------------------------------------------------------------->       
        

