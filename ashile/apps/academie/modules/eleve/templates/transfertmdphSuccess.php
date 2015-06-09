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
         <h3> Dossier MDPH > Transfert de dossier MDPH</h3><br><br>		
		<form action="<?php echo url_for('eleve/transfertmdph?flag=1'); ?>"   onsubmit="return verifierNombre(this.elements['eleve_id'],this.elements['mdph_id'],this.elements['eleve_id_recep']);" method="POST">
      
			
		     <?php  if ($message && $sf_request->getParameter('flag')) {?>
			 <fieldset> 
		
			  <?php  if ($eleve[0]['id'] && $eleve_recep[0]['id'] ) {?>
					 	  
					 <?php echo '<br>Transfert du dossier MDPH de<b>&nbsp;:&nbsp;' ?><a href="<?php echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve[0]['id'],  'academie' => 'true')) ?>"> 
					  <?php echo $eleve[0]['nom'].'&nbsp;'.$eleve[0]['prenom'].'&nbsp;('.$eleve[0]['id'].')</b>'?> </a>
							<?php echo '&nbsp;vers <b>&nbsp;' ?>
					<a href="<?php echo link_to_frontend('', array('module' => 'eleve', 'action' => 'edit', 'id' => $eleve_recep[0]['id'],  'academie' => 'true')) ?>"> 
					  <?php echo $eleve_recep[0]['nom'].'&nbsp;'.$eleve_recep[0]['prenom'].'&nbsp;('.$eleve_recep[0]['id'].')</b>'?> </a>
			<?php } ?>	 
				  <?php echo '<br>'.html_entity_decode($message).'<br>' ?>
			  </fieldset> 
		    <?php } ?>
			
			<fieldset> 
         <table>			
		<tfoot>
				      <tr> 
					
				      <td>
					   
						 Saisir l'Id de l'élève qui à un dossier MDPH à transférer (*)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "eleve_id" value="<?php echo $_POST['eleve_id'] ?>"size="5px"><br />
						 <br>Saisir l'Id  du dossier MDPH à transférer (*)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "mdph_id" value="<?php echo $_POST['mdph_id'] ?>"size="5px"><br />
						 <br>Saisir l'Id de l'élève qui reçoit le dossier MDPH (*)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "eleve_id_recep" value="<?php echo $_POST['eleve_id_recep'] ?>"size="5px"><br />
	  				 </br>
  
						   <br> <input type="submit" value="Transfert" />&nbsp; 
	
						
					  </td>
				      </tr>

	   </tfoot>

      </table>
     * champs obligatoire
	 
					
					 
      </form>
	    
    </fieldset>
		</div>


<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>

<script>
function verifierNombre(champ,champ1,champ2) {
var str = champ.value;
var str1 = champ1.value;
var str2 = champ2.value;
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

if (isNaN(str2) && champ2.name == 'eleve_id_recep') {
message = message + " \n- Saisir un nombre pour l'identifiant de l'élève qui reçoit le dossier MDPH : "+ str2 ;
var flag = 1;

}


if(flag == 1){
alert (message);
champ2.focus;
return false;
}


var confirmation = confirm('Confirmez vous le transfert du dossier MDPH ');
if (confirmation){
  //action à faire pour la valeur true
  return true;
}else{
    alert("Abandon de la procédure");
  //action à faire pour la valeur false
   return false;
}

}


function verifierMdph_id (champ) {
var str = champ.value;
var message = "";


return true;

}

</script>

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