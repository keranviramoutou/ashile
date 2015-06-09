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


<?php if($existEleveAvs) { ?>
<div id="demandeavs"> 
	<div class='aide' onClick="<?php echo url_for('eleve_avs/aide') ?>"> </div> 
<fieldset>
 
	<h3> Liste des accompagnements pour :  <?php echo $eleve_avss[0]['nom'].'  '.$eleve_avss[0]['prenom']?> <?php echo 'né(e) le &nbsp;'.format_date($eleve_avss[0]['datenaissance'],'dd/MM/yyyy') ?></h3> 
	<h5> scolarisé(e) à :&nbsp;<?php echo $dersco1[0]['rne'].'-'.$dersco1[0]['typetab'].'&nbsp'.$dersco1[0]['nometabsco']. ' - &nbsp;'.'sur le secteur de :&nbsp;'.$dersco1[0]['libellesecteur'] ?></h4>

	
	 <?php echo link_to('Créer un nouvelle acc. pour cet élève ', 'eleve_avs/new?eleve_id=' . $eleve_avss[0]['EleveId'] .'&secteur_id=' . $eleve_avss[0]['secteur_id'] ) ?></a></td>
 
</fieldset>	

		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
		<thead>
			<tr>   
 
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
			
					<td><?php echo $eleve_avs['avsnom'].'&nbsp-&nbsp'.$eleve_avs['avsprenom'] ?></td>
					<td><?php if(!$eleve_avs['datefin']) { ?>
					<a href="<?php echo url_for('eleve_avs/edit?id='.$eleve_avs['id'].'&eleve_id=' . $eleve_avs['EleveId'] . '&avs_id=' . $eleve_avs['avs_id'].'&secteur_id=' . $eleve_avs['secteur_id']); ?>"><?php echo 'Modifier</a>'  ?>
					<a><?php // echo link_to('Créer ', 'eleve_avs/new?eleve_id=' . $eleve_avs['EleveId'].'&secteur_id=' . $eleve_avs['secteur_id'] ) ?></a>
					<?php echo link_to('Supprimer', 'eleve_avs/delete?id='.$eleve_avs['id'], array('method' => 'delete', 'confirm' => 'Etes vous sur ?')) ?></td>
					<?php }else{ ?>
					  <?php echo 'commentaire :&nbsp;<small>'.$eleve_avs['commentaire'].'</small>' ?>
					 
					<?php } ?>
					<td><?php echo $eleve_avs['quotite'] ?></td>
					<td><?php echo format_date($eleve_avs['datedebut'],'dd/MM/yyyy') ?></td>
					<td><?php echo format_date($eleve_avs['datefin'],'dd/MM/yyyy') ?></td>
					<td><?php echo format_date($eleve_avs['etat_acc'],'dd/MM/yyyy') ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php } else { ?>
	<?php echo 'pas d\'accompagnement en cours pour l\'élève :&nbsp;'.$eleve ?>


<?php } ?>
</div>

<br><big><a href="<?php echo url_for('eleve/recherche?eleve_id='.$sf_request->getParameter('eleve_id').'&eleve_nom='.$eleve_avss[0]['nom'].'&eleve_prenom='.$eleve_avss[0]['prenom'].'&flag_recherche=1' ) ?>"><button>Retour</button></a></big><br>
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




