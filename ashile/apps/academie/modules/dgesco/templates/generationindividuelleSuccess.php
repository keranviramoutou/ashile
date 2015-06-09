<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>

<?php use_helper('Date') ?>
<?php //$eleves = $form->getObject(); ?>


<div>

<?php //echo phpinfo() ?>
  

	<div id="recherche_eleve">
	
	    <div class='aide' onClick="<?php echo url_for('dgesco/aide') ?>"> </div> 
         <h3> Enquêtes > DEGSCO > Génération de l'enquête pour un élève</h3>	<br>		
		<form action="<?php echo url_for('dgesco/generationindividuelle?flag=1'); ?>"  onsubmit="return verifierNombre(this.elements['eleve_id']);"  method="POST">
    
			
		     <?php  if ($message && $sf_request->getParameter('flag')) {?>

		    <?php } ?>
			
			<fieldset> 
         <table>			
		<tfoot>
				      <tr> 
					
				      <td>
 
						 Saisir l'Id de l'élève pourqui il faut génèrer les questions de l'enquête DGESCO (*)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "eleve_id" value="<?php echo $_POST['eleve_id'] ?>"size="5px"><br />

	  				    </br>NB : Un contrôle est effectué pour vérifier que l'élève à une scolarité "ordinaire" à ce jour.<br>
  
						   <br> <input type="submit" value="Génération" />&nbsp; 
	
					  </td>
				      </tr>

	   </tfoot>

      </table>
     * champs obligatoire
					
					 
      </form>
	    
    </fieldset>
		</div>
		
		
<script>
function verifierNombre (champ) {
var str = champ.value;
if (isNaN(str)) {
alert("Vous n'avez pas saisi un nombre pour identifiant de l'élève!");
champ.focus();
return false;
}
return true;

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