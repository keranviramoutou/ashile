<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<?php if($existeleveEnCharge){ ?>
<!---------------------- tableau JQuery eleves attribués à l avs ------------------------------------>
<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "<?php echo 'Elèves accompagnés par <br><strong>'.$eleveEnCharge[0]['avsnom'].'&nbsp;'. $eleveEnCharge[0]['avsprenom'].'</strong><br>'.'&nbsp;situation&nbsp;au&nbsp;'.format_date(time(),'dd/MM/yyyy') ?>",
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

<div id="eleve_avs">
	<?php if($eleveEnCharge[0]['avsnom']){ ?>
<!--	<h4>Elèves accompagnés par  <?php echo $eleveEnCharge[0]['avsnom'].'&nbsp&nbsp'. $eleveEnCharge[0]['avsprenom'].'&nbspsituation&nbspau&nbsp'.format_date(time(),'dd/MM/yyyy') ?></h4> -->
	<?php } ?>
	
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable"><small>
			<thead>
				<tr>   
					 <th>Secteur</th>
					 <th>Eleve</th>
					 <th>Quotite H.</th>
					 <th>Etab scolaire</th>
					 <th>Prise en Charge </th>
					

				</tr>
			</thead>
			<tbody>
				<?php foreach ($eleveEnCharge as $eleveEnCharges): ?>
				<tr>
				    <td><?php echo $eleveEnCharges['secteur'] ?></td>
					<td><?php echo $eleveEnCharges['nom'].'&nbsp&nbsp'.$eleveEnCharges['prenom'] ?></td>
					<td><?php echo $eleveEnCharges['quotite'].'H'?></td>
					<td><?php echo '<small>'.$eleveEnCharges['typetab'].'  '.$eleveEnCharges['etab'].'&nbsp;<br>'.$eleveEnCharges['rne'].'<small>' ?></td>
					 <td><?php echo '&nbsp;du&nbsp'.format_date($eleveEnCharges['datedebut'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($eleveEnCharges['datefin'],'dd/MM/yyyy') ?></td>


				</tr>
				<?php endforeach; ?>
			</tbody>
        </table></small>
		<?php }else{ 
			echo '<div class="flash_error">Pas d\'élève(s) suivi(s) par cet accompagnant&nbsp'.'&nbspsituation&nbspau&nbsp'.format_date(time(),'dd/MM/yyyy').'</div>';
		} ?>
</div>
 <!--------------------------------------------------------------------------------------->       
        

