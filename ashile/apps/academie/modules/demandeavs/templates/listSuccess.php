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
<br><h3> Dossier MDPH > Demande de Personnel acc. > Affectation de Personnel acc.</h3><br>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
     <th>Eleve</th>
     <th> Affectation</th>	 
     <th>Date ESS</th>
     <th>Date envoi MDPH </th> 
     <th>Date CDA </th>
	 <th>Date Fin acc.</th>
     <th>Date deb. Notif </th>
     <th>Date Fin  Notif </th>
     <th>Secteur</th>
     <th>Etablissement</th>
   </tr>
  </thead>

<?php
	foreach($demande_avss as $demandeavs):
?>
    <tr>
             <td><?php echo $demandeavs['nomeleve'].'&nbsp-&nbsp'. $demandeavs['prenomeleve'].'<br>'.format_date($demandeavs['datenaissanceeleve'],'dd/MM/yyyy') ?></td>
			 <td><?php echo link_to('créer','eleve_avs/new?eleve_id=' . $demandeavs['eleve_id'].'&demandeavs_id='.$demandeavs['id'] ) ?>  <?php echo link_to('clore', 'eleve/edit?id='.$demandeavs['eleve_id'] ) ?></td>
             <td><?php echo format_date($demandeavs['dateess'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['dateenvoiedossier'],'dd/MM/yyyy') ?></td> 
             <td><?php echo format_date($demandeavs['datedecisioncda'],'dd/MM/yyyy') ?></td>
			 <td><?php echo format_date($demandeavs['etat_acc'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['datedebutnotif'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['datefinnotif'],'dd/MM/yyyy') ?></td>
             <td><?php echo $demandeavs['secteur'] ?></td>
             <td><?php echo '<small>'.$demandeavs['typetab'].'&nbsp;'.$demandeavs['etabsco'].$demandeavs['rne'].'</small>' ?></td>

 
     </tr>	
<?php endforeach; ?>

</table>

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

