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
<div class='aide' onClick="<?php echo url_for('demandemateriel/aide#attribution') ?>"> </div> 
<br><h3>Dossier MDPH > Demande de Matériel > Affectation des Ressources</h3><br>
<?php echo ' Demande(s) matériel à l\'état de traitement A ATTRIBUER<br>'?>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Eleve</th>
      <th>Type Materiel<br>Demande</th>
      <th>Catégorie matériel</th>
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
        <td><?php echo '<small>'.$demandemateriel['nomeleve'].'&nbsp-&nbsp'. $demandemateriel['prenomeleve'].'</small>&nbsp;&nbsp;' ?><a href="<?php echo url_for('eleve_materiel/new?eleve_id='.$demandemateriel['eleve_id'].'&demandemateriel_id='.$demandemateriel['id'].'&typemateriel_id='.$demandemateriel['typemateriel_id']); ?>">Prêt</a>
        <?php echo '<small><br>né(e) le &nbsp;'.format_date($demandemateriel['datenaissanceeleve'],'dd/MM/yyyy').'</small>' ?>
		</td>
            <td><?php echo $demandemateriel['typemateriel'].'&nbsp;&nbsp;' ?><a href="<?php echo url_for('demandemateriel/edit?id='. $demandemateriel['id'].'&eleve_id='. $demandemateriel['eleve_id']) ?>"><?php echo 'Modifier' ?></a></td>
            <td><?php echo $demandemateriel['libellecatmateriel'] ?></td>
            <td><?php echo format_date($demandemateriel['datecreationpps'],'dd/MM/yyyy') ?></td>
            <td><?php echo format_date($demandemateriel['dateess'], 'dd/MM/yyyy') ?></td>
            <td><?php echo format_date($demandemateriel['dateenvoiedossier'],'dd/MM/yyyy') ?></td>
            <td><?php echo format_date($demandemateriel['datedecisioncda'],'dd/MM/yyyy') ?></td>
            <td><?php echo format_date($demandemateriel['datedebutnotif'],'dd/MM/yyyy') ?></td>
            <td><?php echo format_date($demandemateriel['datefinnotif'],'dd/MM/yyyy') ?></td>
    </tr>	
        <?php endforeach; ?>
</table>

<script>
var src = "<?php echo url_for('demandemateriel/aide') ?>";

$j(document).ready(function(){
        $j('.aide').click(function (){
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
        });
});

</script>