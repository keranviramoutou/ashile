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
<h3>Dossier MDPH > Demande d'accompagnant >  Suivi de la Demande de Poste</h3>
<br>


<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
	 <th>Secteur</th>
     <th>Eleve</th>
     <th>N° Doss. ASH</th>
	  <th>Etat acc. </th>
     <th>Date CDA </th>
     <th>Debut Notif </th>
     <th>Fin  Notif </th>
     <th>Recep. Demand. ERF</th>
     <th>Dem. DSM </th>
     <th>Decis. DSM </th>
 
   </tr>
  </thead>
<?php $param = 'suiviDSM' ?>
<?php
	foreach($demande_avss as $demandeavs):
?>
            <tr onClick="window.location.href='<?php echo url_for('suiviDSM/edit?id=' . $demandeavs['demandeavs_id'])?>'" style="cursor: pointer" >
			 <td> <?php echo '<small>'.$demandeavs['secteur'].'</small>' ?></td>
			 <td><a href="<?php echo url_for('eleve/edit?id='.$demandeavs['EleveId'] .'&param='.$param);?>">
			 <?php echo $demandeavs['nomeleve'].'  '.$demandeavs['prenomeleve'].'&nbsp;('.$demandeavs[EleveId].')'?></a>
			  <?php echo '<br>né(e) le &nbsp;'. format_date($demandeavs['datenaissance'],'dd/MM/yyyy') ?></td>
             <td><?php echo '</strong>'.$demandeavs['mdph_id'].'' ?></td>
			 <td><?php echo format_date($demandeavs['etat_acc'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['datedecisioncda'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['datedebutnotif'],'dd/MM/yyyy') ?></td>
			 <td><?php echo format_date($demandeavs['datefinnotif'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['daterecepdemanderf'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['datedemanddsm'],'dd/MM/yyyy') ?></td>
             <td><?php echo format_date($demandeavs['datedecidsm'],'dd/MM/yyyy') ?></td>
      

 
     </tr>	
 
     </tr>	
<?php endforeach; ?>
</table>

