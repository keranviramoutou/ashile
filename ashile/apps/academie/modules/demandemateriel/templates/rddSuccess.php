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

<h3>Dossier MDPH > Demande de Matériel > Traitement RDD (prolongation)</h3>
<p> <small>Seules les demandes avec un type et une catégorie et à l'état "RDD" sont listées.</p>
<p>La demande de prolongation sera attachée au matériel de la demande matériel précédente de même type et de même catégorie.</p>
<p> La demande matériel passera directement à l'état REMIS.</p>
<p> La date de fin prêt sera modifiée avec la date de fin de notification de la demande de prolongation.</small></p>
<?php 
	$eleve_id = "";
 ?>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
	   <th>Secteur</th>
      <th>Scolarité</th>
      <th>Eleve</th>
      <th>Materiel</th>
      <th>N° Doss. MDPH</th>


    </tr>
  </thead>

<?php
	foreach ($demande_materiels as $demande_materiel): 
?>
              </tr>
			  <td><?php echo '<small>'.$demande_materiel['libellesecteur'].'</small>'?></td>
              <td><?php echo '<small>'.$demande_materiel['typeetab'].'&nbsp;'. $demande_materiel['nometabsco'].'&nbsp;-&nbsp'.$demande_materiel['rne'].'</small>'  ?></td>   
				<td><a href="<?php echo url_for('demandemateriel/edit?id='. $demande_materiel['demandemateriel_id'].'&eleve_id='. $demande_materiel['eleve_id']) ?>"><?php echo $demande_materiel['nomeleve'].'&nbsp-&nbsp'. $demande_materiel['prenomeleve'] ?></a>
             <?php echo '<br>né(e) le &nbsp;'.format_date($demande_materiel['datenaissanceeleve'],'dd/MM/yyyy') ?></td>
              <td><?php echo $demande_materiel['typemateriel'] ?></td>
              <td><?php echo '<strong>'.$demande_materiel['numeromdph'].'</strong>&nbsp&nbsp(&nbsp'.$demande_materiel['mdph_id'].'&nbsp)' ?></td>

    </tr>	
        <?php endforeach; ?>
</table>


