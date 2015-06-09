
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php  // $breadcrumbs->addItem('My action', 'eleve/index') ?>


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
                "sLoadingRecords": "Téargement...",
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
<h3>Liste des Eleves scolarisés du secteur : &nbsp <?php echo $eleves[0]['libellesecteur'] ?> </h3>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="eleveTable">
    <thead>
        <tr>
 
         
            <th>Eleve</th>
            <th>Orientation</th>
			<th>Etab affectation</th>
             
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eleves as $eleve): ?>
           <tr>
                <td><a href="<?php echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve['eleveId'],  'academie' => 'true')) ?>">
			<?php echo $eleve['nom'].'  '.$eleve['prenom'] ?></a><?php echo ' ( '.$eleve['ine'].') né(e) le '.format_date($eleve['datenaissance'],'dd/MM/yyyy') ?></td>
            	<td> <?php echo link_to('Créer', 'orientation/new?eleve_id=' . $eleve['eleveId'] )  ?> <a href="<?php echo url_for('orientation/edit?id=' . $eleve['orienId'].'&secteur_id=' . $eleve['secteur_id'].'&eleve_id=' . $eleve['eleveId'] ) ?>"><?php echo 'Modifier'  ?></td>
                 <td><?php echo $eleve['typetab'].'  ' . $eleve['nometabsco'] .' - '.$eleve['rne']  ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php

	  // TEST ////////////////////////
	 //sfContext::getInstance()->getUser()->setAttribute('foo', $foo);
	//////////////////////

function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>
