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

<br><h3>&nbsp;Dossier MDPH > Demande de Transport >  Traitement CDA en Attente</h3><br>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Eleve</th>
	  <th>Secteur</th>
      <th>Transport demandé</th>
      <th>Dossier ASH</th>
      <th>Date signature CERFA</th>
      <th>Date ESS</th>
      <th>Date d'envoi a la MDPH</th>		
    </tr>
  </thead>

<?php
	foreach($demande_transports as $demande_transport):
?>
	<tr>
              <td><a href="<?php echo url_for('$demandetransport/edit?id=' . $demande_transport->getId()) ?>"><?php echo $demande_transport->Mdph->Eleve->nom. '&nbsp&nbsp'. $demande_transport->Mdph->Eleve->prenom ?></a>
			   <?php echo '<br>né(e) le &nbsp;'.format_date($demande_transport->Mdph->Eleve->datenaissance,'dd/MM/yyyy') ?></td>
              <td><?php echo '<small>'.$demande_materiel['libellesecteur'].'</small>'?></td>
			  <td><?php echo $demande_transport->getTransport() ?></td>
              <td> <a href="<?php echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $demande_transport->Mdph->Eleve->id,  'academie' => 'true'))."#div_mdph" ?>"><?php  echo  $demande_transport->Mdph->id ?></a></td>
              <td><?php echo format_date($demande_transport->Mdph->datecreationpps,'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_transport->Mdph->dateess,'dd/MM/yyyy') ?></td>
	          <td><?php echo format_date($demande_transport->Mdph->dateenvoiedossier,'dd/MM/yyyy') ?></td>
    </tr>	
        <?php endforeach; ?>
</table>


<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>

