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
<br><h3>Dossier MDPH > Demande de sessad> Affectation des ressources</h3><br>



<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Eleve</th>
      <th>Date. Naiss.</th>    
      <th>Sessad</th>
      <th>N° Doss. MDPH</th>
      <th>Date CERFA </th>
      <th>Date ESS</th>
      <th>Date envoi MDPH</th>
      <th>Date CDA </th>
      <th>Date deb. notif. </th>
      <th>Date fin notif. </th>
      <th>Secteur</th>
      <th>Etablissement</th>
    </tr>
  </thead>

<?php
	foreach($demande_sessads as $demandesessad):
?>


              </tr>
              <td><a href="<?php echo url_for('sessad_obtenu/new?EleveId=' . $demandesessad['EleveId'].'&demandesessad_id='.$demandesessad['id']) ?>"><?php echo $demandesessad['nomeleve'].'&nbsp-&nbsp'. $demandesessad['prenomeleve'] ?></a></td>
              <td><?php echo format_date($demandesessad['datenaissanceeleve'],'dd/MM/yyyy') ?></td>	
              <td><?php echo $demandesessad['libelletypesessad'] ?></td>
              <td><?php echo '<strong>'.$demandesessad['numeromdph'].'</strong>&nbsp&nbsp(&nbsp'.$demandesessad['demandesessad_id'].'&nbsp)' ?></td>
              <td><?php echo format_date($demandesessad['datecreationpps'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demandesessad['dateess'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demandesessad['dateenvoiedossier'],'dd/MM/yyyy') ?></td> 
              <td><?php echo format_date($demandesessad['datedecisioncda'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demandesessad['datedebutnotif'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demandesessad['datefinnotif'],'dd/MM/yyyy') ?></td>
			  <td><?php echo $demandesessad['libellesecteur'] ?></td>
			  <td><?php echo $demandesessad['nometabsco'] ?></td>
   </tr>	
      <?php endforeach; ?>
</table>

