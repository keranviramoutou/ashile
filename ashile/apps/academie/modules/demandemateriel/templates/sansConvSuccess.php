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
<h3>Dossier MDPH > Demande de Matériel > Affectation des Ressources</h3>

<?php use_helper('jQuery') ?>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Eleve</th>
      <th><Date Naiss.</th>
      <th>Type Materiel</th>
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
	foreach($demande_materiels as $demandemateriel):
?>
<tr>
        <td><a href="<?php echo url_for('eleve_materiel/new?eleve_id='.$demandemateriel['eleve_id'].'&demandemateriel_id='.$demandemateriel['id'].'&typemateriel_id='.$demandemateriel['typemateriel_id']); ?>"><?php echo $demandemateriel['nomeleve'].'&nbsp-&nbsp'. $demandemateriel['prenomeleve'] ?></a></td>

            <td><?php echo format_date($demandemateriel['datenaissanceeleve'],'dd/MM/yyyy') ?></td>
            <td><?php echo $demandemateriel['typemateriel'] ?></td>
            <td><?php echo '<strong>'.$demandemateriel['numeromdph'].'</strong>&nbsp&nbsp(&nbsp'.$demandemateriel['mdph_id'].'&nbsp)' ?></td>
            <td><?php echo format_date($demandemateriel['datecreationpps'],'dd/MM/yyyy') ?></td>
            <td><?php echo format_date($demandemateriel['dateess'], 'dd/MM/yyyy') ?></td>
            <td><?php echo format_date($demandemateriel['dateenvoiedossier'],'dd/MM/yyyy') ?></td>
            <td><?php echo format_date($demandemateriel['datedecisioncda'],'dd/MM/yyyy') ?></td>
            <td><?php echo format_date($demandemateriel['datedebutnotif'],'dd/MM/yyyy') ?></td>
            <td><?php echo format_date($demandemateriel['datefinnotif'],'dd/MM/yyyy') ?></td>
    </tr>	
        <?php endforeach; ?>
</table>

