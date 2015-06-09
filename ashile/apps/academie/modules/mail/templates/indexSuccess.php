
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
<?php echo button_to('Créer message', 'mail/new'); ?>
<h1>Historique des messages</h1>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>

      <th>Eleve</th>
      <th>ERF destinataire</th>
      <th>Date de création</th>
      <th>Sujet</th>
      <th>Texte</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($mails as $mail): ?>
    <tr>
      <td><a href="<?php echo url_for('mail/edit?id='.$mail->getId()) ?>"><?php echo $mail->getEleve() ?></a></td>
       <td><?php echo $mail->getSfGuardUser() ?></td>
      <td><?php echo format_date( $mail->getDate(),'dd/MM/yyyy') ?></td>
      <td><?php echo $mail->getSujet() ?></td>
      <td><?php echo $mail->getTexte() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


