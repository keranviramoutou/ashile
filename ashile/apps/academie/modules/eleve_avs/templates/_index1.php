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

 
        
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
		<thead>
			<tr>   
               
				<th>Eleve</th>
				<th>Affectation </th>
                <th> Etab. de recrutement  </th>
			
				
				
			</tr>
		</thead>
		<tbody>
			<?php foreach ($eleve_avss as $eleve_avs): ?>
				<tr>
					<td><a href="<?php 	echo url_for('eleve/edit?id='.$eleve_avs['EleveId'].'&secteur_id=' . $eleve_avs['secteur_id']);
					?>"> <?php echo $eleve_avs['nom'].'  '.$eleve_avs['prenom']?><?php echo ' né(e) le '. format_date($eleve_avs['datenaissance'],'dd/MM/yyyy') ?></a></td>
					<td> <?php echo link_to('Affecter ', 'eleve_avs/new?eleve_id=' . $eleve_avs['EleveId'].'&secteur_id='. $eleve_avs['secteur_id']) ?></td>
					<td><?php echo $eleve_avs['typetab'].'  '.$eleve_avs['etab'] .' - '.$eleve_avs['rne']?></td>
			   
                    					

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




