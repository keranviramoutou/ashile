<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>



<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#dgescoTable').dataTable({
		 "iDisplayLength": 50, //initialise le nmbre d'enregistrement par page
			"bScrollInfinite": true,
			"bScrollCollapse": true,
             "sScrollY": "380px",
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage" : {
                "sProcessing":     "Traitement en cours...",
                "sLengthMenu":     "Afficher _MENU_ Résultats   ",
                "sZeroRecords":    "Aucun &eacute;l&egrave;ve &agrave; afficher",
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
<table width='90%' height='20px'>
<tr>
<td width='20%'>
<h1>Enquête DGESCO</h1>
</td>
<td width='80%' align="right">
 <div class= 'aide' onClick="aide_dgesco()"> </div>
  </td>
</tr>
</table>


<?php $route = $sf_request->getHost(); ?>

<div style="overflow:auto; height: 500px; width: 900px;">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="dgescoTable">
    <thead>
    <tr>
	
	
      <th><small>Eleve</small></th>
	  <th><small>Nbre de réponse</small></th>
		<?php foreach ($questions as $question): ?>
		<?php echo '<th><small>'.$question['num_question'].'&nbsp;-&nbsp'.$question['question'].'</small></th>' ?>
		<?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($dgescos as $dgesco): ?>
 
	<?php	
	    //compte le nombre de réponse par rapport au nombre de question
		//---------------------------------------------------------------
		$reponse  = Doctrine_Query::Create()
		->select('d.id as compte')
		->from('Dgesco d')
		->where('d.eleve_id=?',$dgesco['EleveId'])
		->andwhere('CHARACTER_LENGTH(d.libelle_reponse) > 0')
		->fetcharray();
		$count_reponse=count($reponse);
		
		
		//liste des réponses par élève et question
		//-------------------------------------------
		
		 $dgescos_detail  = Doctrine_Query::Create()
	   ->select('d.id as DgescoId,q.id as id,d.eleve_id as EleveId,q.question as question,d.libelle_reponse as libelle_reponse')
		->from('Dgesco d')
		->innerjoin('d.Question q ON q.id = d.question_id')
		->where ('d.eleve_id=?',$dgesco['EleveId'])
		//->andwhere ('d.question_id=?',27)
		->fetcharray();	
	?>

	
    <tr>
 	 
	  
      <td><?php echo link_to('<small>'.$dgesco['nom'].'&nbsp&nbsp'.$dgesco['prenom'],'eleve/edit?id='.$dgesco['EleveId'].'#div_dgesco') ?> <?php echo '&nbsp;('.$dgesco['EleveId'].')' ?>
	  <?php echo '<br>'.$dgesco['rne'].'<br>'.$dgesco['typetab'].'&nbsp'.$dgesco['etab'].'</small>'  ?></td>
	
	  <td> <?php
	  if($nbquestions > $count_reponse ){
    	  echo $count_reponse.'/'.$nbquestions ;
		  }elseif($nbquestions = $count_reponse) {
		   echo "OK";
		  } ?></td>
	  
		<?php foreach ($dgescos_detail as $dgescos_details): ?>
		<?php if ($dgescos_details['libelle_reponse']){
		$reponse= trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $clef_cryptage, base64_decode($dgescos_details['libelle_reponse']), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	    echo '<td><small>'.$reponse.'</small></td>' ; } else { echo '<td></td>'; }
	   ?>
	
		<?php endforeach; ?>
    </tr>
 
        <?php endforeach; ?>
    </tbody>
</table>

<?php if(1) { 

	echo '<div>';
	//include_partial('dgesco/index1', array('dgescos' => $dgescos_detail)); 
	echo '<div>';
	
 } ?>
</div>


 <script>


	function aide_dgesco() {
	var src = "<?php echo url_for('dgesco/aide') ?>";
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



