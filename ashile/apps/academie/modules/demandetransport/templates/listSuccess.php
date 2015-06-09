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
<br><h3>Dossier MDPH > Demande de Transport > Affectation des Ressources</h3><br>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Eleve</th>
      <th><Date Naiss.</th> 
      <th>Type transport</th>
      <th>N° Doss. MDPH</th>
      <th>Date CERFA</th>
      <th>Date ESS</th>
      <th>Date envoi MDPH </th>
      <th>Date CDA </th>
      <th>Date deb. notif. </th>
      <th>Date fin notif. </th>

    </tr>
  </thead>

<?php
	foreach($demande_transports as $demande_transport):
?>
<tr> 
               <td><a href="<?php echo url_for('transport_obtenu/new?eleve_id='.$demande_transport->Mdph->Eleve->id).'&demandetransport_id='.$demande_transport['id'] ?>"><?php echo $demande_transport->Mdph->Eleve->nom.'&nbsp-&nbsp'. $demande_transport->Mdph->Eleve->prenom ?></a></td>
              <td><?php echo format_date($demande_transport->Mdph->Eleve->datenaissance,'dd/MM/yyyy') ?></td>            	     
              <td><?php echo $demande_transport->getTransport() ?></td>
              <td><?php echo '<strong>'.$demande_transport->Mdph->Eleve->numeromdph.'</strong>&nbsp&nbsp(&nbsp'.$demande_transport->Mdph->id.'&nbsp)' ?></td>
              <td><?php echo format_date($demande_transport->Mdph->datecreationpps,'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_transport->Mdph->dateess,'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_transport->Mdph->dateenvoiedossier,'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_transport->datedecisioncda,'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_transport->datedebutnotif,'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_transport->datefinnotif,'dd/MM/yyyy') ?></td>

     </tr>	
        <?php endforeach; ?>
</table>

