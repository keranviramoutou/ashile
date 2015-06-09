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

<div class='aide' onClick="<?php echo url_for('demandeorientation/aide') ?>"> </div> 
<br><h3>Dossier MDPH > Demande d'orientation > Traitement CDA en Attente</h3><br>



<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
	<th> Secteur </th>
      <th>Eleve</th>
      <th>Classeext</th>
      <th>Nbre de demi-journée</th>
      <th>N° Doss. ASH</th>
      <th>Date CERFA</th>
      <th>Date ESS</th>
      <th>Date envoi MDPH </th>

    </tr>
  </thead>
    <?php foreach ($demande_orientations as $demande_orientation): ?>   
<tr>
	 <td> <?php echo '<small>'.$demande_orientation['libellesecteur'].'</small>' ?></td>
 <td><a href="<?php echo url_for('demandeorientation/edit?id=' . $demande_orientation['id'].'&mdph_id='.$demande_orientation['mdph_id']) ?>"><?php echo $demande_orientation['nomeleve'].'&nbsp-&nbsp'. $demande_orientation['prenomeleve'].'</a>&nbsp;('.$demande_orientation['EleveId'].')' ?>
  <?php echo '<br>né(e) le &nbsp;'.format_date($demande_orientation['datenaissanceeleve'],'dd/MM/yyyy') ?></td>	     

              <td><?php echo $demande_orientation['libelle_classe_ext'] ?></td>
			  <td><?php echo $demande_orientation['libelledemijournee'] ?></td>
              <td> <a href="<?php echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $demande_orientation['EleveId'],  'academie' => 'true'))."#div_mdph" ?>"><?php  echo  $demande_orientation['mdph_id'] ?></a></td>
              <td><?php echo format_date($demande_orientation['datecreationpps'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_orientation['dateess'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_orientation['dateenvoiedossier'],'dd/MM/yyyy') ?></td>


   </tr>	
   <?php endforeach; ?>
</table>



<script>
var src = "<?php echo url_for('demandeorientation/aide') ?>";

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

<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>
