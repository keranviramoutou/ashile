<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>

<?php use_helper('Date') ?>
<?php //$eleves = $form->getObject(); ?>


<div>

<?php //echo phpinfo() ?>
  

	<div id="transfert">

	    <div class='aide' onClick="<?php echo url_for('eleve/aide') ?>"> </div> 
		
         <h3> Elèves > Suppression élève</h3>	<br><br>
        <fieldset> 		 
		<form action="<?php echo url_for('eleve/suppr'); ?>" onsubmit="return verifierNombre(this.elements['eleve_id']);" method="POST">
        <table>
		<tfoot>
				      <tr> 
					
				      <td>
					   
						 Saisir l'Id  l'élève à supprimer de la base&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "eleve_id" value="<?php echo $_POST['eleve_id'] ?>" size="5px"><br />
						<br><b>Attention !!</b>: ce traitement entraine la suppression définitive de l'élève <br>et de toutes les informations le concernant de la base de données!!
	  				 </br>
					 <?php  if ($eleve[0]['id'] ) {?>
					 	   <?php echo '<b><u>Elève supprimé :&nbsp;</u>'.$eleve[0]['nom'].'&nbsp;'.$eleve[0]['prenom'].'&nbsp;('.$eleve[0]['id'].')</b><br>' ?>
				    <?php } ?>	   
						   <br> <input type="submit" value="Supprimer" />&nbsp; 
						   
							
							<?php foreach($demandeavs as $demandeavss):?>
									<?php echo 'tttt'.$demandeavss['id'] ?>
						   	<?php endforeach ?>
						
					  </td>
				      </tr>

	   </tfoot>

      </table>
					 <?php  if ($eleve[0]['id'] ) {?>
				
					  	<?php echo '<br><u>Compte-rendu de suppression :</u> <br>'.html_entity_decode($message).'<br>' ?>
					 <?php } ?>
					
					
					 
      </form>
	  * champs obligatoire    
    </fieldset>
		</div>

	

	
	<script>


function verifierNombre(champ) {
var str = champ.value;
if (isNaN(str)) {
alert("Vous n'avez pas saisi un nombre pour identifiant de l'élève! : " + str );
champ.focus();
return false;
}
var confirmation = confirm('Confirmez vous la suppression de la fiche de cet(te) élève');
if (confirmation){
  //action à faire pour la valeur true
  return true;
}else{
    alert("Abandon de la procèdure");
  //action à faire pour la valeur false
   return false;
}


}

</script>





<script>
var src = "<?php echo url_for('eleve/aide') ?>";

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