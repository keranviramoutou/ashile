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
<h3>Eleves > Liste des élèves suivis par un AVS</h3>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="eleveTable">
    <thead>
        <tr>
            <th>Secteur</th>
            <th>RNE Etab</th>
            <th>Etab affectation</th>
            <th>Ine</th>
            <th>Eleve</th>
            <th>Date naissance</th>
             <th>Nb AVS affectés</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eleves as $eleve): ?>
           <tr onClick="window.location.href='<?php echo  url_for('eleve/edit?id='.$eleve['eleveId'])?>'" style="cursor: pointer" >
                 <td><?php echo $eleve['libellesecteur'] ?></td> 
                <td><?php echo $eleve['rne'] ?></td>
                <td><?php echo $eleve['typetab'].'  ' . $eleve['nometabsco'] ?></td>
                <td><?php echo $eleve['eleveId'] ?></td>
				<td><a href="<?php echo url_for('eleve/edit?id='.$eleve['eleveId']) ?>">
				<?php 
						$elv = Doctrine::getTAble('Eleve')->findOneById($eleve['eleveId'] );
						echo $elv;
				?></a></td>
                <td><?php echo format_date($eleve['datenaissance'],'dd/MM/yyyy') ?></td>
                <td> <?php echo link_to($eleve['compteur'], 'eleve_avs/new?eleve_id=' . $eleve['eleveId'] ) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php

function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>

