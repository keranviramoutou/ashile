<?php use_helper('jQuery'); ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_helper('Date') ?>
<?php $i = 1 ?>
<?php if ($sf_user->hasFlash('succes')): ?>
      <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif ?>
<div class= 'aide' onClick="aide_suiviexterne()"></div> 

<?php echo jq_button_to_remote('Nouveau suivi externe', array('url' => 'suivitexterne/new?eleve_id=' . $sf_request->getParameter('eleve_id'), 'update' => 'div_suivitext')) ?>
<!-- <span>&nbsp;&nbsp;<button onClick="window.location.href='<?php echo url_for('organismesuivit/new')  ?>'">Créer  un Etablissement de suivi</button></span><br> -->
 <button type="button" onClick="organisme()" > Créer  un Etablissement de suivi </button>
 <fieldset >
	<legend>Suivis externes</legend>
	
		<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
		  <thead>
			<tr>
			 <th>Nature du suivi</th>
			  <th>Partenaire</th>
			  <th>Début de prise en charge</th>
			  <th>Fin de prise en charge</th>
			  <th>Etablissement</th>
			</tr>
		  </thead>
		  <tbody>
			<?php foreach ($suivit_externes as $suivit_externe): ?>
			<tr onclick="<?php echo jq_remote_function(array('url' => 'suivitexterne/edit?id=' . $suivit_externe->getId(), 'update' => 'div_suivitext', 'method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
			  <td><center><?php echo $suivit_externe->getNaturesuiviext() ?></td>
			  <td><center><?php if($suivit_externe->getSpecialisteId() ){ echo $suivit_externe->getSpecialiste();} ?></td>
                          <td><center>  <?php echo format_date($suivit_externe->getDatedebutpriseencharge(),'dd/MM/yyyy') ?> </center></td>
                          <td><center>  <?php echo format_date($suivit_externe->getDatefinpriseencharge(),'dd/MM/yyyy') ?> </center></td>
			  <td><center><?php echo $suivit_externe->getOrganismeSuivit() ?></center></td>
			</tr>
			<?php $i++ ?>
				<?php endforeach; ?>
				<?php if ($i == 1): ?>
					<tr><center><td colspan="4" style="font-style: italic">Cet élève n'a pas de suivit externe</center></td></tr>
				<?php endif; ?>
			</tbody>
		</table>
		</fieldset>

<!-- Le second script pour le pop up d'aide -->
<script>
var src = "<?php echo url_for('suivitexterne/aide') ?>";

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




<script>
function organisme() {
//ouverture d'une popup création d'un organisme
//----------------------------------------------
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