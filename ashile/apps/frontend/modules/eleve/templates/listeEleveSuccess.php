<?php use_helper('jQuery') ?>
<?php  use_stylesheet('data_table.css') ?>
<?php  use_stylesheet('datatable_jui.css') ?>
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
               "sZeroRecords":    "Aucun élève à afficher",
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
 <script type="text/javascript">  
	//  document.body.addEventListener('click',alert('dddddfff'), false);
</script>

<script type="text/javascript">  
function cursor_wait() {
document.body.style.cursor = 'defaut';
}

function cursor_clear() {
document.body.style.cursor = 'default';
}


function excel() {

document.body.style.cursor = 'wait';

window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'excel','test' => 'ok')) ?>';


//document.getElementById('message').style.display = "none";

//document.body.style.cursor = 'default';

}



</script>
<?php if ($sf_user->hasFlash('notice')): ?>
      <div class="flash_notice"><?php echo $sf_user->getFlash('alerte') ?></div>
<?php endif ?>

<div id="listeEleve" >
<table width='95%'>
<tr height='20px'>
<td width='70%' >
<h1>Elèves du secteur : <?php echo trim($eleves[0]['libellesecteur']).'</h1>'?>
</td>
<td width='25%' align="right">
<button name="export" onClick="excel()"><small>export Tableur</small></button>
</td>
<td width='5%'>
  <div class= 'aide' onClick="aide_eleve()"></div>
  </td>
</tr>
</table>




<br>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
   <thead>
       <tr>
        
           <th>Identité</th>
           <th>Né(e) le</th>
           <th>Scolarité ordinaire</th>
		   <th>classe</th>
		   <th>Niveau sco</th>
		   <th>Scolarité externe</th>
       </tr>
   </thead>
   <tbody>
     <!--  <?php foreach ($eleves as $eleve): ?> -->
	   			<?php
				//dernière scolarisation de l'élève en cours à la date du jour
				//--------------------------------------------------------------
				$dersco = Doctrine_Core::getTable('Orientation')->getDerSco($eleve['eleveId']);
				$count_dersco = count($dersco);
			   ?>
			   
			 	<?php
				//dernière scolarisation en milieu spé de l'élève en cours à la date du jour
				//--------------------------------------------------------------------------
				$DerModnonsco = Doctrine_Core::getTable('Modnonsco')->getDerModnonSco($eleve['eleveId']);
				$count_DerModnonsco = count($DerModnonsco);
			   ?>
	  
           <tr onClick="window.location.href='<?php echo url_for(array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve['eleveId']))  ?>' "  class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" style="cursor: pointer">
        
               <td><?php echo $eleve['nom'].'&nbsp;'.$eleve['prenom'].'&nbsp;('.$eleve['eleveId'].')'; ?></td>
               <td><?php echo format_date( $eleve['datenaissance'],'dd/MM/yyyy')?></td>
			   <!-- scolarisation en milieu ordinaire -->
			   <?php if($count_dersco > 0){ ?>
				   <?php foreach ($dersco as $derscos): ?>
						<td><?php echo '<small>'.$derscos['rne'].' - '.$derscos['typetab'].'&nbsp;'.$derscos['nometabsco'].'</small>' ?></td>
					    <td><?php echo $derscos['nomtypeclasse']?></td>
						<td><?php echo $derscos['nomniveauscolaire']?></td>
					<?php endforeach; ?>
				<?php } else { ?>
						<td></td>
						<td></td>
						<td></td>
				<?php } ?>

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
