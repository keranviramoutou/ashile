<?php use_helper('Date') ?>               
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>


<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#detailcommande').dataTable({
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

<h3>Liste des Materiels pour cette commande</h3>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="detailcommande">
    <thead>
        <tr>
			<td>Commande N°</td>
			<td>Type de Materiel</td>
			<td>quantite</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($detailcommandes as $detailcommande): ?>
           <tr onClick="window.location.href='<?php echo  url_for('detailcommande/edit?id='.$detailcommande['id'])?>'" style="cursor: pointer" >
                 <td><?php echo $detailcommande['commande'] ?></td> 
                 <td><?php echo $detailcommande['type'] ?></td> 
                 <td><?php echo $detailcommande['quantite'] ?></td>                 
			
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



