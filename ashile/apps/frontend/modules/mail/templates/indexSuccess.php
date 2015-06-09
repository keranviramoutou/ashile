<?php use_helper('jQuery') ?>
<?php  use_stylesheet('data_table.css') ?>
<?php  use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
		   "bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
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

<?php
	//echo $sf_user->getAttribute('secteur_id');
	//echo "USER => ".($tests);
   // echo phpinfo();
	
?>

<div id="listeEleve" >
<h1>Historique des messages pour le secteur de <?php echo $secteur->getlibellesecteur()?></h1>
<br>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
   <thead>
       <tr>
        

           <th>Elève</th>
		   <th>Date du message</th>
           <th>Sujet </th>
           <th>Contenu</th>
       </tr>
   </thead>
   <tbody>
       <?php foreach ( $texts as $text): ?>
           <tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $text['eleve_id']))  ?>'"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
               <td><?php echo $text['nom'].'&nbsp'.$text['prenom'] ?></td>
               <td><?php echo '<small>'.format_date($text['date'],'dd/MM/yyyy').'</small>'; ?></td>
  
               <td><?php echo $text['sujet']?></td>
               <td><?php echo '<small>'.$text['texte'].'</small>' ?></td>

           </tr>
       <?php endforeach; ?>
   </tbody>
</table>
<br />
</DIV>

     <div style=margin-left:50px>
	<!-- le bouton -->

	</div>

