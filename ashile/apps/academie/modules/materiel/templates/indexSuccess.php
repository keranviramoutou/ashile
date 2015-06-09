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
               "sLengthMenu":     "Afficher _MENU_ materiels",
               "sZeroRecords":    "Aucun materiel &agrave; afficher",
               "sInfo":           "Affichage du materiel _START_ &agrave; _END_ sur _TOTAL_ materiels",
               "sInfoEmpty":      "Affichage du materiel 0 sur 0 materiels",
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

<?php $i = 0; ?>

<h3>Materiels >Liste des matériels créé(s) </h3>

		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
		<th>Id</th>
      <th>Marque</th>
      <th>Type</th>
      <th>Libellé</th>
      <th>Caracteristiques</th>
      <th>N° du materiel</th>
      <th>Commentaire</th>
      <th>Etat actuel</th>
  </thead>
  <tbody>
    <?php foreach ($materiels as $materiel): ?>
    <tr onClick="window.location='<?php echo url_for('materiel/edit?id='.$materiel['id']) ?>'" class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
      <td><?php echo $materiel['id'] ?></td>
      <td><?php echo $materiel['marque'] ?></td>
      <td><?php echo $materiel['nom'] ?></td>
      <td><?php echo $materiel['libelleMateriel'] ?></td>
      <td><?php echo $materiel['caracteristiqueMateriel'] ?></td>
      <td><?php echo $materiel['numeroMateriel'] ?></td>
      <td><?php echo $materiel['commentaire'] ?></td>
      <td><?php //echo $materiel['nommouvement'];
		
			$q = Doctrine_Query::Create()
					->select('mo.id, mv.id', 'mo.nommouvement as mouvement')
					->from('MouvementMateriel mv')
					->innerJoin('mv.Mouvement mo ON mo.id = mv.mouvement_id')
					->where('mv.materiel_id =?', $materiel['id'])
					->orderBy('mv.id DESC')
					->limit(1)
					->execute();
				
			echo $q[0]['mouvement'];
	
		// si le mouvement est CREATION	on propose de commander ce materiel
		if($q[0]['mouvement'] == 'CREATION')
		{
			echo ' : '.'<a href = "'.url_for('commande/new').'">Commander</a>';
		}	
       ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('materiel/new') ?>">Nouveau Matériel</a>
