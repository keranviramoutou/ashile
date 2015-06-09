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
               "sLengthMenu":     "Afficher _MENU_ matériels",
               "sZeroRecords":    "Aucun matériels; afficher",
               "sInfo":           "Affichage du matériel _START_ &agrave; _END_ sur _TOTAL_ matériel(s)",
               "sInfoEmpty":      "Affichage du matériel; 0 sur 0 matériel(s)",
               "sInfoFiltered":   "(filtr&eacute; de _MAX_ matériels au total)",
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


<div class='aide' onClick="<?php echo url_for('eleve_materiel/aide') ?>"> </div> 
<div id="eleve_materiel"> 
<fieldset>
 
	<h3> Liste des materiels attribués à : <?php echo $elevemateriels[0]['nom'].'  '.$elevemateriels[0]['prenom']?> <?php echo '<small>né(e) le &nbsp;'.format_date($elevemateriels[0]['datenaissance'],'dd/MM/yyyy').'</small>' ?></h3> 
	<h5> scolarisé(e) à :&nbsp;<?php echo $elevemateriels[0]['rne'].'-'.$elevemateriels[0]['typetab'].'  '.$elevemateriels[0]['etab']. ' - &nbsp;'.'sur le secteur de :&nbsp;'.$elevemateriels[0]['secteur'] ?></h4>

 
</fieldset>	

	<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
	  <thead>
		<tr>
          <th> Matériel(s) alloué(s) </th> 
		  <th> Attribution </th> 
		  <th>Date d'édition <br>de la convention</th>
		  <th>Début du prêt</th>
		  <th>Fin du prêt</th>
		  <th>commentaire</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($elevemateriels as $elevemateriel): ?>
		<tr>
				<td><a href="<?php echo url_for('materiel/edit?id='.$elevemateriel['materiel_id']); ?>">
				<?php  echo '</a>&nbsp - &nbsp;'.$elevemateriel['libelletypemateriel'].'</a>&nbsp - marque :&nbsp;'.$elevemateriel['libellemarque'].'&nbsp;- <br>Référence &nbsp;:&nbsp;<small>'.$elevemateriel['libelleMateriel'].$elevemateriel['caracteristiqueMateriel'].'</small>&nbsp;- n°: &nbsp'.$elevemateriel['numeroMateriel']   ?></td>
				<td><?php //if($elevemateriel['datefin']){?>
				<a href="<?php echo url_for('eleve_materiel/edit?id='.$elevemateriel['eleve_materiel_Id'].'&eleve_id='.$elevemateriel['eleve_id'].'&materiel_id='.$elevemateriel['materiel_id']); ?>"><?php  echo 'Modifier' ?></a>
				
				<a href="<?php echo url_for('eleve_materiel/new?eleve_id='.$elevemateriel['eleve_id'].'&typemateriel_id=' . $elevemateriel['typemateriel_id']); ?>"><?php  echo 'Créer' ?></a>
				
				<?php echo link_to('Supprimer', 'eleve_materiel/delete?id='.$elevemateriel['eleve_materiel_Id'], array('method' => 'delete', 'confirm' => 'la suppression du prêt ne mets pas à jour le mouvement du matériel supprimé, Etes vous sur ?')) ?> </td>
				<?php // } ?>
				</td>
				<td><?php echo format_date($elevemateriel['dateconvention'],'dd/MM/yyyy') ?></td>
				<td><?php echo format_date($elevemateriel['datedebut'],'dd/MM/yyyy') ?></td>
				<td><?php echo format_date($elevemateriel['datefin'],'dd/MM/yyyy') ?></td>
					<td><?php echo $elevemateriel['commentaire'] ?></td>
		</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>
</div>
<br><big><a href="<?php echo url_for('eleve/recherche?eleve_id='.$sf_request->getParameter('eleve_id').'&eleve_nom='.$elevemateriels[0]['nom'].'&eleve_prenom='.$elevemateriels[0]['prenom'].'&flag_recherche=1' ) ?>"><button>Retour</button></a></big><br>



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