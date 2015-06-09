<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>


<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable1').dataTable({
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


<?php if($existEleveAvs) { ?>

	<!-- <div class='aide' onClick="<?php echo url_for('eleve_avs/aide') ?>"> </div> -->
    <br>
	<fieldset>
	<h3> Historique des accompagnements pour :  <?php echo $eleve_avss[0]['avsnom'].'  '.$eleve_avss[0]['avsprenom']?> <?php echo 'né(e) le &nbsp;'.format_date($eleve_avss[0]['avsdatenaissance'],'dd/MM/yyyy') ?></h3> 
	
 
</fieldset>	

		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable1">
		<thead>
			<tr>   
 
				<th>Situation élève&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
				<th>Q.H.</th>
				<th>Affectation</th>
				<th>Etat acc.</th>
				<th>commentaire</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($eleve_avss as $eleve_avs): ?>
				<tr>
					<td><?php echo '<b>'.$eleve_avs['nom'].'&nbsp-&nbsp'.$eleve_avs['prenom'].'</b>&nbsp;<br>né(e)le&nbsp;'.format_date($eleve_avs['datenaissance'],'dd/MM/yyyy')
					. '<br>scolarisé(e) à:<br>&nbsp;'.$eleve_avs['typetab'].'&nbsp;'.$eleve_avs['etab'].'<br>secteur :&nbsp;'.$eleve_avs['secteur'] ?></td>
					<td><?php echo $eleve_avs['quotite'] ?></td>
					<td><?php echo '<small>du&nbsp;'.format_date($eleve_avs['datedebut'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($eleve_avs['datefin'],'dd/MM/yyyy').'</small>' ?></td>
					<td><?php echo format_date($eleve_avs['etat_acc'],'dd/MM/yyyy') ?></td>
					<td><?php echo substr($eleve_avs['commentaire'],0,100) ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php } else { ?>
	<?php echo 'pas d\'accompagnement en cours pour l\'élève :&nbsp;'.$eleve ?>


<?php } ?>


<br><big><a href="<?php //echo url_for('avs/recherche?avs_nom='.$eleve_avss[0]['avsnom'].'&avs_prenom='.$eleve_avss[0]['avsprenom'].'&flag_recherche=1' ) ?>"><!--<button>Retour</button></a></big><br>-->
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




