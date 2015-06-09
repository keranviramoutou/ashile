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
<div class='aide' onClick="<?php echo url_for('eleve/aide') ?>"> </div> 
<h3>Liste des materiels affectés à des élèves > gestion des attributions > liste des matériels affectés </h3>

	<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
	  <thead>
		<tr>
          <th>Secteur</th>
          <th>Etab affect.</th>
		  <th>Eleve</th>
          <th>Date naiss.</th>
          <th> Matériel attribué </th> 
		  <th>Dateconvention</th>
		  <th>Début du prêt</th>
		  <th>Fin du prêt</th>
		  <th>attribution</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($elevemateriels as $elevemateriel): ?>
		<tr>
                 <td><?php echo $elevemateriel['libellesecteur'] ?></td>
                <td><?php echo $elevemateriel['rne'] ?></td>
               <td><?php echo $elevemateriel['Eleve']['nom'].'&nbsp-&nbsp'.$elevemateriel['Eleve']['prenom'] ?></a></td>
              <td><?php echo format_date($elevemateriel['Eleve']['datenaissance'],'dd/MM/yyyy') ?></td>
              <td><a href="<?php echo url_for('eleve_materiel/edit?id='.$elevemateriel['id'].'&eleve_id='.$elevemateriel['eleve_id'].'&materiel_id='.$elevemateriel['materiel_id']); ?>"><?php  echo $elevemateriel['libellemateriel']  ?></a></td>
              <td><?php echo format_date($elevemateriel['dateconvention'],'dd/MM/yyyy') ?></td>
        	  <td><?php echo format_date($elevemateriel['datedebut'],'dd/MM/yyyy') ?></td>
        	  <td><?php echo format_date($elevemateriel['datefin'],'dd/MM/yyyy') ?></td>
			  <td><?php if(format_date($elevemateriel['datefin'],'yyyy/MM/dd') >= format_date(time(),'yyyy/MM/dd')) { ?>
							<a href="<?php echo url_for('eleve_materiel/new?eleve_id='.$elevemateriel['eleve_id']) ?>"><?php echo 'Créer' ?></a>
							<?php echo link_to('&nbspModifier','eleve_materiel/edit?id='.$elevemateriel['id'].'&eleve_id='.$elevemateriel['eleve_id'].'&materiel_id='.$elevemateriel['materiel_id'])  ?></td>
					<?php }else{ ?>
							<a href="<?php echo url_for('eleve_materiel/new?eleve_id='.$elevemateriel['eleve_id']) ?>"><?php echo 'Créer' ?></a></td>
			  <?php } ?>
		</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>


<script>
var src = "<?php echo url_for('eleve_materiel/aide') ?>";

$j(document).ready(function(){
        $j('.aide').click(function (){
                $j.modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
                        closeHTML:"",
                        containerCss:{
                                backgroundColor:"#fff",
                                borderColor:"#fff",
                                height:450,
                                padding:0,
                                width:830
                        },
                        overlayClose:true
                });
        });
});

</script>