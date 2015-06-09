<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>

 
 <?php //print_r($test); ?>
 
<div class= 'aide' onClick="<?php echo url_for('accueil/aide') ?>"></div> 


<h1>Accueil Academie</h1>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <thead>
	  	<th>AVS</th>
    <tr>
   		<td width = 350px >Nombre de nouvelles demande d\'aide AVS</td><td><?php echo $nb_nd_avs;  ?></td>
   	</tr>
   	<tr>	
   		<td>Nombre de demande d\'aide AVS en attente de moyens</td><td><?php echo $nb_am_avs;  ?></td>
   </tr>
   		<th>MATERIEL</th>   
   <tr>		
   		<td>Nombre de nouvelles demande d\'aide MATERIEL</td><td><?php echo $nb_nd_materiel; ?></td>
   </tr>
   <tr>		
   		<td>Nombre de demande d\'aide Materiel en attente de moyens</td><td><?php echo $nb_am_materiel; ?></td>
   </tr>
		<th>SESSAD</th>
   <tr>
		<td>Nombre de nouvelles demande d\'aide SESSAD</td><td><?php echo $nb_nd_sessad; ?></td>
	</tr>
	<tr>	
		<td>Nombre de demande d\'aide Sessad en attente de moyens</td><td><?php echo $nb_am_sessad; ?></td>
   </tr>
		<th>TRANSPORT</th>
   <tr>
		<td>Nombre de nouvelles demande d\'aide TRANSPORT</td><td><?php echo $nb_nd_transport; ?></td>
   </tr>
   <tr>		
		<td>Nombre de demande d\'aide Transport en attente de moyens</td><td><?php echo $nb_am_transport; ?></td>
   </tr>
   </thead>
</table>


<!-- Le second script pour le pop up d'aide -->
<script>
var src = "<?php echo url_for('accueil/aide') ?>";

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



