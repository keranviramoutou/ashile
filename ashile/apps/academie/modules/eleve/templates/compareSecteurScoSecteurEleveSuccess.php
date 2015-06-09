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

<br><h3>Liste des Elèves dont le secteur est différent du secteur de l'établissement de la scolarité en cours</h3>
* ne sont pas affichés dans cette liste les élèves qui sont attentes de changement de secteur et qui sont scolarisés à l'ASH (9740061Y)<br><br>
<br>&nbsp;&nbsp;&nbsp;<input type="submit" value="Synchronisation Secteur " style="float: left" onClick="synchronisationSecteur()">
<br><br><br>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="eleveTable">
    <thead>
        <tr>
            <th>Nom</th>
            <th>prénom</th>
            <th>Scolarité</th>
            <th>Secteur Scolarité</th>
            <th>Secteur élève</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comparesecteur as $eleve): ?>
                  <tr  onClick="window.location.href='<?php echo  url_for('eleve/edit?id='.$eleve['eleve_id'])?>'" style="cursor: pointer"  >
                <td><?php echo $eleve['nom'] ?></td> 
                <td><?php echo $eleve['prenom'] ?></td>
                <td><?php echo $eleve['typetab'].'  ' . $eleve['nometabsco'].'('.$eleve['rne'].')<br>scolarisé(e) du&nbsp;'.format_date($eleve['datedebut'],'dd/MM/yyyy').'&nbspau&nbsp;'.format_date($eleve['datefin'],'dd/MM/yyyy') ?></td>
                <td><?php echo $eleve['libellesecteur'] ?></td>
			    <td><?php echo $eleve['libellesecteur_etab']?></td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<script>
function synchronisationSecteur() {
	var answer = confirm ('voulez vous synchroniser les secteurs');
	             if (answer==true)
                {
           
					var url_dest = 'https://accueil.in.ac-reunion.fr/ashilep/academie.php/eleve/compareSecteurScoSecteurEleve?synchro=1';
                }
                else
                {
                    alert('Opération de synchronisation abandonnée');
                }
	
	document.location.replace(url_dest); //redirection
}
</script>

