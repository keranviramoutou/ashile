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

<br><h3>Dossier MDPH > Demande de Matériel > Traitement CDA en Attente</h3><br>

<?php 
	$eleve_id = "";
 ?>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
	   <th>Secteur</th>
      <th>Eleve</th>
	  <th>Scolarité</th>
      <th>Materiel</th>
      <th>N° Doss. ASH</th>
      <th>Date CERFA</th>		
      <th>Date ESS</th>
      <th>Date envoi MDPH </th>


    </tr>
  </thead>

<?php
	foreach ($demande_materiels as $demande_materiel): 
?>
              </tr>
			  <td><?php echo '<small>'.$demande_materiel['libellesecteur'].'</small>'?></td>

				<td><a href="<?php echo url_for('demandemateriel/edit?id='. $demande_materiel['demandemateriel_id'].'&eleve_id='. $demande_materiel['eleve_id'].'&retour=2') ?>"><?php echo $demande_materiel['nomeleve'].'&nbsp-&nbsp'. $demande_materiel['prenomeleve'].'&nbsp;(<small>'.$demande_materiel['eleve_id'].'</small>)'  ?></a>
             <?php echo '<br>né(e) le &nbsp;'.format_date($demande_materiel['datenaissanceeleve'],'dd/MM/yyyy') ?></td>
			  <td><?php echo '<small>'.$demande_materiel['typetab'].'&nbsp;'. $demande_materiel['nometabsco'].'&nbsp;-&nbsp'.$demande_materiel['rne'].'</small>'  ?></td>   
              <td><?php echo $demande_materiel['typemateriel'] ?></td>
              <td>	 <a href="<?php echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $demande_materiel['eleve_id'],  'academie' => 'true'))."#div_mdph" ?>"><?php  echo  $demande_materiel['mdph_id'] ?></a></td>
              <td><?php echo format_date($demande_materiel['datecreationpps'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_materiel['dateess'], 'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_materiel['dateenvoiedossier'],'dd/MM/yyyy') ?></td>

  
    </tr>	
        <?php endforeach; ?>
</table>


<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>
