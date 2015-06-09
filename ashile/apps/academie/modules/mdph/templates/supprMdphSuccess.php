<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>

<?php use_helper('Date') ?>
<?php //$eleves = $form->getObject(); ?>


<div>

<?php //echo phpinfo() ?>
  

	<div id="transfert">

	    <div class='aide' onClick="<?php echo url_for('mdph/aide') ?>"> </div> 
		
         <h3> Dossier MDPH > Suppression d'un dossier MDPH pour un élève</h3>	<br><br>
		 <?php echo 'gggg'.count($this->demandeavs); ?>
		 					 <?php  if ($eleve[0]['id'] && $mdph[0]['id']  ) {?>
				
					  	<?php echo '<fieldset><br><u>Compte-rendu de suppression :</u> <br>'.html_entity_decode($message).'<br>' ?>
						<?php echo '<br>Suppression du dossier MDPH n° '.$mdph[0]['id']. '&nbsp;de<b>&nbsp;:&nbsp;' ?><a href="<?php echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve[0]['id'],  'academie' => 'true')) ?>"> 
					  <?php echo $eleve[0]['nom'].'&nbsp;'.$eleve[0]['prenom'].'&nbsp;('.$eleve[0]['id'].')</b></fieldset>'?> </a>
					 <?php } ?>
					
        <fieldset> 		 
		<form action="<?php echo url_for('mdph/supprMdph'); ?>"   onsubmit="return verifierNombre(this.elements['eleve_id'],this.elements['mdph_id']);" method="POST">
        <table>
		<tfoot>
				      <tr> 
					
				      <td>
        					 Saisir l'Id l'élève &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "eleve_id" value="<?php echo $_POST['eleve_id'] ?>" size="5px"><br />
						 <br>Saisir l'Id  du dossier AESH&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "mdph_id" value="<?php echo $_POST['mdph_id'] ?>" size="5px"><br />
						<br><b>Attention !!</b>: ce traitement entraine la suppression définitive <br>du dossier MDPH de l'élève concerné(e) ! <br>
	  				 </br>
  
						   <br> <input type="submit" value="Supprimer" />&nbsp; 
						
					  </td>
				      </tr>

	   </tfoot>

      </table>

					
					 
      </form>
	  * champs obligatoire    
    </fieldset>
		</div>

	

	
<script>

function verifierNombre(champ,champ1) {
var str = champ.value;
var str1 = champ1.value;
var flag = 0;
var message = "";


if (isNaN(str) && champ.name == 'eleve_id') {
message = "- Saisir un nombre pour l'identifiant de l'élève : "+ str ;
var flag = 1;

}

if (isNaN(str1) && champ1.name == 'mdph_id') {
message = message + " \n - Saisir un nombre pour le dossier MDPH : "+ str1 ;
var flag = 1;


}



if(flag == 1){
alert (message);
champ1.focus;
return false;
}


var confirmation = confirm('Confirmez vous la suppression du dossier MDPH :' + str1);
if (confirmation){
  //action à faire pour la valeur true
  return true;
}else{
    alert("Abandon de la procédure");
  //action à faire pour la valeur false
   return false;
}

}

</script>


<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>


<script>
var src = "<?php echo url_for('mdph/aide') ?>";

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