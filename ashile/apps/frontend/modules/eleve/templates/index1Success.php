<?php use_helper('jQuery') ?>
<?php  use_stylesheet('data_table.css') ?>
<?php  use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<script type="text/javascript">

   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
		   		"iDisplayLength": 50,
			"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
           "sPaginationType": "full_numbers",
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


<table width='95%'>
<tr height='20px'>
<td width='65%' valign ="center" >
<h1>Liste des Eleves sans scolarité en cours en milieu ordinaire </h1>
</td>
<td width='35%' align="right" valign ="center">
<div class= 'aide' onClick="aide_eleve()"></div> 
</td>
</tr>
</table>



<!-- <span><button style="float: right" onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'index')) ?>'">Liste des élèves par établissement</button></span></h1> -->

<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
   <thead>
       <tr>
   
           <th>Identité</th>
		   <th>Scolarité externe en cours</th>
  
       </tr>
   </thead>
   <tbody>
       <?php foreach ($elevessansetab as $eleve): ?>
	   
				<?php
				//dernière scolarisation en milieu spé de l'élève en cours à la date du jour
				//--------------------------------------------------------------------------
				$DerModnonsco = Doctrine_Core::getTable('Modnonsco')->getDerModnonSco($eleve['id']);
				$count_DerModnonsco = count($DerModnonsco);
			   ?>
			   
           <tr>
        
               <td><?php echo link_to('<small>'.$eleve['nom'].'&nbsp&nbsp'.$eleve['prenom'],'eleve/edit?id='.$eleve['id'].'#div_scolarite').'&nbsp; né(e) le '.format_date( $eleve['datenaissance'],'dd/MM/yyyy') ?></td>
               		 <!-- scolarisation en milieu spécialisé -->
				<?php if($count_DerModnonsco > 0){ ?>
				   <?php foreach ($DerModnonsco as $DerModnonscos): ?>
						<td><?php echo '<small>'.$DerModnonscos['nometabnonsco'].' - '.$DerModnonscos['libelle_classe_spe'].'</small>'?></td>
					<?php endforeach; ?>
				<?php } else { ?>
				<td></td>
					<?php } ?>

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