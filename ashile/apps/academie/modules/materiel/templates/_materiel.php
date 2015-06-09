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
<div id="materiel_eleve"> 
<?php $i = 0; ?>
<?php echo 'test&nbsp' .date('Y-m-d',strtotime($_POST['maj'])) ?> 

		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Marque</th>
	  <th>Catégorie</th>
      <th>Type du Matériel</th>
      <th>Référence(s)</th>
      <th>N° du materiel</th>
      <th>Etat du matériel </th>
	  <th>Prêt</th>
  
  </thead>
  
  		<?php
		 
			//Liste des demandes de matériel en cours à la date du jour 
			//-------------------------------------------------------------
			$demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->getListDemandeMat();
			$existdemande_materiel = count($demande_materiel);
		
		?>
  <tbody>
   <?php foreach ($resultat as $materiel): ?>
   
   
    <?php
	
     //recherche du dernier mouvement créé pour le matérile selectionné
	 //-----------------------------------------------------------------
   		$dernierMouvs = Doctrine_Query::create()
					->select('mouv.id as mouvement_id, m.id as materiel_id,f.id as mouvId,f.nommouvement as nommouvement,mouv.datedebut as datedebut')
					->from('MouvementMateriel mouv')
					->leftJoin('mouv.Materiel m ON mouv.materiel_id = m.id')
					->leftJoin('mouv.Mouvement f ON f.id = mouv.mouvement_id')
					->where('m.id = ?', $materiel['id'])
					->orderBy('mouv.id DESC LIMIT 1')
					->fetchArray();
			
	?>

    <tr onClick="window.location='<?php echo url_for('materiel/edit?id='.$materiel['id']) ?>'" class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">


      <td><?php echo $materiel['marque'] ?></td>
	  <td><?php echo $materiel['libellecatmateriel'] ?></td>
      <td><?php echo $materiel['libelletypemateriel'] ?></td>
      <td><a href="<?php echo url_for('materiel/edit?id='.$materiel['id']) ?>"><?php echo $materiel['libellemateriel'].'</a><br><small>- Type MDPH :&nbsp;'.$materiel['libelletypemateriel'].'</small>' ?></td>
      <td><?php echo $materiel['numeromateriel'] ?></td>

	   <td>
	   <!-- dernier mouvement -->	
	         
			<?php foreach ($dernierMouvs as $dernierMouv): ?>
				<?php echo '<small>'.$dernierMouv['nommouvement'].'<br>le&nbsp;'.format_date($dernierMouv['datedebut'],'dd/MM/yyyy'.'</small>')?>
			<?php endforeach; ?>
	    </td>
       <!-- prêt -->		
		<td>

		<!-- création d'un prêt si des demandes de matériels en cours existent -->
					<?php  if( $existdemande_materiel > 0 ) {?>
				     <br><a href="<?php echo url_for('eleve_materiel/new?materiel_id='.$materiel['id']) ?>"><?php echo 'Créer' ?></a>
				   <?php } ?>	
		</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<div>