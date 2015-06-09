<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>

		
			<?php //echo($_SERVER['REMOTE_ADDR']); ?>
		<?php //echo($_SERVER['HTTP_HOST']); ?>

<script type="text/javascript">
    $j(document).ready(function() {
        oTable = $j('#eleveTable').dataTable({
		"iDisplayLength":<?php echo $nbquestions ?>, //initialise le nmbre d'enregistrement par page au nombre de question par élève dans l'enquête Dgesco
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage" : {
                "sProcessing":     "Traitement en cours...",
                "sLengthMenu":     "Afficher _MENU_ Questions   ",
                "sZeroRecords":    "Aucun &eacute;l&egrave;ve &agrave; afficher",
                "sInfo":           "Affichage de la question _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&egrave;ves",
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
 <div class= 'aide' onClick="aide_dgesco()"></div> 
     <br> <input type="submit" value="Valider la saisie" onClick="saisieREPONSE();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  </br> <br> 
<?php $route = $sf_request->getHost(); ?>
<form action="javascript:saisieREPONSE()">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="eleveTable">
    <thead>
    <tr>
	
	
      <th>Eleve</th>
       <th>Question&nbsp;&nbsp;&nbsp;&nbsp;</th>
  <th>saisie réponse</th>
    </tr>
    </thead>
    <tbody onload="pointeur();">
        <?php foreach ($dgescos as $dgesco): ?>
 
	<?php	
		
		//liste des réponses par élève et question
		//-------------------------------------------
		
		 $reponses  = Doctrine_Query::Create()
	   ->select('r.id as reponse_id,r.num_reponse as num_reponse,r.reponse as reponse')
		->from('Reponse r')
		->where ('r.question_id=?',$dgesco['question_id'])
		->fetcharray();	
	?>
	
    <tr>
 	 
      <td><?php echo link_to('<small>'.$dgesco['nom'].'&nbsp&nbsp'.$dgesco['prenom'],'eleve/edit?id='.$dgesco['EleveId'].'#div_dgesco') ?> <?php echo '&nbsp;('.$dgesco['EleveId'].')' ?>
	  <?php  echo '<br><small>'.'&nbsp'.$dgesco['typetab'].'&nbsp'.$dgesco['etab'].'<br>'.$dgesco['rne'].'</small>' ?> <input type="hidden" name='dgesco_id' value="<?php echo $dgesco['dgesco_id']?>" style="width:10px" ></td>
	  <td><?php echo '<small>'.$dgesco['num_question'].'&nbsp;-&nbsp;'.$dgesco['question'].'</small>' ?></td>
	  <td><?php if($dgesco['libelle_reponse']){
			$reponse= substr(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $clef_cryptage, base64_decode($dgesco['libelle_reponse']), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)),0,64);
		    echo '<br><small>Réponse saisie:&nbsp; <FONT color="green">'.$reponse.'</FONT></small><br><p>';
		}else{
			echo '<small>'.$dgesco['reponse_id'].'</small>' ;
		}
		?>	 
								<select id="valReponseId" name="reponse" style="width:auto;font-size:10px;">
								<option value = "" >	</option>
								<?php foreach( $reponses as  $reponse) { ?>		
								<option  value ="<?php echo $reponse['reponse_id']; ?>" 
						
								<?= ( $reponse['reponse'] == $dgesco['reponse_id'] ? 'selected="selected"' : '' ) ?>   >
								<?php echo $reponse['reponse']; ?>
								</option>
								<?php	} ?>
								</select>
							
		</td>
    </tr>
 
        <?php endforeach; ?>
    </tbody>
</table>
</form>


<script>
	
	/* ---- fonction qui envoie les réponses aux questions de la DGESCO */
	
function saisieREPONSE() {
        
		var lesreps = [];
		
			    var REMOTE_ADDR = '<?php echo($_SERVER['REMOTE_ADDR']); ?>';
				var HTTP_HOST = '<?php echo($_SERVER['HTTP_HOST']); ?>';
	    
				if (HTTP_HOST == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) //portail.ac-reunion.fr
				  {
						 var url_dest = 'https://portail.ac-reunion.fr/ashile/frontend.php/dgesco/list1?lesreps=' ;
				
				} else if (HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) { 
						 var url_dest = 'https://portail.ac-reunion.fr/ashilep/frontend.php/dgesco/list1?lesreps=' ;
				  } 
				
				 if ( HTTP_HOST  == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ) // accueil.in.ac-reunion.fr
				  {
						 var url_dest = 'https://accueil.in.ac-reunion.fr/ashile/frontend.php/dgesco/list1?lesreps=';
				 
				 } else if( HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ){
						 var url_dest = 'https://accueil.in.ac-reunion.fr/ashilep/frontend.php/dgesco/list1?lesreps=' ;
				  }    
	             else{ }
		
             

			for (i=0;i<document.getElementsByName("dgesco_id").length;i++)
			{
					  
				if(document.getElementsByName("reponse")[i].value != "")
				{
				//alert(document.getElementsByName("dgesco_id")[i].value);  
				    a=[document.getElementsByName("dgesco_id")[i].value,document.getElementsByName("reponse")[i].value]
					lesreps.push(a)
					
				}
		
			}

	  var url_dest =  url_dest+lesreps+"";
	  document.location.replace(url_dest);
	  //window.location.reload();
	 
  
	}
</script>

<script>
function pointeur() {
document.getElementsByTagName('body')[0].style.cursor = 'default';
}
</script>



<!-- Le second script pour le pop up d'aide -->
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



