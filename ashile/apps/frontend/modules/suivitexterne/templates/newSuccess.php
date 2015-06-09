<div class= 'aide' onClick="<?php echo url_for('suivitexterne/aide') ?>"></div> 
<h1>Nouveau Suivi externe</h1>
				<?php if ($form->getObject()->isNew()): ?>
				<!-- <span><button onClick="window.location.href='<?php echo url_for('organismesuivit/new')  ?>'">Créer  un Etablissement de suivi</button></span> 
			     <button type="button" onClick="organisme()" > Créer  un Etablissement de suivi </button> -->
				<?php endif; ?>
<?php include_partial('form', array('form' => $form)) ?>

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