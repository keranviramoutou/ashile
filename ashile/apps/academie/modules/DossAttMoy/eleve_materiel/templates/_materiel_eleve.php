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
               "sLengthMenu":     "Afficher _MENU_ matériel(s) alloué(s)  ",
               "sZeroRecords":    "Aucun mouvement &agrave; afficher",
               "sInfo":           "Affichage du matériel _START_ &agrave; _END_ sur _TOTAL_ matériel(s) alloué(s)",
               "sInfoEmpty":      "Affichage du matériel alloué 0 &agrave; 0 sur 0 matériel(s) alloué(s)",
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

<h3>Historique des matériels prêtés à cet Eleve</h3>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
			<thead>
				<tr>   
					 <th>Materiel</th>
					 <th>Debut du prêt</th>
					 <th>Fin du prêt</th>
					 <th>convention <br>editée le</th>
					 <th>N° convention</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($materielEleve as $materielEleves): ?>
				<tr>
					<td><?php if(format_date($materielEleves['datefin'],'yyyy/MM/dd') >= format_date(time(),'yyyy/MM/dd')) { ?>
					<a href="<?php echo url_for('materiel/edit?id='.$materielEleves['materielId']) ?>"><?php  echo '&nbsp'.$materielEleves['typemateriel'].'&nbsp;-&nbsp;'.$materielEleves['libellemateriel'] .'&nbsp&nbspn° '.$materielEleves['numeromateriel'] ?></a></td>
					<?php }else{ ?>
					<?php echo $materielEleves['libellemateriel'] .'&nbsp,&nbsp;n° '.$materielEleves['numeromateriel'] ?></td>
					<?php } ?>
				    <td><?php echo format_date($materielEleves['datedebut'],'dd/MM/yyyy') ?></td>
				    <td><?php echo format_date($materielEleves['datefin'],'dd/MM/yyyy') ?></td>
				    <td><?php echo format_date($materielEleves['dateconvention'],'dd/MM/yyyy') ?></td>
					<td><?php echo $materielEleves['numero_convention'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
        </table>
		
<p> Seuls les matériels avec un date de convention supérieure à la date du jour seront imprimés sur la convention </p>
<p> Seules les attributions de prêt de matériel avec un date de fin de prêt supérieure à la date du jour pourront être modifiées  </p><br>		
 <!--------------------------------------------------------------------------------------->  

