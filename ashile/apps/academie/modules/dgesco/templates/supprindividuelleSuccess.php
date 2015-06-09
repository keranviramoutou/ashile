<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>

<?php use_helper('Date') ?>
<?php //$eleves = $form->getObject(); ?>


<div>

<?php //echo phpinfo() ?>
  

	<div id="transfert">
	
	    <div class='aide' onClick="<?php echo url_for('dgesco/aide') ?>"> </div> 
         <h3> Enquêtes > DEGSCO > Suppression de l'enquête pour un élève</h3>	<br>		
		<form action="<?php echo url_for('dgesco/supprindividuelle'); ?>"  onsubmit="return verifierNombre(this.elements['eleve_id']);"  method="POST">
 
			
		     <?php  if ($message && $sf_request->getParameter('flag')) {?>

		    <?php } ?>
			
			<fieldset> 
         <table>			
		<tfoot>
				      <tr> 
					
				      <td>
 
						 Saisir l'Id de l'élève pourqui il faut supprimer les questions de l'enquête DGESCO (*)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "eleve_id" value="<?php echo  $sf_request->getParameter('eleve_id') ?>"size="5px"><br />

	  		            
  
						   <br> <input type="submit" value="Supprimer" />&nbsp; 
	
					  </td>
				      </tr>

	   </tfoot>

      </table>
     * champs obligatoire
		
					 
    </form>
	    
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
var confirmation = confirm('Confirmez vous la suppression de l\'enquête pour cet élève');
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
var src = "<?php echo url_for('dgesco/aide') ?>";

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