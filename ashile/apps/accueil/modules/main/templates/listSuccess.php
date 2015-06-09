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
<h1>Liste des Eleves du secteur : <?php echo $eleves[0]['libellesecteur']?><span><button style="float: right" onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'index')) ?>'">Liste des élèves par établissement</button></span></h1>
<br>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
   <thead>
       <tr>
        
           <th>date du message</th>
           <th>Elève</th>
           <th>Sujet </th>
           <th>Contenu</th>
       </tr>
   </thead>
   <tbody>
       <?php foreach ( $texts as $text): ?>
           <tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve['eleveId']))  ?>'"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
        
               <td><?php echo format_date($text['date'],'dd/MM/yyyy'); ?></td>
               <td><?php echo link_to($text['nom'].'&nbsp'.$text['prenom'], 'eleve/edit?id=' . $text['eleve_id'] ).'</i></br>'; ?></td>
               <td><?php echo $text['sujet']?></td>
               <td><?php echo $text['texte'] ?></td>

           </tr>
       <?php endforeach; ?>
   </tbody>
</table>
<br />
</DIV>

     <div style=margin-left:50px>
	<!-- le bouton -->
	<form>
	  <br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Entrer"  OnClick="location.href= '<?php echo $direction; ?>'" >
		&nbsp;<input type="button" value="Retour"  OnClick="location.href= '<?php echo $retour; ?>'" >
	</form>	
	</div>

