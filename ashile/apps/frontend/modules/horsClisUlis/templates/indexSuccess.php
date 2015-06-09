<?php use_helper('jQuery') ?>
<?php  use_stylesheet('data_table.css') ?>
<?php  use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
		   		    "iDisplayLength": 50,
			"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
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



<div id="listeEleve" >

<table width='95%'>
<tr height='20px'>
<td width='65%' valign ="center" >
<h1>Liste des Eleves hors Clis ou Ulis secteur : <?php echo $classeHorsClisEtUlis[0]['libellesecteur']?></h1>
</td>
<td width='35%' align="right" valign ="center">
<button style="float: right" onClick="window.location.href='<?php echo url_for(array('module' => 'horsClisUlis', 'action' => 'excel')) ?>'">Export Excel</button>&nbsp;
<button style="float: right" onClick="window.location.href='<?php echo url_for(array('module' => 'horsClisUlis', 'action' => 'pdf')) ?>'">&nbsp;Export Pdf&nbsp;&nbsp;</button>
</td>
</tr>
</table>




<br>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
   <thead>
       <tr>
        
           <th>Nom</th>
           <th>Prénom</th>
           <th>Date de Naissance</th>
           <th>Etablissement </th>
		   <th>Classe</th>
		
       </tr>
   </thead>
   <tbody>
       <?php foreach ($classeHorsClisEtUlis as $eleve): ?>
           <tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve['eleveId']))  ?>'"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
        
               <td><?php echo $eleve['nom']; ?></td>
               <td><?php echo $eleve['prenom']; ?></td>
               <td><?php echo format_date( $eleve['datenaissance'],'dd/MM/yyyy')?></td>
               <td><?php echo $eleve['rne'].' - '.$eleve['typetab'].'&nbsp;'.$eleve['nometabsco'] ?></td>
			   <td><?php echo $eleve['nomlongtypeclasse']; ?> </td>
			 

           </tr>
       <?php endforeach; ?>
   </tbody>
</table>
<br />