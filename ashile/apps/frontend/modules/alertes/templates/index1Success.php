<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_stylesheet('datatable_jui.css') ?>



<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#dataTable').dataTable({
            "bJQueryUI": true,
		   "iDisplayLength": 50,
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
			"bScrollInfinite": true,
			"bScrollCollapse": true,
            "sPaginationType": "full_numbers",
            "oLanguage" : {
                "sProcessing":     "Traitement en cours...",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sInfo":           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
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
	<?php //echo var_dump($transport_alerte) ; ?>
	
<table width='95%'>
	<tr height='20px'>
		<td width='70%' >
		<h1>Liste des Sessad ou Transports en attente de prise en charge</h1>
		</td>

		<td width='30%'>
		<div class= 'aide' onClick="aide_alertes()"></div> 
		</td>
	</tr>
</table>	


<table cellpadding="0" cellspacing="0" border="0" class="display" id="dataTable">
    <thead>
        <tr>
            <th>Elève </th>
			 <th>n° dossier <br>ASH</th>
		     <th>Notifiée du</th>
			 <th>Au</th>
			 <th>Moyen</th>

			

        </tr>
    </thead>
    <tbody>


  <?php  foreach ($transport_alerte as $demande):	?>	
			

			<tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $demande['eleve_id'])) ?> '"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer" >
			<td><?php echo $demande['nom'].'  '.$demande['prenom'] ?></td>
				<td><?php echo $demande['mdph_id']?></td>
				<td class="center"><?php echo format_date($demande['datedebutnotif'],'dd/MM/yyyy') ?></td>
				<td class="center"><?php echo format_date($demande['datefinnotif'],'dd/MM/yyyy') ?></td>
				<td><?php echo 'TRANSPORT'  ?></td>

			</tr>
			<?php endforeach; ?>
	
	
  <?php  foreach ($sessad_alerte as $demande):	?>	
			

			<tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $demande['eleve_id'])) ?> '"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer" >
			<td><?php echo $demande['nom'].'  '.$demande['prenom'] ?></td>
				<td><?php echo $demande['mdph_id']?></td>
				<td class="center"><?php echo format_date($demande['datedebutnotif'],'dd/MM/yyyy') ?></td>
				<td class="center"><?php echo format_date($demande['datefinnotif'],'dd/MM/yyyy') ?></td>
				<td><?php echo 'SESSAD'  ?></td>

			</tr>
			<?php endforeach; ?>
    </tbody>
</table>



	<script>

		
	function aide_alertes() {
	var src = "<?php echo url_for('alertes/aide') ?>";
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
	}


</script>

