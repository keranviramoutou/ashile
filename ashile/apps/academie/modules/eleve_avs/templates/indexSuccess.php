<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>


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

 <?php // echo print_r($eleve_avss); ?>

	<h3>Gestion des Personnels > Gestion des affectations > Liste des élèves accompagnés à ce jour</h3> </h3> <div class='aide' onClick="<?php echo url_for('eleve_avs/aide') ?>"> </div> 
        <p>Seules les affectations élèves sans date de Fin dacc.ou avec une date de fin d'acc. supérieure à la date du jour pas être modifiées</>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
		<thead>
			<tr>   
                <th>Secteur</th>
				<th>Eleve</th>
                <th> Etab. d'affectation  </th>
                <th>Date Naiss.</th>
				<th>Avs</th>
                <th>Affectation</th>
				<th>Q.H.</th>
				<th>Affect. du</th>
				<th>au</th>
				<th>Etat acc.</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($eleve_avss as $eleve_avs): ?>
				<tr>
					<td><?php echo $eleve_avs['secteur'] ?></td>
					<td><a href="<?php //echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve_avs['EleveId'],  'academie' => 'true')) 
					
						echo url_for('eleve/edit?id='.$eleve_avs['EleveId'].'&secteur_id=' . $eleve_avs['secteur_id']);
					
					?>"> <?php echo $eleve_avs['nom'].'  '.$eleve_avs['prenom']?></a></td>
					<td><?php echo '<br>'.$eleve_avs['rne'].'</br>'.$eleve_avs['typetab'].'  '.$eleve_avs['etab'] ?></td>
					<td><?php echo format_date($eleve_avs['datenaissance'],'dd/MM/yyyy') ?></td>                                        
					<td><?php echo $eleve_avs['avsnom'].'&nbsp-&nbsp'.$eleve_avs['avsprenom'] ?></td>
					<td><?php if($eleve_avs['etat_acc'] < $eleve_avs['datefin']) { ?>
					<a href="<?php echo url_for('eleve_avs/edit?id='.$eleve_avs['id'].'&eleve_id=' . $eleve_avs['EleveId'] . '&avs_id=' . $eleve_avs['avsid'].'&secteur_id=' . $eleve_avs['secteur_id']); ?>"><?php echo 'Modifier'  ?>
					<?php echo link_to('Créer ', 'eleve_avs/new?eleve_id=' . $eleve_avs['EleveId'].'&secteur_id=' . $eleve_avs['secteur_id'] ) ?></a></td>
					<?php }else{ ?>
					  <?php echo link_to('Créer ', 'eleve_avs/new?eleve_id=' . $eleve_avs['EleveId'].'&secteur_id=' . $eleve_avs['secteur_id'] ) ?></a></td>
					<?php } ?>
					<td><?php echo $eleve_avs['quotite'] ?></td>
					<td><?php echo format_date($eleve_avs['datedebut'],'dd/MM/yyyy') ?></td>
					<td><?php echo format_date($eleve_avs['datefin'],'dd/MM/yyyy') ?></td>
					<td><?php echo format_date($eleve_avs['etat_acc'],'dd/MM/yyyy') ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>

<script>
var src = "<?php echo url_for('eleve_avs/aide') ?>";

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




