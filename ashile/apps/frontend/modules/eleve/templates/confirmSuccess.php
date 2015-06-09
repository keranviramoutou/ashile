   <?php echo $sf_request->getParameter('nom') ?>
   
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>


<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#eleveTable').dataTable({
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
<?php $route = $sf_request->getHost(); ?>
<h1> <?php echo 'liste des aumonymes pour l\'élève le nom contenant:&nbsp;'.$sf_request->getParameter('eleve_nom').'&nbsp;né(e) le&nbsp;'.format_date($sf_request->getParameter('datenaissance'),'dd/MM/yyyy') ?> </h1>
  
<table cellpadding="0" cellspacing="0" border="0" class="display" id="eleveTable">
    <thead>
        <tr>
             
            <th>Elève</th>
			<th>secteur élève </th>
            <th>Scolarisation </th>


        </tr>
    </thead>
    <tbody>
        <?php foreach ($eleves as $eleve): ?>
          
                
                <td><?php echo $eleve['nom'].''. $eleve['prenom'].'&nbsp;né(e) le &nbsp:'. format_date($eleve['datenaissance'],'dd/MM/yyyy') ?></td>
                <td><?php echo $eleve['libellesecteur']  ?></td>
				<td><?php echo $eleve['typetab'].'  ' . $eleve['nometabsco'].'&nbsp;-&nbsp;'.$eleve['rne'] ?></td>
              
             
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



