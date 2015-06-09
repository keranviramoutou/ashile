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


		<?php echo '<u>Liste des élèves suivi(s)par :</u>&nbsp;'.$suivi_externe[0]['specialiste_nom'].'&nbsp;'.$suivi_externe[0]['specialiste_prenom'].'&nbsp; - spécialité :&nbsp;'.$suivi_externe[0]['libellespecialite'].'<br><br>'?>
	
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
		  <thead>
			<tr>
			  <th>Elève(s) suivi(s)</th>
			  <th>Nature du Suivi externe</th>
			  <th> Etablissement de suivi </th>
			  <th>Période de prise en charge </th>
			</tr>
		  </thead>

		
		
		<?php foreach($suivi_externe as $suivi_externes):?>
	       <tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $suivi_externes['eleve_id']))  ?>' "  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
					<td>
					 <?php echo $suivi_externes['eleve_nom'].'&nbsp;'.$suivi_externes['eleve_prenom'].'<small>&nbsp;('.$suivi_externes['eleve_id'].')</small>' ?>
					</td>
					<td>
					 <?php echo $suivi_externes['libellenaturesuiviext'] ?>
					</td>
					<td>
					 <?php echo $suivi_externes['nomtypeetablissement'].'&nbsp;'.$suivi_externes['nometabnonsco'].'<small>&nbsp;('.$suivi_externes['teletabnonsco'].')</small>&nbsp;'.$suivi_externes['nom_quartier'] ?>
					</td>
			        <td>
					<?php if($suivi_externes['datefinpriseencharge']){ ?>
					<?php echo 'du&nbsp;'.format_date($suivi_externes['datedebutpriseencharge'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($suivi_externes['datefinpriseencharge'],'dd/MM/yyyy') ?>
					<?php }elseif($suivi_externes['datedebutpriseencharge']){ ?>
					<?php echo 'du&nbsp;'.format_date($suivi_externes['datedebutpriseencharge'],'dd/MM/yyyy')?>
					<?php } ?>
					</td>

			</tr>	
		 <?php endforeach; ?>

		</table>


<script>
var src = "<?php echo url_for('specialiste/aide') ?>";

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



