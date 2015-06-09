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


<?php 
	$eleve_id = "";
 ?>

<form action="javascript:maFonction(eleveId)">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
	  <th> selection </th>
      <th>Eleve</th>
      <th>Materiel</th>
      <th>N° Doss. MDPH</th>
      <th>Date CERFA</th>		
      <th>Date ESS</th>
      <th>Date envoi MDPH </th>
      <th>Secteur</th>
      <th>Etablissement</th>
    </tr>
  </thead>

<?php
	foreach ($demande_materiels as $demande_materiel): 
?>
              </tr>
			  <td><?php echo "&nbsp;<input type='checkbox' name='groupDemande' value='".$demande_materiel['demandemateriel_id']."'>".'&nbsp;'.$demande_materiel['demandemateriel_id'] ?></td>
	      <td><a href="<?php echo url_for('demandemateriel/edit?id='. $demande_materiel['demandemateriel_id'].'&eleve_id='. $demande_materiel['eleve_id']) ?>"><?php echo $demande_materiel['nomeleve'].'&nbsp-&nbsp'. $demande_materiel['prenomeleve'] ?></a>
		  <?php echo '<br>née le &nbsp;'.format_date($demande_materiel['datenaissanceeleve'],'dd/MM/yyyy') ?></td>
  
              <td><?php echo $demande_materiel['typemateriel'] ?></td>
              <td><?php echo '<strong>'.$demande_materiel['numeromdph'].'</strong>&nbsp&nbsp(&nbsp'.$demande_materiel['mdph_id'].'&nbsp)' ?></td>
              <td><?php echo format_date($demande_materiel['datecreationpps'],'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_materiel['dateess'], 'dd/MM/yyyy') ?></td>
              <td><?php echo format_date($demande_materiel['dateenvoiedossier'],'dd/MM/yyyy') ?></td>
              <td><?php echo $demande_materiel['libellesecteur'] ?></td>
              <td><?php echo$demande_materiel['nometabsco'] ?></td>     
    </tr>	
        <?php endforeach; ?>
</table>


<script>
	
	/* ---- fonction qui envoie les materiel attribué selectionés pour edition du bon de livraison */
	
	function saisieCDA() {

		var lesMats = [];
			
			for (i=0;i<document.getElementsByName("groupDemande").length;i++)
			{
				if(document.getElementsByName("groupDemande")[i].checked)
				{
					lesMats[i] =document.getElementsByName("groupDemande")[i].value;
				}
			}
		$href="http://accueil.in.ac-reunion.fr/ashilep/academie.php/demandemateriel/traitementcda?lesMats="+lesMats+""; 
		window.open($href,"popupWindow","width=710,height=700,left=220,top=10");	
		 
	}
</script>
