<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>

<br>
<h3>Enquêtes > DGESCO >Génèration de l'enquête</h3>
cette opération consiste à générer pour tous les élèves scolarisés en milieu ordinaire à ce jour<br>
la liste des questions  à compléter
<br>
<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#eleveTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage" : {
                "sProcessing":     "Traitement en cours...",
                "sLengthMenu":     "Afficher _MENU_ Résultats   ",
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






<table cellpadding="0" cellspacing="0" border="0" class="display" id="eleveTable">
    <thead>
    <tr>

      <th>question</th>	  
      <th>question</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $question): ?>
	
		
    <tr>
	   <td><?php echo $question['question_id'] ?></td>
	    <td><?php  echo $question['question'] ?></td>
    </tr>
 
        <?php endforeach; ?>
    </tbody>
</table>


 <br> <?php echo button_to('Retour', 'secteur/recherche4') ?>
  



