<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>


<h1>Etablissements spécialisés</h1>

<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#etabnonsco').dataTable({
            "bJQueryUI": true,
					 "iDisplayLength": 50,
			"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
            "sPaginationType": "full_numbers",
					   		"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
            "oLanguage" : {
                "sProcessing":     "Traitement en cours...",
                "sLengthMenu":     "Afficher _MENU_ Résultats   ",
                "sZeroRecords":    "Aucun &eacute;l&egrave;ve &agrave; afficher",
                "sInfo":           "Affichage de l'établissement _START_ &agrave; _END_ sur _TOTAL_ établissements",
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



<table cellpadding="0" cellspacing="0" border="0" class="display" id="etabnonsco">
  <thead>
    <tr>
    
     <th>Nom de l'établissement</th>
      <th>Adresse de l'établissement </th>
      <th>Téléphone</th>
      <th>Email</th>
	  <th>Fax</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($etabnonscos as $etabnonsco): ?>
    <tr>

      <td><?php echo '<small>'.trim($etabnonsco->getTypeetablissementnonsco()) .' &nbsp;:&nbsp;'. $etabnonsco->getNometabnonsco().'</small>' ?></td>
      <td><?php echo '<small>'.trim($etabnonsco->getAdresseetabnonscobat()).'&nbsp;'.$etabnonsco->getAdresseetabnonscorue().'&nbsp;<br>'.$etabnonsco->getQuartier().'</small>'  ?></td>
      <td><?php echo '<small>'.$etabnonsco->getTeletabnonsco().'</small>' ?></td>
      <td><?php echo '<small>'.$etabnonsco->getEmailetabnonsco().'</small>' ?></td>
      <td><?php echo '<small>'.$etabnonsco->getFaxetabnonsco().'</small>' ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


 
  



