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
               "sLengthMenu":     "Afficher _MENU_ prêt(s)",
               "sZeroRecords":    "Aucun prêt(s); afficher",
               "sInfo":           "Affichage du prêt(s) _START_ &agrave; _END_ sur _TOTAL_ prêt(s)",
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

<!-- création du titre du tableau -->


<?php  if($_POST['typemat']) {?>
<?php $titre = '&nbsp;de type &nbsp;</small>'.$_POST['typemat'].' </small>'; ?>
<?php }else{ ?>
<?php $titre=$titre ; ?>
<?php } ?>

<?php  if($_POST['maj']) {?>
<?php $titre = $titre.'&nbsp; attribué(s) <small> avant le&nbsp;'.$_POST['maj'] ;?>
<?php }else{ $titre = ''; }?>




<h3> Matériel(s) <?php echo $titre ?></h3>
<div id="recherche_materiel"> 
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
	  <thead>
		<tr>
          <th>Secteur</th>
          <th>Etab affect.</th>
		  <th>Eleve</th>
          <th> Matériel attribue </th> 
		  <th>Convention</th>
		  <th>Attribué du</th>
		  <th>au</th>
		  <th>attribution</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($resultat as $elevemateriel): ?>

		<tr>
                 <td><?php echo $elevemateriel['libellesecteur'] ?></td>
                <td><?php echo $elevemateriel['rne'] ?></td>
               <td><?php echo $elevemateriel['Eleve']['nom'].'&nbsp-&nbsp'.$elevemateriel['Eleve']['prenom'] ?></a>
              <?php echo '<br><small>née(le) :&nbsp;'.format_date($elevemateriel['Eleve']['datenaissance'],'dd/MM/yyyy').'</br></small>' ?></td>
              <td><a href="<?php echo url_for('eleve_materiel/edit?id='.$elevemateriel['id'].'&eleve_id='.$elevemateriel['eleve_id'].'&materiel_id='.$elevemateriel['materiel_id']); ?>">
			  <?php  echo $elevemateriel['libellecatmateriel'].'&nbsp;-&nbsp;'.$elevemateriel['marque'].'</a>&nbsp;-&nbsp;'
	  .$elevemateriel['libellemateriel'].'<br><small>- Type MDPH :&nbsp;'.$elevemateriel['libelletypemateriel'].'&nbsp;n°&nbsp;'.$elevemateriel['numeromateriel'].'</small>' ?></a></td>
              <td><?php echo format_date($elevemateriel['dateconvention'],'dd/MM/yyyy') ?></td>
        	  <td><?php echo format_date($elevemateriel['datedebut'],'dd/MM/yyyy') ?></td>
        	  <td><?php echo format_date($elevemateriel['datefin'],'dd/MM/yyyy') ?></td>
			  <td><?php if(format_date($elevemateriel['datefin'],'yyyy/MM/dd') >= format_date(time(),'yyyy/MM/dd')) { ?>
							<a href="<?php echo url_for('eleve_materiel/new?eleve_id='.$elevemateriel['eleve_id']) ?>"><?php echo 'Créer' ?></a>
							<?php echo link_to('&nbsp;Modifier','eleve_materiel/edit?id='.$elevemateriel['id'].'&eleve_id='.$elevemateriel['eleve_id'].'&materiel_id='.$elevemateriel['materiel_id'])  ?></td>
					<?php }else{ ?>
							<a href="<?php echo url_for('eleve_materiel/new?eleve_id='.$elevemateriel['eleve_id']) ?>"><?php echo 'Créer' ?></a></td>
			  <?php } ?>
		</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>

</div>
