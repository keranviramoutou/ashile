<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>

<?php if ($sf_user->hasFlash('succes')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif; ?>
<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
		   	   "iDisplayLength": 50, 
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
		   		"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ sp&eacute;cialistes",
               "sZeroRecords":    "Aucun sp&eacute;cialiste &agrave; afficher",
               "sInfo":           "Affichage des sp&eacute;cialistes _START_ &agrave; _END_ sur _TOTAL_ sp&eacute;cialistes",
               "sInfoEmpty":      "Affichage du sp&eacute;cialiste 0 &agrave; 0 sur 0 sp&eacute;cialiste",
               "sInfoFiltered":   "(filtr&eacute; de _MAX_ sp&eacute;cialiste au total)",
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

<h1>Liste des Partenaires de <?php echo $sf_user->getAttribute('secteur');?></h1>
<span>&nbsp;<button type="button" onClick="partenaire()" > créer un partenaire  </button>
&nbsp;&nbsp;<button onClick="window.location.href='<?php echo url_for('organismesuivit/new')  ?>'">Créer  un Etablissement de suivi</button></span><br><br>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Specialite</th>
	   <th>Etablissement principal d'exercice</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($specialistes as $specialiste): ?>
	<tr onClick="location.href='<?php echo url_for('specialiste/edit?id='.$specialiste->getId())   ?>'"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
      <td><?php echo $specialiste->getNom() ?></td>
      <td><?php echo $specialiste->getPrenom() ?></td>
      <td><?php echo $specialiste->getSpecialite() ?></td>
	  <td><?php echo $specialiste->getOrganismeSuivit()?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<script>
function partenaire() {
//ouverture d'une popup
//---------------------
 var url = " <?php echo url_for('specialiste/popup' ) ?>";
 var width  = 700;
 var height = 500;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'windowname5', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->

</script>
