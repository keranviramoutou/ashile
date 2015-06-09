<div class= 'aide' onClick="<?php echo url_for('reunion/aide') ?>"></div> 
<h1>Nouvelle Réunion</h1>

<?php include_partial('form', array('form' => $form)) ?>
<!-- Le second script pour le pop up d'aide -->
<script>
var src = "<?php echo url_for('reunion/aide') ?>";

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
