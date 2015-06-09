
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
               "sLengthMenu":     "Afficher _MENU_ secteur(s)",
               "sZeroRecords":    "Aucun &eacute;l&egrave;ve &agrave; afficher",
               "sInfo":           "Affichage de l'&eacute;l&egrave;ve _START_ &agrave; _END_ sur _TOTAL_ secteur(s)",
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


<div class='aide' onClick="<?php echo url_for('secteur/aide') ?>"> </div>
<h3>Gestion des personnels acc. > Gestion des Affectations > liste des affectations par secteur</h3>

<div id="secteur">

<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Secteur</th>

    </tr>
  </thead>


    <?php foreach ($secteurs as $secteur): ?>
    <tr>
     <!-- <td><a href="<?php echo url_for('eleve_avs/secteur?secteur_id='.$secteur->getId()) ?>"><?php echo $secteur->getId() ?></a></td> 
      <td><?php echo $secteur->getSfguarduserId() ?></td> -->
      <td><a href="<?php echo url_for('eleve_avs/secteur?secteur_id='.$secteur->getId()) ?>"><?php echo $secteur->getLibellesecteur() ?></td>
    </tr>
    <?php endforeach; ?>


</table>
</div>
<script>
var src = "<?php echo url_for('secteur/aide') ?>";

$j(document).ready(function(){
        $j('.aide').click(function (){
                $j.modal('<iframe src="' + src + '" height="450" width="300" style="border:0">', {
                        closeHTML:"",
                        containerCss:{
                                backgroundColor:"#fff",
                                borderColor:"#fff",
                                height:450,
                                padding:0,
                                width:300
                        },
                        overlayClose:true
                });
        });
});

</script>




