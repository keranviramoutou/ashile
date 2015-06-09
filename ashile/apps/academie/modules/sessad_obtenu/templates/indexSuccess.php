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
               "sZeroRecords":    "Aucun &eacute;l&eagrave;ve &agrave; afficher",
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

        <br><h3>Dossier MDPH > Demande de Sessad >Sessad Attribués</h3><br>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
                <thead>
                        <tr>
                                <th>Eleve</th>
                                <th>Dat. Naiss.</th>
                                 <th> Sessad</th>
                                <th>date Début</th>
                                <th>date Fin</th>
                        </tr>
                </thead>
                <tbody>
                        <?php foreach ($sessad_obtenus as $sessad_obtenu): ?>
                                <tr>
                                        <td><a href="<?php  echo url_for('sessad_obtenu/edit?eleve_id=' . $sessad_obtenu->getEleveId() . '&id=' . $sessad_obtenu->getId()) ?>"><?php echo $sessad_obtenu->Eleve->getNom().'&nbsp&nbsp'.$sessad_obtenu->Eleve->prenom ?></a></td>
				<td><?php echo format_date($sessad_obtenu->Eleve->datenaissance,'dd/MM/yyyy') ?></td>
				<td><?php  echo $sessad_obtenu->Sessad->Typesessad->libelletypesessad  ?></td> 
                                <td> <?php  echo format_date($sessad_obtenu->datedebut,'dd/MM/yyyy')?> </td>
                                <td> <?php  echo format_date($sessad_obtenu->datefin,'dd/MM/yyyy')?> </td>
                                </tr>
                        <?php endforeach; ?>
                </tbody>
        </table>




