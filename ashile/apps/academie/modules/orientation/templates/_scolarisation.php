<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_helper('Date') ?>


<script type="text/javascript">

   $j(document).ready(function() {
       oTable = $j('#maTable1').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ scolarisations",
               "sZeroRecords":    "Aucun &eacute;l&egrave;ve &agrave; afficher",
               "sInfo":           "Affichage de la scolarisation _START_ &agrave; _END_ sur _TOTAL_ scolarisations",
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

	<?php 	if(!$existhistosco){	?>	

	<br><h3>Historique Scolarisation en milieu ordinaire</h3></br>
	<table cellpadding="0" cellspacing="20" border="0" class="display" id="maTable1">
	  <thead>
	    <tr>
	      <th>Etablissement scolaire</th>
		  <th>classe</th>
	      <th>Debut de scolarisation</th>
	      <th>Fin de scolarisation</th>
		  
	    </tr>
	  </thead>
	  <tbody>


	    <?php foreach ($scolarisation as $histosco): ?>
	   <tr>
	           <td><?php echo $histosco['typetab'].'  ' . $histosco['nometabsco'] .' - '.$histosco['rne']  ?></td>
               <td><?php echo $histosco['nomlongtypeclasse']; ?></td>
               <td><?php  echo format_date($histosco['datedebut'],'dd/MM/yyyy')?></td>
               <td><?php echo  format_date($histosco['datefin'],'dd/MM/yyyy')?></td>
         
	    </tr>
		<?php endforeach; ?>
		
		<?php }else{ ?>
	
		    <tr><td colspan="7" style="font-style: italic">Cet élève n'a pas de scolariation en milieu ordinaire</td></tr>
		<?php } ?>
	    </tbody>
	</table>


