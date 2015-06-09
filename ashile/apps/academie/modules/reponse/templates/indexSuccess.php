<h3>Enquête > DGESCO > Paramètrage de l'Enquête</h3>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>

<div class='aide' onClick="<?php echo url_for('reponse/aide') ?>"> </div> 
<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#reponseTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage" : {
                "sProcessing":     "Traitement en cours...",
                "sLengthMenu":     "Afficher _MENU_ Questions  ",
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
<?php $route = $sf_request->getHost(); ?>
 <br><?php echo button_to('Créer une réponse','reponse/new') ?><br><br>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="reponseTable">
  <thead>
    <tr>
      <th>Id</th>
      <th>Reponse</th>
      <th>Libelle de la réponse</th>
      <th>Filtre de la réponse (degré etab)</th>
      <th>Num reponse</th>
      <th>Question</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($reponses as $reponse): ?>
    <tr>
      <td><a href="<?php echo url_for('reponse/edit?id='.$reponse->getId()) ?>"><?php echo $reponse->getId() ?></a></td>
      <td><?php echo $reponse->getReponse() ?></td>
      <td><?php echo $reponse->getLibelleReponse() ?></td>
      <td><?php echo $reponse->getDegreetabsco() ?></td>
      <td><?php echo $reponse->getNumReponse() ?></td>
      <td><?php echo $reponse->getQuestionId() ?></td>
 
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br>

<script>
var src = "<?php echo url_for('reponse/aide') ?>";

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


  <a href="<?php echo url_for('reponse/new') ?>">New</a>
