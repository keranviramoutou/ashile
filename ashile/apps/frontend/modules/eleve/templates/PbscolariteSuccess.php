<?php use_helper('jQuery') ?>
<?php  use_stylesheet('data_table.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>


<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
	   "iDisplayLength": 50, 
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
		   		"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ &eacute;l&egrave;ves",
               "sZeroRecords":    "Aucun &eacute;l&eagrave;ve &agrave; afficher",
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
<div id="listeEleve" >


<table width='100%' height='20px'>
<tr>
<td width='55%'>
<h1>Liste des Eleves avec une scolarité incomplète (classe ou niveau scolaire non renseignés) </h1>
</td>
<td width='45%' align="right">
 <div class= 'aide' onClick="aide_eleve()"> </div>
  </td>
</tr>
</table>

<!-- <span><button style="float: right" onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'index')) ?>'">Liste des élèves par établissement</button></span></h1> -->

<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
   <thead>
       <tr>
        
           <th>Identité</th>
           <th>Date de Naissance</th>
           <th>Dernière scolarité </th>
		    <th>Fin scolarité </th>
			 <th>A renseigner</th>
       </tr>
   </thead>
   <tbody>
       <?php foreach ($elevespbscolarite as $eleve): ?>
			   
           <tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve['id']))  ?>'"  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
        
               <td><?php echo $eleve['nom']. '&nbsp;'. $eleve['prenom'].'&nbsp('.$eleve['eleve_id'].')'; ?></td>
              <td><?php echo format_date( $eleve['datenaissance'],'dd/MM/yyyy')?></td>
               <td><?php echo $eleve['rne'].' - '.$eleve['typetab'].' - '.$eleve['nometabsco']?></td>
			    <td><?php echo format_date( $eleve['datefin'],'dd/MM/yyyy')?></td>
				  <td><?php
				  if(!$eleve['classe_id']){
				   echo '<small>- Classe à renseigner</small><br>' ;
				  }
				  if(!$eleve['niveauscolaire_id']){
				   echo '<small>- Niveau scolaire à renseigner</small><br>' ;
				  }
				  
				  if($eleve['nomniveauscolaire'] == 'ND'){
				   echo '<small>- Niveau scolaire ND à modifier</small><br>' ;
				  }
				  ?>
				  
				</td>
           </tr>
       <?php endforeach; ?>
   </tbody>
</table>
<br />
</DIV>

<script>

		
	function aide_eleve() {
	var src = "<?php echo url_for('eleve/aide#listeeleve') ?>";
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