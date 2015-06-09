<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_helper('Date') ?>
<?php use_helper('Text') ?>
<?php if ($sf_user->hasFlash('succes')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
    <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error1')): ?>
    <div class="flash_error"><?php echo $sf_user->getFlash('error1') ?></div>
<?php endif; ?>


<div class= 'aide' onClick="aide_orientation()"></div> 
<?php $i = 1 ?>
 <fieldset >
	<legend>Scolarisation en milieu ordinaire</legend>

	<table <table cellpadding="0" cellspacing="10" border="0" class="display" id="maTable" width="100%">
	  <thead>
	    <tr>

	      <th>Etablissement scolaire  </th>
	      <th>Classe</th>
	      <th>Début de scolarisation  </th>
	      <th>Fin de scolarisation  </th>
		  <th>Niveau scolaire  </th>
	      <th>Nb de demi-journées  </th>
	      <th> Classe inclusion </th>
	    </tr>
	  </thead>
	  <tbody>

	    <?php $exist = false; ?>	

	    <?php foreach ($orientations as $orientation): ?>
       <?php if ($count_changesecteur == 0 ){ ?> <!-- seulement visible si pas de changement de secteur en cours -->
	   <tr onclick="<?php  echo jq_remote_function(array('url' => 'orientation/edit?id=' . $orientation->getId().'&param='.$param, 'update' => 'div_orientation')) ?> ;document.body.style.cursor='wait'; return true;  " style="cursor: pointer; color: #000; background:#e0e0e0">
       <?php }else{ ?>
	   <tr onclick="<?php  echo jq_remote_function(array('url' => 'orientation/show?id=' . $orientation->getId().'&param='.$param, 'update' => 'div_orientation')) ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
	   <div id="feedback"></div>


	   <?php } ?>
                <td><center><?php echo $orientation->Etabsco->Typeetablissement->getNomtypeetablissement().'&nbsp;'.$orientation->Etabsco->getNometabsco().'&nbsp;<br>'.$orientation->Etabsco->getRne(); ?></center></td>
                <td><center><?php echo $orientation->getClasse(); ?></center></td>
                 <td><center><?php  echo  format_date($orientation->getDatedebut(),'dd/MM/yyyy')?></center></td>
                 <td><center><?php  echo  format_date($orientation->getDatefin(),'dd/MM/yyyy')?></center></td>
				 <td><center><?php echo $orientation->getNiveauscolaire()->getNomniveauscolaire(); ?></center></td>
                <td><center><?php if($orientation->getDemijournee()){ echo $orientation->getDemijournee() ;
				}else{ echo '';} ?>
				</center></td>
				<td><?php  if($orientation->getInclusionId()){
					echo  $orientation->getInclusion()->getClasse().'&nbsp;-'. $orientation->getInclusion()->getTemspclasseintegration().'Heure(s)';
				}else{ echo'';} ?></td>
	    </tr>
		<?php $i++ ?>

		<?php if($orientation->getId()):
			$exist = true;
		      endif; 
		?>
		
		<?php endforeach; ?>
		<?php if ($i == 1): ?>
		    <tr><td colspan="7" style="font-style: italic">Cet(te) élève n'a pas de scolarisation en milieu ordinaire</td></tr>
		<?php endif; ?>
	    </tbody>
	</table>
</fieldset>

<?php
	if($count_changesecteur == 0){ //possible si pas de changement de secteur
echo jq_button_to_remote('Nouvelle scolarisation', array(
    'url' => 'orientation/new?eleve_id=' . $sf_request->getParameter('eleve_id'),
    'update' => 'div_orientation',
	'loading' => 'document.body.style.cursor="wait"',
	'complete' => 'document.body.style.cursor="default"',
)); }
?>&nbsp;&nbsp;
<?php if ($count_orientation > 0): ?>  <!-- affichage du bouton si scolarité ordinaire en cours -->

<button type="button" onClick="changesecteur()" >Changement de secteur  </button><br>
<?php endif; ?>

</br>




<script>
 window.onload=function(){document.body.style.cursor='default';}
		
	function aide_orientation() {
	var src = "<?php echo url_for('orientation/aide') ?>";
		$j.modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
			closeHTML:"",
			containerCss:{
				backgroundColor:"#fff",
				borderColor:"#fff",
				height:450,
				padding:0,
				width:700
			},
			overlayClose:true
		});
	}


</script>

<script>
function changesecteur() {
//ouverture d'une popup
//---------------------
 var url = " <?php echo url_for('orientation/changeSecteur?eleve_id='.$sf_request->getParameter('eleve_id') ) ?>";
 var width  = 600;
 var height = 300;
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

