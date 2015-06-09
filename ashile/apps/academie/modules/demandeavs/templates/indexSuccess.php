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


<div class='aide' onClick="<?php echo url_for('demandeavs/aide') ?>"> </div>
<br><h3> Dossier MDPH > Demande d'accompagnant > Traitement CDA en attente</h3>
<br>
 <div id="demande_avs">   
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
	  <th>Secteur</th>
      <th>Eleve</th>
	        <th>Scolarité</th>
      <th>Type d'accompagnement<br>demandé</th>
      <th>N° Doss. ASH</th>
      <th>Date CERFA</th>
      <th>Date ESS</th>
      <th>Date envoi MDPH </th>

    </tr>
  </thead>

<?php
	foreach($demande_avss as $demandeavs):
?>
    <tr>
	          <td><?php echo $demandeavs['secteur'] ?></td>
              <td><a href="<?php echo url_for('demandeavs/edit?id=' . $demandeavs['demandeavs_id'].'&mdph_id='.$demandeavs['mdph_id'].'&retour=2') ?>"><?php echo $demandeavs['nom'].'&nbsp-&nbsp'. $demandeavs['prenom'].'&nbsp;(<small>'.$demandeavs['eleve_id'].'</small>)' ?></a>
			  <?php echo '<br>né(e) le &nbsp;'. format_date($demandeavs['datenaissance'],'dd/MM/yyyy') ?></td>
		     <td><?php echo '<small>'.$demandeavs['typetab'].'&nbsp;'.$demandeavs['etabsco'].$demandeavs['rne'].'</small>'  ?></td>
              <td><?php echo $demandeavs['naturecontrat']  ?></td>
              <td><?php echo $demandeavs['mdph_id'] ?></td>
              <td><?php echo format_date($demandeavs['datecreationpps'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demandeavs['dateess'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demandeavs['dateenvoiedossier'],'dd/MM/yyyy') ?></td>

   
    </tr>	
        <?php endforeach; ?>



</table>
</div>
<script>
var src = "<?php echo url_for('demandeavs/aide') ?>";

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



