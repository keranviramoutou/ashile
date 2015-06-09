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
	      "iDisplayLength": 50,
           "bJQueryUI": true,
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
<div class= 'aide' onClick="<?php echo url_for('organismesuivit/aide') ?>"></div> 

<h3>Liste des organismes de suivi externe <br> et des établissements d'exercice des partenaires <br>du secteur de <?php echo $libelle_secteur?></h3>

  <button type="button" onClick="organisme()" > créer un organisme </button><br><br>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
  
    <tr>
      <th>Nom de l'organisme</th>
	   <th>adresse</th>
	   <th>adresse suite</th>
      <th>commune</th>
	   <th>Téléphone </th>
	   <th>Fax</th>
	    <th>Mail</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($organisme_suivits as $organisme_suivit): ?>
    <tr>
      <td><a href="<?php echo url_for('organismesuivit/edit?id='.$organisme_suivit->getId()) ?>"><?php echo $organisme_suivit->getNometabnonsco() ?></a></td>
	  <td><?php echo $organisme_suivit->getAdresseetabnonscobat() ?></td>
	  <td><?php echo $organisme_suivit->getAdresseetabnonscorue() ?></td>
  	  <td><?php echo $organisme_suivit->getQuartier() ?></td>
	 <td><?php echo $organisme_suivit->getTeletabnonsco() ?></td>
	 <td><?php echo $organisme_suivit-> getFaxetabnonsco()  ?></td>
	  <td><?php echo $organisme_suivit->getEmailetabnonsco()  ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<script>
function organisme() {
//ouverture d'une popup
//---------------------
 var url = " <?php echo url_for('organismesuivit/popup' ) ?>";
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
<!-- Le second script pour le pop up d'aide -->
<script>
var src = "<?php echo url_for('organismesuivit/aide') ?>";

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