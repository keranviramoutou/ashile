<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>


<h3>Enquêtes > DGESCO > Résultats de l'enquête</h3>

<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#eleveTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage" : {
                "sProcessing":     "Traitement en cours...",
                "sLengthMenu":     "Afficher _MENU_ Résultats   ",
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
<?php $route = $sf_request->getHost(); ?>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="eleveTable">
    <thead>
    <tr>
	  <th>Secteur</th>
	  <th>Etab. scolaire </th>
      <th>Eleve</th>
	  <th>Nbre de réponse</th>

    </tr>
    </thead>
    <tbody>
        <?php foreach ($dgescos as $dgesco): ?>
 
	<?php	
	    //compte le nombre de réponse par rapport au nombre de question
		//---------------------------------------------------------------
		$reponse  = Doctrine_Query::Create()
		->select('count(d.id) as compte')
		->from('Dgesco d')
		->where('d.eleve_id=?',$dgesco['EleveId'])
		->andwhere('CHARACTER_LENGTH(d.libelle_reponse) > 0')
		->groupBy('d.eleve_id')
		->limit(1)
		->fetcharray();
		$count_reponse=count($reponse);

	?>

	
    <tr>
 
	  <td><?php echo $dgesco['libellesecteur'] ?></td>
	  <td><?php echo $dgesco['rne'].'&nbsp'.$dgesco['typetab'].'&nbsp'.$dgesco['etab'] ?></td>	  
      <td><a href="<?php echo url_for('dgesco/index1?eleve_id='.$dgesco['EleveId']) ?>"><?php echo $dgesco['nom'].'&nbsp&nbsp'.$dgesco['prenom'] ?></a></td>
	  <td><?php echo $count_reponse?></td>
	  
	
	
    </tr>
 
        <?php endforeach; ?>
    </tbody>
</table>

<?php if(1) { 

	echo '<div>';
	//include_partial('dgesco/index1', array('dgescos' => $dgescos_detail)); 
	echo '<div>';
	
 } ?>

  



